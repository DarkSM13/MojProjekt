<?php
session_start();
require_once "Login/db.php";
if(isset($_SESSION['user_id']))
    header("location:Profile/profile.php");
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mój Projekt</title>
   <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/MyStyle.css">
     </head>
    
  <?php
  if($_SERVER['REQUEST_METHOD']=='POST')
  {

      if(isset($_POST['login'])) require "Login/login.php";
      elseif (isset($_POST['register'])) require "Login/register.php";
  }
      
      ?>
<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Rejestracja</a></li>
        <li class="tab active"><a href="#login">Logowanie</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>Witaj!</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              Email<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Haslo<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot"><a href="Login/forgot.php">Przypomnij haslo</a></p>
          
          <button class="button button-block" name="login" />Zaloguj</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1>Zapisz sie za Darmo</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Imie<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='name' />
            </div>
        
            <div class="field-wrap">
              <label>
                Nazwisko<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='surname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Haslo<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />Rejestruj</button>
          
          </form>

        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>

