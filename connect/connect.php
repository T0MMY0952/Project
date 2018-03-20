<?php
	
	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName	  = "localhost";
	$userName	  = "Tracking01";
	$userPassword	  = "bastom08";
	$dbName	  = "sp_60_TrackingForAg";

	$con = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_set_charset($con, "utf8");

	if (mysqli_connect_errno())
	{
		echo "Database Connect Failed : " . mysqli_connect_error();
		exit();
	} 

	//*** Reject user not online
	$intRejectTime = 20; // Minute
	$sql = "UPDATE user_account SET status = '0', lastupdate = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(lastupdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
	$query = mysqli_query($con,$sql);

?>