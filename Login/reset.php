<?php
session_start();
require "db.php";

if(isset($_GET['email'])&&!empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email=$mysqli->escape_string($_GET['email']);
    $hash=$mysqli->escape_string($_GET['hash']);
    
    $result=$mysqli->query("SELECT * FROM Users WHERE email='$email' AND hash='$hash'");
    
    if($result->num_rows==0)
    {
          $_SESSION['message'] = "Zly URL do zmiany hasła";
        header("location: error.php");  
    }
}
else {
    $_SESSION['message']="Bład weryfikacji, spróbuj jeszcze raz";
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Ustaw nowe haslo</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="../css/MyStyle.css">
</head>

<body>
    <div class="form">

          <h1>Wybierz nowe haslo</h1>
          
          <form action="reset_passwd.php" method="post">
              
          <div class="field-wrap">
            <label>
              Nowe haslo<span class="req">*</span>
            </label>
            <input type="password" required name="newpasswd" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Potwierdz nowe haslo<span class="req">*</span>
            </label>
            <input type="password" required name="confirmpasswd" autocomplete="off"/>
          </div>
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="hash" value="<?= $hash ?>">    
              
          <button class="button button-block"/>Zatwierdz</button>
          
          </form>

    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../js/index.js"></script>

</body>
</html>