
<div class="container-fluid">
     <!-- Example DataTables Card-->
      <ol class="breadcrumb">
        <h3 align="center">รายชื่อสมาชิก</h3>
      </ol>
      <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><div align="center">ลำดับ</div></th>
                  <th><div align="center">ชื่อ-นามสกุล</div></th>
                  <th><div align="center">เบอร์โทรศัพท์</div></th>
                  <th><div align="center">ลบผู้ใช้</div></th>
                </tr>
              </thead>
              <tbody>
              	<?php
                require_once("./connect/connect.php");
                $id = $_SESSION['iduser_account'];
                $idplace = $_SESSION['id'.$type.'_place'];
                if($type == "factory" || $type == "factoryadmin"){
                	$findstaff = $con->query("SELECT * FROM factory_staff WHERE idfactory_place = $idplace AND iduser_account != $id") or die (mysqli_error($con)); 	
                }elseif($type == "seller" || $type == "selleradmin"){
                	$findstaff = $con->query("SELECT * FROM seller_staff WHERE idseller_place = $idplace AND iduser_account != $id") or die (mysqli_error($con));
                }
                $n = 1;
                while($getstaff = $findstaff->fetch_assoc()){
                ?>
                <tr>
                    <td><div align="center"><?php echo $n; ?></div></td>
                    <td><div align="center"><?php echo $getstaff[$type.'_staffname'].'&nbsp'.$getstaff[$type.'_staffsurname'];  ?></div></td>
                    <td><div align="center"><?php echo $getstaff[$type.'_stafftel'];?></div></td>
                    <td><div align="center"><a href="./usermanage/deletemember.php?id=<?php echo $getstaff['id'.$type.'_staff']; ?>&type=<?php echo $type; ?>"><img src="images/DeleteUser.png" widht="24px" height="24px"></a></div></td>
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