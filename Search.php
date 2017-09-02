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
      getNav();?>
    </div>
    <div class="search">
    <?php
    //Check The Search if They By Name , Or By Price , Or By Three(Name And Two Price)
  
      if(isset($_POST['search']))
      {
          if(isset($_POST['searchbyname'])&&isset($_POST['price1'])&&isset($_POST['price2']))
            {
              if(strlen($_POST['searchbyname'])>0&&strlen($_POST['price1']>0)&&strlen($_POST['price2'])>0)
              {

              $searcharr=array();
              $price1=(int)($_POST['price1']);
              $price2=(int)($_POST['price2']);
              $str=($_POST['searchbyname']);
              $db=new dbclass();
              $searcharr=$db->SearchPriceAndName($str,$price1,$price2);
              foreach ($searcharr as $productsearch) {
               echo '
                       <form action ="ProductDetails" method="post">
                       <div class="col-md-4 portfolio-item">
                       <img src="' . $productsearch->getimage() . '" alt="Screen shot" height="200" width="200" />
                       <h3>'.$productsearch->getProductName().'</h3>
                       <div style="height:80px; overflow:hidden">'.$productsearch->getDescription() .'</div>
                       <a href="ProductDetails.php?productId='.$productsearch->getProductId().'" > למידע נוסף</a>
                       </form>
                       </div>';
                  }
                }
                elseif(strlen($_POST['searchbyname'])>0)
                {   
                    $db=new dbclass();
                    $searchArr=array();
                    $str=($_POST['searchbyname']);
                    $searchArr= $db->SearchByNameProduct((string)$str);
                   foreach ($searchArr as $productsearch) {
                     echo '
                    <form action ="ProductDetails" method="post">
                    <div class="col-md-4 portfolio-item">
                    <img src="' . $productsearch->getimage() . '" alt="Screen shot" height="200" width="200" />
                    <h3>'.$productsearch->getProductName().'</h3>
                    <div style="height:80px; overflow:hidden">'.$productsearch->getDescription() .'</div>
                    <a href="ProductDetails.php?productId='.$productsearch->getProductId().'" > למידע נוסף</a>
                    </form>
                    </div>';
                  }
                }
        elseif(strlen($_POST['price1']>0)&&strlen($_POST['price2'])>0)
        {
        
                 $db=new dbclass();
                 $searcharr=array();
                  $price1=(int)($_POST['price1']);
                  $price2=(int)($_POST['price2']);
                  
                  $searcharr=$db->SerachByPriceProduct($price1,$price2);
                  foreach ($searcharr as $productsearch) {
                         echo '
                    <form action ="ProductDetails" method="post">
                     <div class="col-md-4 portfolio-item">
                    <img src="' . $productsearch->getimage() . '" alt="Screen shot" height="200" width="200" />
                    <h3>'.$productsearch->getProductName().'</h3>
                    <div style="height:80px; overflow:hidden">'.$productsearch->getDescription() .'</div>
                    <a href="ProductDetails.php?productId='.$productsearch->getProductId().'" > למידע נוסף</a>
                    </form>
                  </div>';
                }

       }
       else{
        header("Location: index.php");
       }



                }

            }
       
     

     
   
?>

    </div>
  
    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>