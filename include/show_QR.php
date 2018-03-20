<?php
// include QR_BarCode class 
include ("QR_BarCode.php"); 

// QR_BarCode object 
$qr = new QR_BarCode(); 

// create text QR code 
$id = $_GET['idshipment'];
$qr->text($_SERVER['DOCUMENT_ROOT']."/Project/include/tracking.php?idshipment=".$id); 

// display QR code image
$qr->qrCode();
?>