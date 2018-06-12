<?php
session_start();
require "db.php";

if($_SERVER['REQUEST_METHOD']=='POST')
{
    
    if ((strlen($_POST['password'])<8) || (strlen($_POST['password'])>20))
{
$_SESSION['message']="Haslo musi zawierac od 8 do 20 symboli";
header("location:Login/error.php");			
}
    
    
    
    if($_POST['newpasswd']==$_POST['confirmpasswd'])
    {
        $new_passwd=password_hash($_POST['newpasswd'],PASSWORD_BCRYPT);
        $email=$mysqli->escape_string($_POST['email']);
        $hash=$mysqli->escape_string($_POST['hash']);
        
        $sql="UPDATE Users SET password='$new_passwd',hash='$hash' WHERE email='$email'";
        
        if($mysqli->query($sql))
        {
            $_SESSION['message']="Twoje haslo zostalo zaktualizowane";
            header("location:success.php");
        }
        
    } 
    else
    {
            $_SESSION['message']="Hasla nie zgadzaja sie";
            header("location:error.php");
    }    
}

?>
