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
$id = $_SESSION['id'.$type.'_staff'];
$finddetail = $con->query("SELECT * FROM user_account as u LEFT JOIN ".$type."_staff AS s ON u.iduser_account = s.iduser_account WHERE id".$type."_staff = $id ") 
or die (mysqli_error($con));
$getdetail = $finddetail->fetch_assoc();
?>
<body>
<div class="container-fluid">
     <!-- Example DataTables Card-->
      <ol class="breadcrumb">
        <h3 align="center">แก้ไขข้อมูลส่วนตัว</h3>
      </ol>
      <div class="col-md-8">
        <form method="post" action="./usermanage/updatemember.php?type=<?php echo $type; ?>&id=<?php echo $id; ?>" enctype="multipart/form-data">
            <div class="form-group col-md-8">
            	<label ><a style="color:red;">*</a>อีเมลล์ </label>
            	<input class="form-control" name="email" type="email" placeholder="อีเมลล์" value="<?php echo $getdetail['email']; ?>">
          	</div>
        
          	<div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>รหัสผ่าน</label>
                <input class="form-control" name="password" type="password" placeholder="รหัสผ่าน" value="<?php echo $getdetail['pass']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>ยืนยันรหัสผ่าน</label>
                <input class="form-control" name="repassword" type="password" placeholder="ยืนยันรหัสผ่าน">
            </div>
       
            <div class="form-group col-md-8">
                <label ><a style="color:red;">*</a>ชื่อ</label>
                <input class="form-control" name="name" type="text" placeholder="กรอกชื่อ" value="<?php echo $getdetail[$type.'_staffname']; ?>">
            </div>
            <div class="form-group col-md-8">
                <label><a style="color:red;">*</a>นามสกุล</label>
                <input class="form-control" name="surname" type="text" placeholder="กรอกนามสกุล" value="<?php echo $getdetail[$type.'_staffsurname']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label >เบอร์โทรศัพท์</label>
                <input class="form-control" name="tel" type="number" placeholder="กรอกเบอร์โทรศัพท์" value="<?php echo $getdetail[$type.'_stafftel']; ?>">
            </div>
            <div class="form-group col-md-8">
             <label ><a style="color:red;">*</a>รูปภาพบุคคล</label>
               <input name="peoplepic"  class="form-control" type="file" accept="image/*" onchange="loadFile(event)" >
               <div class="wrapper">
                <p><p><?php echo "<img src='images/".$getdetail[$type."_staffpic"]."'" ?> class="img-responsive"  id="output"/><p>
               </div>
            </div> 
            <div class="form-row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <button class="btn btn-success btn-block" type="submit" mt-5>ตกลง</button>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
                <a class="btn btn-danger btn-block" href="javascript:window.open('','_self').close();" mt-5>ยกเลิก</a>
        </form>
      </div>
</div>
</body>