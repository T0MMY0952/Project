<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
$idap = $_GET['id'];
$deleteap  = $con->query("DELETE FROM agriculture_product WHERE idagriculture_product = $idap ") ;
if($deleteap){
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