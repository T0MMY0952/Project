<style type="text/css">
  .btn-link{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color:#0000EE;
  padding:0;
  text-decoration:underline;
  font-family:inherit;
  font-size:inherit;
}
</style>
<script type="text/javascript">
	function ChkValid() {
   var v1 = document.standard.standard.value;
   var v2 = document.standard.number.value;
   if (v1.length<=0)
      {
      alert("ขออภัย! กรุณากรอกข้อมูลให้ครบ");
      return false;
      }
  else if (v2.length<=0)
      {
      alert("ขออภัย! กรุณากรอกข้อมูลให้ครบ");
      return false;
      }
  else
    {
    return true;
    }
}
</script>
<div class="container-fluid">
	<ol class="breadcrumb">
        <h3 align="center">มาตราฐานการผลิต</h3>
    </ol>
    <div class="card">
    	<div class="card-header">
    		เพิ่มมาตราฐาน
    	</div>
    	<div class="card-body">
    		<form action="./usermanage/standardcontrol.php" method="post" name = "standard" onSubmit="return ChkValid()" >
    			<div class="form-row">
	    			<div class="form-group col-md-4">
	    				<label><a style="color: red">*</a>ชื่อมาตราฐานการผลิต</label>
	    				<input type="text" name="standard" class="form-control">
	    			</div>
	    			<div class="form-group col-md-4">
	    				<label><a style="color: red">*</a>หมายเลขมาตราฐานการผลิต</label>
	    				<input type="text" name="number" class="form-control">
	    				<input hidden="hidden" type="text" name="action" value = "insert">
	    			</div>
	    			<div class="form-group col-md-1">
	    				<label><br></label>
		               	<button  type="submit" class="btn btn-success btn-block">เพิ่ม</button>
                    </div>
    			</div>
    		</form>
    	</div>
    </div>
    <br>
    <div class="card">
    	<div class="card-header">
    		มาตราฐานทั้งหมด
    	</div>
    	<div class="card-body">
    		<div class="col-md-8">
		    		<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">ลำดับ</th>
					      <th scope="col">มาตราฐาน</th>
					      <th scope="col">หมายเลขมาตราฐาน</th>
					      <th scope="col">วันที่เพิ่มมาตราฐาน</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
					  	require_once('./connect/connect.php');
					  	$findstd = $con->query("SELECT * FROM standard WHERE idfactory_place = '".$_SESSION['idfactory_place']."' ");
					  	$n = 1;
					  	while ($getstd = $findstd->fetch_assoc()){
					  	?>
					    <tr>
					      <th><?php echo $n; ?></th>
					      <td><?php echo $getstd['standard'];?></td>
					      <td><?php echo $getstd['number'];?></td>
					      <td>
					      <?php 
					      $date = date_create($getstd['dateadd']);
					      echo $date->format('d/m/y'); ?></td>
					 	  <td>
					 	  	<form action="./usermanage/standardcontrol.php" method="post">
					 	  		<input hidden="hidden" type="text" name="id" value="<?php echo $getstd['idstandard']; ?>">
					 	  		<input hidden="hidden" type="text" name="action" value="delete">
					 	  		<button type="submit" name="your_name" class="btn-link">ลบ</button>	
					 	  	</form>
					 	  </td>
					    </tr>
					    <?php
					    $n = $n+1;
							}
						?>
					  </tbody>
					</table>
			</div>
    	</div>
    </div>
</div>