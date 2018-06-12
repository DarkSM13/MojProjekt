<?php

$email=$mysqli->escape_string($_POST['email']);
$result=$mysqli->query("SELECT * FROM Users WHERE email='$email'");

if($result->num_rows==0){
    $_SESSION['message']="Użytkownik o takim adresie nie istnieje";
header("location:Login/error.php");
}
else
{
    $user=$result->fetch_assoc();
    
    if(password_verify($_POST['password'],$user['password']))
    {
        $_SESSION['email']=$user['email'];
        $_SESSION['name']=$user['name'];
        $_SESSION['surname']=$user['surname'];
        $_SESSION['active']=$user['active'];
        $_SESSION['user_id']=$user['id'];
        
        $_SESSION['logged']=TRUE;
       header("location:Profile/profile.php");
    }
  else{
$_SESSION['message']="Złe hasło";
header("location:Login/error.php");
    }
    
    
}




?>