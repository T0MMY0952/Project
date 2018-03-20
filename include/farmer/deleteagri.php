<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
$idapr = $_GET['id'];
$findidap = $con->query("SELECT idagriculture_product FROM shipment  WHERE idshipment = $idapr ") ;
$getidap = $findidap->fetch_assoc();

$deleteshipment = $con->query("DELETE FROM shipment WHERE idshipment = $idapr") ;
$deleteap  = $con->query("DELETE FROM agriculture_product WHERE idagriculture_product = '".$getidap['idagriculture_product']."' ") ;
if($deleteap && $deleteshipment){
	echo '<script type="text/javascript" >
				alert("ลบข้อมูลเรียบร้อย");
				window.location.href = "javascript:history.back()";
			  	</script>';
}else{
	echo '<script type="text/javascript" >
				alert("ไม่สามารถลบข้อมูลได้");
				window.location.href = "javascript:history.back()";
			  	</script>';
}
?>