
<style type="text/css">
    .wrapper img {
    max-width: 280px;
    
    }
</style>


  <body>
  <div class="card card-register mx-auto mt-5 " style="border-color: #b4fc99; border-width: 2px;">
      <div class="card-header bg-green"><h3 align="center"><a style="color:white;">ลืมรหัสผ่าน</a></h3></div>
      <div class="card-body">
        <form  id="form1" name="form1" method="post" action="include/sendmail.php" enctype="multipart/form-data">
            <div class="alert alert-danger">
               <a style="color:red;">*</a>กรุณากรอกอีเมลล์ที่ต้องการกู้รหัสผ่าน
            </div>
            
  
            <div class="form-group col-md-8">
              <label ><a style="color:red;">*</a>อีเมลล์</label>
              <input type="text" class="form-control" name="email" type="email" placeholder="อีเมลล์">
            </div>

          <div class="form-row">
            <div class="col-xs-6 col-sm-6 col-md-6">
            <button style="cursor:pointer;" class="btn btn-success btn-block" type="submit" mt-5>ตกลง</button>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
            <a class="btn btn-danger btn-block" href="index.php" mt-5>ยกเลิก</a>
          </div>
        </div>
        </form>
      </div>
    </div>
   
  </body>