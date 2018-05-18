<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $idshow = $_GET['idshipment'];?>
  <title>แก้ไขการจัดส่ง</title>
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
 $sql = "SELECT *
		     FROM shipment as s 
         LEFT JOIN agriculture_product as ap ON s.idagriculture_product = ap.idagriculture_product
         LEFT JOIN farmer as f               ON ap.idfarmer = f.idfarmer
         LEFT JOIN farm_place as fp          ON f.idfarm_place = fp.idfarm_place
		     WHERE s.idshipment = $idshow ";
$result = $con->query($sql) or die (mysqli_error($con));
$row = $result->fetch_assoc();
?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">แก้ไขการจัดส่ง&nbsp(<?php echo 'รหัสการจัดส่ง&nbsp'; echo $idshow;?>)</h3>
      </ol>
         <div class="col-md-8">
           <form method="post" action="recieveproduct.php?idshow=<?php echo $idshow?>">
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">รหัสการรับสินค้า</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['idshipment'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">สถานที่ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['farmname']; echo ' '; echo $row['farmaddress'];?>">
              </div>
          </div>
        </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">ชื่อ-นามสกุล ผู้ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['farmername']; echo '  '; echo $row['farmersurname'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm">เบอร์โทรศัพท์ ผู้ส่ง</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['farmertel'];?>" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">ชื่อผลผลิต</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['ap_name'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่เก็บ</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['ap_collectdate'];?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">แปลงที่เก็บ</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['ap_garden'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">จำนวน</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['ap_amount']; echo '  '; echo $row['ap_unit']; ?>">
              </div>
            </div>
          </div>
          <div class="form-group col-md-6">
              <div class="form-row">
                  <label >ราคาต่อหน่วย</label>
                  <div class="col-sm-10">
                    <input class="form-control " name="apr_price" type="text"  value="<?php echo $row['ap_price'];?>" placeholder="ราคาต่อหน่วยของผลผลิต"  >
                  </div>
                  <div class="col-sm-2">
                    <label > บาท</label>
                  </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="form-row">
                <label ><a style="color: red;">*</a>อายุของผลผลิต</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="apr_expdate" value="<?php echo $row['ap_expdate']; ?>" placeholder="อายุของผลผลิตนับจากวันที่เก็บ"/>
                </div>
                <div class="col-sm-2">
                        <label >วัน</label>
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
              <button class="btn btn-success btn-block" type="submit" mt-5>รับสินค้า</buttton>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                <a class="btn btn-danger btn-block reject" href="#reject" mt-5>ไม่รับสินค้า</a>
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
        <form method="post" action="rejectproduct.php" name="check" onSubmit="return ChkValid()">
      <div class="form-group">
        <label for="exampleInputEmail1">เหตุผลที่ไม่รับสินค้า</label>
        <textarea name="comment" rows="3" cols="63"></textarea>
        <input type="text" name="idshow" hidden="hidden" value="<?php echo $idshow; ?>">
      </div>
  <button style="cursor:pointer;" type="submit" class="btn btn-success">ตกลง</button>
  <button style="cursor:pointer;" class="btn btn-danger" role="close" data-dismiss="modal" aria-label="Close"><a>ยกเลิก</a></button>
</form>
      </div>
      
    </div>
  </div>
</div>
</body>
    