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
    <?php  getHead();/*Loading Libraries*/?>
    
    <title>CompStore</title>
  </head>
  <body>
    <div class="row">
      <?php
      getLogoManager();/*Loading Logo*/
      getLoginOutManager();/*Login Manager */
   
      getNavManager();
      ?>
    </div>
      <?php

      //function of out of stock products 
      function _61()
      {   $db=new dbClass();
          $productarr=array();
          $productarr=$db->ProductOutOfStock();//using query 
           
   
         $str="מוצרים שאזלו מהמלאי";
          tabledisieng($str);
          $productDetails=array();
          //put data in table      
        foreach ($productarr as $arr) {
          $productDetails=$db->getProductById($arr->getProductId());
          foreach ($productDetails as $product) {
            $productName=$product->getProductName();
            //$CustomerAddress=$Customer->getCustomerAddress();
          }
         echo'<tr> 
            <td>'.$arr->getProductId().'</td>
                <td>'.$productName.'</td>
                <td><img src="'.$arr->getimage().'" style="width:40%; hight:30%;"></td>
                <td>'.$arr->getUnitPrice().'</td> 
                <td>'.$arr->getCategoryId().'</td>
                <td>'.$arr->getsubCategoryId().'</td>
              </tr>';
    }
     echo '<form method="POST">
    <button type="submit" name="ReportOutofStock" class="btn btn-primary">להוריד דוח</button>
    </form>';
  }
  function tabledisieng (string $str)
  {
    //table desing
          echo ' <div class="row">
         <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">'.$str.'</h3>
            <div class="table table-sm" style="margin-bottom:15%;" >
                <table class="table" dir="ltr">
                    <thead>      <tr>
                            <th>מספר מוצר</th>
                            <th>שם מוצר </th>
                            <th>תמונה</th>
                            <th>מחיר</th>
                            <th>קטגוריה</th>
                            <th>תת קטגוריה</th>
                        </tr> 
                </thead> ';

  }

    if(isset($_POST['ReportOutofStock']))
    {
        
    }



    
          
          

    //function of most lovely product
    function _62()
    {
          $db=new dbClass();
          $productarr=array();
          $productarr=$db->ProductOrder();//get all products in order
          foreach ($productarr as $arr)
          {
            $arr->setQuantityInOrder_Product(0);//set product quantity in order as 0
             $arr2=$db->QuantityofProduct($arr->getProductIDInOrder_Product());
             foreach ($arr2 as $arr3) {
              $arr->setQuantityInOrder_Product($arr3->getQuantityInOrder_Product()+$arr->getQuantityInOrder_Product());//sun all quantity of product in order 
             }
         }
         //sort products by quantity 
        for($i=0;$i<count($productarr);$i++)
        {
          for($j=0;$j<count($productarr);$j++)
          {
            if($productarr[$i]->getQuantityInOrder_Product()>$productarr[$j]->getQuantityInOrder_Product())
            {
              $swap=$productarr[$i];
              $productarr[$i]=$productarr[$j];
              $productarr[$j]=$swap;
            }
          }

        }
        $product=array();
        $i=0;
        foreach ($productarr as $arr)
        {
          $product[$i]=$db->getProductById($arr->getProductIDInOrder_Product());
          $i++;  
        }

       $str="מוצרים נדרשים ביותר";
       tabledisieng($str);
                
          //put data in table      
       for($i=0;$i<count($product);$i++)
         {
           
         echo'<tr> 
            <td>'.$product[$i][0]->getProductId().'</td>
                <td>'.$product[$i][0]->getProductName().'</td>
                <td><img src="'.$product[$i][0]->getimage().'" style="width:40%; hight:30%;"></td>
                <td>'.$product[$i][0]->getUnitPrice().'</td> 
                <td>'.$product[$i][0]->getCategoryId().'</td>
                <td>'.$product[$i][0]->getsubCategoryId().'</td>
              </tr>';
            }

      echo '<form method="POST">
    <button type="submit" name="ReportOutofStock" class="btn btn-primary">להוריד דוח</button>
    </form>';
          
    }
       



       if(isset($_GET['category']))
          {
             $category=$_GET['category'];
             $str= '_';
          
           
               $function= $str.$category;
               $function();
                      
          }
      ?>


     <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>