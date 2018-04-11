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
?>
<div class="container-fluid">
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
          <div class="col-md-8">
          <form method="post" action="recieveagri.php?idshow=<?php echo $idshow?>">
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
    