<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $idshow = $_GET['idshipment'];?>
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
      changeMonth: true,
      changeYear: true,
      format: 'dd/mm/yyyy'
    });   
});

</script>
<?php
 require_once("../../connect/connect.php");
 session_start();
$id = $_SESSION['iduser_account'];

// find shipment
$sql = "SELECT *,datediff(p_exp,p_mfd) as p_expdate
     FROM shipment as s left JOIN product as p on s.idproduct = p.idproduct
     WHERE s.idshipment = $idshow ";
$result = $con->query($sql) or die (mysqli_error($con));
$rowcurrent = $result->fetch_assoc();

// find prev shipment
$sql1 = "SELECT *
         FROM shipment
         WHERE idshipment = '".$rowcurrent['idshipment_prev']."' ";
$findprev = $con->query($sql1) or die (mysqli_error($con));
$row = $findprev->fetch_assoc();

?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">แสดงรายละเอียด&nbsp(<?php echo 'รหัสการรับผลผลิต&nbsp'; echo $idshow;?>)</h3>
      </ol>
      <?php
      if(!is_null($row['idfarmer_send'])){
          include('showagri.php');
      }elseif(!is_null($row['idfactory_send'])){
          include('showproduct.php');
      }
      ?>
      <hr width="100%">
      <div class="col-md-8">
        <form method="post" action="updateproduct.php?idshow=<?php echo $idshow?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>ชื่อสินค้า</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value="<?php echo $rowcurrent['p_name'];?>" placeholder="ชื่อสินค้า" >
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>จำนวนส่งออกสินค้า</label>
                <input class="form-control" name="amount" type="text" aria-describedby="nameHelp" value="<?php echo $rowcurrent['p_amount'];?>" placeholder="จำนวนสินค้าที่ส่งออก" >
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>หน่วย</label>
                <input class="form-control" name="unit" type="text" aria-describedby="nameHelp" value="<?php echo $rowcurrent['p_unit'];?>" placeholder="เช่น ถุง ห่อ กระป๋อง เป็นต้น" >
              </div>
            </div>
            </div>
            <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>กระบวนการผลิต</label>
                <textarea class="form-control" name="process" type="text" aria-describedby="nameHelp"> <?php echo $rowcurrent['p_process'];?> </textarea>
              </div>
            </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>วันที่ผลิตของสินค้า</label>
                <input type="text" id="datepicker" class="form-control" name="mfddate" value="<?php 
                $date = date_create($rowcurrent['p_mfd']);
                echo date_format($date,"d/m/Y"); ?>" placeholder="วันที่ผลิตของสินค้า" />
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>อายุของสินค้า</label>
                <input type="text"  class="form-control" name="expdate" value="<?php 
                echo $rowcurrent['p_expdate']; ?>" placeholder="อายุของสินค้านับตั้งแต่วันที่ผลิต หน่วยเป็นวัน" />
              </div>
            </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="exampleInputTel"><a style="color: red">*</a>วันที่ส่งออกของสินค้า</label>
                  <input class="form-control" name="exportdate" type="text" aria-describedby="nameHelp" value="<?php 
                    date_default_timezone_set("Asia/Bangkok");
                    $date = new DateTime();
                    $date->modify('+543 Year');
                    echo $date->format('d/m/Y H:i:s');
                  ?>" disabled="disabled">
                </div>
                <div class="col-md-6">
                  <label for="basic"><a style="color: red;">*</a>สถานที่จัดส่ง</label>
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
                        <option data-tokens="<?php echo $objResult['factoryname']; ?>" value="<?php echo $objResult['idfactory_place'] ?>" 
                        <?php if($rowcurrent['idfactory_recieve'] == $objResult['idfactory_place']){echo 'selected="selected""';} ?> ><?php echo $objResult['factoryname']; ?>
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
                        <option data-tokens="<?php echo $objResult['sellername']; ?>" value="<?php echo 's'.$objResult['idseller_place'] ?>" 
                        <?php if($rowcurrent['idseller_recieve'] == $objResult['idseller_place']){echo 'selected="selected""';} ?>><?php echo $objResult['sellername']; ?>
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
            </div>       
          </div>
        </form>
      </div>
</body>
    