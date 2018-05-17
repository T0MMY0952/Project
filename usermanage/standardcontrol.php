<meta charset="utf-8">
<?php
require_once('../connect/connect.php');
session_start();


if($_POST['action'] == "insert"){
	$standard = $_POST['standard'];
	$standardnumber = $_POST['number'];
	$idfac = $_SESSION['idfactory_place'];
	$addstandard = $con->query("INSERT INTO standard (standard, idfactory_place, dateadd, number) VALUES ('$standard', $idfac, now(), '$standardnumber') ") or die (mysqli_error($con));
	if($addstandard){
		echo '<script type="text/javascript" >
			alert("เพิ่มมาตราฐานเรียบร้อย");
			window.location.href = "javascript:history.back()";
			</script>';
	}else{
		echo '<script type="text/javascript" >
			alert("เพิ่มมาตราฐานล้มเหลว");
			window.location.href = "javascript:history.back()";
			</script>';
	}
}elseif($_POST['action'] == "delete"){
	$idstd = $_POST['id'];
	$deletestandard = $con->query("DELETE FROM standard WHERE idstandard = $idstd") or die (mysqli_error($con));
	if($deletestandard){
		echo '<script type="text/javascript" >
			alert("ลบมาตราฐานเรียบร้อย");
			window.location.href = "javascript:history.back()";
			</script>';
	}else{
		echo '<script type="text/javascript" >
			alert("ลบมาตราฐานล้มเหลว");
			window.location.href = "javascript:history.back()";
			</script>';
	}
}

?>