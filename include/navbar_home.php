
<script>
$(document).ready(function(){
  $(".login").click(function(){
    $("#login").modal("show");
  });
})

$(document).ready(function(){
  $(".logout").click(function(){
    $("#logout").modal("show");
  });
})

</script>


<nav class="navbar navbar-expand-lg navbar-dark bg-green fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">ระบบจัดการศูนย์ตรวจสอบย้อนกลับผลผลิตทางการเกษตร</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      
      <?php 
      if (isset($_SESSION['iduser_account']) ){
          require_once("./connect/connect.php");
          echo'<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">';
          if ($_SESSION['type'] == "farmer"){
            //-- Login Farmer
           $find = $con->query("SELECT farmername FROM farmer WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
           $get = $find->fetch_assoc();
          
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["farmername"];
           echo '</span></a></li>';
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="หน้าหลัก"><a class="nav-link" href="index.php" class="active">
            <img widht="24px" height="24px" src="icon/Home.png"><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="แก้ไขข้อมูลส่วนตัว"><a class="nav-link" href="index.php?action=edituser">
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a></li>
            	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="เพิ่มข้อมูลผลผลิต">
            <a class="nav-link  nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1" >
                <img widht="24px" height="24px" src="icon/Product.png"><span class="nav-link-text">&nbsp&nbspเพิ่มข้อมูลผลผลิต</span></a>
            <ul class="sidenav-second-level collapse" id="collapseComponents1">
              <li><a href="index.php?action=addagritosell">เพิ่มผลผลิตที่จำหน่าย</a></li>
              <li><a href="index.php?action=addagri">เพิ่มผลผลิตที่ส่งออก</a></li>
            </ul> 
            </li>
            	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="ประวัติผลผลิต">
            <a class="nav-link  nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" >
               <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติผลผลิต</span></a>
            <ul class="sidenav-second-level collapse" id="collapseComponents2">
              <li><a href="index.php?action=historyagrisell">&nbsp&nbspประวัติผลผลิตที่จำหน่าย</a></li>
              <li><a href="index.php?action=history">&nbsp&nbspประวัติผลผลิตที่ส่งออก</a></li>
            </ul> 
            </li>';
                
          }
          if ($_SESSION['type'] == "selleradmin"){
            //-- Login Seller
          $find = $con->query("SELECT seller_staffname FROM seller_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
          $get = $find->fetch_assoc();
          
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"></i><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["seller_staffname"];
           echo '</span></a></li>';
           echo'<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard"><a class="nav-link" href="index.php" class="active">
            <img widht="24px" height="24px" src="icon/Home.png"></i><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts"><a class="nav-link" href="index.php?action=edituser">
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <a class="nav-link  nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" >
                <img widht="23px" height="23px" src="icon/AddUser.png"><span class="nav-link-text">&nbsp&nbspจัดการข้อมูลสมาชิก</span></a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li><a href="index.php?action=adduser">เพิ่มสมาชิก</a></li>
              <li><a href="index.php?action=listuser">รายชื่อสมาชิก</a></li>
            </ul> 
            </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=recieveproduct">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการรับสินค้า</span></a></li>';
          }
          if ($_SESSION['type'] == "seller"){
            //-- Login Seller
          $find = $con->query("SELECT seller_staffname FROM seller_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
          $get = $find->fetch_assoc();
          
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["seller_staffname"];
           echo '</span></a></li>';
           echo'<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard"><a class="nav-link" href="index.php" class="active">
            <img widht="24px" height="24px" src="icon/Home.png"><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts"><a class="nav-link" href="index.php?action=edituser">
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=recieveproduct">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการรับสินค้า</span></a></li>';
          }
          if ($_SESSION['type'] == "factoryadmin"){
            //-- Login Factory
            $find = $con->query("SELECT factory_staffname FROM factory_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
            $get = $find->fetch_assoc();
          
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["factory_staffname"];
           echo '</span></a></li>';
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard"><a class="nav-link" href="index.php" class="active">
            <img widht="24px" height="24px" src="icon/Home.png"><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts"><a class="nav-link" href="index.php?action=edituser">
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <a class="nav-link  nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" >
                <img widht="23px" height="23px" src="icon/AddUser.png"><span class="nav-link-text">&nbsp&nbspจัดการข้อมูลสมาชิก</span></a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li><a href="index.php?action=adduser">เพิ่มสมาชิก</a></li>
              <li><a href="index.php?action=listuser">รายชื่อสมาชิก</a></li>
            </ul> 
            </li>
            	 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=standard">
            <img widht="23px" height="23px" src="icon/Standrad.png"><span class="nav-link-text">&nbsp&nbspมาตราฐานการผลิต</span></a></li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=recieveagri">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a></li>
        		     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=exportproduct">
            <img widht="23px" height="23px" src="icon/Up.png"><span class="nav-link-text">&nbsp&nbspส่งออกสินค้า</span></a></li>
				         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการส่งออกสินค้า</span></a></li>';
          }
          if ($_SESSION['type'] == "factory"){
            //-- Login Factory
            $find = $con->query("SELECT factory_staffname FROM factory_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
            $get = $find->fetch_assoc();
          
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["factory_staffname"];
           echo '</span></a></li>';
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard"><a class="nav-link" href="index.php" class="active">
            <img widht="24px" height="24px" src="icon/Home.png"><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a></li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts"><a class="nav-link" href="index.php?action=edituser">
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a></li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=recieveagri">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a></li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=exportproduct">
            <img widht="23px" height="23px" src="icon/Up.png"><span class="nav-link-text">&nbsp&nbspส่งออกสินค้า</span></a></li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการส่งออกสินค้า</span></a></li>';
          }
      echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables"><a class="nav-link logout" href="#logout">
            <img widht="24px" height="24px" src="icon/Logout.png"><span class="nav-link-text">&nbsp&nbspออกจากระบบ</span></a></li>';
      echo '</ul>
      <ul class="navbar-nav ml-auto">
      </ul>';
      }
      ?>
      <ul class="navbar-nav ml-auto">
          <?php 
          if(!isset($_SESSION['iduser_account'])){
            //-- Not Login
            echo '<li class="text-center"><a style="color:white;" class="btn btn-block" href="index.php?action=register">สมัครสมาชิก</a></li>';
            echo '<li class="text-center"><a style="color:white;" class="btn btn-block login" href="#login">เข้าสู่ระบบ</a></li>';
          }
          ?>
      </ul>
    </div>
</nav>



