<!DOCTYPE html>
<html>
<head>
	<title>Create Structure</title>
	<link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron">
  <h1 class="display-4"><?=$level['kpi_name']?></h1>
  <hr class="my-4">
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<label>KPI Lv 2</label><br>
			<?php for($i=0;$i<$level['level2'];$i++){?>
				<div class="input-group" style="margin-top: 5px">
  					<div class="input-group-prepend">
  					  <span class="input-group-text" id="">KPI & Bobot</span>
  					</div>
  					<input type="text" class="form-control">
  					<input type="text" class="form-control" id="precentage1<?=$i?>">
  					<div class="input-group-append">
    					<span class="input-group-text">%</span>
  					</div>
				</div>
			<?php }?>
			<button class="btn btn-default btn-sm" onclick="sum_precentage(1)" style="margin-top: 5px">check</button>
		</div>
		<div class="col-md-4">
			<label>KPI Lv 3</label><br>
			<?php for($i=0;$i<$level['level3'];$i++){?>
				<div class="input-group" style="margin-top: 5px">
  					<div class="input-group-prepend">
  					  <span class="input-group-text" id="">KPI & Bobot</span>
  					</div>
  					<input type="text" class="form-control">
  					<input type="text" class="form-control" id="precentage2<?=$i?>">
  					<div class="input-group-append">
    					<span class="input-group-text">%</span>
  					</div>
				</div>
			<?php }?>		
			<button class="btn btn-default btn-sm" onclick="sum_precentage(2)" style="margin-top: 5px">check</button>
		</div>
		<div class="col-md-4">
			<label>KPI Lv 4</label><br>
			<?php for($i=0;$i<$level['level4'];$i++){?>
				<div class="input-group" style="margin-top: 5px">
  					<div class="input-group-prepend">
  					  <span class="input-group-text" id="">KPI & Bobot</span>
  					</div>
  					<input type="text" class="form-control">
  					<input type="text" class="form-control" id="precentage3<?=$i?>">
				</div>
			<?php }?>		
			<button class="btn btn-default btn-sm" onclick="sum_precentage(3)" style="margin-top: 5px">check</button>
			<br>
		</div>
	</div>
	<input type="submit" class="btn btn-success">
</div>
</body>
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
function sum_precentage(param){
	var value = 0;
	if(param == 1){
		<?php
			for($i = 0;$i < $level['level2']; $i++){?>
				value += parseFloat($('#precentage1<?=$i?>').val());
			<?php
		}
		?>
		if(value != 100){
			alert("Nilai Bobot level2 tidak valid");	
		}else{
			alert("Nilai Bobot level2 valid");
		}
	}else if(param == 2){
		<?php
			for($i = 0;$i < $level['level3']; $i++){?>
				value += parseFloat($('#precentage2<?=$i?>').val());
			<?php
		}
		?>
		if(value != 100){
			alert("Nilai Bobot level3 tidak valid");
		}else{
			alert("Nilai Bobot level3 valid");
		}
	}else if(param == 3){
		<?php
			for($i = 0;$i < $level['level4']; $i++){?>
				value += parseFloat($('#precentage3<?=$i?>').val());
			<?php
		}
		?>
		if(value != 100){
			alert("Nilai Bobot level4 tidak valid");	
		}else{
			alert("Nilai Bobot level4 valid");
		}
	}
	
}
</script>