<meta charset="utf-8">
<?php
require_once("../../connect/connect.php");
date_default_timezone_set("Asia/Bangkok");
session_start();
$id = $_SESSION['iduser_account'];
$ap_name = $_POST['ap_name'];
$get_ap_collectdate = strtr($_POST['apr_collectdate'], '/', '-');
$ap_collectdate = date('Y-m-d',strtotime($get_ap_collectdate)); 
$get_expdate = $_POST['apr_expdate'];
$ap_garden = $_POST['apr_garden'];
$ap_amount = $_POST['apr_amount'];
$ap_unit = $_POST['apr_unit'];
$ap_price = $_POST['apr_price'];




if(empty($ap_name) || empty($ap_collectdate)  || empty($ap_amount) || empty($ap_unit) || empty($get_expdate) ){
	echo '<script type="text/javascript" >
				alert("กรอกข้อมูลไม่ครบ");
				window.location.href = "javascript:history.back()";
			  	</script>';
}else{
		$ap_expdate = date_modify(date_create($ap_collectdate) ,'+'.$_POST['apr_expdate'].'day' );
		$ap_expdate = $ap_expdate->format('Y-m-d');
		$sql1 = "INSERT INTO agriculture_product (idfarmer,ap_name,ap_amount,ap_unit,ap_collectdate,ap_garden,ap_price,ap_expdate) VALUES ('".$_SESSION['idfarmer']."', '$ap_name', '$ap_amount', '$ap_unit', '$ap_collectdate', '$ap_garden','$ap_price','$ap_expdate')" ;
		$result1 = $con->query($sql1) or die(mysqli_error($con));
		
		if($result1){
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