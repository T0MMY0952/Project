<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $idshow = $_GET['idapr'];?>
  <title>แสดงรายละเอียด</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="../../dist/js/bootstrap-select.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <link href="../../css/tracking.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" /> 
  <link href="../../css/selectfix.css" rel="stylesheet">
  <link rel="stylesheet" href="../../dist/css/bootstrap-select.css">
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
// find shipment
$sql = "SELECT * FROM shipment WHERE idshipment = $idshow";
$result = $con->query($sql) or die (mysqli_error($con));
$row = $result->fetch_assoc();

// find product
$findproduct = $con->query("SELECT p_name,p_amount,p_unit,p_process,p_mfd,p_exp FROM product WHERE idproduct = '".$row['idproduct']."' ");
$getproduct = $findproduct->fetch_assoc();

// find factory
$findfactory = $con->query("SELECT factoryname,factoryaddress,factorytel FROM factory_place WHERE idfactory_place = '".$row['idfactory_send']."' "); 
$getfactory = $findfactory->fetch_assoc();
?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">แสดงรายละเอียด&nbsp(<?php echo 'รหัสการรับผลผลิต&nbsp'; echo $idshow;?>)</h3>
      </ol>
         <div class="col-md-8">
           <form method="post" action="agriexport.php?idshow=<?php echo $idshow?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">ชื่อผลิตภัณฑ์</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value = "<?php echo $getproduct['p_name'];?>" disabled="disabled"  >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">สถานที่ส่ง</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value = "<?php echo $getfactory['factoryname']; 
                echo ' '; echo $getfactory['factoryaddress'];?>" disabled="disabled"  >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">เบอร์โทรศัพท์</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value = "<?php echo $getfactory['factorytel']; ?>" disabled="disabled"  >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">จำนวนผลิตภัณฑ์</label>
                <input class="form-control" name="amount" type="text" aria-describedby="nameHelp" value = "<?php echo $getproduct['p_amount'];  echo ' '; echo $getproduct['p_unit'];?>"  disabled="disabled">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputTel">กระบวนการผลิต</label>
                <textarea class="form-control" name="process" type="text" aria-describedby="nameHelp" disabled="disabled" ><?php echo $getproduct['p_process']; ?> </textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่ผลิตของผลิตภัณฑ์</label>
                <input type="text"  class="form-control" name="mfddate" value = "<?php echo $getproduct['p_mfd'];?>" disabled="disabled"/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">วันที่หมดอายุของผลิตภัณฑ์</label>
                <input type="text"  class="form-control" name="expdate" value = "<?php echo $getproduct['p_exp'];?>" disabled="disabled" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่ส่งออกของผลิตภัณฑ์</label>
                <input class="form-control" name="exportdate" type="text" value = "<?php echo $row['exportdate'];?>" disabled="disabled" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>ชื่อผลิตภัณฑ์</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>จำนวนส่งออกผลิตภัณฑ์</label>
                <input class="form-control" name="amount" type="text" aria-describedby="nameHelp" >
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>หน่วย</label>
                <input class="form-control" name="unit" type="text" aria-describedby="nameHelp" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>กระบวนการผลิต</label>
                <textarea class="form-control" name="process" type="text" aria-describedby="nameHelp"> </textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>วันที่ผลิตของผลิตภัณฑ์</label>
                <input type="text" id="datepicker" class="form-control" name="mfddate" />
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>วันที่หมดอายุของผลิตภัณฑ์</label>
                <input type="text" id="datepicker1" class="form-control" name="expdate" />
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
                <label for="basic"><a style="color: red;">*</a>สถานที่ที่จัดส่ง</label>
                <select id="basic" class="selectpicker show-tick form-control" data-live-search="true" name="idrecieve" >
                    <option>เลือกสถานที่จัดส่ง</option>
                    <optgroup label="โรงงาน">
                    <?php
                      $sql = "SELECT idfactory_place, factoryname FROM factory_place  
                              WHERE idfactory_place NOT IN (SELECT idfactory_place FROM factory_staff WHERE iduser_account = $id)
                              ORDER BY factoryname ASC";
                      $objQuery = mysqli_query($con,$sql) or die(mysqli_error($con)) ;
                      while($objResult = mysqli_fetch_array($objQuery)){
                    ?>
                      <option data-tokens="<?php echo $objResult['factoryname']; ?>" value="<?php echo $objResult['idfactory_place'] ?>" ><?php echo $objResult['factoryname']; ?>
                      </option>
                    <?php
                     }
                    ?>
                    <optgroup label="ผู้จัดจำหน่าย">
                    <?php
                      $sql = "SELECT idseller_place, sellername FROM seller_place ORDER BY sellername ASC";
                      $objQuery = mysqli_query($con,$sql) or die(mysqli_error($con)) ;
                      while($objResult = mysqli_fetch_array($objQuery)){
                    ?>
                      <option data-tokens="<?php echo $objResult['sellername']; ?>" value="<?php echo 's'.$objResult['idseller_place'] ?>" ><?php echo $objResult['sellername']; ?>
                      </option>
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
    