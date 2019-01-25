<!DOCTYPE html>
<html>
<head>
	<title>KPI Isi Skor</title>
	<link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?=form_open('dashboard/index')?>
<div class="container" style="margin-top: 30px">
	<div class="input-group">
	  <div class="input-group-prepend">
	    <span class="input-group-text" id="">Cari KPI</span>
	  </div>
		<select class="form-control" name="kpi">
			<?php foreach ($kpi_name as $data): ?>
				<option value="<?=$data->kpi_name?>"><?=$data->kpi_name?></option>
			<?php endforeach; ?>
		</select>
	  	<select class="form-control" name="month">
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">July</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
    	</select>
    	 <div class="input-group-prepend">
    		<button type="submit" name="submit" class="btn btn-outline-secondary">Cari</button>
  		</div>
	</div>
<?=form_close()?>
</div>

<div class="container" style="margin-top: 40px">
	<?php if($ikpi == null){
		echo "<center>NO DATA</center>";
	}else{?>
	<table class="table table-bordered">
		<tr>
			<td align="center" rowspan="2">Action</td>
			<td align="center" rowspan="2">KPI</td>
			<td align="center" rowspan="2">Bobot</td>
			<td align="center" colspan="2">Hasil</td>
		</tr>
		<tr>
			<td>Nilai</td>
			<td>Skor</td>
		</tr>

		<?php foreach ($ikpi_all as $data): ?>
		<tr>
			<td align="center" style="width: 30px">
			<?php foreach ($ikpi as $row):
				if($data->kpi == $row->kpi){?>
					<a href="#" onclick="generateModal(<?=$data->kpi_id?>)" data-target="#manageModal" data-toggle="modal"  class="btn btn-primary btn-sm" style="color: white;"><span class="fa fa-pencil-square-o"></span></a><?php 
				}endforeach; ?>
			</td>
			<td><?=$data->kpi?></td>
			<td><?=($data->weight)*100?>%</td>
			<td><?=($data->skor/$data->weight)?></td>
			<td><?=$data->skor?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<div class="container">
		<label>SKOR KPI <?php 
							echo $score_kpi['total'];
						?>
		</label>
	</div>
	<?php } ?>
</div>

<!-- Modal Manage structure -->
<div class="modal fade bd-example-modal-lg" id="manageModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Struktur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container" style="margin-top: 30px">
		<?=form_open('dashboard/insert')?>
			<input type="hidden" name="month" value="<?=@$month?>">
			<fieldset class="form-group">
				<label>KPI Name</label>
				<input type="text" class="form-control" name="kpi_name" id="kpi_name"  readonly="">
			</fieldset>
			<fieldset class="form-group">
				<label>KPI</label>
				<input type="text" class="form-control" name="kpi" id="kpi" readonly="">
			</fieldset>
			<fieldset class="form-group">
				<label>Bobot</label>
				<input type="text" class="form-control" name="weight" id="bobot" readonly="">
			</fieldset>
			<fieldset class="form-group">
				<label>Penilaian</label>
				<input type="number" class="form-control" name="nilai" id="nilai" placeholder="Nilai" oninput="generateScore()" required="">
			</fieldset>
			<fieldset class="form-group">
				<label>Skor</label>
				<input type="text" class="form-control" name="skor" id="skor" readonly="">
			</fieldset>
			<button type="submit" class="btn btn-primary">Submit</button>
		<?=form_close()?>
		</div>
      </div>
  </div>
</div>
</div>



</body>
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
	function generateModal(id){
    $.ajax({
        url: "<?php echo site_url('dashboard/json_kpi/') ?>"+id,
        dataType: "JSON",
        success: function(data){
        	document.getElementById('kpi_name').value = data.kpi_name;
        	document.getElementById('kpi').value = data.kpi;
        	document.getElementById('bobot').value = data.weight;
        	}
    	});
	}

	function generateScore(){
		var bobot = $('#bobot').val();
		var nilai = $('#nilai').val();
		var skor;
		skor = nilai*bobot;
		document.getElementById('skor').value = skor;

	}
</script>