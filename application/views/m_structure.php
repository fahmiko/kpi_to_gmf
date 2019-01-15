<?php
$st_lv = $this->session->userdata('structure_level');
$st = $this->session->userdata('structure');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Structure</title>
	<link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron">
  <h1 class="display-4">Structure KPI </h1>
  <hr class="my-4">
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
</div>
<div class="container">
	<!-- Card Level 2 -->
<div class="card">
  <div class="card-header">
    KPI LEVEL 2
  </div>
  <div class="card-body">
  	<?php for($i = 0;$i < $st_lv['level']['level3'];$i++){ ?>
	  <div class="input-group mb-1">
	  	<div class="input-group-append">
	   		<input type="text" class="form-control" value="<?=$st['level2'][$i]['name']?>" readonly="">
	  	</div>
	  	<div class="input-group-append">
	   		<input type="date" class="form-control">
	  	</div>
	  	<div class="input-group-append">
	   		<label class="input-group-text">Date End</label>
	  	</div>
	</div>
	<?php }?>
  </div>
</div>
<!-- Card Level 2 -->
<div class="card" style="margin-top: 5px">
  <div class="card-header">
    KPI LEVEL 3
  </div>
  <div class="card-body">
  	  <?php for($i = 0;$i < $st_lv['level']['level3'];$i++){ ?>
	  <div class="input-group mb-1">
	  	<select class="custom-select" id="inputGroupSelect02" style="max-width: 150px">
	    	<?php
				for($j = 0;$j < $st_lv['level']['level2'];$j++){
					echo $select['level2'][$j];
					}
			?>
	  	</select>
	  	<div class="input-group-append">
	   		<input type="text" class="form-control" value="<?=$st['level3'][$i]['name']?>" readonly="">
	  	</div>
	  	<div class="input-group-append">
	   		<input type="date" class="form-control">
	  	</div>
	  	<div class="input-group-append">
	   		<label class="input-group-text">Date End</label>
	  	</div>
	</div>
	<?php } ?>
  </div>
</div>

<!-- Card Level 2 -->
<div class="card" style="margin-top: 5px">
  <div class="card-header">
    KPI LEVEL 4
  </div>
  <div class="card-body">
  	  <?php for($i = 0;$i < $st_lv['level']['level4'];$i++){ ?>
	  <div class="input-group mb-1">
	  	<select class="custom-select" id="inputGroupSelect02" style="max-width: 150px">
	    	<?php
				for($j = 0;$j < $st_lv['level']['level3'];$j++){
					echo $select['level3'][$j];
					}
			?>
	  	</select>
	  	<div class="input-group-append">
	   		<input type="text" class="form-control" value="<?=$st['level4'][$i]['name']?>" readonly="">
	  	</div>
	  	<div class="input-group-append">
	   		<input type="date" class="form-control">
	  	</div>
	  	<div class="input-group-append">
	   		<label class="input-group-text">Date End</label>
	  	</div>
	</div>
	<?php } ?>
  </div>
</div>
<input type="submit" class="btn btn-success" style="margin-top: 20px"><br><br><br>
	
</div>
</body>
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>resources/vendors/bootstrap/dist/js/bootstrap.min.js"></script>