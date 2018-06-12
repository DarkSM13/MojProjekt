<?php
session_start();
require_once "../Login/db.php";
if($_SESSION['logged']==1)
{    
    $active=$_SESSION['active'];
    if(!$active) header("location:profile.php");
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
  <title>PDF</title>
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../css/MyStyle2.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
 </head>

   <body>
       
<?php
    //Konfiguracja
    $maxFileSize = 2621440; 
    $uploadFolder = 'C:/xampp/htdocs/MojProjekt/FilesPDF/'.$UserID;  
    $acceptMIME = 'application/pdf'; 
     
    if(@$_GET['a'] == 'upload')
    	{
    	$pdf = $_FILES['upload_pdf'];
    	if(empty($pdf['error']))
    		{
    		$check = 0;
    			if($pdf['type'] === $acceptMIME) 
    				{
    				$check = 1;
    				
    				}
    
    		$sql="SELECT name FROM PDFFILES WHERE name='".$uploadFolder.'/'.$pdf['name']."'";
                $result=$mysqli->query($sql);
                    
                if($result->num_rows!=0) $check=10; 
                
                
                
                if($check==10)$errorMsg = 'Plik o takiej nazwie juz istnieje';
    		else if($check)
    			{
    			$send_pdf= @move_uploaded_file($pdf['tmp_name'], $uploadFolder.'/'.$pdf['name']);
    			if(!$send_pdf) $errorMsg = 'Wystapil problem podczas kopiowania pliku do wyznaczonego folderu!';
    			else {
                           
                             $successMsg = 'Kopiowanie pliku zakonczone sukcesem!';
                             $note=$mysqli->escape_string($_POST['note']);
                             $sql="insert into pdffiles (id_User,size,name,note) values(".$UserID.",'".$pdf['size']."','".$uploadFolder.'/'.$pdf['name']."','$note')";
                             $mysqli->query($sql);
                    
                        }
                            
                            
                            
                            
                           
    			}
    		else $errorMsg = 'Nieprawidlowy typ pliku!';
    		}
    	else
    		{
    		switch($pdf['error'])
    			{
    			case 1 :
    				$errorMsg = 'Rozmiar pliku przekracza maksymalny dopuszczalny rozmiar ustawiony w konfiguracji php (php.ini)!';
    				break;
    			case 2 :
    				$errorMsg = 'Rozmiar pliku przekracza maksymalny dopuszczalny rozmiar ustawiony w skrypcie!';
    				break;
    			case 3 :
    				$errorMsg = 'Plik nie zostal wyslany w calosci!';
    				break;
    			case 4 :
    				$errorMsg = 'Plik nie zostal wybrany';
    				break;	
    			}
    		}
    	}
    ?>
   
       
     <div class="form2">
  <h1>PDF</h1>
  
           <div class="menu">
              <div class="btn"><a href="profile.php"><i class="fa fa-home"></i>HOME</a></div>
              <div class="btn" ><a href="uploadtxt.php"><i class="fa fa-file-text" aria-hidden="true"></i>TXT</a></div>
              <div class="btn"><a href="uploadpdf.php"><i class="fa fa-file" aria-hidden="true"></i>PDF</a></div>
              <div class="btn"><a href="uploadjpg.php"><i class="fa fa-floppy-o" aria-hidden="true"></i>JPG</a></div>
              <div class="btn"><a href="uploadmp3.php"><i class="fa fa-music" aria-hidden="true"></i>MP3</a></div>
          </div>
 
<form class="form3" enctype="multipart/form-data"  name="posting" action="uploadpdf.php?a=upload" method="post">
    <h2>Dodaj plik .pdf</h2>
  <table class="table table-hover">
      <tr>
          
          <th width="30%">  <h4>Plik:</h4></th>
          
          <th width="70%">  


    
   <div class="input-file-container">  
    <input class="input-file" id="upload_picture" type="file" name="upload_pdf">
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
<button class="button button-block" name="pdf_send"/>Wyślij</button>
 
</form>
 <?php if(!empty($errorMsg)) echo '<div class="info">'.$errorMsg.'</div>'; ?>
 <?php if(!empty($successMsg)) echo '<div class="info2">'.$successMsg.'</div>'; ?>

   <?php
 
     $q="SELECT count(*)as howMany FROM pdffiles WHERE id_user='$UserID';";
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

    $dir = opendir($uploadFolder);
    while($file = readdir($dir)) if($file != '.' && $file != '..') $read_file[] = $file;
    closedir($dir);
    @sort($read_file);
    $r=$mysqli->query("Select * from pdffiles where id_User=$UserID;");
 //   echo '<br /><b><u>Pliki:</u></b><br />';


    
while($row=$r->fetch_assoc()){
    echo "<tr><td>".str_replace("C:/xampp/htdocs/MojProjekt/FilesPDF/$UserID/", "", $row['name'])."</td><td>".$row['note']."</td><td><a href=detailspdf.php?id_pdffile=".$row['id_pdffile'].">Szczegoły</a></td></tr>";
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