
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

          function _12()//Function to Add Category
          {
            AddCategoryDesing();
                 
       
          if(isset($_POST['Add']))
          {
            $db=new dbClass();
            $categoriescustomer=new categories();
            $categoriesmanager=new managercategories();
            if(isset($_POST['ManagerCategories_id'])&&isset($_POST['ManagerCategories_name']))
            {
             
                $categoriescustomer->setCategoryId($_POST['ManagerCategories_id']);
                $categoriescustomer->setCategoryName($_POST['ManagerCategories_name']);
                $db->AddNewCategories($categoriescustomer);
                echo '<h2style="font-style:italic;">הופת קטגוריה בהצלחה</h2>';
            }
            $categoriescustomer1=new subcategory();
            if(isset($_POST['ManagerSubCategories_id'])&&isset($_POST['ManagerSubCategories_name']))
            {
             
                $categoriescustomer1->setSubCategoryId($_POST['ManagerSubCategories_id']);
                $categoriescustomer1->setCategoryname($_POST['ManagerSubCategories_name']);
                $categoriescustomer1->setCategoriesID($_POST['ManagerCategories_id']);
                $db->InsertSubCategory($categoriescustomer1);
                echo '<h2 style="font-style:italic;">הוספת תת קטגוריה בהצלה</h2>';

            }


          }

         
          


          }

          function _13()//Function to Delete Category
          {

              $db=new dbClass();
              $categories=array();
              $categories=$db->getCategories();
              echo '  <div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">מחיקת קטגוריות</h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%"><form method="POST">
			              <label>שם קטגוריה :</label>
                     <select name="CategoryName">
					 </form>
			
      ';
             
            foreach ( $categories as $arr )
              {
                  echo' <option  value='. $arr->getCategoryId().'>'.$arr->getCategoryName().'</option>;
                ';
          }

          echo'   
          </select>  <form method="post"> <br><button type="sumbit" calss="btn btn-default" name="DeleteCategory">מחיקת קטגוריה</button>
         
        </form></form></div></div>';
         
              if(isset($_POST['DeleteCategory'])&&isset($_POST['CategoryName']))
              {  

              	$db=new dbclass();
              	$categoryarr=array();
                $Product=$db-> getProductInCategory((int)$_POST['CategoryName']);
			              if(!count($Product)){
                    $deleteSubCategory=$db->DeleteSubCategoryByCategory((int)$_POST['CategoryName']);  
                    $deletecategory=$db->DeleteCategoriesCustomer((int)$_POST['CategoryName']);
                  echo "מחיקת קטגוריה הצליחה";
			  }
                 else
                 {
                  echo "קטגוריה מכילה מוצרים אי אפשר למחוק";
                 }

              }




}
    function _14()//Function Displays Order Management
    {
      $db=new dbClass();
      $OrderArr=$db->getOrderDetails();
      echo  ' <div class="row">
        <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">הזמנות שנמצאות בטיפול</h3>
        <div class="table" style="margin-bottom:15%;">
                <table class="table"  dir="ltr">
                
                    <thead >      <tr>
                            <th>שם המזמין</th>
                            <th>ת.ז המזמין </th>
                            <th>מספר הזמנה </th>
                            <th>תאריך הזמנה</th>
                            <th>סטטוס</th>
                        </tr> 
                </thead> <tbody>';

                $customerDetails=array();
                $CustomerName="aa";
               
        foreach ($OrderArr as $arr) {
          $customerDetails=$db->getCustomerById($arr->getOCustomerId());
          foreach ($customerDetails as $Customer) {
            $CustomerName=$Customer->getCustomerName();
            //$CustomerAddress=$Customer->getCustomerAddress();
          }

         echo'
         <tr>
                <td>'.$CustomerName.'</td>
                <td>'.$arr->getOCustomerId().'</td>
                <td>'.$arr->getOrderId().'</td> 
                <td>'.$arr->getOrderDate().'</td>
                <td>'.$arr->getStatus().'</td>
              </tr>';
    }
  echo  '</tbody> </table>
            </div>
        </div>
    </div>
';
    getdevide();//Using Function To Desing Devide Of Order To Employee
  }


//Function Of Desing of devide 
  function getdevide()
  {

    $emp=array();
    $db=new dbClass();
 
        echo  '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">חילוק הזמנות לעובד</h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%">
           
            <label>שם עובד</label>
           <select name="employee_id">';
            $employee=array();
            $employee=$db-> getEmployeeDetails();
       foreach ( $employee as $arr )
              {
                  if($arr->getManager()==0)
                  echo' <option value='.$arr->getEmployeesId().'>'.$arr->getFirstName().'</option>;
                ';
              }
      echo'</select><br><br>
    <label>מס הזמנה </label>
       <select name="ordnumber">';

            $order=array();
            $order=$db-> getOrderDetails();
            foreach ( $order as $arr )
              {
                  echo' <option value='.$arr->getOrderId().'>'.$arr->getOrderId().'</option>';
              }
    echo'</select><br><br>
     <button class="btn btn-default" type="submit" name="divide">בצע</button>
      </form></div></div>';
      devideOrder();
    
      
  
}


