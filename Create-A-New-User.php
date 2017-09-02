<?php
require_once "functions/functions.php";
getrequire();
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
      ?>
      </div>
    <div class="row2">
      <?php  
      getNav();?>
    </div>

    <div class="row">
        <div class="container col-md-5 col-lg-5 col-xs-3 col-sm-3">
            <!--Empty 5 Columns to Move form-signin to the center-->
        </div>
        <div class="container col-md-3 col-lg-3 col-xs-5 col-sm-5 ">
            <form class="form form-signup" method="POST" style="margin-bottom: 50%">
                <h2 style="margin-top: 20%;margin-bottom:10%"> משתמש חדש</h2>
                <label for="inpuid">ת.ז</label>
                <input type="text" name="Customer_id" class="form-control" maxlength="9" pattern="[0-9]+" minlength="9" placeholder="ת.ז" required autofocus>
                
                
                <label for="inputFName">שם פרטי</label>
                <input type="text" name="Customer_name" class="form-control" maxlength="20"  placeholder="שם פרטי" required>
                <label for="inputLName">שם משפחה</label>
                <input type="text" name="Customer_lastname" class="form-control" maxlength="20"  placeholder="שם משפחה" required>
                <label for="selectGender">

                <label for="inputPass">סיסמה</label>
                <input type="password" name="pass" class="form-control" placeholder="סיסמה" maxlength="8" minlength="8" required>
                <small id="passwordHelpInline" class="text-muted"> </small>

                <label for="ReinputPass">אימות סיסמה</label>
                <input type="password" name="pass" class="form-control" placeholder="אימות סיסמה" maxlength="8" minlength="8" required>

                    מין:
                    <input type="radio" name="gender" value="male" class="custom-control-indicator" required> זכר
                    <input type="radio" name="gender" value="female" class="custom-control-indicator" required> נקבה
               
                <br>
                <label for="inputTown" >כתובת מגורים</label>
                <input type="text" name="address" class="form-control" placeholder="עיר" maxlength="15" required>


                <label for="inputPhoneNo" >מספר טלפון</label>
                <input type="text" name="phone" class="form-control" placeholder="מספר פלאפון" maxlength="10" pattern="[0-9]+" minlength="10"   required>

                <label for="inpuEmail">מייל</label>
                <input type="text" name="email" class="form-control" placeholder="מייל" required autofocus>

                <button class="btn btn-lg btn-primary btn-block"  type="submit" name="submit" style="margin-top:20%; margin-bottom:10%;">הרשמה</button>
            </form>
        <?php NewCustomer();//create new customer?>
        </div>
    </div>
  
    <div class="Footer">
      <?php getFooter();?>
    </div>
</body>

</html>
