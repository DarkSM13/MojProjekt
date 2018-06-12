<?php
require 'db.php';
session_start();


if($_SERVER['REQUEST_METHOD']=='POST')
{
    $email=$mysqli->escape_string($_POST['email']);
    $result=$mysqli->query("SELECT * FROM Users WHERE email='$email'");
    if($result->num_rows==0)
    {
        $_SESSION['message']="Nie ma takiego adresu w bazie";
        header("location: error.php");
    }
    else{
        $user=$result->fetch_assoc();
        $email=$user['email'];
        $hash=$user['hash'];
        $name=$user['name'];
        $_SESSION['message']="Na adres email został wysłany link, dzięki któremu"
                . " wygenerujesz nowe hasło";
            $to=$email;
        $subject='Resetowanie hasla (MojaStrona)';
        $message_b="Cześć '.$name'"            
            ."\n\nAby zresetować hasło kliknij w poniższy link:\n"
            ."http://localhost/MojProjekt/Login/reset.php?email=".$email."&hash=".$hash;
          
            
        
        mail($to,$subject, $message_b );
         
        //Dla tymczasowego
        $_SESSION['message']= "http://localhost/MojProjekt/Login/reset.php?email=".$email."&hash=".$hash;
        header("location:success.php");
        
        
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="../css/MyStyle.css">
</head>

<body>
    
  <div class="form">

    <h1>Ustaw nowe haslo</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Adres email<span class="req">*</span>
      </label>
      <input type="email" required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Reset</button>
    </form>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../js/index.js"></script>
</body>

</html>
