<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
require_once("phpExcel/Classes/PHPExcel.php");
require_once("phpExcel/Classes/PHPExcel/IOFactory.php");
require_once("Functions/functions.php");
require_once("DataBase/dbClass.php");
getrequire();
   $db=new dbClass();
   $productArr=array();
   $prdouctArr=$db->getProduct();
   $productDetails=array();
   $excel=new PHPExcel();
   $row=1;
   $excel->getActiveSheet()->setCellValue('A1', 'היי');
   $excel->getActiveSheet()->setTitle('Chesse1');
   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header('Content-Disposition: attachment;filename="helloworld.xlsx"');
   header('Cache-Control: max-age=0');

   $objWriter=phpExcel_IOFactory::createWriter($excel, 'Excel2007');
   $objWriter->save('C:\xampp\htdocs');

?>
</body>
</html>

