<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
require_once "functions/functions.php";
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
      getSearch();
      ProcessLoginOut();
      
      ?>
    </div>
    <div class="row2">
      <?php 
      getNav(); getNewProductTitle();?>
    </div>
   
    <div class="loadProducts">
      <?php 
  //Load Product In The Main Page of User InterFace
      if(!isset($_GET['Page']))
      {
        $_GET['Page']=1;
        $Page=1;
        loadProducts($Page);
      }
      else
      {
        $Page=$_GET['Page'];
        loadProducts($Page);
      }
      
      ?>
    </div>
    <div class="getNextPrev">
    <?php getNextPrev();
     ?>
    </div>
    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>