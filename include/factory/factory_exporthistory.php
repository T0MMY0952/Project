<script>
function edit(id) {
    var myWindow = window.open("./include/factory/factory_showedit.php?idshipment="+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=700,height=750");  
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
                          <td><div align="center"><?php echo '<img widht="24px" height="24px" src="icon/Complete.png">'; ?></div></td>
                          <td><div align="center"></div></td>
                      <?php
                      }elseif($row['status'] == 0){?>
                          <td><div align="center"><?php echo '<img widht="30px" height="30px" src="icon/Wait.png">'; ?></div></td>
                          <?php if(!is_null($row['idfarmer_send'])){ ?>
                                <td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" ><img src="icon/EditList.png" widht="24px" height="24px"></a>&nbsp;<b>/</b>&nbsp;<a class="delete" 
                                  href="#delete
                                  <?php 
                                      $num = $n;
                                      $link = 'include/factory/deleteproduct.php?id='.$row['idshipment']; 
                                      echo $link;
                                      echo $num; 
                                  ?>"><img src="icon/Delete.png" widht="24px" height="24px"></a></div></td>
                          <?php 
                          }elseif(!is_null($row['idfactory_send'])) { ?>
                                <td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" ><img src="icon/EditList.png" widht="24px" height="24px"></a>&nbsp;<b>/</b>&nbsp;<a class="delete" 
                                  href="#delete
                                  <?php 
                                      $num = $n;
                                      $link = 'include/factory/deleteproduct.php?id='.$row['idshipment']; 
                                      echo $link;
                                      echo $num; 
                                  ?>"><img src="icon/Delete.png" widht="24px" height="24px"></a></div></td>
                          <?php
                          }
                      }elseif ($row['status'] == 2){?>
                           <td><div align="center"><a data-toggle="modal" data-id="<?php echo $row['comment']; ?>"class="open-my_modal" href="#my_modal" ><?php echo '<img widht="24px" height="24px" src="icon/cross.png">'; ?></a></div></td>
                           <td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" ><img src="icon/EditList.png" widht="24px" height="24px"></a>&nbsp;<b>/</b>&nbsp;<a class="delete" href="include/farmer/deleteagri.php?id=<?php echo $row['idshipment']; ?>"><img src="icon/Delete.png" widht="24px" height="24px"></a></div></td>

                                <td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" >แก้ไข</a>/<a href="include/factory/deleteproduct.php?id=<?php echo $row['idshipment']; ?>">ลบข้อมูล</a></div></td>
                          <?php 
                          }elseif(!is_null($row['idfactory_send'])) { ?>
                                <td><div align="center"><a onclick="edit(<?php echo $row['idshipment']; ?>)" href="" >แก้ไข</a>/<a href="include/factory/deleteproduct.php?id=<?php echo $row['idshipment']; ?>">ลบข้อมูล</a></div></td>
                    <?php
                        
                    }
                    ?>
                </tr>
                <?php $n = $n+1; } ?>
             </tbody>
            </table>
<script type="text/javascript">
 $(document).on("click", ".open-my_modal", function () {
     var myBookId = $(this).data('id');
     document.getElementById("bookId").innerHTML = myBookId;
});
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="my_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a>เหตุผลที่ไม่รับสินค้า</a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="cursor:pointer;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="rejectfromfac.php">
        <div class="form-group">
          <a name="bookId" id="bookId" value=""/></a>
        </div>
        <div class="modal-footer">
        <button style="cursor:pointer;" class="btn btn-danger" role="close" data-dismiss="modal" aria-label="Close"><a>ปิด</a></button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

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