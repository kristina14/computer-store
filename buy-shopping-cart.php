
<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
require_once "functions/functions.php";
getrequire();?>
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
      getSearch();//loading search
      ProcessLoginOut();//login customer
      ?>
    </div>
    <div class="row2">
      <?php 
      getNav();
      ?>
      </div>

<div clas="row3">
<?php
     
             $cartArr=array();
             $db=new dbclass();
             $order=new order();
             $CustomerId=(int)$_SESSION['Customer'];
             $cartArr=$db->getAllDetailsCartProductByCustomerId($CustomerId);
             $ProductArr=array();
             $productcartshoppingdetails=array();
             $totalprice=0;
              $order->setOrderDate(date("y-m-d"));   
              $order->setOCustomerId($CustomerId);
              $order->setStatus("In Process");
            $productcartshoppingdetails=$db->InsertOrder($order);
            $maxorderid=$db->GetMaxId();
                foreach ($cartArr as $arr) { 
                   $selectcart=(int)$arr->getProductIdCart();
                   $Quantity=(int)$arr->getQuantityCart();
                   try{
                    $OneProduct=$db->InsertOrderProduct( $maxorderid, $selectcart,$Quantity);
                   }catch(PDOException $e){
                   }
                   	
                 }
           echo '<h2 style="font-style:italic;">ביקשת הועברה לטיפול</h2>
                 <h4 style="font-style:italic;">מספר הזמנה : '.$maxorderid.'</h4>
                           ';
                  $db->DeleteProductsShoppingCart($CustomerId);
      

?>
</div>
<div class="Footer">
      <?php getFooter();?>
    </div>
</body>

</html>
