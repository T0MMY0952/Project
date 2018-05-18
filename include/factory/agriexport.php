<meta charset="utf8">
<?php 
require_once("../../connect/connect.php");
session_start();
date_default_timezone_set("Asia/Bangkok");
$id = $_SESSION['iduser_account'];
$idapr = $_GET['idshow'];
$p_name = $_POST['name'];
$p_amount = $_POST['amount'];
$p_unit = $_POST['unit'];
$p_process = $_POST['process'];
$mfd = strtr($_POST['mfddate'], '/', '-');
$p_mfd = date('Y-m-d',strtotime($mfd));
$get_expdate = $_POST['expdate'];
$p_exportdate = date('Y-m-d H:i:s'); 
$idsendto = $_POST['idrecieve'];

if(empty($p_name) || empty($p_amount) || empty($p_unit) || empty($p_process) || empty($mfd) || $idsendto == '0' || empty($p_exportdate) || empty($get_expdate)){
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
	$exp = date_modify(date_create($p_mfd) ,'+'.$_POST['expdate'].'day' );
	$p_exp = $exp->format('Y-m-d');
	$findfac = $con->query("SELECT idfactory_place FROM factory_staff WHERE iduser_account = $id");
	$getfac = $findfac->fetch_assoc();
	$insertproduct = $con->query("INSERT INTO product (idfactory_place, p_name, p_amount, p_unit, p_process, p_mfd, p_exp) VALUES ('".$getfac['idfactory_place']."', '$p_name', '$p_amount', '$p_unit', '$p_process', '$p_mfd', '$p_exp')") or die (mysqli_error($con));
	$last_id = $con->insert_id;
	$insertshipment = $con->query("INSERT INTO shipment (idfactory_send, $idrecieve, idproduct, idshipment_prev,exportdate) VALUES ('".$getfac['idfactory_place']."', $idvalue, $last_id, $idapr, '".$p_exportdate."')") or die (mysqli_error($con));
	if($insertproduct && $insertshipment){
			echo '<script type="text/javascript" >
			alert("ส่งออกสินค้าเรียบร้อย");
			window.onunload = refreshParent;
        	function refreshParent() {
            window.opener.location.reload();
        	}
			window.close();
		  </script>';
	}else{
			echo '<script type="text/javascript" >
			alert("ส่งออกสินค้าล้มเหลว");
			window.location.href = "../../index.php?action=addagri";
			</script>';
	}
}
?>