<!DOCTYPE html>
<html>
<head>
	<title>Create Structure</title>
	<link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron">
  <h1 class="display-4">KPI <?=$level['kpi_name']?></h1>
  <hr class="my-4">
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
</div>
<div class="container">
	<?=form_open('welcome/test')?>
	<div class="row">
		<div class="col-md-4">
			<label>KPI Lv 2</label><br>
			<?php for($i=1;$i<=$level['level2'];$i++){?>
				<input style="margin-top: 2px" id="lv2<?=$i?>" type="text" name="lv2<?=$i?>"><br>
			<?php }?>		
		</div>
		<div class="col-md-4">
			<label>KPI Lv 3</label><br>
			<select name="" id="pilihan" onclick="select_level()">
				<option selected="selected" hidden="">Pilih Level 2</option>
			</select>
			<?php for($i=1;$i<=$level['level3'];$i++){?>
				<input style="margin-top: 2px" type="text" name="lv3<?php $i?>"><br>
			<?php }?>		
		</div>
		<div class="col-md-4">
			<label>KPI Lv 4</label><br>
			<?php for($i=1;$i<=$level['level4'];$i++){?>
				<input style="margin-top: 2px" type="text" name="lv4<?php $i?>"><br>
			<?php }?>		
			<input type="submit">
		</div>
		<?=form_close()?>
	</div>
</div>
</body>
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	function select_level(){
		var select = document.getElementById("pilihan");
		select.options.length = 0;
		<?php for($i=1;$i<=$level['level2'];$i++){?>
			var nilai = $('#lv2<?=$i?>');
			select.options[select.options.length] = new Option(nilai.val(), '0', false, false);
		<?php } ?>
	}
</script>