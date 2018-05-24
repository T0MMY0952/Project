
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
          
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right">
			<button type="button" class="btn btn-success btn-block">เกษตรกร</button></li>
           <li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["farmername"];
           echo '</span></a></li>';
           if(isset($_GET['action']) && $_GET['action'] == "edituser"){
           		$l1 = array(null,null );
           		$l2 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$collapse1 = 'collapse';
				$collapse2 = 'collapse';
				
			}elseif(isset($_GET['action']) && $_GET['action'] == "addagri"){
				$l1 = array(null,null );
				$l2 = array(null,null );         					
				$l3 = null;
				$l4 = 'success';	
				$l5 = null;
				$l6 = null;
				$collapse1 = null;
				$collapse2 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "history"){
				$l1 = array(null,null );
				$l2 = array(null,null );
           		$l3 = null;			
				$l4 = null;
				$l5 = null;
				$l6 = 'success';
				$collapse1 = 'collapse';
				$collapse2 = null;
			}elseif(isset($_GET['action']) && $_GET['action'] == "historyagrisell"){
				$l1 = array(null,null );
				$l2 = array(null,null );
           		$l3 = null;			
				$l4 = null;
				$l5 = 'success';
				$l6 = null;
				$collapse1 = 'collapse';
				$collapse2 = null;
			}elseif(isset($_GET['action']) && $_GET['action'] == "addagritosell"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l3 = 'success';			
				$l4 = null;
				$l5 = null;				
				$l6 = null;
				$collapse1 = null ;
				$collapse2 = 'collapse';
			}else{
				$l1 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$collapse1 = 'collapse';
				$collapse2 = 'collapse';
			}

           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="หน้าหลัก">'.$l1[0].'<a class="nav-link" href="index.php">
            <img widht="24px" height="24px" src="icon/Home.png"><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a>'.$l1[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="แก้ไขข้อมูลส่วนตัว">'.$l2[0].'<a href="index.php?action=edituser" class="nav-link" >
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a>'.$l2[1].'</li>
            	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="เพิ่มข้อมูลผลผลิต">
            <a class="nav-link  nav-link-collapse " data-toggle="collapse" href="#collapseComponents1" >
                <img widht="24px" height="24px" src="icon/Product.png"><span class="nav-link-text">&nbsp&nbspเพิ่มข้อมูลผลผลิต</span></a>
            <ul class="sidenav-second-level '.$collapse1.'" id="collapseComponents1">
               <li><a class="btn btn-'.$l3.' " role="button"  href="index.php?action=addagritosell">เพิ่มผลผลิตที่จำหน่าย</a></li>
               <li><a class="btn btn-'.$l4.' " href="index.php?action=addagri"  role="button" >เพิ่มผลผลิตที่ส่งออก</a></li>
            </ul> 
            </li>
            	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="ประวัติผลผลิต">
            <a class="nav-link  nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" >
               <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติผลผลิต</span></a>
            <ul class="sidenav-second-level '.$collapse2.'" id="collapseComponents2">
              <li><a class="btn btn-'.$l5.'" href="index.php?action=historyagrisell" role="button">ประวัติผลผลิตที่จำหน่าย</a></li>
              <li><a class="btn btn-'.$l6.'" href="index.php?action=history" role="button">ประวัติผลผลิตที่ส่งออก</a></li>
            </ul> 
            </li>';
                
          }
          if ($_SESSION['type'] == "selleradmin"){
            //-- Login Seller
          $find = $con->query("SELECT seller_staffname FROM seller_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
          $get = $find->fetch_assoc();
          
           echo '
           <li class="nav-item" data-toggle="tooltip" data-placement="right">
			<button type="button" class="btn btn-primary btn-block"><img widht="24px" height="24px"  src="icon/king.png">&nbspผู้จัดจำหน่าย</button></li>
           <li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"></i><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["seller_staffname"];
           echo '</span></a></li>';
           if(isset($_GET['action']) && $_GET['action'] == "edituser"){
				$l1 = array(null,null );
           		$l2 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "recieveproduct"){
				$l1 = array(null,null );
           		$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l6 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
				$l1 = null;
           		$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "adduser"){
				$l1 = array(null,null );
           		$l2 = array(null,null );
				$l3 = 'success';
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$collapse1 = null;
			}elseif(isset($_GET['action']) && $_GET['action'] == "listuser"){
				$l1 = array(null,null );
           		$l2 = array(null,null );
				$l3 = null;
				$l4 = 'success';
				$l5 = null;
				$l6 = null;
				$collapse1 = null;
			}else{
				$l1 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
           		$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$collapse1 = 'collapse';		
			}

           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="หน้าหลัก">'.$l1[0].'<a class="nav-link" href="index.php">
            <img widht="24px" height="24px" src="icon/Home.png"><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a>'.$l1[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="แก้ไขข้อมูลส่วนตัว">'.$l2[0].'<a href="index.php?action=edituser" class="nav-link" >
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a>'.$l2[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <a class="nav-link  nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" >
                <img widht="23px" height="23px" src="icon/AddUser.png"><span class="nav-link-text">&nbsp&nbspจัดการข้อมูลสมาชิก</span></a>
            <ul class="sidenav-second-level '.$collapse1.'" id="collapseComponents">
              <li><a class="btn btn-'.$l3.' " role="button" href="index.php?action=adduser">เพิ่มสมาชิก</a></li>
              <li><a class="btn btn-'.$l4.' " role="button" href="index.php?action=listuser">รายชื่อสมาชิก</a></li>
            </ul> 
            </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l5[0].'<a class="nav-link" href="index.php?action=recieveproduct">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a>'.$l5[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l6[0].'<a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการรับสินค้า</span></a>'.$l6[1].'</li>';
          }
          if ($_SESSION['type'] == "seller"){
            //-- Login Seller
          $find = $con->query("SELECT seller_staffname FROM seller_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
          $get = $find->fetch_assoc();
          
           echo '
           <li class="nav-item" data-toggle="tooltip" data-placement="right">
			<button type="button" class="btn btn-primary btn-block">ผู้จัดจำหน่าย</button></li>
           <li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["seller_staffname"];
           echo '</span></a></li>';
           if(isset($_GET['action']) && $_GET['action'] == "edituser"){
				$l1 = array(null,null );
           		$l2 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l5 = null;
				$l6 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "recieveproduct"){
				$l1 = array(null,null );
           		$l2 = array(null,null );
				$l5 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l6 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
				$l1 = null;
           		$l2 = array(null,null );
				$l5 = null;
				$l6 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$collapse1 = 'collapse';
			}else{
				$l1 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
           		$l2 = array(null,null );
				$l5 = null;
				$l6 = null;
				$collapse1 = 'collapse';		
			}

           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="หน้าหลัก">'.$l1[0].'<a class="nav-link" href="index.php">
            <img widht="24px" height="24px" src="icon/Home.png"><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a>'.$l1[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="แก้ไขข้อมูลส่วนตัว">'.$l2[0].'<a href="index.php?action=edituser" class="nav-link" >
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a>'.$l2[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l5[0].'<a class="nav-link" href="index.php?action=recieveproduct">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a>'.$l5[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l6[0].'<a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการรับสินค้า</span></a>'.$l6[1].'</li>';
          }
          if ($_SESSION['type'] == "factoryadmin"){
            //-- Login Factory
            $find = $con->query("SELECT factory_staffname FROM factory_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
            $get = $find->fetch_assoc();
          
           echo '
           <li class="nav-item" data-toggle="tooltip" data-placement="right">
			<button type="button" class="btn btn-warning btn-block"><img widht="24px" height="24px"  src="icon/king.png">&nbspโรงงาน</button></li>
           <li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["factory_staffname"];
           echo '</span></a></li>';
           if(isset($_GET['action']) && $_GET['action'] == "edituser"){
				$l1 = array(null,null );
           		$l2 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$l7 = null;
				$l8 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "recieveagri"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l7 = null;
				$l8 = null;
				$collapse1 = 'collapse';
				
			}elseif(isset($_GET['action']) && $_GET['action'] == "exportproduct"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$l7 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l8 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$l7 = null;
				$l8 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "adduser"){
				$l1 = array(null,null );
           		$l2 = array(null,null );
				$l3 = 'success';
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$l7 = null;
				$l8 = null;
				$collapse1 = null;
				
			}elseif(isset($_GET['action']) && $_GET['action'] == "listuser"){
				$l1 = array(null,null );
           		$l2 = array(null,null );
				$l3 = null;
				$l4 = 'success';
				$l5 = null;
				$l6 = null;
				$l7 = null;
				$l8 = null;
				$collapse1 = null;
				
			}elseif(isset($_GET['action']) && $_GET['action'] == "standard"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l6 = null;
				$l7 = null;
				$l8 = null;
				$collapse1 = 'collapse';
				
			}else{
				$l1 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l2 = array(null,null );
				$l3 = null;
				$l4 = null;
				$l5 = null;
				$l6 = null;
				$l7 = null;
				$l8 = null;
				$collapse1 = 'collapse';
				
			}
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">'.$l1[0].'<a class="nav-link" href="index.php" class="active">
            <img widht="24px" height="24px" src="icon/Home.png"></i><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a>'.$l1[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="แก้ไขข้อมูลส่วนตัว">'.$l2[0].'<a href="index.php?action=edituser" class="nav-link" >
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a>'.$l2[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <a class="nav-link  nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" >
                <img widht="23px" height="23px" src="icon/AddUser.png"><span class="nav-link-text">&nbsp&nbspจัดการข้อมูลสมาชิก</span></a>
            <ul class="sidenav-second-level '.$collapse1.'" id="collapseComponents">
              <li><a class="btn btn-'.$l3.' " role="button" href="index.php?action=adduser">เพิ่มสมาชิก</a></li>
              <li><a class="btn btn-'.$l4.' " role="button" href="index.php?action=listuser">รายชื่อสมาชิก</a></li>
            </ul> 
            </li>
            	 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l5[0].'<a class="nav-link" href="index.php?action=standard">
            <img widht="23px" height="23px" src="icon/Standrad.png"><span class="nav-link-text">&nbsp&nbspมาตราฐานการผลิต</span></a>'.$l5[1].'</li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l6[0].'<a class="nav-link" href="index.php?action=recieveagri">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a>'.$l6[1].'</li>
        		     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l7[0].'<a class="nav-link" href="index.php?action=exportproduct">
            <img widht="23px" height="23px" src="icon/Up.png"><span class="nav-link-text">&nbsp&nbspส่งออกสินค้า</span></a>'.$l7[1].'</li>
				         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l8[0].'<a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการส่งออกสินค้า</span></a>'.$l8[1].'</li>';
          }
          if ($_SESSION['type'] == "factory"){
            //-- Login Factory
            $find = $con->query("SELECT factory_staffname FROM factory_staff WHERE iduser_account = '".$_SESSION['iduser_account']."' ");
            $get = $find->fetch_assoc();
          
           echo '
           <li class="nav-item" data-toggle="tooltip" data-placement="right">
			<button type="button" class="btn btn-warning btn-block"><img widht="24px" height="24px"  src="icon/king.jpg">โรงงาน</button></li>
           <li class="nav-item" data-toggle="tooltip" data-placement="right"><a class="nav-link">
            <img widht="24px" height="24px"  src="icon/User.png"><span class="nav-link-text">&nbspสวัสดีคุณ';
           echo '&nbsp';
           echo $get["factory_staffname"];
           echo '</span></a></li>';
           if(isset($_GET['action']) && $_GET['action'] == "edituser"){
				$l1 = array(null,null );
           		$l2 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l6 = null;
				$l7 = null;
				$l8 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "recieveagri"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l6 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l7 = null;
				$l8 = null;
				$collapse1 = 'collapse';
				
			}elseif(isset($_GET['action']) && $_GET['action'] == "exportproduct"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l6 = null;
				$l7 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l8 = null;
				$collapse1 = 'collapse';
			}elseif(isset($_GET['action']) && $_GET['action'] == "historyproduct"){
				$l1 = array(null,null );
				$l2 = array(null,null );
				$l6 = null;
				$l7 = null;
				$l8 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$collapse1 = 'collapse';
				
			}else{
				$l1 = array('<button type="button" class="btn btn-success btn-block text-left">','</button>' );
				$l2 = array(null,null );
				$l6 = null;
				$l7 = null;
				$l8 = null;
				$collapse1 = 'collapse';
				
			}
           echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">'.$l1[0].'<a class="nav-link" href="index.php" class="active">
            <img widht="24px" height="24px" src="icon/Home.png"></i><span class="nav-link-text">&nbsp&nbspหน้าหลัก</span></a>'.$l1[1].'</li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="แก้ไขข้อมูลส่วนตัว">'.$l2[0].'<a href="index.php?action=edituser" class="nav-link" >
            <img widht="23px" height="23px" src="icon/Edituser.png"><span class="nav-link-text">&nbsp&nbspแก้ไขข้อมูลส่วนตัว</span></a>'.$l2[1].'</li>
            
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l6[0].'<a class="nav-link" href="index.php?action=recieveagri">
            <img widht="23px" height="23px" src="icon/Down.png"><span class="nav-link-text">&nbsp&nbspรับสินค้า</span></a>'.$l6[1].'</li>
        		     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l7[0].'<a class="nav-link" href="index.php?action=exportproduct">
            <img widht="23px" height="23px" src="icon/Up.png"><span class="nav-link-text">&nbsp&nbspส่งออกสินค้า</span></a>'.$l7[1].'</li>
				         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">'.$l8[0].'<a class="nav-link" href="index.php?action=historyproduct">
            <img widht="24px" height="24px" src="icon/History.png"><span class="nav-link-text">&nbsp&nbspประวัติการส่งออกสินค้า</span></a>'.$l8[1].'</li>';
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



