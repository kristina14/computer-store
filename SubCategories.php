<?php
require_once "functions/functions.php";
getrequire();

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
    getNav();?>
  </div>
  <div>
    <?php 
    //Load SubCategory Details of The User InterFace
    $db=new dbclass();
    if(isset($_GET['category']))
    {

      $res=$_GET['category'];
      //$_SESSION['ProductId']=$_GET['productId'];

     $product=$db->getProductBySubCategories($res);
    
     foreach ($product as $product) {
      echo '
      <div class="col-md-4 portfolio-item">
        <img src="' . $product->getimage() . '" alt="Screen shot" height="200" width="200" />
        <h3>'.$product->getProductName().'</h3>
        <div style="height:80px; overflow:hidden">'.$product->getDescription() .'</div>
          <div style="color:blue;"><h5>מחיר יחידה: '.$product->getUnitPrice().'</h5></div>
          <a href="ProductDetails.php?productId='.$product->getProductId().'" > למידע נוסף</a>
        
      </div>';
    }
  }
    ?> 
      <div class="getNextPrev2">
    <?php getNextPrev();
     ?>
    </div>
  </div>
  <div class="Footer">
    <?php getFooter();?>
  </div>
</body>
</html>