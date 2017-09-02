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
    <?php  getHead();//loading libraries?>
    
    <title>CompStore</title>
  </head>
  <body>
    <div class="row">
      <?php
      getLogoManager();//loading logo
      getLoginOutManager();//login manager
     
      getNavManager();
      ?>
    </div>
    <div class="managmenetemployes">
        <?php 
          function _41()//add employee
          {

             PageDesign();//design the add and update page
             $employee=new employees();
             $db=new dbClass();
        
              if(isset($_POST['Employee_id'])&&isset($_POST['First_name'])&&isset($_POST['Last_name'])&&isset($_POST['pass'])&&isset($_POST['Manager']))
              {

                $employee->setEmployeesId($_POST['Employee_id']);
                $employee->setFirstName($_POST['First_name']);
                $employee->setLastName($_POST['Last_name']);
                $employee->setPassManager($_POST['pass']);
                $employee->setManager($_POST['Manager']);
          

                try{
                  $employeeArr=$db->InsertEmployee($employee);
                  echo '<div class="row">
  
  <div class="col-md-12">
 
 <img style="width:15%; hight:10%;  margin-right:50%; margin-bottom:5%;" alt="link" src="images/done.png">
 
  <div></div>';
  header("Refresh:1; url=Managerindex.php");

                }
                catch(PDOEXCEPTION $e)
                {
                  echo $e;
                }
               
              }
           

             }

  


              
          
          function _42()//delete employee
          {
            $db=new dbClass();
           DeleteDesing2();
          if(isset($_POST['employeedelete']))
          {
             if(isset($_POST['employee_id']))
             {


                $employeeId=$_POST['employee_id'];
                $employeeOrder=$db->getEmployeeOrder($employeeId);
                foreach ($employeeOrder as $arr) {
                  $db->SetStatusYes("in process",$arr->getOrderId());
                 } 
    
                try
                {
                  if(count($employeeOrder)>0)
                    $deleteEmployeeOrder=$db->DeleteOrderByEmployee($employeeId);
                    $Delete=$db->DeleteEmployee((int)$employeeId) ;
                  echo "מחיקת עובד הצליחה" ;  
                }
                catch(PDOException $e)
                {
                 echo "מחיקת עובד לא הצליחה";
                }
             }
           }

          }


        //Page Desing Of delete Employee
        function DeleteDesing2()
        {   
                       echo  '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">מחיקת עובד</h2>
          <form class="form form-signup" method="POST" style="margin-bottom: 50%">';
         echo '  
            <label>שם עובד</label>
           <select name="employee_id">';
            $db=new dbClass();
            $employee=array();
            $employee=$db-> getEmployeeDetails();
       foreach ( $employee as $arr )
              {
                  echo' <option value='.$arr->getEmployeesId().'>'.$arr->getFirstName().'</option>;
                ';
          }
          echo'   

          </select><br><br><button class="btn btn-default" type="submit" name="employeedelete">מחיקת עובד</button></form></div></div>';

        }
          function _43()//View Employee
          {
              $db=new dbClass();
           $employeeArr=array();
           $employeeArr=$db->getEmployeeDetails();

         echo ' <div class="row">
        <div class="container col-md-2 col-lg-2 col-xs-2 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-8 col-lg-8 col-xs-4 col-sm-4 ">
        <h3 style="margin-top:10%; margin-bottom:5%;">צפייה בעובדים</h3>
            <div class="table" style="margin-bottom:15%;">
                <table class="table" dir="ltr">
                    <thead>      <tr>
                            <th>ת.ז של העובד</th>
                            <th>שם פרטי </th>
                            <th>שם משפחה</th>
                            <th>מנהל/לא</th>
                        </tr> 
                </thead> ';
                $employeedetails=array();
                
          $employee="";  
        foreach ($employeeArr as $arr) {
          $employeedetails=$db->getEmployeeById($arr->getEmployeesId());
          foreach ($employeedetails as $employee) {
                 $employeeName=$employee->getFirstName();
                 $manager=$employee->getManager();
            
           
     echo  ' <tr> 
                   <td>'.$employee->getEmployeesId().'</td>
                     <td>'.$employeeName.'</td>
                     <td>'.$employee->getLastName().'</td>
                     <td>'.$manager.'</td>
              
                   </tr>';
          }
     
    }
  echo
             ' </table>
            </div>
        </div>
    </div>
';
          }

       function PageDesign()
       {

        echo '   <div class="row">
        <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
            <form class="form form-signup" method="POST" style="margin-bottom: 50%">
                <h2 style="margin-top: 20%;margin-bottom:10%"> עובד חדש</h2>
                <label for="inpuid">ת.ז</label>
                <input type="text" name="Employee_id" class="form-control" maxlength="9"  placeholder="ת.ז" required autofocus>
                
                
                <label for="inputFName">שם פרטי</label>
                <input type="text" name="First_name" class="form-control" maxlength="20"  placeholder="שם פרטי" required>
                <label for="inputLName">שם משפחה</label>
                <input type="text" name="Last_name" class="form-control" maxlength="20"  placeholder="שם משפחה" required>
                <label for="selectGender">

                <label for="inputPass">סיסמה</label>
                <input type="password" name="pass" class="form-control" placeholder="סיסמה" maxlength="8" minlength="8" required>
                <small id="passwordHelpInline" class="text-muted"> </small>

                <label for="ReinputPass">אימות סיסמה</label>
                <input type="password" name="pass" class="form-control" placeholder="אימות סיסמה" maxlength="8" minlength="8" required>

       
             
                <label>מהנל כן/לא</label>
                <input type="text" name="Manager" class="form-control" placeholder="כן/לא" maxlength="3" required>


                <button class="btn btn-lg btn-primary btn-block" name="Submit" type="submit" style="margin-top:20%">הרשמה</button>
            </form>
          
        </div>
    </div>';
       }



          

             if(isset($_GET['category']))
          {
             $category=$_GET['category'];
             $str= '_';
            if(isset($_SESSION['Employee']))
            {
              $emp=new employees();
              $db=new dbClass();
              $emp=$db-> getEmployeeById($_SESSION['Employee']);
              if($emp[0]->getManager()=='כן')
             {
             $function= $str.$category;
             $function();
             }
           else
           {
            echo '<div class="row">
         <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
         </div>
         <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
         <h2 style="margin-top: 20%;margin-bottom:10%">הממשק לשימוש המנהל בלבד </h2>
        </div><div>';
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