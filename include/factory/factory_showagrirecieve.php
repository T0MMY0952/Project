<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $idshow = $_GET['idapr'];?>
  <title>แสดงรายละเอียด</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <link href="../../css/tracking.css" rel="stylesheet">
</head>

<body style="height: 750px;">
<?php 
  require_once("../../connect/connect.php");
 ?>

<?php
 require_once("../../connect/connect.php");
 session_start();
$id = $_SESSION['iduser_account'];
// find shipment
$sql = "SELECT * FROM shipment WHERE idshipment = $idshow";
$result = $con->query($sql) or die (mysqli_error($con));
$row = $result->fetch_assoc();

// find farmer
$findfarmer = $con->query("SELECT farmname,farmaddress,farmername, farmersurname, farmertel FROM farm_place as fp LEFT JOIN farmer as f ON fp.idfarm_place = f.idfarm_place  
              WHERE idfarmer = '".$row['idfarmer_send']."' ");
$getfarmer = $findfarmer->fetch_assoc();

// find agriculture product 
$findagri = $con->query("SELECT ap_name, ap_collectdate, ap_garden, ap_amount, ap_unit, ap_exportdate FROM agriculture_product WHERE idagriculture_product = '".$row['idagriculture_product']."' "); 
$getagri = $findagri->fetch_assoc();
?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">แสดงรายละเอียด&nbsp(<?php echo 'รหัสการรับผลผลิต&nbsp'; echo $idshow;?>)</h3>
      </ol>
         <div class="col-md-8">
           <form method="post" action="recieveagri.php?idshow=<?php echo $idshow?>">
            <form>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">รหัสการรับผลผลิต</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['idshipment'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">สถานที่ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getfarmer['farmname']; echo ' '; echo $getfarmer['farmaddress'];?>">
              </div>
          </div>
        </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">ชื่อ-นามสกุล ผู้ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getfarmer['farmername']; echo '  '; echo $getfarmer['farmersurname'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm">เบอร์โทรศัพท์ ผู้ส่ง</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getfarmer['farmertel'];?>" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">ชื่อผลผลิต</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getagri['ap_name'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่เก็บ</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getagri['ap_collectdate'];?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">แปลงที่เก็บ</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getagri['ap_garden'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">จำนวน</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getagri['ap_amount']; echo '  '; echo $getagri['ap_unit']; ?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              
              <div class="col-md-6">
                <label for="exampleInputFarm">วันที่ส่งออก</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['exportdate'];?>">
              </div>
            </div>
          </div>
          
            <div class="form-row">
              <div class="col-xs-6 col-sm-6 col-md-6">
              <button class="btn btn-success btn-block" type="submit" mt-5>ตกลง</buttton>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
              <a class="btn btn-danger btn-block" href="javascript:window.open('','_self').close();" mt-5>ยกเลิก</a>
            </div>
            </form>
         </div>
      </div>
</body>
    