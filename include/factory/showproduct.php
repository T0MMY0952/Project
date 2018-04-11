<?php
// find product
$findproduct = $con->query("SELECT p_name,p_amount,p_unit,p_process,p_mfd,p_exp FROM product WHERE idproduct = '".$row['idproduct']."' ");
$getproduct = $findproduct->fetch_assoc();

// find factory
$findfactory = $con->query("SELECT factoryname,factoryaddress,factorytel FROM factory_place WHERE idfactory_place = '".$row['idfactory_send']."' "); 
$getfactory = $findfactory->fetch_assoc();
?>      
      
      <hr width="100%">
         <div class="col-md-8">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">ชื่อผลิตภัณฑ์</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value = "<?php echo $getproduct['p_name'];?>" disabled="disabled"  >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">สถานที่ส่ง</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value = "<?php echo $getfactory['factoryname']; 
                echo ' '; echo $getfactory['factoryaddress'];?>" disabled="disabled"  >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">เบอร์โทรศัพท์</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" value = "<?php echo $getfactory['factorytel']; ?>" disabled="disabled"  >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">จำนวนผลิตภัณฑ์</label>
                <input class="form-control" name="amount" type="text" aria-describedby="nameHelp" value = "<?php echo $getproduct['p_amount'];  echo ' '; echo $getproduct['p_unit'];?>"  disabled="disabled">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputTel">กระบวนการผลิต</label>
                <textarea class="form-control" name="process" type="text" aria-describedby="nameHelp" disabled="disabled" ><?php echo $getproduct['p_process']; ?> </textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่ผลิตของผลิตภัณฑ์</label>
                <input type="text"  class="form-control" name="mfddate" value = "<?php echo $getproduct['p_mfd'];?>" disabled="disabled"/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">วันที่หมดอายุของผลิตภัณฑ์</label>
                <input type="text"  class="form-control" name="expdate" value = "<?php echo $getproduct['p_exp'];?>" disabled="disabled" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่ส่งออกของผลิตภัณฑ์</label>
                <input class="form-control" name="exportdate" type="text" value = "<?php echo $row['exportdate'];?>" disabled="disabled" />
              </div>
            </div>
          </div>
        </div>