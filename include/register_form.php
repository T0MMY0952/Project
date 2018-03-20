
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
  
  <div class="card card-register mx-auto mt-5 " style="border-color: #b4fc99; border-width: 2px;">
      <div class="card-header bg-green"><h3 align="center"><a style="color:white;">สมัครสมาชิก</a></h3></div>
      <div class="card-body">
        <form method="post" action="./usermanage/register.php" enctype="multipart/form-data">
            <div class="alert alert-danger">
              <strong>ข้อควรระวัง!</strong> กรุณากรอกข้อมูลตามหัวข้อที่มี<a style="color:red;"> * </a>ให้ครบ
            </div>
            
          	<div class="form-group col-md-6">
                <label ><a style="color:red;">*</a>ประเภทผู้ใช้งาน</label>
                <select class="form-control" name="type" id = "usertype">
                 <option >เลือกประเภทผู้ใช้งาน</option>
                 <option value="1">เกษตรกร</option>
                 <option value="2">โรงงาน</option>
                 <option value="3">ผู้จัดจำหน่าย</option>
                </select>
            </div>

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
          	
            <div class="form-group col-md-8 search-box">
                <label ><a style="color:red;">*</a>ชื่อสวน/โรงงาน/ผู้จัดจำหน่าย</label>
                <input class="form-control" name="businessname" type="text"  placeholder="กรอกชื่อสวน/ฟาร์ม/โรงงาน/บริษัท" autocomplete="off">
                <div class="result"></div>
            </div>
            
            <div class="form-group col-md-12">
                <label ><a style="color:red;">*</a>ที่อยู่</label>
                <textarea class="form-control" name="businessaddress" rows="3"></textarea>
          	</div>
      	
            <div class="form-group col-md-6">
                <label >เบอร์โทรศัพท์สวน/ฟาร์ม/โรงงาน/บริษัท</label>
                <input class="form-control" name="businesstel" type="text" aria-describedby="nameHelp" placeholder="กรอกเบอร์โทรศัพท์สถานประกอบการ">
            </div>

          <div class="form-group col-md-8">
             <label ><a style="color:red;">*</a>รูปภาพบุคคล</label>
               <input name="peoplepic"  class="form-control" type="file" accept="image/*" onchange="loadFile(event)" >
               <div class="wrapper">
                <p><p><img class="img-responsive"  id="output"/><p>
               </div>
          </div> 
			     
          <div class="form-group col-md-8">
             <label >รูปภาพสวน/ฟาร์ม/โรงงาน/บริษัท</label>
               <input name="placepic"  class="form-control" type="file" accept="image/*" onchange="loadFile1(event)"">
               <div class="wrapper">
                <p><p><img class="img-responsive" id="output1"/><p>
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