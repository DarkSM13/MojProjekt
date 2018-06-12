<?php
session_start();
require_once "../Login/db.php";

if($_SESSION['logged']==1)
{
    $UserID=$_SESSION['user_id'];
    if(isset($_POST['delete_file_txt'])){
    $id=$_POST['delete_file_txt'];
    $sql="DELETE FROM txtfiles WHERE id_txtfile=$id AND id_user=$UserID";
    $mysqli->query($sql);
    header("location:uploadtxt.php");
           
    }
       
    if(isset($_POST['delete_file_jpg'])){
    $id=$_POST['delete_file_jpg'];
    $r=$mysqli->query("Select * from jpgfiles where id_jpgfile=$id;");
    $row=$r->fetch_assoc();
    $delete = unlink($row['name']);
    if($delete) {
    $sql="DELETE FROM jpgfiles WHERE id_jpgfile=$id AND id_user=$UserID";
    $mysqli->query($sql);
    header("location:uploadjpg.php");
    }      
    }
    
       if(isset($_POST['delete_file_pdf'])){
    $id=$_POST['delete_file_pdf'];
    $r=$mysqli->query("Select * from pdffiles where id_pdffile=$id;");
    $row=$r->fetch_assoc();
    $delete = unlink($row['name']);
    if($delete) {
    $sql="DELETE FROM pdffiles WHERE id_pdffile=$id AND id_user=$UserID";
    $mysqli->query($sql);
    header("location:uploadpdf.php");
    }      
    } 
        if(isset($_POST['delete_file_mp3'])){
    $id=$_POST['delete_file_mp3'];
    $r=$mysqli->query("Select * from mp3files where id_mp3file=$id;");
    $row=$r->fetch_assoc();
    $delete = unlink($row['name']);
    if($delete) {
    $sql="DELETE FROM mp3files WHERE id_mp3file=$id AND id_user=$UserID";
    $mysqli->query($sql);
    header("location:uploadmp3.php");
    }      
    }    
    
} 
   

else
{
    $_SESSION['message']="Musisz najpierw się zalogowac";
     header("location:../Login/error.php");
}
   

?>