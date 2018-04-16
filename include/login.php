

<div class="modal fade" tabindex="-1" role="dialog" id="login">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">เข้าสู่ระบบ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="cursor:pointer;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="./usermanage/authen.php">
  <div class="form-group">
    <label for="exampleInputEmail1">อีเมลล์</label>
    <input type="text" class="form-control" name="username">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">รหัสผ่าน</label>
    <input type="password" class="form-control" name="password" >
  </div>
  <button style="cursor:pointer;" type="submit" class="btn btn-success">เข้าสู่ระบบ</button>
  <button style="cursor:pointer;" class="btn btn-danger" role="close" data-dismiss="modal" aria-label="Close"><a>ยกเลิก</a></button>
</form>

<p class="text-center"><a href="#">ลืมรหัสผ่าน</a></p>
      </div>
      
    </div>
  </div>
</div>

