<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
session_start();
date_default_timezone_set("Asia/Bangkok");
$recievedate = date('Y-m-d H:i:s'); 
$id = $_SESSION['iduser_account'];
$idapr = $_GET['idshow'];
$updateshipment = "UPDATE shipment as s  SET status = '1', recievedate =  '".$recievedate."' WHERE s.idshipment = $idapr " ;
$result1 = $con->query($updateshipment) or die (mysqli_error($con));
$insertwork = "INSERT INTO seller_staff_work (idseller_staff, idshipment) VALUES ((SELECT idseller_staff FROM seller_staff WHERE iduser_account = $id), $idapr)" ;
$result2 = $con->query($insertwork) or die (mysqli_error($con));
if ($result1 && $result2){
	echo '<script type="text/javascript" >
			alert("รับสินค้าเรียบร้อย");
			window.onunload = refreshParent;
        	function refreshParent() {
            window.opener.location.reload();
        	}
			window.close();
			</script>';
}else{
	echo '<script type="text/javascript" >
				alert("รับสินค้าล้มเหลว");
				window.location.href = "javascript:history.back()";
			  	</script>';
}
?>