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
      getLogoManager();
      getLoginOutManager();
   
      getNavManager();
      ?>
    </div>
    <div class="managmenetCustomer">
      <?php

      function _32()//send Mail
      {

              echo  '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">שליחת מייל ללקוחות  </h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%">';
      
            $db=new dbClass();
            $Customer=array();
            $Customer=$db-> getCustomers();
     echo '
          <textarea class="control-label" name="description" rows="6" placeholder="תיאור"></textarea>
          <br><br>
          <button class="btn btn-default" type="submit" name="SENDMAIL"> אישור</button></form></div></div>';



          if(isset($_POST['SENDMAIL']))
          {
 
            if(isset($_POST['description']))
            {
               foreach ($Customer as $arr) {
               $to=$arr->getCustomeremail();
               $subject='The Computer Shop';
               $message=$_POST['description'];
               $headers='From:TheComputerShop@org.com'."\r\n".'X-Mailer:PHP/' . phpversion();
               mail($to,$subject,$message,$headers);
             }
            }
              

          }




      }

      function _33()//View Customers
      {
          $db=new dbClass();
        $customerArr=$db->getCustomers();

         echo ' <div class="row">
        <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">לקוחות רשומים במערכת </h3>
        <form method="post">
  <div class="input-group col-xs-6">
    <input type="text" class="form-control" placeholder="חיפוש לפי ת.ז"  dir="rtl" name="searchbynamecustomer" maxlength="9" minlength="9">
    <span class="input-group-btn" dir="rtl">
      <button class="btn btn-primary" name="searchcustomer" >
      <span   class="glyphicon glyphicon-search">
      </span> חיפוש
      </button>
    </span>
  </div></form>
  <br><br>';
           
          if(isset($_POST['searchbynamecustomer'])&&isset($_POST['searchcustomer'])) 
          {
            if(strlen($_POST['searchbynamecustomer'])>0){
               CustomerSeacrh();
             }
             else
             {
              return;
             }

           

          }
   
  else
             {
              echo ' <div class="table" style="margin-bottom:15%;" >
                <table class="table" dir="ltr">
                    <thead>      <tr>
                            <th>ת.ז של הלקוח</th>
                            <th>שם הלקוח </th>
                            <th>מספר טלפון</th>
                            <th>עיר</th>
                            <th>איימל</th>
                            <th>מין</th>
                        </tr> 
                </thead> ';
               $customerdetails=array();  
               $customerName="";  
               foreach ($customerArr as $arr) {
                $customerdetails=$db->getCustomerById($arr->getCustomerId());
                foreach ($customerdetails as $customer) {
                $customerName=$customer->getCustomerName();
            //$CustomerAddress=$Customer->getCustomerAddress();
          }
         echo'<tr> 
              <td>'.$arr->getCustomerId().'</td>
                <td>'.$customerName.'</td>
                <td>'.$arr->getCustomerPhone().'</td>
               <td>'.$arr->getCustomerAddress().'</td>
                <td>'.$arr->getCustomeremail().'</td>
                <td>'.$arr->getCustomergender().'</td>

              </tr>';
    }
  echo
             ' </table>
            </div>
        </div>
    </div>
';
             }

      }



      function CustomerSeacrh()
      {
          if(isset($_POST['searchbynamecustomer'])&&isset($_POST['searchcustomer'])) 
          {
             $CustomerArr=array();
             $db=new dbClass();
             $CustomerArr=$db->getCustomerById($_POST['searchbynamecustomer']);
          echo '   <div class="table" style="margin-bottom:15%;" >
                <table class="table" dir="ltr">
                    <thead>      <tr>
                            <th>ת.ז של הלקוח</th>
                            <th>שם הלקוח </th>
                            <th>מספר טלפון</th>
                            <th>עיר</th>
                            <th>איימל</th>
                            <th>מין</th>
                        </tr> 
                </thead> ';
           
          
         echo'<tr> 
              <td>'.$CustomerArr[0]->getCustomerId().'</td>
                <td>'.$CustomerArr[0]->getCustomerName().'</td>
                <td>'.$CustomerArr[0]->getCustomerPhone().'</td>
                <td>'.$CustomerArr[0]->getCustomerAddress().'</td> 
                <td>'.$CustomerArr[0]->getCustomeremail().'</td>
                <td>'.$CustomerArr[0]->getCustomergender().'</td>
              </tr>';
    }
  echo
             ' </table>
            </div>
        </div>
    </div>
';
          }       

     

     //function of sub category delete user 
      function _34()
      {
          $db=new dbClass();
          DeleteDesing();
          if(isset($_POST['customerdelete']))
          {
             if(isset($_POST['Customer_id']))
             {
                $custId=$_POST['Customer_id'];
                $customerorder=$db->getOrderofCustomer($custId);
                try
                {
                  if(count($customerorder)==0)//case of no orders of customer or no orders in proccess
                  {
                   
                    
                     $customerorder=$db->getAllOrderofCustomer($custId);
                     foreach ($customerorder as $arr) 
                     {
                       $db->DeleteOrderProduct($arr->getOrderId());
                       $db-> DeleteEmployeeOrder($arr->getOrderId());
                     } 
                    $db->DeleteProductsShoppingCart($custId); 
                    $deleteCustomerOrder=$db->DeleteOrderByCustomer($custId);
                    $db->DeleteCustomer($custId); 
                    //echo "מחיקת לקוח הצליחה" ;

                  } 
                  else
                  { 
                    echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">ללקוח יש הזמנות בטיפול.. אי אפשר למחוק</h2>
         </div></div>';
          
                  } 
                }
                catch(PDOException $e)
                {
                 echo $e;
                }
             }
           }
      }

