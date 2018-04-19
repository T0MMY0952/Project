<?php
    $findinfo2 = $con->query("SELECT * 
                      FROM shipment as s 
                      LEFT JOIN product as p          ON s.idproduct = p.idproduct 
                      LEFT JOIN factory_place as fp   ON p.idfactory_place = fp.idfactory_place 
                      WHERE idshipment = $step2") or die(mysqli_error($con));
    $getinfo2 = $findinfo2->fetch_assoc();
?>
  <div class="tab-pane fade" id="<?php echo "profile".$i; ?>" role="tabpanel" aria-labelledby="profile-tab">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
     <div class="form-group">
   <br>
    <div class="row">
    <div class="col-md-5">
    <div class="col-md-offset-1 " >
    <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อผลิตภัณฑ์</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo2['p_name']; ?>" disabled="disabled" >
    </div>

  </div>

    <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ชื่อโรงงาน</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $getinfo2['factoryname']; ?>" disabled="disabled">
    </div>
 
  </div>

  <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">กระบวนการผลิต</label>
    <div class="col-sm-9 ">
      <textarea type="textarea" class="form-control" id="inputEmail3" disabled="disabled"><?php echo $getinfo2['p_process']; ?></textarea> 
    </div>

  </div>

  <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-4 control-label">ที่อยู่</label>
    <div class="col-sm-9 ">
      <textarea type="textarea" class="form-control" id="inputEmail3"  disabled="disabled"><?php echo $getinfo2['factoryaddress']; ?></textarea>
    </div>

  </div>


  <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-7 control-label">วันที่ผลิตของสินค้า</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php 
      $date = date_create($getinfo2['p_mfd']); 
      echo $date->format('d/m/Y');?>" disabled="disabled">
    </div>

  </div>

    <div class="form-group form-group-sm" >
    <label for="inputEmail3" class="col-sm-7 control-label">วันที่หมดอายุของสินค้า</label>
    <div class="col-sm-9 ">
      <input type="email" class="form-control" id="inputEmail3" value="<?php 
       $date = date_create($getinfo2['p_exp']); 
       echo $date->format('d/m/Y'); ?>" disabled="disabled">
    </div>
 
  </div>

  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">วันที่รับสินค้า</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php 
       $date = date_create($getinfo2['recievedate']); 
       echo $date->format('d/m/Y H:i:s'); ?>" disabled="disabled">
    </div>

  </div>

  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputPassword3" value="<?php echo $getinfo2['factorytel']; ?>" disabled="disabled">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="inputPassword3" class="control-label">มาตราฐานที่ได้รับ</label>
      <table class="table">
              <thead>
                <tr>
                  <th scope="col">มาตราฐาน</th>
                  <th scope="col">วันที่เพิ่มมาตราฐาน</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $findstd = $con->query("SELECT * FROM standard WHERE idfactory_place = '".$getinfo2['idfactory_place']."' ");
                
                while ($getstd = $findstd->fetch_assoc()){
                ?>
                <tr>
                  
                  <td><?php echo $getstd['standard'];?></td>
                  <td>
                  <?php 
                  $date = date_create($getstd['dateadd']);
                  echo $date->format('d/m/y'); ?></td>
                
                </tr>
                <?php
                
                }
              ?>
              </tbody>
      </table>
    </div>
  </div>
  </div>
  <!------ปิด col-5 ---->

  <!-----------------แบ่งcolum สำหรับรูป------>
    <div class="col-md-6">  

  <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <?php echo "<img src='../images/".$getinfo2["factorypic"]."'" ?> class="d-block w-100" alt="First slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>
   </div>
  </div>
</div>
</div>
</div>