<style type="text/css">
    .wrapper img {
    max-width: 280px;
    
    }
</style>
<script type="text/javascript">
  function loadFile(file,num) {
    var output = document.getElementById('output'+num);
    var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert('ไฟล์มีขนาดใหญ่กว่า 2 MB กรุณาเลือกไฟล์ใหม่');
            window.URL.revokeObjectURL(output);
            $(file).val('');
        }else{
            output.src = URL.createObjectURL(event.target.files[0]);
        }
  };
</script>
<?php
require_once("./connect/connect.php");
$id = $_SESSION['iduser_account'];
$finddetail = $con->query("SELECT * 
                           FROM user_account as u 
                           LEFT JOIN ".$type."_staff AS s ON u.iduser_account = s.iduser_account
                           LEFT JOIN ".$type."_place AS p ON s.id".$type."_place = p.id".$type."_place
                           WHERE u.iduser_account = $id ") 
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
            <div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>ประเภทผู้ใช้งาน</label>
                <select class="form-control" name="type" id = "usertype" disabled="disabled">
                 <option >เลือกประเภทผู้ใช้งาน</option>
                 <option value="1" <?php if ($type == "farmer"){echo 'selected="selected""';}?>>เกษตรกร</option>
                 <option value="2" <?php if ($type == "factory" || $type == "factoryadmin"){echo 'selected="selected""';}?>>โรงงาน</option>
                 <option value="3" <?php if ($type == "seller"  || $type == "selleradmin"){echo 'selected="selected""';}?>>ผู้จัดจำหน่าย</option>
                </select>
            </div>
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
             <label for="exampleInputAddress">รูปภาพบุคคล</label>
               <input name="peoplepic"  class="form-control" type="file" accept="image/*" onchange="loadFile(this,1)" >
               <div class="wrapper">
                <p><p><?php echo "<img src='images/".$getdetail[$type."_staffpic"]."'" ?> class="img-responsive"  id="output1"/><p>
               </div>
          </div> 
            <div class="form-group col-md-8 search-box">
                <label ><a style="color:red;">*</a>ชื่อสวน/ฟาร์ม/โรงงาน/บริษัท</label>
                <input class="form-control" name="businessname" type="text"  placeholder="กรอกชื่อสวน/ฟาร์ม/โรงงาน/บริษัท" autocomplete="off" value="<?php echo $getdetail["{$type}name"];?>" disabled="disabled">
                <div class="result"></div>
            </div>
            
            <div class="form-group col-md-12">
                <label ><a style="color:red;">*</a>ที่อยู่</label>
                <textarea class="form-control" name="businessaddress" rows="3" disabled="disabled" ><?php echo $getdetail["{$type}address"];?></textarea>
            </div>
        
            <div class="form-group col-md-6">
                <label >เบอร์โทรศัพท์สวน/ฟาร์ม/โรงงาน/บริษัท</label>
                <input class="form-control" name="businesstel" type="text" aria-describedby="nameHelp" placeholder="กรอกเบอร์โทรศัพท์สถานประกอบการ" value="<?php echo $getdetail["{$type}tel"];?>" disabled="disabled">
            </div>
            <div class="form-group col-md-8">
             <label for="exampleInputAddress">รูปภาพสวน/ฟาร์ม/โรงงาน/บริษัท</label>
               <input name="placepic"  class="form-control" type="file" accept="image/*" disabled="disabled" >
               <div class="wrapper">
                <p><p><?php echo "<img src='images/".$getdetail["{$type}pic"]."'" ?> class="img-responsive"  /><p>
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