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
 </style>
</head>


<body class="bg-dark" id="page-top">
  <div class="container">
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">ตรวจสอบย้อนกลับ</h3>
      </ol>
<?php
  $id = $_GET['idshipment'];
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
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home-tab" aria-selected="true">เกษตรกร</a>
  </li>
<?php
  $n = $gettrack['count'];
  if ($n >= 3){
        for ($i = 2 ; $i <=  $gettrack['count']-1; $i++) {
?>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile-tap" aria-selected="false">โรงงาน</a>
  </li>
<?php
      }
  }
?>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact-tab" aria-selected="false">ผู้จัดจำหน่าย</a>
  </li>

</ul>


<!------------------------------------เปิดทั้ง3tap---------------------------------------->
<div class="tab-content" id="myTabContent">
<!------------------------------------เปิดtapเกษตรกร---------------------------------------->
<?php
  $step1 = $gettrack['t1'];
  $findinfo1 = $con->query("SELECT * 
                      FROM shipment as s 
                      LEFT JOIN agriculture_product as ap ON s.idagriculture_product = ap.idagriculture_product 
                      LEFT JOIN farmer as f               ON ap.idfarmer = f.idfarmer 
                      LEFT JOIN farm_place as fp          ON f.idfarm_place = fp.idfarm_place 
                      WHERE idshipment = $step1") or die(mysqli_error($con));
  $getinfo1 = $findinfo1->fetch_assoc();
?>
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="form-group">
        <br>
      <div class="row">
      <div class="col-md-5">
      <div class="col-md-offset-1 " >
      <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อผลผลิต</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['ap_name']; ?> " disabled="disabled">
    </div>
    </div>
  
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">วันที่เก็บ</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['ap_collectdate']; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">วันที่ส่งออก</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['ap_exportdate']; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อสวน/ฟาร์ม</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['farmname']; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-5 control-label">ชื่อ-นามสกุลเกษตรกร</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo1['farmername']; echo ' '; echo $getinfo1['farmersurname'];?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">ที่อยู่</label>
    <div class="col-sm-9">
      <textarea type="text" class="form-control" id="inputEmail3" disabled="disabled"> <?php echo $getinfo1['farmaddress']; ?></textarea> 
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo1['farmertel']; ?>" disabled="disabled">
    </div>
  </div>

</div> 
</div> 

  <!-----------------แบ่งcolum สำหรับรูป------>
     <div class="col-md-6">

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img class="d-block w-100" src="C:\AppServ\www\beau\pic\สวนมะพร้าว.jpg" alt="First slide">
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" src="C:\AppServ\www\beau\pic\สวนมะพร้าว2.jpg" alt="Second slide">
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" src="C:\AppServ\www\beau\pic\สวนมะพร้าว3.jpg" alt="Third slide">
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>


  </div>
</div>
</div>
</div>
  <!------------------------------------ปิดtapเกษตรกร---------------------------------------->


<!------------------------------------เปิดtapโรงงาน---------------------------------------->
<?php
  $n = $gettrack['count'];
  if ($n >= 3){
    for ($c = 2 ; $c <=  $gettrack['count']-1; $c++) {
    $step2 = $gettrack['t'.$c];
    $findinfo2 = $con->query("SELECT * 
                      FROM shipment as s 
                      LEFT JOIN product as p          ON s.idproduct = p.idproduct 
                      LEFT JOIN factory_place as fp   ON p.idfactory_place = fp.idfactory_place 
                      WHERE idshipment = $step2") or die(mysqli_error($con));
    $getinfo2 = $findinfo2->fetch_assoc();
?>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
     <div class="form-group">
   <br>
    <div class="row">
    <div class="col-md-5">
    <div class="col-md-offset-1 " >
    <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อผลิตภัณฑ์</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo2['p_name']; ?>" disabled="disabled" >
    </div>

  </div>

    <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อโรงงาน</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo2['factoryname']; ?>" disabled="disabled">
    </div>
 
  </div>

  <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">กระบวนการผลิต</label>
    <div class="col-sm-9 ">
      <textarea type="textarea" class="form-control" id="inputEmail3" disabled="disabled"><?php echo $getinfo2['p_process']; ?></textarea> 
    </div>

  </div>

  <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ที่อยู่</label>
    <div class="col-sm-9 ">
      <textarea type="textarea" class="form-control" id="inputEmail3"  disabled="disabled"><?php echo $getinfo2['factoryaddress']; ?></textarea>
    </div>

  </div>


  <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-7 control-label">วันที่ผลิตของสินค้า</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo2['p_mfd']; ?>" disabled="disabled">
    </div>

  </div>

    <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-7 control-label">วันที่หมดอายุของสินค้า</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo2['p_exp']; ?>" disabled="disabled">
    </div>
 
  </div>

  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">วันที่รับสินค้า</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo2['recievedate']; ?>" disabled="disabled">
    </div>

  </div>

  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo2['factorytel']; ?>" disabled="disabled">
    </div>
   </div>
    
  </div>
  </div>
  <!------ปิด col-5 ---->

  <!-----------------แบ่งcolum สำหรับรูป------>
    <div class="col-md-6">  

  <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img class="d-block w-100" src="C:\AppServ\www\beau\pic\กะทิ1.jpg" alt="First slide">
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" src="C:\AppServ\www\beau\pic\กะทิ2.jpg" alt="Second slide">
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" src="C:\AppServ\www\beau\pic\กะทิ3.jpg" alt="Third slide">
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>
   </div>
  </div>
</div>
</div>
</div>
<?php
    }
}
?>
<!------------------------------------ปิดtapโรงงาน---------------------------------------->



<!------------------------------------เปิดtapผู้จัดจำหน่าย---------------------------------------->
<?php
  $step3 = $gettrack['t'.$n];
  $findinfo3 = $con->query("SELECT * 
                      FROM shipment as s 
                      LEFT JOIN seller_place as sp          ON s.idseller_recieve = sp.idseller_place
                      WHERE idshipment = $step3") or die(mysqli_error($con));
  $getinfo3 = $findinfo3->fetch_assoc();
?>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="form-group">
        <br>
      <div class="row">
      <div class="col-md-5">
      <div class="col-md-offset-1 " >

   <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">จัดจำหน่ายโดย</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo3['sellername']; ?>" disabled="disabled" >
    </div>
  </div>
  

  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">ที่อยู่</label>
    <div class="col-sm-9">
      <textarea type="textarea" class="form-control" id="inputPassword3"  disabled="disabled" ><?php echo $getinfo3['selleraddress']; ?></textarea>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo3['sellertel']; ?>" disabled="disabled">
    </div>
    
  </div>
  </div>
  <!-----ปิดcol5-------->
  </div> 
   <!-----ปิดcol5-------->

<!-----------------แบ่งcolum สำหรับรูป------>
    <div class="col-md-6">       

       <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img class="d-block w-100" src="C:\AppServ\www\beau\pic\คลังสินค้า.jpg" alt="First slide">
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>
   </div>

  </div>
</div>
</div>
</div>
<!------------------------------------เปิดtapผู้จัดจำหน่าย---------------------------------------->

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
