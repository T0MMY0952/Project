<div class="container-fluid">
	<ol class="breadcrumb">
        <h3 align="center">มาตราฐานการผลิต</h3>
    </ol>
    <div class="card">
    	<div class="card-header">
    		เพิ่มมาตราฐาน
    	</div>
    	<div class="card-body">
    		<form action="./usermanage/standardcontrol.php" method="post">
    			<div class="form-row">
	    			<div class="form-group col-md-8">
	    				<label>ชื่อมาตราฐานการผลิต</label>
	    				<input type="text" name="standard" class="form-control">
	    			</div>
	    			<div class="form-group col-md-1">
	    				<label><br></label>
	    				<button class="btn btn-success btn-block" type="submit" mt-5>เพิ่ม</button>
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
					      <td>
					      <?php 
					      $date = date_create($getstd['dateadd']);
					      echo $date->format('d/m/y'); ?></td>
					 	  <td><a href="./usermanage/standardcontrol.php?id=<?php echo $getstd['idstandard'];?>">ลบ</a></td>
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