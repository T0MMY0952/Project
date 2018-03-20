<?php
	session_start();

	require_once("../connect/connect.php");
	

	//*** Update Status
	$sql = "UPDATE user_account SET lastupdate = '0000-00-00 00:00:00' WHERE iduser_account = '".$_SESSION["iduser_account"]."' ";
	$query = mysqli_query($con,$sql);

	session_destroy();
	header("location:../index.php");
?>