<?php
session_start();

if($_SESSION['logged']==1)
{
    $name=$_SESSION['name'];
    $surname=$_SESSION['surname'];
    $email=$_SESSION['email'];
    $active=$_SESSION['active'];
    $UserID=$_SESSION['user_id'];
          if ( isset($_SESSION['message']) )          
            unset( $_SESSION['message'] );
   
   
}
else
{
    $_SESSION['message']="Musisz najpierw się zalogować";
    header("location:../Login/error.php");
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Strona Domowa</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../css/MyStyle2.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="form">

          <h1>Strona Domowa</h1>
          
          <div class="menu">
              <div class="btn"><a href="profile.php"><i class="fa fa-home"></i>HOME</a></div>
              <div class="btn" ><a href="uploadtxt.php"><i class="fa fa-file-text" aria-hidden="true"></i>TXT</a></div>
              <div class="btn"><a href="uploadpdf.php"><i class="fa fa-file" aria-hidden="true"></i>PDF</a></div>
              <div class="btn"><a href="uploadjpg.php"><i class="fa fa-floppy-o" aria-hidden="true"></i>JPG</a></div>
               <div class="btn"><a href="uploadmp3.php"><i class="fa fa-music" aria-hidden="true"></i>MP3</a></div>
          </div>
           
          <p>

          </p>
          
          <?php
         
             if ( !$active ){
              echo
              '<div class="info">
           Twoje konto nie jest aktywne, prosze potwierdz adres email.
           Bez aktywnego konta nie mozesz dodawac plikow PDF, MP3 i JPG
              </div>';    
          }
          
          ?>
          
          <div class="a"><?php echo $name.' '.$surname; ?></div>
          <p><?= $email ?></p>
          
         

          
          <a href="../Login/logout.php"><button class="button button-block" name="logout"/>Wyloguj</button></a>

          
    </div>
    <div class="form">
        <h1><?php echo date("Y-m-d").", ".date("H:i"); ?></h1>
        <h3>Serwis nie powstal w celach komercyjnych </h3>
    
    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../js/index.js"></script>

</body>
</html>
