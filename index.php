<?php
	session_start();
	require_once("./connect/connect.php");
	if(isset($_SESSION['iduser_account']))
	{
		//*** Update Last Stay in Login System
		$sql = "UPDATE user_account SET lastupdate = NOW() WHERE iduser_account = '".$_SESSION["iduser_account"]."' ";
		$query = mysqli_query($con,$sql);
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Tracking Center</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="dist/js/bootstrap-select.js"></script>


  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/tracking.css" rel="stylesheet">
  <link href="css/selectfix.css" rel="stylesheet">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
</head>

<body>
<?php 
include("include/login.php");
include("include/logout.php");
include("include/navbar_home.php");



if(isset($_SESSION['iduser_account'])){
//-- Login Frame
echo '<div class="content-wrapper">';
echo '<div class="container-fluid" style="margin-top: 60px; margin-bottom:60px">';
		//-- Login Menu
	if($_SESSION['type'] == "farmer"){
		//-- Farmer Menu
		if(isset($_GET['action']) && $_GET['action'] == "edituser"){
			include("usermanage/edituser.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "addagri"){
			include("include/farmer/farmer_addagri.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "history"){
			include("include/farmer/farmer_history.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "historyagrisell"){
			include("include/farmer/farmer_historysell.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "addagritosell"){
			include("include/farmer/farmer_addagritosell.php");
		}else{
			include("include/farmer/farmer_home.php");
		}
	}
	if($_SESSION['type'] == "factoryadmin"){
		//-- Factory Menu
		if(isset($_GET['action']) && $_GET['action'] == "edituser"){
			include("usermanage/edituser.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "recieveagri"){
			include("include/factory/factory_recieve.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "exportproduct"){
			include("include/factory/factory_export.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
			include("include/factory/factory_exporthistory.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "adduser"){
			include("usermanage/adduser.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "listuser"){
			$type = "factory";
			include("usermanage/listuser.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "standard"){
			include("usermanage/standard.php");
		}else{
			include("include/factory/factory_home.php");
		}
	}
	if($_SESSION['type'] == "factory"){
		//-- Factory Menu
		if(isset($_GET['action']) && $_GET['action'] == "edituser"){
			$type = "factory";
			include("usermanage/editmember.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "recieveagri"){
			include("include/factory/factory_recieve.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "exportproduct"){
			include("include/factory/factory_export.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
			include("include/factory/factory_exporthistory.php");
		}else{
			include("include/factory/factory_home.php");
		}
	}
	if($_SESSION['type'] == "selleradmin"){
		//-- Seller Menu
		if(isset($_GET['action']) && $_GET['action'] == "edituser"){
			include("usermanage/edituser.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "recieveproduct"){
			include("include/seller/seller_recieveproduct.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
			include("include/seller/seller_historyproduct.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "adduser"){
			include("usermanage/adduser.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "listuser"){
			$type = "seller";
			include("usermanage/listuser.php");
		}else{
			include("include/seller/seller_home.php");
		}
	}
	if($_SESSION['type'] == "seller"){
		//-- Seller Menu
		if(isset($_GET['action']) && $_GET['action'] == "edituser"){
			$type = "seller";
			include("usermanage/editmember.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "recieveproduct"){
			include("include/seller/seller_recieveproduct.php");
		}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
			include("include/seller/seller_historyproduct.php");
		}else{
			include("include/seller/seller_home.php");
		}
	}
echo '</div>';
echo '</div>';
		
}
else {
//-- Not Login Frame
echo '<div class="container" style="margin-top: 80px; margin-bottom:60px">';

	if(isset($_GET['action']) && $_GET['action'] == "register"){
		include("include/register_form.php");
		}
	else{
		include("include/panel_home.php");
		}
}
echo '</div>';
?>

</body>