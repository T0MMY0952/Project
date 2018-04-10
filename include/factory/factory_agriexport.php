<script>
function showagri(idapr) {
    var myWindow = window.open("./include/factory/factory_showagriexport.php?idapr="+idapr, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
}
function showproduct(idapr) {
    var myWindow = window.open("./include/factory/factory_showproductexport.php?idapr="+idapr, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
}

</script>   
    <div class="container-fluid">
     <!-- Example DataTables Card-->
        <ol class="breadcrumb">
        <h3 align="center">ส่งออกสินค้า</h3>
      </ol>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><div align="center">ลำดับ</div></th>
                  <th><div align="center">ชื่อผลผลิต</div></th>
                  <th><div align="center">ชื่อผู้ส่ง</div></th>
                  <th><div align="center">จำนวน</div></th>
                  <th><div align="center">วันที่รับ</div></th>
                  <th><div align="center">รายละเอียด</div></th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once("./connect/connect.php");
                $id = $_SESSION['iduser_account'];
                $id = $_SESSION['iduser_account'];
                $findid_fac = $con->query("SELECT idfactory_place FROM factory_staff WHERE iduser_account = $id ") or die (mysqli_error($con));
                $getid_fac = $findid_fac->fetch_assoc();
                $sql = "SELECT *
                        FROM shipment 
                        WHERE idfactory_recieve = '".$getid_fac['idfactory_place']."' AND status = 1 
                        ORDER BY recievedate DESC";
                $result = $con->query($sql) or die (mysqli_error($con));
                $n = 1;
                while($row = $result->fetch_assoc()){
                    //check export
                    $checkexport = $con->query("SELECT COUNT(*) as c FROM shipment WHERE idshipment_prev = '".$row['idshipment']."' ") or die (mysqli_error($con));
                    $getcheck = $checkexport->fetch_assoc();
                    if($getcheck['c'] == 0){
                ?>
                <tr>
                    <td><div align="center"><?php echo $n; ?></div></td>
                    <?php 
                      if( !is_null($row['idfarmer_send']) ){
                        // farmer send
                        $findfarmer = $con->query("SELECT * FROM farmer as f LEFT JOIN agriculture_product as ap ON f.idfarmer = ap.idfarmer 
                                      WHERE f.idfarmer = '".$row['idfarmer_send']."' AND idagriculture_product = '".$row['idagriculture_product']."' ") or die (mysqli_error($con));
                        $getfarmer = $findfarmer->fetch_assoc();?>
                        <td><div align="center"><?php echo $getfarmer['ap_name']; ?></div></td>
                        <td><div align="center"><?php echo $getfarmer['farmername']; echo '&nbsp'; echo $getfarmer['farmersurname']; ?></div></td>
                        <td><div align="center"><?php echo $getfarmer['ap_amount']; echo '&nbsp'; echo $getfarmer['ap_unit']; ?></div></td>
                        <?php
                            $date2 = new DateTime($row['recievedate']);
                            $date2->modify('+543 Year');
                        ?>
                        <td><div align="center"><?php echo $date2->format('d/m/Y H:i:s'); ?></div></td>
                        <td><div align="center"><a onclick="showagri(<?php echo $row['idshipment']; ?>)" href="" >ส่งออกผลผลิต</a></td>
                    <?php
                      }elseif( !is_null($row['idfactory_send']) ){
                        // factory send
                        $findfactory = $con->query("SELECT * FROM factory_place as fp LEFT JOIN product as p ON fp.idfactory_place = p.idfactory_place 
                                       WHERE fp.idfactory_place = '".$row['idfactory_send']."' AND idproduct = '".$row['idproduct']."' ") or die (mysqli_error($con));
                        $getfactory = $findfactory->fetch_assoc();?>
                        <td><div align="center"><?php echo $getfactory['p_name']; ?></div></td>
                        <td><div align="center"><?php echo $getfactory['factoryname']; ?></div></td>
                        <td><div align="center"><?php echo $getfactory['p_amount']; echo '&nbsp'; echo $getfactory['p_unit']; ?></div></td>
                        <?php
                            $date2 = new DateTime($row['recievedate']);
                            $date2->modify('+543 Year');
                        ?>
                        <td><div align="center"><?php echo $date2->format('d/m/Y H:i:s'); ?></div></td>
                        <td><div align="center"><a onclick="showproduct(<?php echo $row['idshipment']; ?>)" href="" >ส่งออกผลผลิต</a></td>
                    <?php
                      }
                    ?>
                  </tr>
                  <?php $n = $n+1; } 
                }?>
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