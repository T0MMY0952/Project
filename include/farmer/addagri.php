<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
date_default_timezone_set("Asia/Bangkok");
session_start();
$id = $_SESSION['iduser_account'];
$ap_name = $_POST['ap_name'];
$get_ap_collectdate = strtr($_POST['apr_collectdate'], '/', '-');
$ap_collectdate = date('Y-m-d',strtotime($get_ap_collectdate)); 
$ap_garden = $_POST['apr_garden'];
$ap_amount = $_POST['apr_amount'];
$ap_unit = $_POST['apr_unit'];
$ap_exportdate = date('Y-m-d H:i:s'); 
$idsendto = $_POST['idsend'];
$ap_price = $_POST['apr_price'];




if(empty($ap_name) || empty($ap_collectdate)  || empty($ap_amount) || empty($ap_unit) || empty($ap_exportdate) || empty($idsendto) || empty($ap_price) ){
	echo '<script type="text/javascript" >
				alert("กรอกข้อมูลไม่ครบ");
				window.location.href = "javascript:history.back()";
			  	</script>';
}else{
		if(substr($idsendto, 0, 1) == 's'){
			$idrecieve = 'idseller_recieve';
			$idvalue   =  substr($idsendto, 1); 
		}else{
			$idrecieve = 'idfactory_recieve';
			$idvalue   = $idsendto;
		}
		$findidfarmer = $con->query("SELECT idfarmer FROM farmer WHERE iduser_account = '".$id."' ") or die (mysqli_error($con));
		$getidfarmer = $findidfarmer->fetch_assoc();
		$sql1 = "INSERT INTO agriculture_product (idfarmer,ap_name,ap_amount,ap_unit,ap_collectdate,ap_exportdate,ap_garden,ap_price) VALUES ('".$getidfarmer['idfarmer']."', '$ap_name', '$ap_amount', '$ap_unit', '$ap_collectdate', '".$ap_exportdate."', '$ap_garden','$ap_price')" ;
		$result1 = $con->query($sql1) or die(mysqli_error($con));
		$last_id = $con->insert_id;
		$sql2 = "INSERT INTO shipment (idfarmer_send, $idrecieve, idagriculture_product) VALUES ('".$getidfarmer['idfarmer']."', $idvalue, $last_id)";
		$result2 = $con->Query($sql2) or die(mysqli_error($con));

		if($result1 && $result2){
			echo '<script type="text/javascript" >
			alert("เพิ่มข้อมูลเรียบร้อย");
			window.location.href = "../../index.php?action=addagri";
			</script>';
		}else{
			echo '<script type="text/javascript" >
			alert("เพิ่มข้อมูลล้มเหลว");
			window.location.href = "../../index.php?action=addagri";
			</script>';
		}
}
?>