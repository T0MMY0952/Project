<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $idshow = $_GET['idshipment'];?>
  <title>แสดงรายละเอียด</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <link href="../../css/tracking.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
</head>

<body style="height: 750px;">
<?php 
  require_once("../../connect/connect.php");
 ?>

<script type="text/javascript">

$(function() {
    $('#datepicker').datepicker({
      format: 'dd/mm/yyyy'
    });   
});

$(function() {
    $('#datepicker1').datepicker({
      format: 'dd/mm/yyyy'
    });   
});


</script>
<?php
 require_once("../../connect/connect.php");
 session_start();
$id = $_SESSION['iduser_account'];
// find factory
$findidfactory = $con->query("SELECT idfactory_place FROM factory_staff WHERE iduser_account = '".$id."' ") or die (mysqli_error($con));
$getidfactory = $findidfactory->fetch_assoc();

// find shipment
$sql = "SELECT *
     FROM shipment as s left JOIN product as p on s.idproduct = p.idproduct
     WHERE s.idshipment = $idshow ";
$result = $con->query($sql) or die (mysqli_error($con));
$row = $result->fetch_assoc();

// find prev shipment
$sql1 = "SELECT *
         FROM shipment as s
         left JOIN agriculture_product as ap on s.idagriculture_product = ap.idagriculture_product 
         left JOIN farmer as f on ap.idfarmer = f.idfarmer
         left JOIN farm_place as fp on f.idfarm_place = fp.idfarm_place
         WHERE idshipment = '".$row['idshipment_prev']."' ";
$findprev = $con->query($sql1) or die (mysqli_error($con));
$getprev = $findprev->fetch_assoc();

?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">แสดงรายละเอียด&nbsp(<?php echo 'รหัสการรับผลผลิต&nbsp'; echo $idshow;?>)</h3>
      </ol>
         <div class="col-md-8">
           <form method="post" action="updateproduct.php?idshow=<?php echo $idshow?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">รหัสการรับผลผลิต</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['idshipment'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">สถานที่ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['farmname']; echo ' '; echo $getprev['farmaddress'];?>">
              </div>
          </div>
        </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">ชื่อ-นามสกุล ผู้ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['farmername']; echo '  '; echo $getprev['farmersurname'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm">เบอร์โทรศัพท์ ผู้ส่ง</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['farmertel'];?>" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">ชื่อผลผลิต</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['ap_name'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่เก็บ</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['ap_collectdate'];?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">แปลงที่เก็บ</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['ap_garden'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">จำนวน</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['ap_amount']; echo '  '; echo $getprev['ap_unit']; ?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              
              <div class="col-md-6">
                <label for="exampleInputFarm">วันที่ส่งออก</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getprev['exportdate'];?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>ชื่อผลิตภัณฑ์</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value="<?php echo $row['p_name'];?>" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>จำนวนส่งออกผลิตภัณฑ์</label>
                <input class="form-control" name="amount" type="text" aria-describedby="nameHelp" value="<?php echo $row['p_amount'];?>" >
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>หน่วย</label>
                <input class="form-control" name="unit" type="text" aria-describedby="nameHelp" value="<?php echo $row['p_unit'];?>" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>กระบวนการผลิต</label>
                <textarea class="form-control" name="process" type="text" aria-describedby="nameHelp"> <?php echo $row['p_process'];?> </textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>วันที่ผลิตของผลิตภัณฑ์</label>
                <input type="text" id="datepicker" class="form-control" name="mfddate" value="<?php echo $row['p_mfd'];?>" />
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>วันที่หมดอายุของผลิตภัณฑ์</label>
                <input type="text" id="datepicker1" class="form-control" name="expdate" value="<?php echo $row['p_exp'];?>"/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>วันที่ส่งออกของผลิตภัณฑ์</label>
                <input class="form-control" name="exportdate" type="text" aria-describedby="nameHelp" value="<?php 
                  date_default_timezone_set("Asia/Bangkok");
                  $date = new DateTime();
                  $date->modify('+543 Year');
                  echo $date->format('d/m/Y H:i:s');
                ?>" disabled="disabled">
              </div>
              <div class="col-md-6">
                <label for="exampleInputAddress"><a style="color: red;">*</a>สถานที่จัดส่ง</label>
                <select class="form-control" name="idrecieve" >
                    <option>เลือกผู้จัดจำหน่ายที่จัดส่ง</option>
                  <?php
                    $sql = "SELECT idseller_place, sellername FROM seller_place ORDER BY sellername ASC";
                    $objQuery = mysqli_query($con,$sql) or die(mysqli_error($con)) ;
                    while($objResult = mysqli_fetch_array($objQuery)){
                  ?>
                    <option value="<?php echo $objResult['idseller_place'] ?>" <?php if($row['idseller_recieve'] == $objResult['idseller_place']){echo 'selected="selected""';} ?> ><?php echo $objResult['sellername']; ?></option>
                    <?php
                  }
                  ?>
                </select>
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
    