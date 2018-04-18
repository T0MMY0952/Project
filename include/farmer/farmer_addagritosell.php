<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<?php 
  require_once("./connect/connect.php");
 ?>

<script type="text/javascript">
$(function() {
    $('#datepicker').datepicker({
      format: 'dd/mm/yyyy'
    }); 
    $('#datepicker').datepicker('setDate', 'now');  
});


</script>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <h3 align="center">เพิ่มข้อมูลผลผลิตที่จำหน่าย</h3>
      </ol>
         <div class="col-md-8">
           <form method="post" action="./include/farmer/addagritosell.php">
            <div class="form-group col-md-8 ">
                <label ><a style="color: red;">*</a>ชื่อผลผลิต</label>
                <input class="form-control" name="ap_name" type="text"  autocomplete="off" placeholder="ชื่อผลผลิต" >
                <div class="result"></div>
            </div>
            <div class="form-group col-md-5">
                <label ><a style="color: red;">*</a>วันที่เก็บ</label>
                <input type="text" id="datepicker" class="form-control" name="apr_collectdate" placeholder="วันที่เก็บผลผลิต" />
            </div>
            <div class="form-group col-md-8">
                <label >แปลงที่เก็บ</label>
                <input class="form-control" name="apr_garden" type="text" placeholder="ตำแหน่งที่เก็บ เช่น สวนขนัด2 แปลงที่2 เป็นต้น">
            </div>
            <div class="form-group col-md-8"> 
              <div class="form-row">
                <div class="col-md-6">
                  <label ><a style="color: red;">*</a>จำนวน</label>
                  <input class="form-control" name="apr_amount" type="text" placeholder="จำนวนของผลผลิต" >
                </div>
                <div class="col-md-6">
                  <label ><a style="color: red;">*</a>หน่วย</label>
                  <input class="form-control" name="apr_unit" type="text" placeholder="เช่น กิโลกรัม ถุง เป็นต้น">
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="form-row">
                  <label >ราคาต่อหน่วย</label>
                  <div class="col-sm-10">
                    <input class="form-control " name="apr_price" type="text" placeholder="ราคาต่อหน่วยของผลผลิต"  >
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
                    <input type="text" class="form-control" name="apr_expdate" placeholder="อายุของผลผลิตนับจากวันที่เก็บ" />
                </div>
                <div class="col-sm-2">
                        <label >วัน</label>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-xs-6 col-sm-6 col-md-6">
              <button class="btn btn-success btn-block" type="submit" mt-5>ตกลง</button>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
              <a class="btn btn-danger btn-block" href="index.php" mt-5>ยกเลิก</a>
            </div>
        </form>
          </div>
</div>
    