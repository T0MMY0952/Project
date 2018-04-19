<script>
function recieveproduct(id) {
    var myWindow = window.open("./include/seller/seller_showproduct.php?idshipment="+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
}
function recieveagri(id) {
    var myWindow = window.open("./include/seller/seller_showagri.php?idshipment="+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
}
</script>   
    <div class="container-fluid">
     <!-- Example DataTables Card-->
        <ol class="breadcrumb">
        <h3 align="center">รับสินค้า</h3>
      </ol>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><div align="center">ลำดับ</div></th>
                  <th><div align="center">ชื่อสินค้า</div></th>
                  <th><div align="center">จำนวน</div></th>
                  <th><div align="center">ผู้จัดส่ง</div></th>
                  <th><div align="center">วันที่จัดส่ง</div></th>
                  <th><div align="center">รับสินค้า</div></th>
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
                        WHERE idseller_recieve = '".$getid_sel['idseller_place']."' AND status != 1";
                $result = $con->query($sql) or die (mysqli_error($con));
                $n = 1;
                while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><div align="center"><?php echo $n; ?></div></td>
                    <?php
                      if(!is_null($row['idfactory_send'])){
                        $findproduct = $con->query("SELECT p_name, p_amount, p_unit FROM product WHERE idproduct = '".$row['idproduct']."' ") or die (mysqli_error($con));
                        $getproduct = $findproduct->fetch_assoc(); 
                        echo '<td><div align="center">'; echo $getproduct['p_name']; echo '</div></td>';
                        echo '<td><div align="center">'; echo $getproduct['p_amount']; echo '&nbsp'; echo $getproduct['p_unit']; echo '</div></td>';
                        $date = new DateTime($row['exportdate']);
                        
                        $findfac = $con->query("SELECT factoryname FROM factory_place WHERE idfactory_place = '".$row['idfactory_send']."'");
                        $getfac = $findfac->fetch_assoc();
                        echo '<td><div align="center">'; echo $getfac['factoryname']; echo '</div></td>';
                        echo '<td><div align="center">'; echo $date->format('d/m/Y H:i:s'); echo '</div></td>';
                        echo '<td><div align="center"><a onclick="recieveproduct(';echo $row['idshipment']; echo ')" href="">รับสินค้า</a></div></td>';
                      }elseif(!is_null($row['idfarmer_send'])){
                        $findagri = $con->query("SELECT ap_name, ap_amount, ap_unit, ap_exportdate FROM agriculture_product WHERE idagriculture_product = '".$row['idagriculture_product']."' ") or die (mysqli_error($con));
                        $getagri = $findagri->fetch_assoc(); 
                        echo '<td><div align="center">'; echo $getagri['ap_name']; echo '</div></td>';
                        echo '<td><div align="center">'; echo $getagri['ap_amount']; echo '&nbsp'; echo $getagri['ap_unit']; echo '</div></td>';
                        $date = new DateTime($getagri['ap_exportdate']);
                        
                        $findfac = $con->query("SELECT farmername, farmersurname FROM farmer WHERE idfarmer = '".$row['idfarmer_send']."'");
                        $getfac = $findfac->fetch_assoc();
                        echo '<td><div align="center">'; echo $getfac['farmername']; echo ' '; echo $getfac['farmersurname']; echo '</div></td>';
                        echo '<td><div align="center">'; echo $date->format('d/m/Y H:i:s'); echo '</div></td>';
                        echo '<td><div align="center"><a onclick="recieveagri(';echo $row['idshipment']; echo ')" href="">รับสินค้า</a></div></td>';
                      }
                    ?>
                    
                </tr>
                <?php $n = $n+1; } ?>
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