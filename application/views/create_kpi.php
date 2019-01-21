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
        <select class="form-control">
            <option selected="selected" hidden="">Bulan Selesai</option>
            <option>Januari</option>
            <option>Februari</option>
            <option>Maret</option>
            <option>April</option>
            <option>Mei</option>
            <option>Juni</option>
            <option>July</option>
            <option>Agustus</option>
            <option>Oktober</option>
            <option>November</option>
            <option>Desember</option>
        </select><br>
		<input type="text" class="form-control" id="lv2" name="level2" placeholder="masukan jumlah lv2"><br>
		<input type="text" class="form-control" id="lv3" name="level3" placeholder="masukan jumlah lv3"><br>
		<input type="text" class="form-control" id="lv4" name="level4" placeholder="masukan jumlah lv4"><br>
		<a onclick="show(2)" class="btn btn-primary">Buat Level 2</a>
		<a onclick="show(3)" class="btn btn-primary">Buat Level 3</a>
		<a onclick="show(4)" class="btn btn-primary">Buat Level 4</a>
		<input type="submit" class="btn btn-success">
		<?=form_close()?>
	</div>
</body>
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>resources/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=base_url()?>resources/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    	$('#lv2').hide();
    	$('#lv3').hide();
    	$('#lv4').hide();
    });

    function show(num){
    	var id = parseInt(num);
    	switch(id){
    		case 2:
    		$('#lv2').show();
    		break;
    		case 3:
    		$('#lv3').show();
    		break;
    		case 4:
    		$('#lv4').show();
    		break;
    	}
    }
</script>