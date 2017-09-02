<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
require_once "functions/functions.php";
//session_start();
getrequire();
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
    <?php  getHead();?>
    <link href="ProductDetails.css">
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
      getNav();?>
    </div>
    <div>
    <?php
    //Load All Product Details 
        $db=new dbclass();
        if(isset($_GET['productId']))
        {

          $res=$_GET['productId'];
          $productArr=array();
          $productArr=$db->getProductById($res);
          $_SESSION['ProductId']=$_GET['productId'];
          $str=(string)$productArr[0]->getUnitPrice();
         foreach ($productArr as $product) {
          echo '

          <div class="col-md-2 pull-right"></div>

          <div class="col-md-3 portfolio-item pull-right" style="margin-top:3%">

         <div  style="height:100%; margin-bottom:5%; " class="pull-right text-right row" overflow:auto">'.$product->getDescription().'</div> 
         <br>

         <div style="color:blue;"><h5>מחיר יחידה: '.$str.'</h5></div>
         <form method="post" action="BuyOneProduct.php">
       <button  type="submit" name="Buy" class="btn btn-default pull-left">לקנייה לחץ כאן </button></form>
         <br><br>
         <form method="post" action="BuyOneProduct.php">
        <button type="submit" name="addToBasket" class="btn btn-default pull-left" style="margin-bottom:15%;"><img src="images/shopping_basket_add_24px_1187401_easyicon.net.ico">הוסף לסל</button></form>
         </div>

         
         

<div class="col-md-4 portfolio-item">
         <div class="container  col-xs-5 col-sm-5 pull-right text-right style="text-algin:center; margin-top:3%;">
        <img src="' . $product->getimage() . '" alt="Screen shot" height="400" width="400" />

         <h3 style="margin-bottom:20%; ">'.$product->getProductName().'</h3>
        
        </div>

         </div>';

    }

      }
    ?>
    </div>
    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>