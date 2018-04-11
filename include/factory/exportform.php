<hr width="100%"> 
<form method="post" action="agriexport.php?idshow=<?php echo $idshow?>">
        <div class="col-md-8">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>ชื่อผลิตภัณฑ์</label>
                <input class="form-control" name="name" type="text" aria-describedby="nameHelp" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>จำนวนส่งออกผลิตภัณฑ์</label>
                <input class="form-control" name="amount" type="text" aria-describedby="nameHelp" >
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>หน่วย</label>
                <input class="form-control" name="unit" type="text" aria-describedby="nameHelp" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>กระบวนการผลิต</label>
                <textarea class="form-control" name="process" type="text" aria-describedby="nameHelp"> </textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>วันที่ผลิตของผลิตภัณฑ์</label>
                <input type="text" id="datepicker" class="form-control" name="mfddate" />
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm"><a style="color: red">*</a>วันที่หมดอายุของผลิตภัณฑ์</label>
                <input type="text" id="datepicker1" class="form-control" name="expdate" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel"><a style="color: red">*</a>วันที่ส่งออกของผลิตภัณฑ์</label>
                <input class="form-control" name="exportdate" type="text" aria-describedby="nameHelp" value="<?php 
                  date_default_timezone_set("Asia/Bangkok");
                  $date = new DateTime();
                  $date->modify('+543 Year');
                  echo $date->format('d/m/Y H:i:s');
                ?>" disabled="disabled">
              </div>
              <div class="col-md-6">
                <label for="basic"><a style="color: red;">*</a>สถานที่ที่จัดส่ง</label>
                <select id="basic" class="selectpicker show-tick form-control" data-live-search="true" name="idrecieve" >
                    <option>เลือกสถานที่จัดส่ง</option>
                    <optgroup label="โรงงาน">
                    <?php
                      $id = $_SESSION['iduser_account'];
                      $sql = "SELECT idfactory_place, factoryname FROM factory_place  
                              WHERE idfactory_place NOT IN (SELECT idfactory_place FROM factory_staff WHERE iduser_account = $id)
                              ORDER BY factoryname ASC";
                      $objQuery = mysqli_query($con,$sql) or die(mysqli_error($con)) ;
                      while($objResult = mysqli_fetch_array($objQuery)){
                    ?>
                      <option data-tokens="<?php echo $objResult['factoryname']; ?>" value="<?php echo $objResult['idfactory_place'] ?>" ><?php echo $objResult['factoryname']; ?>
                      </option>
                    <?php
                     }
                    ?>
                    <optgroup label="ผู้จัดจำหน่าย">
                    <?php
                      $sql = "SELECT idseller_place, sellername FROM seller_place ORDER BY sellername ASC";
                      $objQuery = mysqli_query($con,$sql) or die(mysqli_error($con)) ;
                      while($objResult = mysqli_fetch_array($objQuery)){
                    ?>
                      <option data-tokens="<?php echo $objResult['sellername']; ?>" value="<?php echo 's'.$objResult['idseller_place'] ?>" ><?php echo $objResult['sellername']; ?>
                      </option>
                    <?php
                     }
                    ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
              <div class="col-xs-6 col-sm-6 col-md-6">
              <button style="cursor:pointer"  class="btn btn-success btn-block" type="submit" mt-5>ตกลง</button>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
              <a class="btn btn-danger btn-block" href="javascript:window.open('','_self').close();" mt-5>ยกเลิก</a>
              </div>
          </div>
      </div>
</form>