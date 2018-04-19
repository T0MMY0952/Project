<meta charset="utf8">
<?php
require_once('../connect/connect.php');
session_start();
$standard = $_POST['standard'];
$idfac = $_SESSION['idfactory_place'];
$idstd = $_GET['id'];

if(!isset($idstd)){
	$addstandard = $con->query("INSERT INTO standard (standard, idfactory_place, dateadd) VALUES ('$standard', $idfac, now()) ") or die (mysqli_error($con));
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
}else{
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