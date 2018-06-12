<?php
session_start();
require_once "../Login/db.php";
if($_SESSION['logged']==1)
{
    $UserID=$_SESSION['user_id'];
    $active=$_SESSION['active'];
    if(isset($_GET['id_txtfile'])){
    $id=$_GET['id_txtfile'];
    $result=$mysqli->query("SELECT * FROM txtfiles where id_txtfile='$id' and id_user='$UserID';");
    $full="view.php?id_txtfile=$id";
    $files=$result->fetch_assoc();
    }
    else header("location:uploadtxt.php");
 }
else
{
    $_SESSION['message']="Musisz najpierw się zalogować";
    header("location:../Login/error.php");
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Szczegóły</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../css/MyStyle2.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="form2">

          <h1>Detale pliku TXT</h1>
           <table width="90%">
              <tr><th>         <p>Nazwa: </p> </th><th><div class="detailsName"><?= $files['name'];   ?></div></th></tr>
              <tr><th>         <p>Data dodania:</p></th><th> <h2><?= $files['tim'];   ?></h2></th></tr>
              <tr><th>        <p>Typ pliku:</p></th><th> <h2>.txt</h2></th></tr>
              <tr><th>         <p>Notatka:</p></th><th> <div class="detailsName"><?= $files['note'];   ?></div></th></tr>
          </table>
          
          <table width="90%" align="center">
              <tr>
                  <td width="25%"><a href="uploadtxt.php"><button class="button button-block" name="return"/>Powrót</button></a></td>
                 <td width="25%"><form action="download.php" method="post"><button class="buttondetailxtxt2 button-block" value="<?=$id?>" name="download_file_txt"/>Pobierz</button></form></td>
                 <?php echo "<td width="."25"."%"."><a href=$full>";?> <button class="buttondetailxtxt3 button-block" name="watch"/>Wartość</button></a></td>
  <td width="25%"><form action="deletefile.php" method="post"><button class="buttondetailxtxt4 button-block" value="<?=$id?>" name="delete_file_txt"/>Usuń</button></form></td>
       
              </tr>
              
          </table>
          
    </div>
 
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../js/index.js"></script>

</body>
</html>
