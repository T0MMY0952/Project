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
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/tracking.css" rel="stylesheet">
<style type="text/css">
body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}

.col-20{
  float: left;
  width: 18%; 
  margin-top: 8%;
  margin-left:4%;
}

.col-80{
  float: left;
  width: 78%;
  margin-top: 2%; 
}

</style>
</head>


<script type="text/javascript">
	function printlayer(layer){
		var generator = window.open(",'name,");
		var layertext = document.getElementById(layer);
		generator.document.write(layertext.innerHTML.replace("Print Me"));
		generator.document.close();
		generator.print();
		generator.close();
	}
</script>

<body> 

	<div class="col-20">
   	    <form action="test2.php" method="post">
      <ol style="background-color:#8FBC8F;" class="breadcrumb">
        <h5 align="center">พิมพ์ QR CODE</h5>
      </ol>	    	

        <ul>
	  	<li><label><strong>จำนวน QR Code ที่ต้องการ</strong></label></li><br>
		 <input class="form-control" type="int" name="qrcode" value = 1 id="qrcode"></input><br>
	  	<li><label><strong><td>ขนาด QR Code ที่ต้องการ</strong></label></li><br>
		 <input class="form-control" type="int" name="size" value = 200 id="size"></input><br><br>
         <button style="cursor:pointer;" class="btn btn-success btn-block" mt-5>ตกลง</button>
		 <button style="cursor:pointer;" class="btn btn-success btn-block" href="#" id="print" onclick="javascript:printlayer('printqrcode')">Print</button>
  		</form>
  		</ul> 
	</div>


	<div class="col-80">
		<page size="A4" id="printqrcode">
		<?php
		// include QR_BarCode class 
		include ("QR_BarCode.php"); 

		// QR_BarCode object 
		$qr = new QR_BarCode(); 

		// create text QR code 
		$qr->text("www.google.co.th"); 

		// display QR code image
		$qrcode = $_POST['qrcode'];
		$size = $_POST['size'];
		$qr->size($size);
		$img = $qr->qrCode();

		for($i = 1 ; $i <= $qrcode ; $i++){
		echo '<img src="data:image/png;base64,' . base64_encode($img) . '">';
		}
		?>
		</page>
  	</div>

</body>

<!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

</html>


