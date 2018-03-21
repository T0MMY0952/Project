<?php
// include QR_BarCode class 
include ("QR_BarCode.php"); 

// QR_BarCode object 
$qr = new QR_BarCode(); 

// create text QR code 
$id = $_GET['idshipment'];
$type = $_GET['type'];
$qr->text("158.108.207.4/sp_60_TrackingForAg/include/tracking.php?idshipment=".$id"&type=".$type); 

// display QR code image
$qr->qrCode();
?>