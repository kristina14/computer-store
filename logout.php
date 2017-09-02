<?php
/*Authors:Mai Hamduni & Kristina Mushkuv*/
		    require_once "functions/functions.php";
			session_start();

            if(isset($_SESSION['Customer']))//Logout The Customer
         	{
         	session_unset($_SESSION['Customer']);
         	session_destroy();
         	header("Location: index.php");
         	}
            //logout the Employee /Manager
         	elseif (isset($_SESSION['Employee'])) {
         	session_unset($_SESSION['Employee']);
         	session_destroy();
         	header("Location: index.php");
         	}
         
         	
?>