<meta charset="utf-8">
<?php
	require_once("../connect/connect.php");
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$type = $_POST['type'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$tel = $_POST['tel'];
	$businessname = $_POST['businessname'];
	$businessaddress = $_POST['businessaddress'];
	$businesstel = $_POST['businesstel'];
	$peoplepic = $_FILES['peoplepic']['name']; 
	$placepic = $_FILES['placepic']['name'];

	
	if (empty($email) || empty($password) || empty($repassword) || empty($name) || empty($surname)  || empty($businessname) || empty($businessaddress) || !is_numeric($type) || 
		empty($peoplepic) ){
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
		$result = $con->query("SELECT COUNT(*) AS count FROM user_account WHERE email='$email' ");
		$row=$result->fetch_assoc();
			if($row['count']){
			//--email ซ้ำกัน
			echo '<script type="text/javascript" >
				alert("email นี้เคยถูกใช้แล้ว");
				window.location.href = "javascript:history.back()";
			  	</script>';
			}else{
				$target1 = "../images/".$peoplepic;
				$target2 = "../images/".$placepic;
				move_uploaded_file($_FILES['peoplepic']['tmp_name'], $target1);
				move_uploaded_file($_FILES['placepic']['tmp_name'], $target2);
				/*if (move_uploaded_file($_FILES['peoplepic']['tmp_name'], $target) && move_uploaded_file($_FILES['placepic']['tmp_name'], $target2)) {
  					echo  "Image uploaded successfully";
  				}else{
  					echo "Failed to upload image";
  				}*/
				if ($type == 1) {
					//--farmer regis
					//--Check farmname is duplicate
					$duplicate = $con->query("SELECT COUNT(*) AS count FROM farm_place WHERE farmname = '$businessname'")  or die(mysqli_error($con));
					$row1 = $duplicate->fetch_assoc();
					if($row1['count']){
						$insertuser = $con->query("INSERT INTO user_account (iduser_account,email,pass,type) VALUES ('','$email','$password','farmer')") or die(mysqli_error($con));
						$insertfarmer = $con->query("INSERT INTO farmer(idfarm_place,iduser_account,farmername,farmersurname,farmertel,farmerpic) VALUES(
						(SELECT idfarm_place FROM farm_place WHERE farm_place.farmname = '$businessname'), (SELECT iduser_account FROM user_account WHERE user_account.email = '$email'),'$name','$surname','$tel','$peoplepic')")  or die(mysqli_error($con));
					}else{
						$insertuser = $con->query("INSERT INTO user_account (iduser_account,email,pass,type) VALUES ('','$email','$password','farmer')") or die(mysqli_error($con));
						$insertfarm = $con->query("INSERT INTO farm_place (idfarm_place,farmname,farmaddress,farmtel,farmpic) VALUES ('','$businessname','$businessaddress','$businesstel','$placepic')")  or die(mysqli_error($con));
						$insertfarmer = $con->query("INSERT INTO farmer(idfarm_place,iduser_account,farmername,farmersurname,farmertel,farmerpic) VALUES(
						(SELECT idfarm_place FROM farm_place WHERE farm_place.farmname = '$businessname'), (SELECT iduser_account FROM user_account WHERE user_account.email = '$email'),'$name','$surname','$tel','$peoplepic')")  or die(mysqli_error($con));
					}
					echo '<script type="text/javascript" >
					alert("สมัครสมาชิกเรียบร้อย");
					window.location.href = "../index.php";
			  		</script>';
				}
				if ($type == 2) {
					//--factory regis
					//--Check factoryname is duplicate
					$duplicate = $con->query("SELECT COUNT(*) AS count FROM factory_place WHERE factoryname = '$businessname'") 
								 or die(mysqli_error($con));
					$checkdup = $duplicate->fetch_assoc();
					if($checkdup['count']){
						echo '<script type="text/javascript" >
						alert("โรงงานนี้มีผู้ใช้แล้ว กรุณาตั้งชื่อโรงงานใหม่");
						window.location.href = "../index.php";
			  			</script>';
					}else{
						$insertuser = $con->query("INSERT INTO user_account (iduser_account,email,pass,type) VALUES ('','$email','$password','factoryadmin')") or die(mysqli_error($con));
						$insertfactory = $con->query("INSERT INTO factory_place (idfactory_place,factoryname,factoryaddress,factorytel,factorypic) VALUES ('','$businessname','$businessaddress','$businesstel','$placepic')") or die(mysqli_error($con));
						$insertfactory_staff = $con->query("INSERT INTO factory_staff(idfactory_place,iduser_account,factory_staffname,factory_staffsurname,factory_stafftel,factory_staffpic) VALUES(
						(SELECT idfactory_place FROM factory_place WHERE factory_place.factoryname = '$businessname'), (SELECT iduser_account FROM user_account WHERE user_account.email = '$email'),
						'$name','$surname','$tel','$peoplepic')") or die(mysqli_error($con));
					}
					echo '<script type="text/javascript" >
					alert("สมัครสมาชิกเรียบร้อย");
					window.location.href = "../index.php";
			  		</script>';
				}
				if ($type == 3) {
					//--seller regis
					//--Check sellername is duplicate
					$duplicate = $con->query("SELECT COUNT(*) AS count FROM seller_place WHERE sellername = '$businessname'") 
								 or die(mysqli_error($con));
					$checkdup = $duplicate->fetch_assoc();
					if($checkdup['count']){
						echo '<script type="text/javascript" >
						alert("ผู้จัดจำหน่ายนี้มีผู้ใช้แล้ว กรุณาตั้งชื่อผู้จัดจำหน่ายใหม่");
						window.location.href = "../index.php";
			  			</script>';
					}else{
						$insertuser = $con->query("INSERT INTO user_account (iduser_account,email,pass,type) VALUES ('','$email','$password','selleradmin')");
						$insertseller = $con->query("INSERT INTO seller_place (idseller_place,sellername,selleraddress,sellertel,sellerpic) VALUES ('','$businessname','$businessaddress','$businesstel','$placepic')");
						$insertseller_staff = $con->query("INSERT INTO seller_staff(idseller_place,iduser_account,seller_staffname,seller_staffsurname,seller_stafftel,seller_staffpic) VALUES(
						(SELECT idseller_place FROM seller_place WHERE seller_place.sellername = '$businessname'), (SELECT iduser_account FROM user_account WHERE user_account.email = '$email'),'$name','$surname','$tel','$peoplepic')") or die(mysqli_error($con));
					}
					echo '<script type="text/javascript" >
					alert("สมัครสมาชิกเรียบร้อย");
					window.location.href = "../index.php";
			  		</script>';
				}

				
				
			}
		}
	}
?>