//function to devide orders to employee
function devideOrder()
{

         $db=new dbClass();
   
         if(isset($_POST['divide']))
        {
        if(isset($_POST['employee_id'])&&isset($_POST['ordnumber']))
        {

           if(isset($_SESSION['Employee']))
             $empid=$_SESSION['Employee'];
             $employee=$db->getEmployeeById($empid);
            if($employee[0]->getManager()==1)
            {
              $employeeid=$_POST['employee_id'];
              $orderid=$_POST['ordnumber'];
        
              $str="DONE";
              try
              {
               $db->AddOrderEmployee($orderid,$employeeid);
               $db->SetStatusYes($str,$orderid);
               echo "ההזמנה התאספה לעובד";
              }
              catch(PDOException $e)
              {
                 echo $e;
  
              }
   }

}

}
}


  //Page Desing Of Add Category 
  function AddCategoryDesing()
  {

         echo '
              <div class="row">
            <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
            </div>
             <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
             <form class="form form-signup" method="POST" style="margin-bottom: 50%"  dir="ltr">
                <h2 style="margin-top: 20%;margin-bottom:10%"> הוספת קטגוריה</h2>
                <label for="inpuid">מספר קטגוריה</label>
                <input type="text" name="ManagerCategories_id" class="form-control" maxlength="9"  placeholder="מספר קטגוריה" required autofocus>
                 <label for="inpuid">שם קטגוריה</label>
                 <input type="text" name="ManagerCategories_name" class="form-control" maxlength="9"  placeholder="שם קטגוריה" required autofocus>       
            <label for="inpuid">מספר תת קטגוריה</label>
            <input type="text" name="ManagerSubCategories_id" class="form-control" maxlength="9"  placeholder="מספר תת קטגוריה" required autofocus>
            <label for="inpuid">שם תת קטגוריה</label>
            <input type="text" name="ManagerSubCategories_name" class="form-control" maxlength="9"  placeholder="שם תת קטגוריה" required autofocus>
            <button type="submit" name="Add" class="btn btn-default">הוסף </button>
           </div>
           </form>
           </div> 
           </div>';
  }
   

   //Page Desing Add Small Category
  function AddSmallCategoryDesing()
  {
                $db=new dbClass();
              $categories=array();
              $categories=$db->getCategories();
              echo '   <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">הוספת תת קטגוריה </h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%"><form method="POST">
                    <label>שם קטגוריה  :</label>
                     <select name="CategoryName">
           
        ';
             
            foreach ( $categories as $arr )
              {
                  echo' <option  value='. $arr->getCategoryId().'>'.$arr->getCategoryName().'</option>;
                ';
          }

          echo'   
           </select> <br>
           <form class="form form-signup" method="POST" style="margin-bottom: 50%"  dir="ltr">
           <label for="inpuid">מספר תת קטגוריה</label>
           <input type="text" name="ManagerSubCategories_id" class="form-control" maxlength="9"  placeholder="מספר תת קטגוריה" required autofocus>
           <label for="inpuid">שם תת קטגוריה</label>
           <input type="text" name="ManagerSubCategories_name" class="form-control" maxlength="9"  placeholder="שם תת קטגוריה" required autofocus>
           <button type="submit" name="Add" class="btn btn-default">הוסף </button></form></form></form></div>' ;

  }
       

       function _15()
       {
         $db=new dbClass();
         AddSmallCategoryDesing();
         if(isset($_POST['Add'])&&isset($_POST['ManagerSubCategories_id'])&&isset($_POST['ManagerSubCategories_name'])&&isset($_POST['CategoryName']))
         {
            $subCategory=new subcategory();
            $subCategory->setSubCategoryId($_POST['ManagerSubCategories_id']);
            $subCategory->setCategoryname($_POST['ManagerSubCategories_name']);
            $subCategory->setCategoriesID($_POST['CategoryName']);
            $db->InsertSubCategory($subCategory);
            echo '<h2 style="font-style:italic;">הוספת תת קטגוריה הצליחה</h2>';
         }
        
        }



        function _16()
        {
           $db=new dbClass();
      $OrderArr=$db->getOrderDetailsDONE();
      echo  ' <div class="row">
        <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">הזמנות שבוצעו</h3>
        <div class="table" style="margin-bottom:15%;">
                <table class="table"  dir="ltr">
                
                    <thead >      <tr>
                            <th>שם המזמין</th>
                            <th>ת.ז המזמין </th>
                            <th>מספר הזמנה </th>
                            <th>תאריך הזמנה</th>
                            <th>סטטוס</th>
                        </tr> 
                </thead> <tbody>';

                $customerDetails=array();
                $CustomerName="aa";
               
        foreach ($OrderArr as $arr) {
          $customerDetails=$db->getCustomerById($arr->getOCustomerId());
          foreach ($customerDetails as $Customer) {
            $CustomerName=$Customer->getCustomerName();
            //$CustomerAddress=$Customer->getCustomerAddress();
          }

         echo'
         <tr>
                <td>'.$CustomerName.'</td>
                <td>'.$arr->getOCustomerId().'</td>
                <td>'.$arr->getOrderId().'</td> 
                <td>'.$arr->getOrderDate().'</td>
                <td>'.$arr->getStatus().'</td>
              </tr>';
    }
  echo  '</tbody> </table>
            </div>
        </div>
    </div>
';
    

     
     
        }



           if(isset($_GET['category']))
          {
             $category=$_GET['category'];
             $str= '_';

              $emp=new employees();
              $db=new dbClass();
             $function= $str.$category;
             $function();
           

           }
           
         
    ?>

    


 
    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>