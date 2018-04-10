<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
date_default_timezone_set("Asia/Bangkok");
$ap_name = $_POST['ap_name'];
$get_ap_collectdate = strtr($_POST['apr_collectdate'], '/', '-');
$ap_collectdate = date('Y-m-d',strtotime($get_ap_collectdate));
$ap_garden = $_POST['apr_garden'];
$ap_amount = $_POST['apr_amount'];
$ap_unit = $_POST['apr_unit'];
$ap_exportdate = date('Y-m-d H:i:s'); 
$idsendto = $_POST['idsend'];
$idapr = $_POST['id'];
$ap_price = $_POST['apr_price'];

if(empty($ap_name) || empty($ap_collectdate)  || empty($ap_amount) || empty($ap_unit) || empty($ap_exportdate) || empty($idsendto)){
	echo '<script type="text/javascript" >
				alert("กรอกข้อมูลไม่ครบ");
				window.location.href = "javascript:history.back()";
			  	</script>';
}else{
		if(substr($idsendto, 0, 1) == 's'){
			$sql2 = "UPDATE shipment SET idseller_recieve = '".substr($idsendto, 1)."', idfactory_recieve = NULL, exportdate = '$ap_exportdate'  
					 WHERE idshipment = $idapr ";
			$result2 = $con->Query($sql2) or die(mysqli_error($con));
			
		}else{
			$sql2 = "UPDATE shipment SET idfactory_recieve = $idsendto, idseller_recieve = NULL , exportdate = '$ap_exportdate' 
					 WHERE idshipment = $idapr ";
			$result2 = $con->Query($sql2) or die(mysqli_error($con));
			
		}
		
		$sql1 = "UPDATE agriculture_product as ap  SET ap_name = '$ap_name', ap_collectdate = '$ap_collectdate' , ap_garden = '$ap_garden' , ap_amount = '$ap_amount', ap_unit = '$ap_unit', ap_price = '$ap_price' WHERE idagriculture_product = (SELECT idagriculture_product FROM shipment WHERE idshipment = $idapr) " ;
		$result1 = $con->query($sql1) or die(mysqli_error($con));
		
		if($result1 && $result2){
			echo '<script type="text/javascript" >
			alert("แก้ไขข้อมูลเรียบร้อย");
			window.onunload = refreshParent;
        	function refreshParent() {
            window.opener.location.reload();
        	}
			window.close();
			</script>';
		}else{
			echo '<script type="text/javascript" >
				alert("แก้ไขข้อมูลล้มเหลว");
				window.location.href = "javascript:history.back()";
			  	</script>';
		}
}
?>