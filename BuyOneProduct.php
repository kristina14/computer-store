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
      getNav();//loading category OF User Interface?>
    </div>

    <div class="order">

    <?php 

  if(isset($_SESSION['Customer']))//Check if Details of Customer Saved
  {

      $CustomerId=(int)$_SESSION['Customer'];
      $db=new dbClass();

      
  if(isset($_POST['Buy']))
  {
   

         $ord=new order();
         $ord->setOCustomerId($CustomerId);
         $ord->setOrderDate(date("y-m-d"));   
         $ord->setStatus("In Process");
     
              
             if(isset($_SESSION['ProductId']))
                {
                  $productArr=array();
                  $productArr=$db->getProductById($_SESSION['ProductId']);
                  if($productArr[0]->getQuantityProduct()<1)
                  {
                    echo '<div class="row">
                  <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">המוצר לא נמצא זמנית במלאי</h3>
        <img src="images/images.png">
        </div><div>';
                    return;
                  }
                    try{

                        $OrderArr=$db->InsertOrder($ord);
                        $productArr[0]->setQuantityProduct($productArr[0]->getQuantityProduct()-1);
                        $db->UpdateQuantityofProduct($_SESSION['ProductId'],$productArr[0]->getQuantityProduct());
                        $arr=$db->GetMaxId();
                      $OneProduct=$db->InsertOrderProduct($arr,$_SESSION['ProductId'],1);
                        echo '<h2 style="font-style:italic;">ביקשת הועברה לטיפול</h2>
                            <h4 style="font-style:italic;">מספר הזמנה : '.$arr.'</h4>
                           ';

                      }
                     catch(PDOException $e)
                  
                {
                         $e="ההזמנה הזאת בוצעה לפני זה - אי אפשר לעשות הזמנה על אותו מוצר עוד פעם";
                        echo $e;
                        header("Refresh:1;url=index.php");
                }
                }
    }
    if(isset($_POST['addToBasket']))//Add to Order Table 
    {
         $cart=new shoppingcart();
         $cart->setCustomerIdCart($CustomerId);

         if(isset($_SESSION['ProductId'])){
            $cart->setProductIdCart($_SESSION['ProductId']);
         }
         
          $cartArr=array();
          $cartArr=$db->getAllDetailsCartProductByCustomerId($CustomerId);
         
         $flag=0;
          foreach ($cartArr as $arr) {
              if($cart->getProductIdCart()==$arr->getProductIdCart())
              {
                      $cart->setQuantityCart($arr->getQuantityCart());
                      $flag=1;
                      break;
              }
          }
          
         try{
          if($flag==1)
            {   
              
                
                $cartQuantity= $cart->getQuantityCart()+1;
                $result=$db->UpdateShoppingCart($cart->getProductIdCart(),$cart->getCustomerIdCart(),$cartQuantity);    
                 echo '<div class="row">
  
  <div class="col-md-12">
  <ul class="nav nav-justified">  

  <li><img style="width:15%; hight:10%;  margin-right:30%; margin-top:5%;" alt="link" src="images/completedorder.png">
  </li>
    <li><img style="width:20%; hight:15%;   margin-bottom:10%;" alt="link" src="images/thank-you.png">
  </li>
 
  <ul><div></div>';

            }
            else
            {
            
              $cart->setQuantityCart(1);
              $result=$db->InsertShoppingCart($cart);
              echo '<div class="row">
  
  <div class="col-md-12">
  <ul class="nav nav-justified">  

  <li><img style="width:15%; hight:10%;  margin-right:30%; margin-top:5%;" alt="link" src="images/completedorder.png">
  </li>
    <li><img style="width:20%; hight:15%;   margin-bottom:10%;" alt="link" src="images/thank-you.png">
  </li>
 
  <ul><div></div>';
         
            }

            

         }
         catch(PDOException $e)
         {
             echo 'insert is not done';
         }
         
    }
  }
     else 
     {
       
        header("Refresh:0;url=Login.php");
      }

    ?>
     </div>
   <div class="Footer">
      <?php getFooter();?>
    </div>
    
  </body>
</html>