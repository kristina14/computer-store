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

        if(isset($_POST['OK'])&&isset($_POST['OrderId']))
        {
           $OrderId=$_POST['OrderId'];
           $db=new dbClass();
           $productArr=array();
           $productArr=$db->getOrderProductDetails($OrderId);
        echo  ' <div class="row">
         <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">מוצרים של הזמנה </h3>
        <div class="table" style="margin-bottom:15%;">
                <table class="table"  dir="ltr">
                    <thead >      <tr>
                            <th>מספר מוצר</th>
                            <th>כמות</th>
                        </tr> 
                </thead> <tbody> ';
                 foreach ($productArr as $arr) {
       echo '
         <tr>   
                <td>'.$arr->getProductIDInOrder_Product().'</td>
                <td>'.$arr->getQuantityInOrder_Product().'</td>
              </tr>';
    }
  echo  '</tbody> </table>
            </div>
        </div>
    </div>
          ';
          UpdateProductAmount($OrderId);
              }
            


            function UpdateProductAmount(int $OrderId)
            {
              $db=new dbClass();
              $productArr=array();
              $productArr=$db->getOrderProductDetails($OrderId);
           
              echo  
              '
          <div class="row">
           <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
            </div>
            <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
            <h2 style="margin-top: 20%;margin-bottom:10%">עדכון </h2>
           <form  method="post" style="margin-bottom:50%">
        
             <label>מס מוצר </label>
             <select name="ProductNum">';

              foreach ( $productArr as $arr )
              {
                  echo' <option value='.$arr->getProductIDInOrder_Product().'>'.$arr->getProductIDInOrder_Product().'</option>';
              }

              echo'</select><br><br>
             
              <input type="text" name="ProductQuantity"  placeholder="כמות מוצר לחזרה " maxlength="9" pattern="[0-9]+">
              <br><br>
             <button class="btn btn-primary" type="submit" name="ProductSubmit">סיום הזמנה</button>
          </form></div></div>';
              echo '<pre>';
              print_r($_POST);
              echo '</pre>';
              if(isset($_POST['ProductSubmit'])&&isset($_POST['ProductNum'])&&isset($_POST['ProductQuantity']))
              {
                 echo '<pre>';
                 print_r($_POST);
                 echo '</pre>';
                 $productQuantity=$_POST['ProductQuantity'];
                 $ProductId=$_POSt['ProductNum'];
                 $quantity=$db->getQuantityByProductIDInOrder($ProductId);
              }
              else
              {
              echo '<pre>';
              print_r($_POST);
              echo '</pre>';
              }
            }

?>
     </div>
  <br><br>  
    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>