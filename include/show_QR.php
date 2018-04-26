<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>หน้าพิมพ์ QR Code</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/tracking.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>


<script type="text/javascript">
	$(function () {
    $("#btnPrint").click(function () {
        var contents = $("#printqrcode").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "relative", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});

</script>

<body> 
<?php 
$array =  unserialize(base64_decode($_POST['data']));
$type = $_POST['type']; 
?>
<div class="container-fluid" style="margin-top: 30px;">
<div class="row">
	<div class="col">
	  <form action="" method="post">
      <ol style="background-color:#8FBC8F;" class="breadcrumb">
        <h5 align="center">พิมพ์ QR CODE</h5>
      </ol>	    	

        <ul>
	  	<li><label><strong>จำนวน QR Code ที่ต้องการ(ชิ้น)</strong></label></li><br>
		 <input class="form-control" type="text" name="qrcode"  value="<?php 
		 if(!isset($_POST['qrcode'])){
		 	$qrcode = 25;
		 	echo '25';
		 }else{
		 	$qrcode = $_POST['qrcode'];
		 echo htmlspecialchars($_POST['qrcode']); 
		 }?>"></input><br>
	  	<li><label><strong><td>ขนาด QR Code ที่ต้องการ(พิกเซล)</strong></label></li><br>
		 <input class="form-control" type="text" name="size"   value="<?php 
		 if(!isset($_POST['qrcode'])){
		 	$size = 130;
		 	echo '130';
		 }else{
		 	$size = $_POST['size'];
		 echo htmlspecialchars($_POST['size']); 
		 } ?>"></input><br><br>
		 <input type="hidden" name="data" value="<?= base64_encode(serialize($array)); ?>" />
		 <input type="hidden" name="type" value="<?php echo $type; ?>" />
		 <button style="cursor:pointer;" class="btn btn-success btn-block" mt-5>ตกลง</button>
     	 <input style="cursor:pointer;" class="btn btn-success btn-block" type="button" id="btnPrint" value="Print" mt-5>
  		</ul> 
  	</form>
	</div>
	<div class="col-8">
		<div class="card">
			<div class="card-header">
				สินค้าที่ใช้กับ QR Code นี้
			</div>
			<div class="card-body">
				<table class="table">
				<?php if($type == "farmer"){?>
					<thead>
					<th>ชื่อสินค้า : <?php echo $array['ap_name']; ?></th>
					</thead>
					<thead>
					<th>วันที่เก็บ : <?php $date = date_create($array['ap_collectdate']); echo $date->format('d/m/Y'); ?></th>
					</thead>
					<thead>
					<th>แปลงที่เก็บ : <?php echo $array['ap_garden']; ?></th>
					</thead>
				 <?php 
				}elseif($type == "seller"){ ?>
					<thead>
					<th>ชื่อสินค้า : <?php $product = $_POST['product']; echo $product; ?></th>
					</thead>
					<thead>
					<th>ส่งมาจาก : <?php $sender = $_POST['sender']; echo $sender; ?></th>
					</thead>
					<thead>
					<th>วันที่รับสินค้า : <?php $date = date_create($array['recievedate']); echo $date->format('d/m/Y H:i:s'); ?></th>
					</thead>
				<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
	


	
		
	<?php
		// include QR_BarCode class 
		include ("QR_BarCode.php"); 

		// QR_BarCode object 
		$qr = new QR_BarCode(); 

    // include connect
    require_once('../connect/connect.php');

		// create text QR code 
    if($type == "farmer"){
      $qr->text("158.108.207.4/sp_60_TrackingForAg/include/trackingagri.php?id=".$array['idagriculture_product']);
      $findplace = $con->query("SELECT * 
                                FROM farm_place AS fp 
                                LEFT JOIN farmer AS f ON fp.idfarm_place = f.idfarm_place  
                                WHERE f.idfarmer = '".$array['idfarmer']."'") or die (mysqli_error($con));
      $getplace = $findplace->fetch_assoc();
      $place = $getplace['farmname'];
      $exp = date_create($array['ap_expdate']);
      $exp = $exp->format('d/m/Y');

	}elseif($type == "seller"){
      $qr->text("158.108.207.4/sp_60_TrackingForAg/include/tracking.php?idshipment=".$array['idshipment']."&type=".$type);
      $findplace = $con->query("SELECT * 
                                FROM seller_place  
                                WHERE idseller_place = '".$array['idseller_recieve']."'") or die (mysqli_error($con));
      $getplace = $findplace->fetch_assoc();
      $place = $getplace['sellername'];
      $findexp = $con->query("SELECT * 
                                FROM product  
                                WHERE idproduct = '".$array['idproduct']."'") or die (mysqli_error($con));
      $getexp = $findexp->fetch_assoc();
      $exp = date_create($getexp['p_exp']);
      $exp = $exp->format('d/m/Y');
    }
    ?>

	<div class="container d-none" id="printqrcode">
	<?php
		// display QR code image
		$qr->size($size);
		$img = $qr->qrCode();
	  
	  echo '<div class="row" style="margin-left:5px;">';
		for($i = 1 ; $i <= $qrcode ; $i++){
      echo '<div class="card" style="border-width: 2px;">';
      echo '<a class="text-center">'.$place.'</a>';
	  echo '<img src="data:image/png;base64,' . base64_encode($img) . '">';
      echo '<a class="text-center">วันหมดอายุของสินค้า<br></a>';
      echo '<a class="text-center">'.$exp.'</a>';
      echo '</div>';
		}
      echo '</div>';
     
	?>
		
  	</div>

</body>

<!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

</html>


