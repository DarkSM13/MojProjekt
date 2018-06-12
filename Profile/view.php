<?php
session_start();
require_once "../Login/db.php";
$UserID=$_SESSION['user_id'];
$active=$_SESSION['active'];

if(!isset($_SESSION['user_id'])||$active===0)
    header("location:profile.php");

if(isset($_GET['id_txtfile'])){
$id=$_GET['id_txtfile'];
$result=$mysqli->query("SELECT * FROM txtfiles where id_txtfile='$id' and id_user='$UserID';");
$files=$result->fetch_assoc();
header("Content-Type:".$files['type']);
echo $files['file_txt'];
}
if(isset($_GET['id_pdffile'])){
$id=$_GET['id_pdffile'];
$result=$mysqli->query("SELECT * FROM pdffiles where id_pdffile='$id' and id_user='$UserID';");
$files=$result->fetch_assoc();

header( 'Content-type: application/pdf' );
header( "Content-Disposition:inline; filename=".$files['name'] );
header('Accept-Ranges:bytes');
@readfile($files['name']);
}

?>