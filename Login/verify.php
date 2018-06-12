<?php
session_start();
require "db.php";

if(isset($_GET['email'])&& !empty($_GET['email']) AND isset($_GET['hash'])&& !empty($_GET['hash']))
{
$email=$mysqli->escape_string($_GET['email']);
$hash=$mysqli->escape_string($_POST['hash']);
$result=$mysqli->query("SELECT * FROM Users WHERE email='$email' AND active='0'");

if($result->num_rows==0){
    $_SESSION['message']="Użytkownik jest już aktywny lub zły URL";
header("location:error.php");
 
}
else
{
  $_SESSION['message']="Konto zostało aktywowane"; 
  $query = $mysqli->query("UPDATE Users SET active='1' WHERE email='$email'");
  $_SESSION['active']=1;
  $ID=$result->fetch_assoc();
  mkdir("../Files/".$ID['id']);
  mkdir("../FilesPDF/".$ID['id']);
  mkdir("../FilesMP3/".$ID['id']);
  header("location:success.php");
}
}
else{
    $_SESSION['message']="Nie udało się aktywować konta"; 
  
   header("location:error.php");
}


?>