<?php

session_start();
require_once "../Login/db.php";
$UserID=$_SESSION['user_id'];
$active=$_SESSION['active'];
if(!isset($_SESSION['user_id'])||$active===0)
    header("location:profile.php");
if(isset($_POST['download_file_txt'])){
$id=$_POST['download_file_txt'];
$result=$mysqli->query("SELECT * FROM txtfiles where id_txtfile=$id and id_user='$UserID';");
$files=$result->fetch_assoc();
$filename = $files['name'];
$file = $files['file_txt'];
header("Content-Disposition: attachment; filename=$filename");
ob_clean();
flush();
echo $file;
}
if(isset($_POST['download_file_jpg'])){
$id=$_POST['download_file_jpg'];
$result=$mysqli->query("SELECT * FROM jpgfiles where id_jpgfile=$id and id_user='$UserID';");
$files=$result->fetch_assoc();
$file = $files['name'];
    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    
    //Use the switch-generated Content-Type
    header("Content-Type: image/jpg");
 
    //Force the download
    @$header="Content-Disposition: attachment; filename=".str_replace("C:/xampp/htdocs/MojProjekt/Files/$UserID/", "", $file).";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$files['size']);
    @readfile($file);
    
echo $file;
}
if(isset($_POST['download_file_pdf'])){
$id=$_POST['download_file_pdf'];
$result=$mysqli->query("SELECT * FROM pdffiles where id_pdffile=$id and id_user='$UserID';");
$files=$result->fetch_assoc();
$file = $files['name'];
    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    
    //Use the switch-generated Content-Type
    header("Content-Type:application/pdf");
 
    //Force the download
    @$header="Content-Disposition: attachment; filename=".str_replace("C:/xampp/htdocs/MojProjekt/FilesPDF/$UserID/", "", $file).";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$files['size']);
    @readfile($file);
    
echo $file;
}
if(isset($_POST['download_file_mp3'])){
$id=$_POST['download_file_mp3'];
$result=$mysqli->query("SELECT * FROM mp3files where id_mp3file=$id and id_user='$UserID';");
$files=$result->fetch_assoc();
$file = $files['name'];
    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    
    //Use the switch-generated Content-Type
    header("Content-Type:audio/mpeg");
 
    //Force the download
    @$header="Content-Disposition: attachment; filename=".str_replace("C:/xampp/htdocs/MojProjekt/FilesMP3/$UserID/", "", $file).";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$files['size']);
    @readfile($file);
    
echo $file;




}
?>