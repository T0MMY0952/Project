<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
date_default_timezone_set("Asia/Bangkok");
$id = $_GET['idshow'];
$p_name = $_POST['name'];
$p_amount = $_POST['amount'];
$p_unit = $_POST['unit'];
$p_process = $_POST['process'];
$mfd = strtr($_POST['mfddate'], '/', '-');
$p_mfd = date('Y-m-d',strtotime($mfd));
$exp = date_modify(date_create($p_mfd) ,'+'.$_POST['expdate'].'day' );
$p_exp = $exp->format('Y-m-d');
$p_exportdate = date('Y-m-d H:i:s'); 
$idsendto = $_POST['idrecieve'];


if(empty($p_name) || empty($p_amount) || empty($p_unit) || empty($p_process) || empty($mfd) || empty($exp)  || empty($idsendto)){
	echo '<script type="text/javascript" >
			alert("กรอกข้อมูลไม่ครบ");
			window.location.href = "javascript:history.back()";
		  </script>';
}else{
	if(substr($idsendto, 0, 1) == 's'){
			$sql2 = "UPDATE shipment SET idseller_recieve = '".substr($idsendto, 1)."', idfactory_recieve = NULL, 
					 exportdate = '$p_exportdate' , status = '0', comment = NULL 
					 WHERE idshipment = $id ";
			$result2 = $con->Query($sql2) or die(mysqli_error($con));
			
		}else{
			$sql2 = "UPDATE shipment SET idfactory_recieve = $idsendto, idseller_recieve = NULL , exportdate = '$p_exportdate'
					 , status = '0', comment = NULL  
					 WHERE idshipment = $id ";
			$result2 = $con->Query($sql2) or die(mysqli_error($con));
			
		}
	$sql1 = "UPDATE product SET p_name = '$p_name' , p_amount = '$p_amount', p_unit = '$p_unit', p_process = '$p_process', p_mfd = '".$p_mfd."' , p_exp = '".$p_exp."' WHERE idproduct = (SELECT idproduct FROM shipment WHERE idshipment = $id) " ;
	$result1 = $con->query($sql1) or die(mysqli_error($con));
	if($result1 && $result2){
			echo '<script type="text/javascript" >
			alert("แก้ไขเรียบร้อย");
			window.onunload = refreshParent;
        	function refreshParent() {
            window.opener.location.reload();
        	}
			window.close();
		  </script>';
	}else{
			echo '<script type="text/javascript" >
				alert("แก้ไขข้อมูลล้มเหลว");
				window.close();";
			  	</script>';
	}
}
?>