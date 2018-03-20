<meta charset="utf-8">
<?php
	session_start();
	require_once("../connect/connect.php");
	$type = $_GET['type'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$tel = $_POST['tel'];
	$peoplepic = $_FILES['peoplepic']['name']; 
	
	if (empty($email) || empty($password) || empty($repassword) || empty($name) || empty($surname)){
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
			$target1 = "../images/".$peoplepic;
			move_uploaded_file($_FILES['peoplepic']['tmp_name'], $target1);
				if ($type == "factory") {
					//--factory regis
					$insertuser = $con->query("INSERT INTO user_account (iduser_account,email,pass,type,status,lastupdate) VALUES ('','$email','$password','factory','','')");
					$last_id = mysqli_insert_id($con);
					$find_id = $con->query("SELECT idfactory_place FROM factory_staff WHERE iduser_account = '".$_SESSION['iduser_account']."'");
					$get_id = $find_id->fetch_assoc();
					$insertfactory_staff = $con->query("INSERT INTO factory_staff
						(idfactory_place,iduser_account,factory_staffname,factory_staffsurname,factory_stafftel,factory_staffpic) VALUES('".$get_id['idfactory_place']."','$last_id','$name','$surname','$tel','$peoplepic')") or die (mysqli_error($con));
				}
				if ($type == "seller") {
					//--seller regis
					$insertuser = $con->query("INSERT INTO user_account (iduser_account,email,pass,type,status,lastupdate) VALUES ('','$email','$password','seller','','')");
					$last_id = mysqli_insert_id($con);
					$find_id = $con->query("SELECT idseller_place FROM seller_staff WHERE iduser_account = '".$_SESSION['iduser_account']."'");
					$get_id = $find_id->fetch_assoc();
					$insertseller_staff = $con->query("INSERT INTO seller_staff
						(idseller_place,iduser_account,seller_staffname,seller_staffsurname,seller_stafftel,seller_staffpic) VALUES(
						'".$get_id['idseller_place']."', '$last_id','$name','$surname','$tel','$peoplepic')") or die (mysqli_error($con));
				}

				echo '<script type="text/javascript" >
				alert("สมัครสมาชิกเรียบร้อย");
				window.location.href = "../index.php";
			  	</script>';
		}
	}
