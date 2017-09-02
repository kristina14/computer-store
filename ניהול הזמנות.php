
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
       function _14()//Function Displays Order Management
    {
      $db=new dbClass();
      $OrderArr=$db->getOrderDetails();
        if(isset($_SESSION['Employee']))
        {
          $emp=new employees();
         $emp=$db-> getEmployeeById($_SESSION['Employee']);
          if($emp[0]->getManager()=='כן')
          {
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
    getdevide2();//Using Function To Desing Devide Of Order To Employee
  }
  else
  {
    echo '<div class="row">
        <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">פונקציה זו לשימוש מנהל בלבד</h3><div><div>';
  }
  }

  }


//Function Of Desing of devide 
  function getdevide2()
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
                  if($arr->getManager()=='לא')
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
      devideOrder2();
    
      
  
}


//function to devide orders to employee
function devideOrder2()
{

         $db=new dbClass();
    
         if(isset($_POST['divide']))
        {
        if(isset($_POST['employee_id'])&&isset($_POST['ordnumber']))
        {

      
              $employee=$db->getEmployeeById($_POST['employee_id']);
              $employeeid=$_POST['employee_id'];
              $orderid=$_POST['ordnumber'];
              
              $str="DONE";
              try
              {
             
               $db->AddOrderEmployee($orderid,$employeeid);
         
               $db->SetStatusYes($str,$orderid);
               echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">ההזמנה נוספה לעובד</h2>
         </div></div>';
            
               header("Location :ניהול הזמנות.php");
           
             }
              catch(PDOException $e)
              {
                 echo $e;
              }
   }

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


function _17()
{
    if(isset($_SESSION['Employee']))
    {
       $db=new dbClass();
       $emp=$_SESSION['Employee'];
       $emporder=array();
       $emporder=$db->getorderByEmployee($emp);
         echo  ' <div class="row">
        <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">הזמנות שלי</h3>
        <div class="table" style="margin-bottom:15%;">
                <table class="table"  dir="ltr">
                
                    <thead >   
                    <tr>
                            <th>מספר הזמנה  </th>
                            <th>תאריך הזמנה</th>
                            <th>סטטוס</th>
                    </tr> 
                </thead>';
       foreach ($emporder as $arr) {
         $orderByemp=$db->getOrderById($arr->getOrderId());
         foreach ($orderByemp as $arr2) {    
echo '
         <tr>
                <td>'.$arr2->getOrderId().'</td> 
                <td>'.$arr2->getOrderDate().'</td>
                <td>'.$arr2->getStatus().'</td>
              </tr>';
    }
 
         
       } 
        echo  '</table>
            </div>
        </div>
    </div>
          ';
       orderemployee($emporder); 
     }
}
//Function to delete employee order while dne 
    function orderemployee($emporder)
     {
      $db=new dbClass();
       echo  '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">שינוי מצב הזמנה </h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%">
         <label>מס הזמנה </label>
          <select name="ordnumber">';

          
            foreach ( $emporder as $arr )
              {
                  echo' <option value='.$arr->getOrderId().'>'.$arr->getOrderId().'</option>';
              }
              echo'</select><br><br>
             <button class="btn btn-default" type="submit" name="DeleteOrder">סיום הזמנה</button>
             </form></div></div>';
            
          if(isset($_POST['DeleteOrder']))
          {
              if(isset($_POST['ordnumber']))
              {
                 $str="End Process";
                 $orderid=$_POST['ordnumber'];
                 try
                 {
                  $db->SetStatusYes($str,$orderid);
                 }
                 catch(PDOEXCEPTION $E)
                 {
                  echo $E;
                 }
                 
              }
          }



       }

        //Ok
       function _18()
       {
         $db=new dbClass();
       echo  '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">שינוי מצב הזמנה </h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%;" action="UPDATE-Order-Product.php">
          <label>מס הזמנה </label>
          <input type="text" name="OrderId" class="form-control" placeholder="ת.ז" maxlength="9"><br><br> 
          <button type="submit" name="OK" class="btn btn-primary">אישור</button></form></div></div>';
       
        
       }



     /*  function showOrderProduct()
       {
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
             
              <input type="text" name="ProductQuantity" class="form-control" placeholder="כמות מוצר לחזרה " maxlength="9" pattern="[0-9]+">
              <br><br>
             <button class="btn btn-default" type="submit" name="ProductSubmit">סיום הזמנה</button>
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
            }*/
        


       





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