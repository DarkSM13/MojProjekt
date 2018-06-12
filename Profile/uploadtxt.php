<?php
session_start();
require_once "../Login/db.php";
if($_SESSION['logged']==1)
{    
    $active=$_SESSION['active'];
    $UserID=$_SESSION['user_id'];
}
else
{
    $_SESSION['message']="Musisz najpierw się zalogować";
    header("location:../Login/error.php");
}
?>



<!DOCTYPE html>
    <html>
 <head>
  <meta charset="UTF-8">
  <title>TXT</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../css/MyStyle2.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
 </head>

   <body>
       
   <?php
   if(isset($_POST['send_file']))
   {
     if($_FILES['myfile']['type']==='text/plain'){
       $name=$_FILES['myfile']['name'];
       $type=$_FILES['myfile']['type'];
       $note=$mysqli->escape_string($_POST['note']);
       $data=file_get_contents($_FILES['myfile']['tmp_name']);
       $sql="INSERT INTO txtfiles (id_user,file_txt,name,note,type) values "
               . "('$UserID','$data','$name','$note','$type');";

           if($mysqli->query($sql)){
                
                $successMsg = 'Dodano do bazy!';
            }
            else $errorMsg ="Nie dodano do bazy";
     }
     else $errorMsg ="Nieprawidłowy typ pliku!";
   }
     ?>
   
       
     <div class="form2">
  <h1>TXT</h1>
  
           <div class="menu">
              <div class="btn"><a href="profile.php"><i class="fa fa-home"></i>HOME</a></div>
              <div class="btn" ><a href="uploadtxt.php"><i class="fa fa-file-text" aria-hidden="true"></i>TXT</a></div>
              <div class="btn"><a href="uploadpdf.php"><i class="fa fa-file" aria-hidden="true"></i>PDF</a></div>
              <div class="btn"><a href="uploadjpg.php"><i class="fa fa-floppy-o" aria-hidden="true"></i>JPG</a></div>
              <div class="btn"><a href="uploadmp3.php"><i class="fa fa-music" aria-hidden="true"></i>MP3</a></div>
          </div>
 
<FORM class="form3" ACTION="uploadtxt.php" METHOD="POST" ENCTYPE="multipart/form-data">
    <h2>Dodaj plik .txt</h2>
  <table class="table table-hover">
      <tr>
          
          <th width="30%">  <h4>Plik:</h4></th>
          
          <th width="70%">  


    
   <div class="input-file-container">  
    <input class="input-file" id="my-file" type="file" name="myfile">
    <label tabindex="0" for="my-file" class="input-file-trigger">Wybierz Plik</label>
  </div>
  
          
          
          </th>
         
    
      </tr>
            <tr>
          
          <th width="30%">  <h4>Notatka:</h4></th>
          
          <th width="70%"> 
          <textarea class="tarea1" name="note" cols="60" rows="3" placeholder="Napisz notatkę dotyczącą pliku..."></textarea>
                
          </th>
          
      </tr>
  </table>
 <p class="file-return"></p>
<br>
<button class="button button-block" name="send_file"/>Wyślij</button>

 
</form>

<?php if(!empty($errorMsg)) echo '<div class="info">'.$errorMsg.'</div>'; ?>
 <?php if(!empty($successMsg)) echo '<div class="info2">'.$successMsg.'</div>'; ?>
  <?php
 
     $q="SELECT count(*)as howMany FROM txtfiles WHERE id_user='$UserID';";
    $r=$mysqli->query($q);
    $many=$r->fetch_assoc();
    if($many['howMany']!=0)
    {
echo '<table class="greyGridTable" width="80%">';
echo "<thead>";
echo "<tr>";
echo "<th>Plik</th>";
echo "<th>Notatka</th>";
echo "<th>Szczegóły</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

    $q="SELECT * FROM txtfiles WHERE id_user='$UserID';";
    $r=$mysqli->query($q);
     
while($row=$r->fetch_assoc()){
    echo "<tr><td>".$row['name']."</td><td>".$row['note']."</td><td><a href=detailstxt.php?id_txtfile=".$row['id_txtfile'].">Szczegoły</a></td></tr>";
}




echo "</tbody>";
echo "</table>";
    }
?>
    </div>
       

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../js/uploadfile.js"></script>   

</body>
    </html>