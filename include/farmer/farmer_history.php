<script>
function edit(idapr) {
    var myWindow = window.open("./include/farmer/farmer_updateagri.php?idapr="+idapr, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
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
        <h3 align="center">ประวัติผลผลิตที่ส่งออก</h3>
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
                  <th><div align="center">สถานที่ปลายทาง</div></th>
                  <th><div align="center">วันที่จัดส่ง</div></th>
                  <th><div align="center">สถานะการรับ</div></th>
                  <th><div align="center">แก้ไข/ลบข้อมูล</div></th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once("./connect/connect.php");
                $sql = "SELECT s.idshipment, ap.ap_name, ap.ap_collectdate, ap.ap_garden, s.idfactory_recieve,s.status,ap.ap_amount, ap.ap_unit,
                        s.idseller_recieve,s.exportdate,ap.ap_price
						            FROM shipment as s 
                        LEFT JOIN agriculture_product as ap on s.idagriculture_product = ap.idagriculture_product
						            WHERE s.idfarmer_send = '".$_SESSION['idfarmer']."' 
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
                    ?>
                    <td><div align="center"><?php echo $date->format('d/m/Y'); ?></div></td>
                    <td><div align="center"><?php echo $row['ap_garden']; ?></div></td>
                    <td><div align="center"><?php echo $row['ap_amount']; echo '&nbsp'; echo $row['ap_unit']; ?></div></td>
                    <td><div align="center"><?php echo $row['ap_price']; echo '&nbsp บาท'; ?></div></td>
                    <?php
                    if(!is_null($row['idseller_recieve'])){
                      $type = 'seller';
                    }else{
                      $type = 'factory';
                    }
                    $s =  "SELECT ".$type."name FROM ".$type."_place WHERE id".$type."_place = '".$row['id'.$type.'_recieve']."' ";
                    $findfac = $con->query($s) or die (mysqli_error($con));
                    $result1 = $findfac->fetch_assoc() or die (mysqli_error($con));
                     ?>
                    <td><div align="center"><?php echo $result1[$type.'name']; ?></div></td>
                    <?php 
                    	$date = new DateTime($row['exportdate']);
                    ?>
                    <td><div align="center"><?php echo $date->format('d/m/Y H:i:s'); ?></div></td>
                    <?php
                    if($row['status'] == 0){?>
                    	<td><div align="center"><?php echo '<img widht="30px" height="30px" src="images/Wait.png">'; ?></div></td>
                    	<td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" ><img src="images/EditList.png" widht="24px" height="24px"></a>&nbsp;<b>/</b>&nbsp;<a class="delete" href="#delete<?php 
                        $num = $n;
                        $link = 'include/farmer/deleteagri.php?id='.$row['idshipment'];
                        echo $link;
                        echo $num; 
                      ?>"><img src="images/Delete.png" widht="24px" height="24px"></a></div></td>
                    <?php
            		    }elseif ($row['status'] == 1) {?>
            			   <td><div align="center"><?php echo '<img widht="24px" height="24px" src="images/Complete.png">'; ?></div></td>
                     <td><div align="center"></div></td>
            		    <?php
            		    }
                    ?>
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