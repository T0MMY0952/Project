<?php 
require_once("./connect/connect.php");
$id = $_SESSION['iduser_account'];
if ($_SESSION['type'] == "farmer"){
    $people = "farmer";
    $place = "farm_place";
    $sub = substr($people,0,4);      
}
if ($_SESSION['type'] == "factory" || $_SESSION['type'] == "factoryadmin"){
    $people = "factory_staff";
    $place = "factory_place";
    $sub = substr($people,0,7);
}
if ($_SESSION['type'] == "seller" || $_SESSION['type'] == "selleradmin"){
    $people = "seller_staff";
    $place = "seller_place";
    $sub = substr($people,0,6);
}


$sql = "SELECT u.email,u.pass,f.{$people}name, f.{$people}surname, f.{$people}tel, fp.{$sub}name,fp.{$sub}address,fp.{$sub}tel,f.{$people}pic,fp.{$sub}pic,u.type
      FROM $people as f
      INNER JOIN user_account as u ON f.iduser_account = u.iduser_account
      INNER JOIN $place as  fp ON fp.id{$place} = f.id{$place}
      WHERE u.iduser_account = '".$id."' ";

$query = mysqli_query($con,$sql) or die(mysqli_error($con));
$result= mysqli_fetch_array($query,MYSQLI_ASSOC);
?>

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

  var loadFile1 = function(event) {
    var output = document.getElementById('output1');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
  
    <div class="container-fluid">
      <ol class="breadcrumb success">
        <h3 align="center">แก้ไขข้อมูลส่วนตัว</h3>
      </ol>
      <div class="alert alert-danger">
              <strong>ข้อควรระวัง!</strong> กรุณากรอกข้อมูลตามหัวข้อที่มี<a style="color:red;"> * </a>ให้ครบ
      </div>
      <div class="col-md-8">
        <form method="post" action="./usermanage/updateuser.php" enctype="multipart/form-data">
          	<div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>ประเภทผู้ใช้งาน</label>
                <select class="form-control" name="type" id = "usertype" disabled="disabled">
                 <option >เลือกประเภทผู้ใช้งาน</option>
                 <option value="1" <?php if ($result['type'] == "farmer"){echo 'selected="selected""';}?>>เกษตรกร</option>
                 <option value="2" <?php if ($result['type'] == "factory" || $result['type'] == "factoryadmin"){echo 'selected="selected""';}?>>โรงงาน</option>
                 <option value="3" <?php if ($result['type'] == "seller" || $result['type'] == "selleradmin"){echo 'selected="selected""';}?>>ผู้จัดจำหน่าย</option>
                </select>
            </div>

            <div class="form-group col-md-8">
            	<label ><a style="color:red;">*</a>อีเมลล์ </label>
            	<input class="form-control" name="email" type="email" placeholder="อีเมลล์" value="<?php echo $result["email"];?>">
          	</div>
        
          	<div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>รหัสผ่าน</label>
                <input class="form-control" name="password" type="password" placeholder="รหัสผ่าน" value="<?php echo $result["pass"];?>">
            </div>
            <div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>ยืนยันรหัสผ่าน</label>
                <input class="form-control" name="repassword" type="password" placeholder="ยืนยันรหัสผ่าน">
            </div>
       
            <div class="form-group col-md-8">
                <label ><a style="color:red;">*</a>ชื่อ</label>
                <input class="form-control" name="name" type="text" placeholder="กรอกชื่อ" value="<?php echo $result["{$people}name"];?>">
            </div>
            <div class="form-group col-md-8">
                <label><a style="color:red;">*</a>นามสกุล</label>
                <input class="form-control" name="surname" type="text" placeholder="กรอกนามสกุล" value="<?php echo $result["{$people}surname"];?>">
            </div>
         
        
            <div class="form-group col-md-6">
                <label >เบอร์โทรศัพท์</label>
                <input class="form-control" name="tel" type="number" placeholder="กรอกเบอร์โทรศัพท์" value="<?php echo $result["{$people}tel"];?>">
            </div>
          	
            <div class="form-group col-md-8 search-box">
                <label ><a style="color:red;">*</a>ชื่อสวน/ฟาร์ม/โรงงาน/บริษัท</label>
                <input class="form-control" name="businessname" type="text"  placeholder="กรอกชื่อสวน/ฟาร์ม/โรงงาน/บริษัท" autocomplete="off" value="<?php echo $result["{$sub}name"];?>">
                <div class="result"></div>
            </div>
            
            <div class="form-group col-md-12">
                <label ><a style="color:red;">*</a>ที่อยู่</label>
                <textarea class="form-control" name="businessaddress" rows="3" ><?php echo $result["{$sub}address"];?></textarea>
          	</div>
      	
            <div class="form-group col-md-6">
                <label >เบอร์โทรศัพท์สวน/ฟาร์ม/โรงงาน/บริษัท</label>
                <input class="form-control" name="businesstel" type="number" aria-describedby="nameHelp" placeholder="กรอกเบอร์โทรศัพท์สถานประกอบการ" value="<?php echo $result["{$sub}tel"];?>">
            </div>

          <div class="form-group col-md-8">
             <label for="exampleInputAddress">รูปภาพบุคคล</label>
               <input name="peoplepic"  class="form-control" type="file" accept="image/*" onchange="loadFile(event)" >
               <div class="wrapper">
                <p><p><?php echo "<img src='images/".$result["{$people}pic"]."'" ?> class="img-responsive"  id="output"/><p>
               </div>
          </div> 
			     
          <div class="form-group col-md-8">
             <label for="exampleInputAddress">รูปภาพสวน/ฟาร์ม/โรงงาน/บริษัท</label>
               <input name="placepic"  class="form-control" type="file" accept="image/*" onchange="loadFile1(event)"" >
               <div class="wrapper">
                <p><p><?php echo "<img src='images/".$result["{$sub}pic"]."'" ?> class="img-responsive"  id="output1"/><p>
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
    </div>
 