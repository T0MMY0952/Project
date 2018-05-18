<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
session_start();
date_default_timezone_set("Asia/Bangkok");
$recievedate = date('Y-m-d H:i:s'); 
$idapr = $_POST['idshow'];
$comment = $_POST['comment'];
$updateshipment = "UPDATE shipment as s  SET status = '2', comment = '$comment' WHERE s.idshipment = $idapr " ;
$result1 = $con->query($updateshipment) or die (mysqli_error($con));

$findwork = 
$con->query("SELECT * FROM seller_staff_work WHERE idseller_staff = '".$_SESSION['idseller_staff']."' AND idshipment = '$idapr'");
$getwork = $findwork->fetch_assoc();
if(!$getwork){
	$insertwork = "INSERT INTO seller_staff_work (idseller_staff, idshipment) VALUES ('".$_SESSION['idseller_staff']."', $idapr)" ;
	$result2 = $con->query($insertwork) or die (mysqli_error($con));
	if ($result1 && $result2){
		echo '<script type="text/javascript" >
				alert("ไม่รับผลผลิตเรียบร้อย");
				window.onunload = refreshParent;
	        	function refreshParent() {
	            window.opener.location.reload();
	        	}
				window.close();
				</script>';
	}else{
		echo '<script type="text/javascript" >
					alert("ไม่รับผลผลิตล้มเหลว");
					window.location.href = "javascript:history.back()";
				  	</script>';
	}
}else{
	if ($result1){
		echo '<script type="text/javascript" >
				alert("ไม่รับผลผลิตเรียบร้อย");
				window.onunload = refreshParent;
	        	function refreshParent() {
	            window.opener.location.reload();
	        	}
				window.close();
				</script>';
	}else{
		echo '<script type="text/javascript" >
					alert("ไม่รับผลผลิตล้มเหลว");
					window.location.href = "javascript:history.back()";
				  	</script>';
	}
}
?>