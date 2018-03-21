<?php
  $step3 = $gettrack['t'.$n];
  $findinfo3 = $con->query("SELECT * 
                      FROM shipment as s 
                      LEFT JOIN seller_place as sp          ON s.idseller_recieve = sp.idseller_place
                      WHERE idshipment = $step3") or die(mysqli_error($con));
  $getinfo3 = $findinfo3->fetch_assoc();
?>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="form-group">
        <br>
      <div class="row">
      <div class="col-md-5">
      <div class="col-md-offset-1 " >

   <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">จัดจำหน่ายโดย</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo3['sellername']; ?>" disabled="disabled" >
    </div>
  </div>
  

  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">ที่อยู่</label>
    <div class="col-sm-9">
      <textarea type="textarea" class="form-control" id="inputPassword3"  disabled="disabled" ><?php echo $getinfo3['selleraddress']; ?></textarea>
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo3['sellertel']; ?>" disabled="disabled">
    </div>
    
  </div>
  </div>
  <!-----ปิดcol5-------->
  </div> 
   <!-----ปิดcol5-------->

<!-----------------แบ่งcolum สำหรับรูป------>
    <div class="col-md-6">       

       <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <?php echo "<img src='../images/".$getinfo3["sellerpic"]."'" ?> class="d-block w-100" alt="First slide">
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>
   </div>

  </div>
</div>
</div>
</div>