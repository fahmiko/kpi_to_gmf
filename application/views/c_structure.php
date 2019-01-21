<?php
$structure = $this->session->userdata('structure');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Structure</title>
	<link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron">
  <h1 class="display-4"><?=$structure['kpi_name']?></h1>
  <hr class="my-4">
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
</div>
<div class="container-fluid">
<input type="hidden" name="kpi_name" value="<?=$structure['kpi_name']?>">
<?=form_open('welcome/test')?>
	<div class="row">
		<div class="col-md-4">
			<label>KPI Lv 2</label><br>
			<?php for($i=0;$i<$structure['level2'];$i++){?>
				<div class="input-group" style="margin-top: 5px">
  					<div class="input-group-prepend">
  					  <span class="input-group-text" id="">KPI & Bobot</span>
  					</div>
  					<input type="text" class="form-control" id="kpi_lv2_<?=$i?>" name="kpi_lv2_<?=$i?>">
  					<input type="text" class="form-control" id="precentage1<?=$i?>" name="weight_lv2_<?=$i?>">
  					<div class="input-group-append">
    					<span class="input-group-text">%</span>
  					</div>
				</div>
			<?php }?>
		</div>
		<div class="col-md-4">
			<label>KPI Lv 3</label><br>
			<?php for($i=0;$i<$structure['level3'];$i++){?>
				<div class="input-group" style="margin-top: 5px">
  					<div class="input-group-prepend">
  					  <span class="input-group-text" id="">KPI & Bobot</span>
  					</div>
  					<input type="text" class="form-control" id="kpi_lv3_<?=$i?>" name="kpi_lv3_<?=$i?>">
  					<input type="text" class="form-control" id="precentage2<?=$i?>" name="weight_lv3_<?=$i?>">
  					<div class="input-group-append">
    					<span class="input-group-text">%</span>
  					</div>
				</div>
			<?php }?>		
		</div>
		<div class="col-md-4">
			<label>KPI Lv 4</label><br>
			<?php for($i=0;$i<$structure['level4'];$i++){?>
				<div class="input-group" style="margin-top: 5px">
  					<div class="input-group-prepend">
  					  <span class="input-group-text" id="">KPI & Bobot</span>
  					</div>
  					<input type="text" class="form-control" id="kpi_lv4_<?=$i?>" name="kpi_lv4_<?=$i?>">
  					<input type="text" class="form-control" id="precentage4<?=$i?>" name="weight_lv4_<?=$i?>">
  					<div class="input-group-append">
    					<span class="input-group-text">%</span>
  					</div>
				</div>
			<?php }?>		
			<br>
		</div>
	</div>
	<br>
	<a data-toggle="modal" data-target="#manageModal" class="btn btn-success" onclick="generate()" style="color: white;">Manage</a>
</div>
</body>
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
      	<div class="row">
      		<div class="col-md-6">
      			<div class="card">
				  <div class="card-header">
				    <!-- Header -->
				    Informasi KPI
				    <!-- End Header -->
				  </div>
				  <div class="card-body">
				    <!-- Body -->
				    <div class="input-group mb-1">
  						<div class="input-group-prepend">
    						<span class="input-group-text" id="basic-addon1" style="width: 100px">Nama KPI</span>
  						</div>
  						<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?=$structure['kpi_name']?>">
					</div>
					<div class="input-group mb-1">
  						<div class="input-group-prepend">
    						<span class="input-group-text" id="basic-addon1" style="width: 100px">Tanggal</span>
  						</div>
  						<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
					</div>
				    <!-- End Body -->
					</div>
      			</div>
      		</div>
      		<div class="col-md-6">
      			<div class="card">
				  <div class="card-header">
				    <!-- Header -->
				    KPI Level 2
				    <!-- End Header -->
				  </div>
				  <div class="card-body">
				    <!-- Body -->
				    <?php for($i = 0;$i < $structure['level2'];$i++){ ?>
				    <div class="input-group mb-1">
  						<div class="input-group-prepend">
    						<span class="input-group-text" id="basic-addon1" style="width: 50px">KPI</span>
  						</div>
  						<input type="text" class="form-control" readonly="" id="svalue_lv2_<?=$i?>">
					</div>
					<?php }?>
				    <!-- End Body -->
					</div>
      			</div>
      		</div>
      	</div>
      	<br>
      	<div class="row">
      		<div class="col-md-6">
      			<div class="card">
				  <div class="card-header">
				    <!-- Header -->
				    KPI Level 3
				    <!-- End Header -->
				  </div>
				  <div class="card-body">
				    <!-- Body -->
				    <?php for($i = 0;$i < $structure['level3'];$i++){ ?>
					  <div class="input-group mb-1">
					  	<select class="form-control" id="parent_lv_3_<?=$i?>" name="parent_lv3_<?=$i?>" style="max-width: 150px">
					  	</select>
					  	<div class="input-group-append">
					   		<input type="text" class="form-control" readonly="" id="svalue_lv3_<?=$i?>">
					  	</div>
					</div>
					<?php } ?>
				    <!-- End Body -->
					</div>
      			</div>
      		</div>
      		<div class="col-md-6">
      			<div class="card">
				  <div class="card-header">
				    <!-- Header -->
				    KPI Level 4
				    <!-- End Header -->
				  </div>
				  <div class="card-body">
				    <!-- Body -->
				    <?php for($i = 0;$i < $structure['level4'];$i++){ ?>
					  <div class="input-group mb-1">
					  	<select class="form-control" id="parent_lv_4_<?=$i?>" name="parent_lv4_<?=$i?>" style="max-width: 150px">
					  	</select>
					  	<div class="input-group-append">
					   		<input type="text" class="form-control" readonly="" id="svalue_lv4_<?=$i?>">
					  	</div>
					</div>
					<?php } ?>
				    <!-- End Body -->
					</div>
      			</div>
      		</div>
      	</div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save changes">
      </div>
    </div>
  </div>
</div>
<?=form_close()?>
<!-- End Modal structure -->
</html>
<script src="<?=base_url()?>resources/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
function generate(){
	//Lv 2 Sructure KPI
	<?php
		for($i = 0; $i < $structure['level2']; $i++){?>
			document.getElementById('svalue_lv2_<?=$i?>').value =  $('#kpi_lv2_<?=$i?>').val();
		<?php }
	?>
	// Clear Option
	<?php
		for($i = 3; $i <=4; $i++){
			$lv = "level".$i;
			for($j = 0; $j < $structure[$lv];$j++){?>
				document.getElementById("parent_lv_<?=$i?>_<?=$j?>").options.length=0;<?php
			}
		}

	// Lv 3 Structure
		for($i = 0; $i < $structure['level2']; $i++){?>
			document.getElementById('svalue_lv3_<?=$i?>').value =  $('#kpi_lv3_<?=$i?>').val();<?php
			for($j = 0; $j < $structure['level2']; $j++){?>
				$('#parent_lv_3_<?=$i?>').append(new Option($('#kpi_lv2_<?=$j?>').val(), $('#kpi_lv2_<?=$j?>').val(), true));
			<?php }
		}
	?>
	// Lv 4 structure
	<?php
		for($i = 0; $i < $structure['level3']; $i++){?>
			document.getElementById('svalue_lv4_<?=$i?>').value =  $('#kpi_lv4_<?=$i?>').val();<?php
			for($j = 0; $j < $structure['level3']; $j++){?>
				$('#parent_lv_4_<?=$i?>').append(new Option($('#kpi_lv3_<?=$j?>').val(), $('#kpi_lv3_<?=$j?>').val(), true));
			<?php }
		}
	?>
}
</script>