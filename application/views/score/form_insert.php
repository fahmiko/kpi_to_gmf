<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top: 30px">
<?=form_open('dashboard/insert')?>
	<input type="hidden" name="month" value="<?=$_GET['month'];?>">
	<fieldset class="form-group">
		<label>KPI Name</label>
		<input type="text" class="form-control" name="kpi_name" value="<?=$kpi->kpi_name?>" readonly="">
	</fieldset>
	<fieldset class="form-group">
		<label>KPI</label>
		<input type="text" class="form-control" name="kpi" value="<?=$kpi->kpi?>" readonly="">
	</fieldset>
	<fieldset class="form-group">
		<label>Bobot</label>
		<input type="text" class="form-control" name="weight" id="bobot" value="<?=$kpi->weight?>" readonly="">
	</fieldset>
	<fieldset class="form-group">
		<label>Penilaian</label>
		<input type="number" class="form-control" name="nilai" id="nilai" placeholder="Nilai" oninput="generateScore()">
	</fieldset>
	<fieldset class="form-group">
		<label>Skor</label>
		<input type="text" class="form-control" name="skor" id="skor" readonly="">
	</fieldset>
	<button type="submit" class="btn btn-primary">Submit</button>
<?=form_close()?>
</div>

</body>
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function generateScore(){
		var bobot = $('#bobot').val();
		var nilai = $('#nilai').val();
		var skor;
		skor = nilai*bobot;
		document.getElementById('skor').value = skor;

	}
</script>