<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $idshow = $_GET['idshipment'];?>
  <title>รับสินค้า</title>
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
 session_start();
$id = $_SESSION['iduser_account'];
// find shipment
$sql = "SELECT *
     FROM shipment as s left JOIN product as p on s.idproduct = p.idproduct
     WHERE s.idshipment = $idshow ";
$result = $con->query($sql) or die (mysqli_error($con));
$row = $result->fetch_assoc();

?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">รายละเอียดสินค้า</h3>
      </ol>
      <div class="col-md-8">
      	<form method="post" action="recieveproduct.php?idshow=<?php echo $idshow?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">ชื่อสินค้า</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value="<?php echo $row['p_name'];?>" disabled="disabled">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">จำนวนสินค้า</label>
                <input class="form-control" name="amount" type="text" aria-describedby="nameHelp" value="<?php echo $row['p_amount']; echo ' '; echo $row['p_unit']; ?>" disabled="disabled">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputTel">กระบวนการผลิต</label>
                <textarea class="form-control" name="process" type="text" aria-describedby="nameHelp" disabled="disabled"> <?php echo $row['p_process'];?> </textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่ผลิตสินค้า</label>
                <?php
                  $date = new DateTime($row['p_mfd']);
                  $result = $date->format('d/m/Y');
                ?>
                <input type="text" id="datepicker" class="form-control" name="mfddate" value="<?php echo $result;?>" disabled="disabled" />
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm">วันที่หมดอายุสินค้า</label>
                <?php
                  $date = new DateTime($row['p_exp']);
                  $result = $date->format('d/m/Y');
                ?>
                <input type="text" id="datepicker1" class="form-control" name="expdate"  value="<?php echo $result;?>" disabled="disabled"/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่ส่งออกสินค้า</label>
                <?php
                  $date = new DateTime($row['exportdate']);
                  $result = $date->format('d/m/Y H:i:s');
                ?>
                <input class="form-control" name="exportdate" type="text" aria-describedby="nameHelp" value="<?php echo $result;?>" disabled="disabled">
              </div>
            </div>
          </div>
          
            <div class="form-row">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <button class="btn btn-success btn-block" type="submit" mt-5>รับสินค้า</buttton>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                <a class="btn btn-danger btn-block reject" href="#reject" mt-5>ไม่รับสินค้า</a>
              </div>
            </div>


            </form>
         </div>
      </div>
<script type="text/javascript">
        $(document).ready(function(){
  $(".reject").click(function(){
    $("#reject").modal("show");
  });
})
  function ChkValid() {
   var v1 = document.check.comment.value;
   if (v1.length<=0)
      {
      alert("กรุณาระบุเหตุผลที่ไม่รับสินค้า");
      return false;
      }
  else
    {
    return true;
    }
}
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="reject">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="cursor:pointer;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="rejectproduct.php">
      <div class="form-group">
        <label for="exampleInputEmail1">เหตุผลที่ไม่รับสินค้า</label>
        <textarea name="comment" rows="3" cols="63"></textarea>
        <input type="text" name="idshow" hidden="hidden" value="<?php echo $idshow; ?>">
      </div>
      <div class="modal-footer">
  <button style="cursor:pointer;" type="submit" class="btn btn-success">ตกลง</button>
  <button style="cursor:pointer;" class="btn btn-danger" role="close" data-dismiss="modal" aria-label="Close"><a>ยกเลิก</a></button>
      </div>
</form>
      </div>
      
    </div>
  </div>
</div>
</body>
    