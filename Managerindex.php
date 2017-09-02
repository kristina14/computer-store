<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
require_once "functions/functions.php";
require_once "functions/FunctionsManager.php";
getrequire();
//session_start();

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
    <?php  getHead();?>
    
    <title>CompStore</title>
  </head>
  <body>
    <div class="row">
      <?php
      getLogo();
      getLoginOutManager();
      getNavManager();//The Category And SubCategory of The Manager Interface
      ?>
    </div>
    <div class="row2">
    <?php
      echo '<div class="row">
  
  <div class="col-md-12">
  <ul class="nav nav-justified">  

  <li><img style="width:40%; hight:20%;  margin-right:30%;" alt="link" src="images/Welcome-PNG-Transparent.png">
  </li><br>
  <li><img style="width:50%; hight:30%; margin-right:30%;margin-bottom:10%; " alt="link" src="images/Start-Work-Now-Logo.png">
  </li>
  <ul><div></div>';
         ?>
    </div>
  <br><br>  
    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>