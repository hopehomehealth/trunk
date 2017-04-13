<?
include "phpqrcode.php";

$value = $_GET['v']; 

if($value=='') exit;

$errorCorrectionLevel = 'L';

$matrixPointSize = 4;

QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);

exit;
?>