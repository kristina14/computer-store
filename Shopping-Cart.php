  <?php

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
      getNav();
      ?>
      </div>
    <div class="row3">
    <?php

 
    if(isset($_SESSION['Customer'])){
  

          $cartArr=array();
          $db=new dbclass();
          $CustomerId=(int)$_SESSION['Customer'];
          $cartArr=$db->getAllDetailsCartProductByCustomerId($CustomerId);
           if(count($cartArr)>0)
            {
         echo '<div class="row">
                  <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">מוצרים שיש בסל קניות</h3>
        <form class="form form-signup" method="POST" style="margin-bottom: 20%" >
         <div class="table-responsive" >
         <table class="table"  >
         <thead>';

             $ProductArr=array();
             $totalprice=0; 
              echo ' <div style="text-align:center">  <th>מק"ט</th>
                    <th>שם מוצר</th>
                    <th>מחיר</th>
                    <th>כמות פריט בסל</th>
                    <th>מחיר כללי</th>
                     <br><br>
                    <th style="text-align:right;">תמונה</th>
                    <th></th>
                    <tr></div>';
          foreach ($cartArr as $arr) { 
                $selectcart=(int)$arr->getProductIdCart();
                $ProductArr=$db->getProductById($selectcart);     
                foreach ($ProductArr as $product)
                 {
                echo '
                      <td>'.$product->getProductId().'</td>
                      <td>'.$product->getProductName().' </td>
                      <td>'.$product->getUnitPrice().' </td>
                      <td>'.$arr->getQuantityCart().'</td> 
                      <td>'.$arr->getQuantityCart()*$product->getUnitPrice().'</td>
                      <td><img src="'.$product->getimage().'" style="width:40%; hight:30%;"></td> 
                      <td><button class="btn-info" name="DecProductAmount" value="'.$product->getProductId().'">-</button></td>
                      </tr>' ;
                 $totalprice+=($product->getUnitPrice()*$arr->getQuantityCart());

              } 

            }
      
                      echo '  

                       </thead>
                </table> ';
                echo '
                  <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
       
         <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">';
               $totalprice1=$totalprice+$totalprice*0.17;  
                 echo '<h3 >מחיר כולל לפני מע"ם:'.$totalprice.'₪</h3>
               <h3 > מע"ם:  17%</h3>
               <h3 > מחיר כולל אחרי מע"ם :'.$totalprice1.'₪</h3>
              <button class="btn btn-default" type="submit" ><a href="buy-shopping-cart.php">לקנייה</a></button><br><br><br></form></div></div></div></div>
             ';


  }
  else
  {
      echo '<div class="row">
                  <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">לא קיים מוצרים בסל </h3></div></div>';
  }
}


else
{
  header("Location: Login.php");
}
if(isset($_POST['DecProductAmount']))
{
  $productId=$_POST['DecProductAmount'];
  foreach ($cartArr as $product) 
  {
    $Amount=$product->getQuantityCart();
  
    if($productId==$product->getProductIdCart())
    { 

      $Amount=$product->getQuantityCart()-1;     
      $db->UpdateShoppingCartByCustomerIDANDproduct($CustomerId,$Amount,$productId);
        if($Amount<=0)
      {
        $db->DeleteProductsShoppingCart0($productId,$CustomerId);
      }

    }
  }


}

    header("Refresh:0");


?>
    </div>
 <div class="Footer">
      <?php getFooter();?>
    </div>
</body>

</html>
