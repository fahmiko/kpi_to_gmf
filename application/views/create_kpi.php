<!DOCTYPE html>
<html>
<head>
	<title>Buat Struktur KPI</title>
	<link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<?=form_open('welcome/create_structure')?>
		<label>Buat KPI</label>
		<input type="text" class="form-control" name="kpi_name" placeholder="Nama KPI"><br>
		<input type="text" class="form-control" id="lv2" name="level2" placeholder="masukan jumlah lv2"><br>
		<input type="text" class="form-control" id="lv3" name="level3" placeholder="masukan jumlah lv3"><br>
		<input type="text" class="form-control" id="lv4" name="level4" placeholder="masukan jumlah lv4"><br>
		<input type="submit" class="btn btn-success">
		<?=form_close()?>
	</div>
</body>
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>resources/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=base_url()?>resources/vendors/bootstrap/dist/js/bootstrap.min.js"></script>