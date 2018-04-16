<script>
function editagritosell(idapr) {
    var myWindow = window.open("./include/farmer/farmer_updateagritosell.php?idapr="+idapr, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
}
function qrcode(id) {
    var myWindow = window.open("./include/show_QR.php?idshipment="+id+"&type=farmer", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=500,height=500");  
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
        <h3 align="center">ประวัติผลผลิตที่จำหน่าย</h3>
      </ol>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><div align="center">ลำดับ</div></th>
                  <th><div align="center">ชื่อผลผลิต</div></th>
                  <th><div align="center">วันที่เก็บ</div></th>
                  <th><div align="center">แปลงที่เก็บ</div></th>
                  <th><div align="center">จำนวน</div></th>
                  <th><div align="center">ราคาต่อหน่วย</div></th>
                  <th><div align="center">แก้ไข/ลบข้อมูล</div></th>
                  <th><div align="center">พิมพ์ QR Code</div></th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once("./connect/connect.php");
                $sql = "SELECT ap_name,ap_garden,ap_amount,ap_price,ap_unit,ap.idagriculture_product,ap_collectdate
						            FROM agriculture_product as ap
                        LEFT JOIN shipment as s  on ap.idagriculture_product = s.idagriculture_product
						            WHERE idfarmer = '".$_SESSION['idfarmer']."' AND s.idagriculture_product IS NULL
                        ORDER BY exportdate DESC ";    
                $result = $con->query($sql) or die (mysqli_error($con));
                $n = 1;
                while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><div align="center"><?php echo $n; ?></div></td>
                    <td><div align="center"><?php echo $row['ap_name']; ?></div></td>
                    <?php 
                    	$date = new DateTime($row['ap_collectdate']);
                    	$date->modify('+543 Year');
                    ?>
                    <td><div align="center"><?php echo $date->format('d/m/Y'); ?></div></td>
                    <td><div align="center"><?php echo $row['ap_garden']; ?></div></td>
                    <td><div align="center"><?php echo $row['ap_amount']; echo '&nbsp'; echo $row['ap_unit']; ?></div></td>
                    <td><div align="center"><?php echo $row['ap_price']; echo '&nbsp บาท'; ?></div></td>
                    <td><div align="center">
                    <a onclick="editagritosell(<?php echo $row['idagriculture_product']; ?>)" href="" >
                    <img src="images/EditList.png" widht="24px" height="24px"></a><b>&nbsp;/&nbsp;</b>
                    <a class="delete" href="#delete
                    <?php 
                        $num = $n;
                        $link = 'include/farmer/deleteagritosell.php?id='.$row['idagriculture_product'];
                        echo $link;
                        echo $num; 
                    ?>"> 
                    <img src="images/Delete.png" widht="24px" height="24px"></a></div></td>
                    <td><div align="center"><a onclick="qrcode(<?php echo $row['idagriculture_product']; ?>)" href="" ><img src="images/Print.png" widht="34px" height="34px"></a></div></td>
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