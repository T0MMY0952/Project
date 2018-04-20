<meta charset="utf-8">
<?php
require_once("../connect/connect.php");
$id = $_GET['id'];
$type = $_GET['type'];
if (!unlink($_SERVER['DOCUMENT_ROOT'] ."/sp_60_TrackingForAg/images/".$getimage[$type."_staffpic"]."")){
	echo "Delete Picture Fail";
}
$deleteuser  = $con->query("DELETE FROM user_account 
	           WHERE iduser_account = (SELECT iduser_account FROM ".$type."_staff WHERE id".$type."_staff = $id) ") or die (mysqli_error($con)) ;
$deletestaff  = $con->query("DELETE FROM ".$type."_staff WHERE id".$type."_staff = $id ") or die (mysqli_error($con)) ;

if($deletestaff && $deleteuser){
	echo '<script type="text/javascript" >
				alert("ลบผู้ใช้เรียบร้อย");
				window.location.href = "javascript:history.back()";
			  	</script>';
}else{
	echo '<script type="text/javascript" >
				alert("ไม่สามารถลบผู้ใช้ได้");
				window.location.href = "javascript:history.back()";
			  	</script>';
}
?>