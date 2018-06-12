<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Wylogowanie</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="../css/MyStyle.css">
</head>

<body>
    <div class="form">
          <h1>Dziekuje za odwiedzenie mojej strony</h1>
              
          <p><?= 'Zostales wylogowany'; ?></p>
          
          <a href="../index.php"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>
