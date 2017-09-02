<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
require_once "functions/functions.php";
getrequire();
?>

<html lang="he" dir="rtl">
  <head>
    <?php  getHead();?>
    <title>CompStore</title>
    <link rel="stylesheet" href="styles/Contant.css">
  </head>
  <body>
    <div class="row">
      <?php
      getLogo();
      getSearch();
     echo' <button type="button" class="btn btn-default"><a href="Login.php"> <img alt="login" src="images/user_24px_1174223_easyicon.net.ico"> כניסה/רישום</a> </button>';
      ?>  
</div>

    <div class="row2">
      <?php  
      getNav();?>
    </div>


<div id="container">
        <h1>יצירת קשר</h1>
        <br><br>
        <h2>שרות לקוחות <br><br>
        שעות הפעילות שלנו </h2>
        <div class="contact">
            <img class="image" src="images/Rade8-Minium-2-Sidebar-Search.ico" alt="phone" >
        <table class="table" border="1">
    <thead>
      <tr>
        <th>יום</th>
        <th>שעות</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>ראשון-חמישי</td>
        <td>8:00-18:00</td>
      </tr>
      <tr>
        <td>שישי</td>
        <td>9:00-13:00</td>
      </tr>
            <tr>
        <td>שבתות וחגים</td>
        <td>סגור</td>
      </tr>
    </tbody>
  </table>

        </div>   
     
        <div class="contact">
            <img class="image" src="images/phone-icon-85715.png" alt="phone" ><br><br>
        <h2>מספר טלפון </h2><br>
        0525460000
        </div>

       </div>

    <div class="Footer">
      <?php getFooter();?>
    </div>
  </body>
</html>