//page desing of delete case 
        function DeleteDesing()
        {   
           echo  '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">מחיקת לקוח</h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%">';
         echo '  
            <label>ת.ז של לקוח:</label>
           <select name="Customer_id">';
            $db=new dbClass();
            $customer=array();
            $customer=$db-> getCustomers();
       foreach ( $customer as $arr )
              {
                  echo' <option value='.$arr->getCustomerId().'>'.$arr->getCustomerId().'</option>;
                ';
          }
          echo'   

          </select><br><br><button class="btn btn-default" type="submit" name="customerdelete">מחיקת לקוח</button></form></div></div>';

        }

//function of update user sub category 
        function _35()
        {
               echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">עדכון לקוח</h2>';
         
          $customer=new customers();
           updatedesing($customer,0);
          fillCustomerById($customer);
    
          fillCustomer($customer);
      
       if(isset($_POST['submit']))
       {       
          $db=new dbClass();
          $result=array();
       
          try{
        $result=$db->UpdateCustomer($customer);
        echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">פרטים הלקוח עדכנו</h2>
         </div></div>';
      
      }
        catch (PDOException $e) {
           echo "";
       
          }
        }
        }

  //fill customer data by id 
  function fillCustomerById(customers $customer )
  {
  
    if(isset($_POST['Next']))
    { 
     $db=new dbClass();
     $cusomerArr=$db->getCustomerById($_POST['Customer_id']);
     foreach ($cusomerArr as $arr) 
     {
       $customer->setCustomerId($_POST['Customer_id']);
       $customer->setCustomerName($arr->getCustomerName());
       $customer->setCustomerPhone($arr->getCustomerPhone());
       $customer->setCustomerAddress($arr->getCustomerAddress());
       $customer->setCustomeremail($arr->getCustomeremail());
     }
   
     updatedesing($customer,1);
    }

  }
  function fillCustomer(customers $customer)
  {
    if(isset($_POST['Customer_id'])&&isset($_POST['Customer_name'])&&isset($_POST['phone'])&&isset($_POST['address'])&&isset($_POST['email']))
    {
      $customer->setCustomerId($_POST['Customer_id']);
       $customer->setCustomerName($_POST['Customer_name']);
       $customer->setCustomerPhone($_POST['phone']);
       $customer->setCustomerAddress($_POST['address']);
       $customer->setCustomeremail($_POST['email']);
    }
     
  }



//function of update user desing
       function updatedesing(customers $cust,int $flag)
     {
         
      if(!$flag)
      {
        echo '  
            <form class="form form-signup" method="POST" style="margin-bottom: 50%">
            <label>ת.ז של לקוח</label>
           <select name="Customer_id">';
           $db=new dbClass();
            $customer=array();
            $customer=$db->getCustomers();
       foreach ( $customer as $arr )
              {
                  echo' <option value='.$arr->getCustomerId().'>'.$arr->getCustomerId().'</option>;
                ';
          }
          echo'   

          </select><br><br>
          <button class="btn btn-primary" type="submit" name="Next">המשך</button><br><br> ';
          return;
          
        }
        else
        {
     
             echo '       
       
  
             
          
                <label for="inputFName">שם פרטי</label>
                <input type="text" name="Customer_name" value="'.$cust->getCustomerName().'" class="form-control" maxlength="20"  placeholder="שם פרטי" required>
                <label for="inputLName">שם משפחה</label>
                <input type="text" name="Customer_lastname" value="'.$cust->getCustomerName().'" class="form-control" maxlength="20"  placeholder="שם משפחה" required>
                <label for="inputTown" >כתובת מגורים</label>
                <input type="text" name="address" value="'.$cust->getCustomerAddress().'" class="form-control" placeholder="עיר" maxlength="15" required>


                <label for="inputPhoneNo" >מספר טלפון</label>
                <input type="text" name="phone" value="'.$cust->getCustomerPhone().'" class="form-control" placeholder="מספר פלאפון" maxlength="10" pattern="[0-9]+" minlength="10"   required>

                <label for="inpuEmail">מייל</label>
                <input type="text" name="email" value="'.$cust->getCustomeremail().'" class="form-control" placeholder="מייל" required autofocus>

                <button class="btn btn-lg btn-primary btn-block"  type="submit" name="submit" style="margin-top:20%; margin-bottom:10%;">עדכן</button>
            </form>
       
        </div>
    </div>
  ';
       }
     }

     



       if(isset($_GET['category']))
          {
             $category=$_GET['category'];
             $str= '_';
             $function= $str.$category;
             $function();
          }


      ?>

    </div>
         <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>