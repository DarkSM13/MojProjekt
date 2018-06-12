<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sukces</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="../css/MyStyle.css">
</head>
<body>
<div class="form">
    <h1>Sukces</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location:../index.php" );
    endif;
    ?>
    </p>     
    <a href="../index.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>




