<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
//session_start();
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
    <div class="row2">
      <?php 
      getNav();?>
    </div>
      <div class="login col-md-3 pull-right" style="margin-right: 20%; margin-top: 2%;">


          <h4 class="modal-title" style=" font-weight: bold; font-size: 250%;">כניסת משתמש</h4>

<?php getLoginprocess() ; //Function to Process of The Login?>
        <div class="container col-md-3 col-lg-6 col-xs-5 col-sm-5">
          <!---Page Design of Login-->
          <form class="form-signin" method="post">
          <div class="form-group row" style="margin-top: 25%;">
            <div class="form-group mx-sm-6">
            <label for="inputId" class="sr-only">ת.ז</label>
            <input name="us_name" type="text" class="form-control" placeholder="ת.ז" maxlength="9" pattern="[0-9]+">
            </div>

             <div class="form-group mx-sm-6">
            <label for="inputPassword" class="sr-only">סיסמה</label>
            <input name="us_pass" type="password"  class="form-control" placeholder="סיסמה" maxlength="8" pattern="[0-9A-Za-z]+" required>
            </div>
        </div>
            
            <button class="btn btn-lg btn-primary btn-block" " name="submit" type="submit" style="margin-top:10%">התחבר</button>
            <br>
          
            <label for="passwordReset"><a href="Create-A-New-User.php" class="text-muted" action="Create-A-New-User.php">משתמש חדש</a></label>
          </form>
</div>
      </div>
    </div>


    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>