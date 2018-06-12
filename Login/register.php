<?php

$_SESSION['email']=$_POST['email'];
$_SESSION['name']=$_POST['name'];
$_SESSION['surname']=$_POST['surname'];
if($mysqli->connect_errno!=0)
{
$_SESSION['message']="Nie można połączyć się z bazą";
header("location:Login/error.php");
}
elseif (strlen($_POST['password'])<8 || strlen($_POST['password'])>20)
{
$_SESSION['message']="Haslo musi zawierac od 8 do 20 symboli";
header("location: Login/error.php");
}
else{
$name=$mysqli->escape_string($_POST['name']);
$surname=$mysqli->escape_string($_POST['surname']);
$email=$mysqli->escape_string($_POST['email']);
$passwd=$mysqli->escape_string(password_hash($_POST['password'],PASSWORD_BCRYPT));
$hash=$mysqli->escape_string(md5(rand(0,1000)));
$result=$mysqli->query("SELECT * FROM Users WHERE email='$email'") or die ($mysqli->error());

if($result->num_rows!=0){
    $_SESSION['message']="Użytkownik o takim adresie już istnieje";
    
header("location:Login/error.php" );
}
else
{
    $sql="INSERT INTO Users (name,surname,email,password,hash) "
            . "VALUES ('$name','$surname','$email','$passwd','$hash')";
    if($mysqli->query($sql)){
      
        $_SESSION['active']=0;
        $_SESSION['logged']=TRUE;
        $_SESSION['message']=""
                . "Wysłano wiadomość na adres $email\n"
                . "Aby móc korzystać z serwisu potwierdź wiadomość.";
        $to=$email;
        $subject='Weryfikacja konta (MojaStrona)';
        $message_b="Cześć '.$name'"
            . "\n\nDziękuję za rejestracje na stronie,"
            ."\n\nAby korzysać z serwisu potwierdź email:\n"
            ."http://localhost/MojProjekt/Login/verify.php?email=".$email."&hash=".$hash;
          
            
        
        mail($to,$subject, $message_b );
        //Tymczasowo
        $_SESSION['message']="http://localhost/MojProjekt/Login/verify.php?email=".$email."&hash=".$hash;
       header("location: Login/success.php"); 
        
    }
    else{
            $_SESSION['message']="Rejestracja się nie powiodła";
            header("location:error.php");
    }
} 
    
}
?>