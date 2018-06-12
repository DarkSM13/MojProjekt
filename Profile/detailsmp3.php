<?php
session_start();
require_once "../Login/db.php";
if($_SESSION['logged']==1)
{
    $UserID=$_SESSION['user_id'];
    $active=$_SESSION['active'];
    if(!$active) header("location:profile.php");
    if(!isset($_GET['id_mp3file'])) header("location:uploadmp3.php");
    $id=$_GET['id_mp3file'];
    $result=$mysqli->query("SELECT * FROM mp3files where id_mp3file='$id' and id_user='$UserID';");
    $files=$result->fetch_assoc();
    
 $wynik = str_replace("C:/xampp/htdocs/MojProjekt/FilesMP3/", "http://localhost/MojProjekt/FilesMP3/", $files['name']);
 }
else
{
    $_SESSION['message']="Musisz najpierw się zalogować";
    header("location:../Login/error.php");
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<html >
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" >
  <title>Szczegóły</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../css/MyStyle2.css">
  <link rel="stylesheet" href="../css/MyStyle3.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="form2">
      <h1>Detale pliku MP3</h1>
      
    <embed src="<?= $wynik;?>"  width="60%" height="45" autostart="false" />
       
           <table width="90%">
              <tr><th>         <p>Nazwa: </p> </th><th><div class="detailsName"><?= str_replace("C:/xampp/htdocs/MojProjekt/FilesMP3/$UserID/", "", $files['name'])   ?></div></th></tr>
              <tr><th>         <p>Rozmiar:</p></th><th> <h2><?= $files['size'];   ?> B</h2></th></tr>
              <tr><th>        <p>Typ pliku:</p></th><th> <h2>MP3</h2></th></tr>
              <tr><th>         <p>Data dodania:</p></th><th> <h2><?= $files['tim'];   ?></h2></th></tr>
              <tr><th>         <p>Notatka:</p></th><th> <div class="detailsName"><?= $files['note'];   ?></div></th></tr>
          </table>
          
          <table width="90%" align="center">
              <tr>
                  <td width="33%"><a href="uploadmp3.php"><button class="button button-block" name="return"/>Powrót</button></a></td>
                 <td width="34%"><form action="download.php" method="post"><button class="buttondetailxtxt2 button-block" value="<?=$id?>" name="download_file_mp3"/>Pobierz</button></form></td>
                 <td width="33%"><form action="deletefile.php" method="post"><button class="buttondetailxtxt4 button-block" value="<?=$id?>" name="delete_file_mp3"/>Usuń</button></form></td>
       
              </tr>
              
          </table>
          
    </div>
 
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../js/index.js"></script>

</body>
</html>
