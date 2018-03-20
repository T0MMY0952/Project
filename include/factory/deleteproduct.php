<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
$id = $_GET['id'];
$findidp = $con->query("SELECT idproduct FROM shipment  WHERE idshipment = $id ") ;
$getidp = $findidp->fetch_assoc();

$deleteshipment = $con->query("DELETE FROM shipment WHERE idshipment = $id") ;
$deletep  = $con->query("DELETE FROM product WHERE idproduct = '".$getidp['idproduct']."' ") ;
if($deletep && $deleteshipment){
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