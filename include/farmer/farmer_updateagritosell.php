<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $idshow = $_GET['idapr'];?>
  <title>แก้ไขผลผลิตที่จำหน่าย</title>
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
      format: 'dd/mm/yyyy',
      changeMonth: true,
      changeYear: true
    });   
});

</script>
<?php
 require_once("../../connect/connect.php");
 $sql = "SELECT *
		     FROM agriculture_product 
		     WHERE idagriculture_product = $idshow ";
$result = $con->query($sql) or die (mysqli_error($con));
$row = $result->fetch_assoc();
?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">แก้ไขผลผลิตที่จำหน่าย&nbsp(<?php echo 'รหัสผลผลิต&nbsp'; echo $idshow;?>)</h3>
      </ol>
         <div class="col-md-8">
           <form method="post" action="updateagritosell.php">
            <div class="form-group col-md-8 ">
                <label ><a style="color: red;">*</a>รหัสผลผลิต</label>
                <input class="form-control" name="idap" type="text" readonly="readonly" value="<?php echo $row['idagriculture_product'];?>" >
            </div>
            <div class="form-group col-md-8 ">
                <label ><a style="color: red;">*</a>ชื่อผลผลิต</label>
                <input class="form-control" name="ap_name" type="text" autocomplete="off" value="<?php echo $row['ap_name'];?>" >
            </div>
            <div class="form-group col-md-8">
                <label ><a style="color: red;">*</a>วันที่เก็บ</label>
                <input class="form-control" name="apr_collectdate" type="text" id="datepicker"  value="<?php  
                $date = date_create($row['ap_collectdate']);
                echo date_format($date,"d/m/Y"); ?>" >
            </div>
            <div class="form-group col-md-8">
                <label >แปลงที่เก็บ</label>
                <input class="form-control" name="apr_garden" type="text"  value="<?php echo $row['ap_garden'];?>" >
            </div>
            <div class="form-group col-md-8"> 
              <div class="form-row">
                <div class="col-md-6">
                  <label ><a style="color: red;">*</a>จำนวน</label>
                  <input class="form-control" name="apr_amount" type="text" value="<?php echo $row['ap_amount'];?>" >
                </div>
                <div class="col-md-6">
                  <label ><a style="color: red;">*</a>หน่วย</label>
                  <input class="form-control" name="apr_unit" type="text"  value="<?php echo $row['ap_unit'];?>">
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="form-row">
                  <label >ราคาต่อหน่วย</label>
                  <div class="col-sm-10">
                    <input class="form-control " name="apr_price" type="text"  value="<?php echo $row['ap_price'];?>" >
                  </div>
                  <div class="col-sm-2">
                    <label > บาท</label>
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
    