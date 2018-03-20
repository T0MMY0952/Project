<style type="text/css">
    .wrapper img {
    max-width: 280px;
    
    }
</style>
<script type="text/javascript">
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<?php
require_once("./connect/connect.php");
$find_id = $con->query("SELECT * FROM factory_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
$get_id = $find_id->fetch_assoc();
if($get_id){
  $type = "factory";
}else{
  $type = "seller";
}
?>
<div class="container-fluid">
     <!-- Example DataTables Card-->
      <ol class="breadcrumb">
        <h3 align="center">เพิ่มสมาชิก</h3>
      </ol>
      <div class="col-md-8">
        <form method="post" action="./usermanage/registermember.php?type=<?php echo $type; ?>" enctype="multipart/form-data">
            <div class="form-group col-md-8">
            	<label ><a style="color:red;">*</a>อีเมลล์ </label>
            	<input class="form-control" name="email" type="email" aria-describedby="emailHelp" placeholder="อีเมลล์">
          	</div>
        
          	<div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>รหัสผ่าน</label>
                <input class="form-control" name="password" type="password" placeholder="รหัสผ่าน">
            </div>
            <div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>ยืนยันรหัสผ่าน</label>
                <input class="form-control" name="repassword" type="password" placeholder="ยืนยันรหัสผ่าน">
            </div>
       
            <div class="form-group col-md-8">
                <label ><a style="color:red;">*</a>ชื่อ</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" placeholder="กรอกชื่อ">
            </div>
            <div class="form-group col-md-8">
                <label><a style="color:red;">*</a>นามสกุล</label>
                <input class="form-control" name="surname" type="text" aria-describedby="nameHelp" placeholder="กรอกนามสกุล">
            </div>
            <div class="form-group col-md-6">
                <label >เบอร์โทรศัพท์</label>
                <input class="form-control" name="tel" type="text" aria-describedby="nameHelp" placeholder="กรอกเบอร์โทรศัพท์">
            </div>
            <div class="form-group col-md-8">
             <label ><a style="color:red;">*</a>รูปภาพบุคคล</label>
               <input name="peoplepic"  class="form-control" type="file" accept="image/*" onchange="loadFile(event)" >
               <div class="wrapper">
                <p><p><img class="img-responsive"  id="output"/><p>
               </div>
            </div> 
            <div class="form-row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <button class="btn btn-success btn-block" type="submit" mt-5>สมัคร</button>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
                <a class="btn btn-danger btn-block" href="index.php" mt-5>ยกเลิก</a>
        </form>
      </div>
</div>