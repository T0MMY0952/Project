<script>
function edit(id) {
    var myWindow = window.open("./include/factory/factory_showedit.php?idshipment="+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
}
function qrcode(id) {
    var myWindow = window.open("./include/show_QR.php?idshipment="+id+"&type=factory", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=900,height=900");  
}
$(document).ready(function(){
  $(".delete").click(function(){
    $("#delete").modal("show");
  });
})
</script>   
    <div class="container-fluid">
     <!-- Example DataTables Card-->
        <ol class="breadcrumb">
        <h3 align="center">ประวัติการส่งออกสินค้า</h3>
      </ol>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><div align="center">ลำดับ</div></th>
                  <th><div align="center">ชื่อสินค้า</div></th>
                  <th><div align="center">จำนวน</div></th>
                  <th><div align="center">วันที่ส่งออก</div></th>
                  <th><div align="center">สถานที่ปลายทาง</div></th>
                  <th><div align="center">สถานะ</div></th>
                  <th><div align="center">แก้ไข/ลบ</div></th>
                  <th><div align="center">พิมพ์ QR Code</div></th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once("./connect/connect.php");
                $id = $_SESSION['iduser_account'];
                $findid_fac = $con->query("SELECT idfactory_place FROM factory_staff WHERE iduser_account = $id ") or die (mysqli_error($con));
                $getid_fac = $findid_fac->fetch_assoc();
                $sql = "SELECT *
                        FROM shipment 
                        WHERE idfactory_send = '".$getid_fac['idfactory_place']."'
                        ORDER BY exportdate DESC";
                $result = $con->query($sql) or die (mysqli_error($con));
                $n = 1;
                while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><div align="center"><?php echo $n; ?></div></td>

                    <?php
                      $findproduct = $con->query("SELECT p_name, p_amount, p_unit FROM product WHERE idproduct = '".$row['idproduct']."' ") or die (mysqli_error($con));
                      $getproduct = $findproduct->fetch_assoc(); 
                    ?>
                    <td><div align="center"><?php echo $getproduct['p_name']; ?></div></td>
                    <td><div align="center"><?php echo $getproduct['p_amount']; echo '&nbsp'; echo $getproduct['p_unit']; ?></div></td>
                    <?php 
                      $date = new DateTime($row['exportdate']);
                    ?>
                    <td><div align="center"><?php echo $date->format('d/m/Y H:i:s'); ?></div></td>

                    <?php
                    if(!is_null($row['idseller_recieve'])){
                      $type = 'seller';
                    }else{
                      $type = 'factory';
                    }
                    $s =  "SELECT ".$type."name FROM ".$type."_place WHERE id".$type."_place = '".$row['id'.$type.'_recieve']."' ";
                    $finddest = $con->query($s) or die (mysqli_error($con));
                    $showdest = $finddest->fetch_assoc() or die (mysqli_error($con));
                    ?>
                    <td><div align="center"><?php echo $showdest[$type.'name']; ?></div></td>

                    <?php 
                      if($row['status'] == 1){?>
                          <td><div align="center"><?php echo '<img widht="24px" height="24px" src="images/Complete.png">'; ?></div></td>
                          <td><div align="center"></div></td>
                      <?php
                      }elseif($row['status'] == 0){?>
                          <td><div align="center"><?php echo '<img widht="30px" height="30px" src="images/Wait.png">'; ?></div></td>
                          <?php if(!is_null($row['idfarmer_send'])){ ?>
                                <td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" ><img src="images/EditList.png" widht="24px" height="24px"></a>&nbsp;<b>/</b>&nbsp;<a class="delete" 
                                  href="#delete
                                  <?php 
                                      $num = $n;
                                      $link = 'include/factory/deleteproduct.php?id='.$row['idshipment']; 
                                      echo $link;
                                      echo $num; 
                                  ?>"><img src="images/Delete.png" widht="24px" height="24px"></a></div></td>
                          <?php 
                          }elseif(!is_null($row['idfactory_send'])) { ?>
                                <td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" ><img src="images/EditList.png" widht="24px" height="24px"></a>&nbsp;<b>/</b>&nbsp;<a class="delete" 
                                  href="#delete
                                  <?php 
                                      $num = $n;
                                      $link = 'include/factory/deleteproduct.php?id='.$row['idshipment']; 
                                      echo $link;
                                      echo $num; 
                                  ?>"><img src="images/Delete.png" widht="24px" height="24px"></a></div></td>
                          <?php
                        }
                    }
                    ?>
                    <td><div align="center"><a onclick="qrcode(<?php echo $row['idshipment']; ?>)" href=""><img widht="34px" height="34px" src="images/Print.png"></a></div></td>
                </tr>
                <?php $n = $n+1; } ?>
             </tbody>
            </table>
    <?php
      include('./include/deleteconfirm.php');
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  
  </div>