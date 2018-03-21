 <script>
function qrcode(id) {
    var myWindow = window.open("./include/show_QR.php?idshipment="+id"&type=seller", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=500,height=500");  
}
</script> 
     <div class="container-fluid">
     <!-- Example DataTables Card-->
        <ol class="breadcrumb">
        <h3 align="center">ประวัติการรับสินค้า</h3>
      </ol>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><div align="center">ลำดับ</div></th>
                  <th><div align="center">ชื่อสินค้า</div></th>
                  <th><div align="center">จำนวน</div></th>
                  <th><div align="center">สถานที่จัดส่ง</div></th>
                  <th><div align="center">วันที่จัดส่ง</div></th>
                  <th><div align="center">วันที่รับสินค้า</div></th>
                  <th><div align="center">พิมพ์ QR Code</div></th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once("./connect/connect.php");
                $id = $_SESSION['iduser_account'];
                $findid_sel = $con->query("SELECT idseller_place FROM seller_staff WHERE iduser_account = $id ") or die (mysqli_error($con));
                $getid_sel = $findid_sel->fetch_assoc();
                $sql = "SELECT *
                        FROM shipment 
                        WHERE idseller_recieve = '".$getid_sel['idseller_place']."' AND status = 1";
                $result = $con->query($sql) or die (mysqli_error($con));
                $n = 1;
                while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><div align="center"><?php echo $n; ?></div></td>

                    <?php
                      if (!is_null($row['idfactory_send'])){
                        $findproduct = $con->query("SELECT p_name, p_amount, p_unit, p_export FROM product WHERE idproduct = '".$row['idproduct']."' ") or die (mysqli_error($con));
                        $getproduct = $findproduct->fetch_assoc(); ?>
                        <td><div align="center"><?php echo $getproduct['p_name']; ?></div></td>
                        <td><div align="center"><?php echo $getproduct['p_amount']; echo '&nbsp'; echo $getproduct['p_unit']; ?></div></td>
                    <?php
                        $findfac = $con->query("SELECT factoryname FROM factory_place WHERE idfactory_place = '".$row['idfactory_send']."'");
                        $getfac = $findfac->fetch_assoc(); ?>
                        <td><div align="center"><?php echo $getfac['factoryname']; ?></div></td>
                    <?php 
                        $date = new DateTime($getproduct['p_export']);
                        $date->modify('+543 Year');
                    ?>
                        <td><div align="center"><?php echo $date->format('d/m/Y H:i:s'); ?></div></td>
                    <?php 
                        $date = new DateTime($row['recievedate']);
                        $date->modify('+543 Year');
                    ?>
                        <td><div align="center"><?php echo $date->format('d/m/Y H:i:s'); ?></div></td>
                    <?php 

                      }elseif(!is_null($row['idfarmer_send'])){
                        $findproduct = $con->query("SELECT ap_name, ap_amount, ap_unit, ap_exportdate FROM agriculture_product WHERE idagriculture_product = '".$row['idagriculture_product']."' ") or die (mysqli_error($con));
                        $getproduct = $findproduct->fetch_assoc(); ?>
                        <td><div align="center"><?php echo $getproduct['ap_name']; ?></div></td>
                        <td><div align="center"><?php echo $getproduct['ap_amount']; echo '&nbsp'; echo $getproduct['ap_unit']; ?></div></td>
                    <?php
                        $findfac = $con->query("SELECT farmname FROM farm_place WHERE idfarm_place = (SELECT idfarm_place FROM farmer WHERE idfarmer = '".$row['idfarmer_send']."' )");
                        $getfac = $findfac->fetch_assoc(); ?>
                        <td><div align="center"><?php echo $getfac['farmname']; ?></div></td>
                    <?php 
                        $date = new DateTime($getproduct['ap_exportdate']);
                        $date->modify('+543 Year');
                    ?>
                        <td><div align="center"><?php echo $date->format('d/m/Y H:i:s'); ?></div></td>
                    <?php 
                        $date = new DateTime($row['recievedate']);
                        $date->modify('+543 Year');
                    ?>
                        <td><div align="center"><?php echo $date->format('d/m/Y H:i:s'); ?></div></td>
                    <?php
                      }
                    ?>
                    <td><div align="center"><a onclick="qrcode(<?php echo $row['idshipment']; ?>)" href="">พิมพ์</a></div></td>
                </tr>
                <?php 
                $n = $n+1;
              } 
              ?>
             </tbody>
            </table>
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