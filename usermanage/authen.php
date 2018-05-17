<meta charset="utf-8">
<?php
	session_start();

	require_once("../connect/connect.php");
	$strUsername = mysqli_real_escape_string($con,$_POST['username']);
	$strPassword = mysqli_real_escape_string($con,$_POST['password']);

	$strSQL = "SELECT * FROM user_account WHERE email = '".$strUsername."' and pass = '".$strPassword."'";
	$objQuery = mysqli_query($con,$strSQL) or die (mysqli_error());
	$objResult = mysqli_fetch_array($objQuery);

	if(!$objResult)
	{
		echo '<script type="text/javascript" >
			   alert("ขออภัย! อีเมลล์หรือรหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง");
			   window.location.href = "../index.php";
			  	</script>';
	}
	else
	{
			

			//*** Session
			$_SESSION["iduser_account"] = $objResult["iduser_account"];
			$_SESSION["type"] = $objResult["type"];
			
			if($_SESSION["type"] == "farmer"){
				//--Login as farmer
				$findid = $con->query("SELECT idfarmer,idfarm_place FROM farmer WHERE iduser_account = '".$_SESSION["iduser_account"]."' ");
				$getid = $findid->fetch_assoc();
				$_SESSION['idfarmer'] = $getid['idfarmer'];
				$_SESSION['idfarm_place'] = $getid['idfarm_place'];
			}elseif($_SESSION["type"] == "factory" || $_SESSION["type"] == "factoryadmin"){
				//-- Login as factory admin or factory staff
				$findid = $con->query("SELECT idfactory_staff, idfactory_place FROM factory_staff WHERE iduser_account = '".$_SESSION["iduser_account"]."' ");
				$getid = $findid->fetch_assoc();
				$_SESSION['idfactory_staff'] = $getid['idfactory_staff'];
				$_SESSION['idfactory_place'] = $getid['idfactory_place'];
			}elseif($_SESSION["type"] == "seller" || $_SESSION["type"] == "selleradmin"){
				//-- Login as seller admin or seller staff
				$findid = $con->query("SELECT idseller_staff, idseller_place FROM seller_staff WHERE iduser_account = '".$_SESSION["iduser_account"]."' ");
				$getid = $findid->fetch_assoc();
				$_SESSION['idseller_staff'] = $getid['idseller_staff'];
				$_SESSION['idseller_place'] = $getid['idseller_place'];
			}
			session_write_close();

			//*** Go to Main page
			header("location:../index.php");
		
			
	}
	mysqli_close($con);
?>