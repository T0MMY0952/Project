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
	$peoplepic = $_FILES['peoplepic']['name']; 
	$type = $_SESSION['type'];
	$id = $_SESSION['iduser_account'];

	if (empty($email) || empty($password) || empty($repassword) || empty($name) || empty($surname) ){
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
				if ($type == "factory") {
					//--factory update
					$updateuser = $con->query("UPDATE user_account SET email = '$email' , pass = '$password' WHERE iduser_account = '".$id."' ");
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
				}
				elseif ($type == "seller") {
					$updateuser = $con->query("UPDATE user_account SET email = '$email' , pass = '$password' WHERE iduser_account = '".$id."' ");
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
				}

				echo '<script type="text/javascript" >
				alert("แก้ไขข้อมูลเรียบร้อย");
				window.location.href = "../index.php?action=edituser";
			  	</script>';
				
			}
		}
	}
?>