<?php
  $findinfo1 = $con->query("SELECT * 
                      FROM shipment as s 
                      LEFT JOIN agriculture_product as ap ON s.idagriculture_product = ap.idagriculture_product 
                      LEFT JOIN farmer as f               ON ap.idfarmer = f.idfarmer 
                      LEFT JOIN farm_place as fp          ON f.idfarm_place = fp.idfarm_place 
                      WHERE idshipment = $step1") or die(mysqli_error($con));
  $getinfo1 = $findinfo1->fetch_assoc();
?>
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="form-group">
        <br>
      <div class="row">
      <div class="col-md-5">
      <div class="col-md-offset-1 " >
      <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อผลผลิต</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['ap_name']; ?> " disabled="disabled">
    </div>
    </div>
  
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">วันที่เก็บ</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['ap_collectdate']; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">วันที่ส่งออก</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['exportdate']; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อสวน/ฟาร์ม</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputEmail3" value="<?php echo $getinfo1['farmname']; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-5 control-label">ชื่อ-นามสกุลเกษตรกร</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo1['farmername']; echo ' '; echo $getinfo1['farmersurname'];?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputEmail3" class="col-sm-4 control-label">ที่อยู่</label>
    <div class="col-sm-9">
      <textarea type="text" class="form-control" id="inputEmail3" disabled="disabled"> <?php echo $getinfo1['farmaddress']; ?></textarea> 
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo1['farmertel']; ?>" disabled="disabled">
    </div>
  </div>

</div> 
</div> 

  <!-----------------แบ่งcolum สำหรับรูป------>
     <div class="col-md-6">

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <?php echo "<img src='../images/".$getinfo1["farmerpic"]."'" ?> class="d-block w-100" alt="First slide">
    </div>

    <div class="carousel-item">
      <?php echo "<img src='../images/".$getinfo1["farmpic"]."'" ?> class="d-block w-100" alt="Second slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>


  </div>
</div>
</div>
</div>