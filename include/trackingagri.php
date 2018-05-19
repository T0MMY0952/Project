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
  $array = unserialize($data);
  require_once("../connect/connect.php");
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home-tab" aria-selected="true">เกษตรกร</a>
  </li>
</ul>

<!------------------------------------เปิดทั้ง3tap---------------------------------------->
<div class="tab-content" id="myTabContent">
<?php
  $id = $_GET['id'];
  $findinfo1 = $con->query("SELECT * 
                      FROM agriculture_product as ap       
                      LEFT JOIN farmer as f               ON ap.idfarmer = f.idfarmer 
                      LEFT JOIN farm_place as fp          ON f.idfarm_place = fp.idfarm_place 
                      WHERE idagriculture_product = $id ") or die(mysqli_error($con));
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
      <input type="email" class="form-control" id="inputEmail3" value="<?php 
      $date = date_create($getinfo1['ap_collectdate']); 
      echo $date->format('d/m/Y');?>" disabled="disabled">
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
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <?php echo "<img src='../images/".$getinfo1['farmerpic']."'" ?> class="d-block w-100" alt="First slide">
    </div>

    <div class="carousel-item">
      <?php echo "<img src='../images/".$getinfo1['farmpic']."'" ?> class="d-block w-100" alt="Second slide">
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
