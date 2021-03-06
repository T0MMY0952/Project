<?php
// find farmer
$findfarmer = $con->query("SELECT farmname,farmaddress,farmername, farmersurname, farmertel FROM farm_place as fp LEFT JOIN farmer as f ON fp.idfarm_place = f.idfarm_place  
              WHERE idfarmer = '".$row['idfarmer_send']."' ");
$getfarmer = $findfarmer->fetch_assoc();

// find agriculture product 
$findagri = $con->query("SELECT ap_name, ap_collectdate, ap_garden, ap_amount, ap_unit, ap_expdate FROM agriculture_product 
            WHERE idagriculture_product = '".$row['idagriculture_product']."' "); 
$getagri = $findagri->fetch_assoc();
?>
      <div class="card">
        <div class="card-header text-black" color="#e9ecef">
            รายละเอียดสินค้าที่รับมา
        </div>
        <br>
         <div class="col-md-8">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">รหัสการรับผลผลิต</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $row['idshipment'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">สถานที่ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getfarmer['farmname']; echo ' '; echo $getfarmer['farmaddress'];?>">
              </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputTel">ชื่อ-นามสกุล ผู้ส่ง</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getfarmer['farmername']; echo '  '; echo $getfarmer['farmersurname'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputFarm">เบอร์โทรศัพท์ ผู้ส่ง</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getfarmer['farmertel'];?>" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">ชื่อผลผลิต</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getagri['ap_name'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่เก็บ</label>
                <input class="form-control" type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php 
                $date = new DateTime($getagri['ap_collectdate']);
                echo $date->format('d/m/Y');?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputFarm">แปลงที่เก็บ</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getagri['ap_garden'];?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">จำนวน</label>
                <input class="form-control"  type="text" aria-describedby="nameHelp" disabled="disabled" value="<?php echo $getagri['ap_amount']; echo '  '; echo $getagri['ap_unit']; ?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label >วันที่หมดอายุ</label>
                <input type="text" class="form-control" disabled="disabled" name="apr_expdate" value="<?php 
                $date = new DateTime($getagri['ap_expdate']);
                echo $date->format('d/m/Y');?>" />
              </div>
              <div class="col-md-6">
                <label for="exampleInputTel">วันที่ส่งออก</label>
                <input class="form-control" name="exportdate" type="text" value = "<?php 
                $date = new DateTime($row['exportdate']);
                echo $date->format('d/m/Y H:i:s');?>" disabled="disabled" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  
      
      