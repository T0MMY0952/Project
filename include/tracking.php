<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tracking</title>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/tracking.css" rel="stylesheet">
 
 <style type="text/css">
   
   .content-wrapper {
    margin-left: 10px;
    margin-right:  10px;
}
body {
    background-image: url("../icon/bg.jpg");
    background-color: #cccccc;
}
 </style>
</head>


<body id="page-top" >
  <div class="container" >
  <div class="content-wrapper" style="border:2px solid #33cc33; border-radius: 25px;">
    <div class="container-fluid" >
      <!-- Breadcrumbs-->
      <ol class="breadcrumb" style="background-color: #33cc33;">
        <h3 align="center" style="color:white;"><img widht="50px" height="50px"  src="../icon/trace.png">&nbspตรวจสอบย้อนกลับผลผลิตทางการเกษตร</h3>
      </ol>
<?php
  $id = $_GET['idshipment'];
  $type = $_GET['type'];
  require_once("../connect/connect.php");
  $findtrack = $con->query
                ("SELECT t1.idshipment as t1 , t2.idshipment as t2, t3.idshipment as t3, t4.idshipment as t4 , t5.idshipment as t5, 
                  !ISNULL(t1.idshipment)+ !ISNULL(t2.idshipment) +  !ISNULL(t3.idshipment) +  !ISNULL(t4.idshipment) +  !ISNULL(t5.idshipment)  as count
                  FROM shipment AS t1 
                  LEFT JOIN shipment as t2 ON t1.`idshipment` = t2.`idshipment_prev`
                  LEFT JOIN shipment as t3 ON t2.`idshipment` = t3.`idshipment_prev`
                  LEFT JOIN shipment as t4 ON t3.`idshipment` = t4.`idshipment_prev`
                  LEFT JOIN shipment as t5 ON t4.`idshipment` = t5.`idshipment_prev`
                  WHERE  t1.`idshipment` = $id  OR t2.`idshipment` = $id  OR t3.`idshipment` = $id OR t4.`idshipment` = $id OR t5.`idshipment` = $id
                  LIMIT 1") or die(mysqli_error($con));
  $gettrack = $findtrack->fetch_assoc();
  $n = $gettrack['count'];
  if ($type == "factory"){
  	$const = 1;
  }elseif($type =="seller"){
  	$const = 0;
  }
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home-tab" aria-selected="true"><img widht="24px" height="24px"  src="../icon/farmer.png">เกษตรกร</a>
  </li>
<?php
  if ($n >= 2){
        for ($i = 2 ; $i <=  $gettrack['count']; $i++) {
?>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="<?php echo "#profile".$i; ?>" role="tab" aria-controls="profile-tap" aria-selected="false"><img widht="24px" height="24px"  src="../icon/factory.png">โรงงาน<?php echo $i-1; ?></a>
  </li>
<?php
      }
  }
?>
<?php
	if ($type != "factory"){
?>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact-tab" aria-selected="false"><img widht="24px" height="24px"  src="../icon/seller.png">ผู้จัดจำหน่าย</a>
  </li>
<?php
	}
?>
</ul>


<!------------------------------------เปิดทั้ง3tap---------------------------------------->
<div class="tab-content" id="myTabContent">
<?php 
	//-- farmer tab
	$step1 = $gettrack['t1'];
	include('trackingfarmer.php');

	
	if($type == "factory"){
		//-- factory tab for factory user
		for ($i = 2 ; $i <=  $gettrack['count']; $i++) {
			$step2 = $gettrack['t'.$i];
			include('trackingfactory.php');
		}
	}elseif($type == "seller"){
		//-- factory tab for seller user
		for ($i = 2 ; $i <=  $gettrack['count']; $i++) {
			$step2 = $gettrack['t'.$i];
			include('trackingfactory.php');
		}
		//-- seller tab
		$step3 = $gettrack['t'.$n];
		include('trackingseller.php');
	}
?>











</div>
<!------------------------------------ปิดทั้ง3tap---------------------------------------->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </div>
</div>
</body>

</html>
