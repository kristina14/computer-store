  

<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
require_once "functions/functions.php";
require_once "functions/FunctionsManager.php";
//require_once "phpToPDF/phpToPDF.php";
getrequire();
//session_start();

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
    <?php  getHead();//Loading Libraries?>
    
    <title>CompStore</title>
  </head>
  <body>
    <div class="row">
      <?php
      getLogoManager();//Loading Logo
        getLoginOutManager();
      getNavManager();
      ?>
    </div>

     <?php 

     function _21()//Function Add Product
     {
     echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">הוספת מוצר</h2>';
         $product=new product();
            getemptyproduct($product);
            PageDesinge($product,0);
	      
        if(fillProduct($product)==false)
          return;

    	
        if(isset($_POST['Submit']))
         {

           $db=new dbclass();
           try {
                  
                 $resultproduct=$db->InsertProductManager($product);
     
                 echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
                 <h2 style="font-style:italic;">הוספת מוצר הצליחה</h2>
                 </div></div><br><br>';
             }
        
          catch (PDOException $e) {
           //echo "יתכו שיש שכפול בקוד של מוצר או שמספר קטגוריה/תתקטגוריה לא נכון ";
		   echo $e;
          }

        }
    }

    function getemptyproduct(product $product)
    {
       $product->setProductName("");

          $product->setUnitPrice(0);
          $product->setdescription("");
          $product->setsubCategoryId("");
          $product->setQuantityProduct(0);


    }


    function _22()//Delete Product
    {
       echo  '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">מחיקת מוצרים</h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%">';
         echo '  
            <label>שם מוצר</label>
           <select name="Product_id">';
           $db=new dbClass();
            $product=array();
            $product=$db->getProduct();
       foreach ( $product as $arr )
              {
                  echo' <option value='.$arr->getProductId().'>'.$arr->getProductName().'</option>;
                ';
          }
          echo'   

          </select><br><br><button class="btn btn-default" type="submit" name="deleteproduct">מחיקת מוצר</button></form></div></div>';

          if(isset($_POST['deleteproduct']))
          {
             if(isset($_POST['Product_id']))
             {
             
                $productId=$_POST['Product_id'];
              
                try
                {
                  $check=$db->CheckiFproductInOrder($productId);
                  if(!count($check)){
                  $Delete=$db->DeleteProduct($productId) ;
                  echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">מחיקת מוצר הצליחה</h2>
         </div></div>' ;  
                }
                else
                {
                  echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">לא ניתן למחוק את המוצר. מוצר נמצא בהזמנה שטרם בוצעה.</h2>
         </div></div>';
                  
                }
                }
                catch(PDOException $e)
                {
                  echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">מחיקת מוצר לא הצליחה</h2>
         </div></div>';
                 
                }
             }
           }
    }


    function _23()//UPDATE product
    {
      
       echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">עדכון מוצר</h2>';
         $product=new product();
          getemptyproduct($product);   
          PageDesinge($product,0);
          getIdAndfillDetailes($product);
       if(isset($_POST['Submit']))
       {    
         
          $db=new dbClass();
          $result=array();
          
        
         if(fillProduct($product)==false)
          return;
         
              echo '<pre>';
              print_r($product);
              echo '</pre>';
          try{
			  $result=$db->UpdateProducts($product);
			  echo"הצלחת עדכון מוצר";
		  }
		    catch (PDOException $e) {
           echo "יתכו שיש שכפול בקוד של מוצר או שמספר קטגוריה/תתקטגוריה לא נכון ";
		   
          }
        }
      }

      function  getIdAndfillDetailes(product $product)
      {
          
           if(isset($_POST['Fill'])&&isset($_POST['Product_id']))
           {
              $db=new dbClass();
              $productArr=array();
              $productArr=$db->getproductbyId($_POST['Product_id']);
              foreach ($productArr as $arr) 
              {
                 $product->setProductId($_POST['Product_id']);
                 $product->setProductName($arr->getProductName());
                 $product->setUnitPrice($arr->getUnitPrice());
                 $product->setimage($arr->getimage());
                 $product->setdescription($arr->getDescription());
                 $product->setQuantityProduct($arr->getQuantityProduct());
              }

              PageDesinge($product,1);

           }
      }


      function _24()//View Store Inventory
      {
         $db=new dbClass();
        $prdouctArr=$db->getProduct();
         echo ' <div class="row">
         <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">מוצרים במלאי החנות</h3>
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
                $productDetails=array();
                
               
        foreach ($prdouctArr as $arr) {
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
  echo
             '<form method="POST"> <button type="submit" name="submit" class="btn btn-default" >להוריד דוח </button></form></table>
            </div>
        </div>
    </div>
';
       
            if(isset($_POST['submit']))
                 {
                
               $file=fopen("report.txt","w");
              foreach ($prdouctArr as $arr)
            {
             $productDetails=$db->getProductById($arr->getProductId());
               foreach ($productDetails as $product){
                    $productName=$product->getProductName();
                 }
                  fputs($file,$arr->getProductId());
                  fputs($file,$productName);
                   fputs($file,$arr->getUnitPrice());
                  fputs($file,$arr->getCategoryId() .'\n\n');
                 

            }
             fclose($file);
       }
       

        }
      
  
  function details()
  {
     $db=new dbClass();
        $prdouctArr=$db->getProduct();
         echo ' <div class="row">
        <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
            <h3>מוצרים במלאי החנות</h3>
            <div class="table table-sm" >
                <table class="table">
                    <thead>      <tr>
                            <th>מספר מוצר</th>
                            <th>שם מוצר </th>
                            <th>תמונה</th>
                            <th>מחיר</th>
                            <th>קטגוריה</th>
                            <th>תת קטגוריה</th>
                        </tr> 
                </thead> ';
                $productDetails=array();
                
               
        foreach ($prdouctArr as $arr) {
          $productDetails=$db->getProductById($arr->getProductId());
          foreach ($productDetails as $product) {
            $productName=$product->getProductName();
            //$CustomerAddress=$Customer->getCustomerAddress();
          }
         echo'<tr> 
            <td>'.$arr->getProductId().'</td>
                <td>'.$productName.'</td>
                <td><img src="'.$arr->getimage().'" style="width:80%;"></td>
                <td>'.$arr->getUnitPrice().'</td> 
                <td>'.$arr->getCategoryId().'</td>
                <td>'.$arr->getsubCategoryId().'</td>
              </tr>';
    }
  echo
             ' <button type="submit" class="btn btn-default" name="pdf">להוריד דוח </button></table>
            </div>
        </div>
    </div>
';
  }




     function fillProduct(product $product)//Function return true if all product data is ok else return false
     {
     
       if(isset($_POST['Product_Name'])&&isset($_POST['description'])&&isset($_POST['unit_price'])&&isset($_POST['category_id'])&&isset($_POST['subcategory_id'])&&isset($_POST['ProductAmount']))
      if(isset($_FILES['uploadedfile']['name']))
        {
         
           $target_path = 'images/'.$_FILES['uploadedfile']['name']; 
           $result = move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);

          if($result) {
            $product->setimage("images/".$_FILES['uploadedfile']['name']); 

        
        }
        else {
            echo "There was an error uploading the file, please try again!";
             $product->setimage("");
        } 
         if($_GET['category']==23){
               if(isset($_POST['Product_id']))

           $product->setProductId($_POST['Product_id']); 
         }

        if($_POST['unit_price']<=0)
        { 
          echo ' <div class="row">
        <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
            <h3>אי אפשר להיות מחיר שלילי</h3></div></div><br><br>';
          return false;

        }      
          $product->setProductName($_POST['Product_Name']);

          $product->setUnitPrice($_POST['unit_price']);
          $product->setCategoryId($_POST['category_id']);
          $product->setdescription($_POST['description']);
          $product->setsubCategoryId($_POST['subcategory_id']);
          $product->setQuantityProduct($_POST['ProductAmount']);
          if($_POST['ProductAmount']<=0)
          {
            echo '<div class="row">
        <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
            <h3>אי אפשר להיות כמות שלילית</h3></div></div><br><br>';
            return false;
          }
     }
     return true;
   }

     function PageDesinge(product $prod,int $flag)//Desinge of The Add And UPDATE pages
     {

      if(!$flag)
      {
        echo '
         <form enctype="multipart/form-data" method="POST">
         <input name="uploadedfile" type="file" />';
      }
			echo '<form class="form form-signup" method="POST" style="margin-bottom: 50%">';
			if($_GET['category']!=21&&!$flag)
			{
          echo '  
            <label>מספר מוצר:</label>
           <select name="Product_id">';
           $db=new dbClass();
            $product=array();
            $product=$db->getProduct();
       foreach ( $product as $arr )
              {
                  echo' <option value='.$arr->getProductId().'>'.$arr->getProductId().'</option>;
                ';
          }
          echo'   

          </select> <button class="btn btn-primary" type="submit" name="Fill">אישור</button>'
          ;

				return;
			}

	             if($_GET['category']!=21)
               {
                  echo '<br>      
                 <br>
                 <label>מספר מוצר</label>
                 <input type="text" value="'.$prod->getProductId().'"  name="Product_id"
               maxlength="9" placeholder="מספר מוצר" >
               <br>';
               }
           echo '
                <label for="inpuid">שם מוצר</label>
                <input type="text" value="'.$prod->getProductName().'" name="Product_Name" class="form-control" maxlength="9"  placeholder="שם מוצר" required autofocus>

                <label for="inputFName">תיאור</label>
                <input type="text" value="'.$prod->getDescription().'" name="description" class="form-control" maxlength="20"  placeholder="תיאור" required>
                <label for="inputLName">מחיר</label>
                <input type="text" value="'.$prod->getUnitPrice().'" name="unit_price" class="form-control" placeholder="מחיר" required><br>';


          echo '  
            <label>קטגוריה:</label>
           <select name="category_id">';
           $db=new dbClass();
            $category=array();
            $category=$db->getCategories();
          
       foreach ( $category as $arr )
              {
                  echo' <option value='.$arr->getCategoryId().'>'.$arr->getCategoryId().'</option>';   
          }
          echo'   
          </select> <br><br> ';
         
         echo '  
            <label>תת קטגוריה:</label>
            <select name="subcategory_id">';

            $subcategory=array();
            $subcategory=$db-> getAllSubCategory();
       foreach ( $subcategory as $arr )
              {
                  echo' <option value='.$arr->getSubCategoryId().'>'.$arr->getSubCategoryId().'</option>;
                ';
          }
          echo'   

          </select> <br><br>
         <label>כמות מוצר </lable>
                <input type="text" name="ProductAmount" value="'.$prod->getQuantityProduct().'" class="form-control" placeholder="כמות מוצר " maxlength="15" required>
               </form> 
                <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:20%" name="Submit" action="ניהול האתר.php" >הוסף</button>
       </form>
        </div>
    </div>';
     }

      $product=new product();
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