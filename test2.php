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
</style>
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
<form action="test2.php" method="post">
	<label>จำนวน QR Code ที่ต้องการ</label><br>
		<input type="int" name="qrcode" value = 1 id="qrcode"></input><br>
	<label>ขนาด QR Code ที่ต้องการ</label><br>
		<input type="int" name="size" value = 200 id="size"></input><br>
	<button type="submit">ตกลง</button>
</form>
<a href="#" id="print" onclick="javascript:printlayer('printqrcode')">print</a>

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
</body>

