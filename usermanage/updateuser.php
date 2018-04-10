<meta charset="utf-8">
<?php
	session_start();
	require_once("../connect/connect.php");
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$tel = $_POST['tel'];
	$businessname = $_POST['businessname'];
	$businessaddress = $_POST['businessaddress'];
	$businesstel = $_POST['businesstel'];
	$peoplepic = $_FILES['peoplepic']['name']; 
	$placepic = $_FILES['placepic']['name'];
	$type = $_SESSION['type'];
	$id = $_SESSION['iduser_account'];

	if (empty($email) || empty($password) || empty($repassword) || empty($name) || empty($surname)  || empty($businessname) || empty($businessaddress)){
		//--กรอกข้อมูลไม่ครบ
		echo '<script type="text/javascript" >
				alert("กรอกข้อมูลไม่ครบ");
				window.location.href = "javascript:history.back()";
			  </script>';

	}else{
		//--กรอกข้อมูลครบ
		if($password != $repassword){
		//--รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน
		echo '<script type="text/javascript" >
				alert("รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน");
				window.location.href = "javascript:history.back()";
			  </script>';
		}else{
		$id = $_SESSION['iduser_account'];
		$result = $con->query("SELECT  COUNT(*) as count FROM (SELECT * FROM user_account WHERE email = '$email') AS T WHERE iduser_account!= '".$id."' ");
		$row=$result->fetch_assoc();
			if($row['count']){
			//--email ซ้ำกัน
			echo '<script type="text/javascript" >
				alert("email นี้เคยถูกใช้แล้ว");
				window.location.href = "javascript:history.back()";
			  	</script>';
			}else{
  				if ($type == "farmer") {
					//--farmer update
					$findid = $con->query("SELECT idfarm_place FROM farmer WHERE iduser_account = '".$id."' ");
					$resultid = $findid->fetch_assoc();
					$updateuser = $con->query("UPDATE user_account SET email = '$email' , pass = '$password' WHERE iduser_account = '".$id."' ");
					$farm_place = $con->query("UPDATE farm_place SET farmname = '$businessname' , farmaddress = '$businessaddress' , farmtel = '$businesstel'  WHERE idfarm_place = '".$resultid['idfarm_place']."'");
					$factory_staff = $con->query("UPDATE farmer SET farmername = '$name' , farmersurname = '$surname' , farmertel = '$tel' WHERE iduser_account = '".$id."' ");

					if(!empty($peoplepic)){
						$findimage = $con->query("SELECT farmerpic FROM farmer WHERE iduser_account = '".$id."' ");
						$getimage = $findimage->fetch_assoc();
						if($getimage['farmerpic'] != ''){
							if(!unlink($_SERVER['DOCUMENT_ROOT'] ."/sp_60_TrackingForAg/images/".$getimage["farmerpic"]."")){
								echo "Delete Picture Fail";
							}
						}

						$target1 = "../images/".$peoplepic;
						if(move_uploaded_file($_FILES['peoplepic']['tmp_name'], $target1)){
							echo "Success";
						}else{
							echo "Fail";
						}
						$pic1 = $con->query("UPDATE farmer SET farmerpic = '$peoplepic' WHERE iduser_account = '".$id."' ") ;
					}
					if(!empty($placepic)){
						$findimage = $con->query("SELECT farmpic FROM farm_place WHERE idfarm_place = '".$resultid['idfarm_place']."' ");
						$getimage = $findimage->fetch_assoc();
						if($getimage['farmpic'] != ''){
							if(!unlink($_SERVER['DOCUMENT_ROOT'] ."/sp_60_TrackingForAg/images/".$getimage["farmpic"]."")){
								echo "Delete Picture Fail";
							}
						}

						$target2 = "../images/".$placepic;
						if(move_uploaded_file($_FILES['placepic']['tmp_name'], $target2)){
							echo "Success";
						}else{
							echo "Fail";
						}
						$pic2 = $con->query("UPDATE farm_place SET farmpic = '$placepic' WHERE idfarm_place = '".$resultid['idfarm_place']."' ") ;
					}
					echo '<script type="text/javascript" >
					alert("แก้ไขข้อมูลเรียบร้อย");
					window.location.href = "../index.php?action=edituser";
			  		</script>';
				}
				elseif ($type == "factory" || $type == "factoryadmin" ) {
					//--factory update
					$findid = $con->query("SELECT idfactory_place FROM factory_staff WHERE iduser_account = '".$id."' ");
					$resultid = $findid->fetch_assoc();
					$updateuser = $con->query("UPDATE user_account SET email = '$email' , pass = '$password' WHERE iduser_account = '".$id."' ");
					$factory_place = $con->query("UPDATE factory_place SET factoryname = '$businessname' , factoryaddress = '$businessaddress' , factorytel = '$businesstel' WHERE idfactory_place = '".$resultid['idfactory_place']."'  ");
					$factory_staff = $con->query("UPDATE factory_staff SET factory_staffname = '$name' , factory_staffsurname = '$surname' , factory_stafftel = '$tel' WHERE iduser_account = '".$id."' ");
					if(!empty($peoplepic)){
						$findimage = $con->query("SELECT factory_staffpic FROM factory_staff WHERE iduser_account = '".$id."' ");
						$getimage = $findimage->fetch_assoc();
						if($getimage['factory_staffpic'] != ''){
							if(!unlink($_SERVER['DOCUMENT_ROOT'] ."/sp_60_TrackingForAg/images/".$getimage["factory_staffpic"]."")){
								echo "Delete Picture Fail";
							}
						}

						$target1 = "../images/".$peoplepic;
						move_uploaded_file($_FILES['peoplepic']['tmp_name'], $target1);
						$pic = $con->query("UPDATE factory_staff SET factory_staffpic = '$peoplepic' WHERE iduser_account = '".$id."' ");
					}
					if(!empty($placepic)){
						$findimage = $con->query("SELECT factorypic FROM factory_place WHERE idfactory_place = '".$resultid['idfactory_place']."' ");
						$getimage = $findimage->fetch_assoc();
						if($getimage['factorypic'] != ''){
							if(!unlink($_SERVER['DOCUMENT_ROOT'] ."/sp_60_TrackingForAg/images/".$getimage["factorypic"]."")){
								echo "Delete Picture Fail";
							}
						}
						$target2 = "../images/".$placepic;
						move_uploaded_file($_FILES['placepic']['tmp_name'], $target2);
						$pic = $con->query("UPDATE factory_place SET factorypic = '$placepic' WHERE idfactory_place = '".$resultid['idfactory_place']."' ");
					}
					echo '<script type="text/javascript" >
					alert("แก้ไขข้อมูลเรียบร้อย");
					window.location.href = "../index.php?action=edituser";
			  		</script>';
				}
				elseif ($type == "seller" || $type == "selleradmin") {
					$findid = $con->query("SELECT idseller_place FROM seller_staff WHERE iduser_account = '".$id."' ");
					$resultid = $findid->fetch_assoc();
					$updateuser = $con->query("UPDATE user_account SET email = '$email' , pass = '$password' WHERE iduser_account = '".$id."' ");
					$seller_place = $con->query("UPDATE seller_place SET sellername = '$businessname' , selleraddress = '$businessaddress' , sellertel = '$businesstel' WHERE idseller_place = '".$resultid['idseller_place']."'  ");
					$factory_staff = $con->query("UPDATE seller_staff SET seller_staffname = '$name' , seller_staffsurname = '$surname' , seller_stafftel = '$tel' WHERE iduser_account = '".$id."' ");
					if(!empty($peoplepic)){
						$findimage = $con->query("SELECT seller_staffpic FROM seller_staff WHERE iduser_account = '".$id."' ");
						$getimage = $findimage->fetch_assoc();
						if($getimage['seller_staffpic'] != ''){
							if(!unlink($_SERVER['DOCUMENT_ROOT'] ."/sp_60_TrackingForAg/images/".$getimage["seller_staffpic"]."")){
								echo "Delete Picture Fail";
							}
						}
						$target1 = "../images/".$peoplepic;
						move_uploaded_file($_FILES['peoplepic']['tmp_name'], $target1);
						$pic = $con->query("UPDATE seller_staff SET seller_staffpic = '$peoplepic'  WHERE iduser_account = '".$id."'  ");
					}
					if(!empty($placepic)){
						$findimage = $con->query("SELECT sellerpic FROM seller_place WHERE idseller_place = '".$resultid['idfactory_place']."' ");
						$getimage = $findimage->fetch_assoc();
						if($getimage['sellerpic'] != ''){
							if(!unlink($_SERVER['DOCUMENT_ROOT'] ."/sp_60_TrackingForAg/images/".$getimage["sellerpic"]."")){
								echo "Delete Picture Fail";
							}
						}

						$target2 = "../images/".$placepic;
						move_uploaded_file($_FILES['placepic']['tmp_name'], $target2);
						$pic = $con->query("UPDATE seller_place SET sellerpic = '$placepic' WHERE idseller_place = '".$resultid['idseller_place']."'   ");
					}
					echo '<script type="text/javascript" >
					alert("แก้ไขข้อมูลเรียบร้อย");
					window.location.href = "../index.php?action=edituser";
			  		</script>';
				}

				
				
			}
		}
	}
?>