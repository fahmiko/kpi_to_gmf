<?php
$login = $this->session->userdata('login');
function get_color($actual, $target){
	if($actual >= $target){
		return "#2ecc71";
	}else if(($actual <= $target) && ($actual  > 0)){
		return "#fdcb6e";
	}else{
		return "#d63031";
	}
}
?>
<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
<style type="text/css">
td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_open.png')       no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
}

td.details-control1 {
    background: url('http://www.datatables.net/examples/resources/details_open.png')       no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control1 {
    background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
}

.well {
    background: none;
}

.table-hover > tbody > tr:hover > td,
.table-hover > tbody > tr:hover > th {
    background-color: #CFF5FF;
}


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Score
      <small>List Score</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Skor</li>
    </ol>
  </section>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Score</h3>
            </div>
            <!-- /.box-header -->
            <?=form_open('gmf/score')?>
            <div class="box-body">
            	<div class="row">
            		<div class="col-md-2" hidden="">
            			<div class="input-group-prepend">
	  						  <span class="input-group-text" id="">Cari KPI</span>
	  					</div>
            			<div class="input-group input-group-sm">
								<select class="form-control" name="kpi" style="width: 100%">
									<?php 
									if($kpi_name == null){
										echo "<option>NO DATA</option>";
									}
									foreach ($kpi_name as $data): ?>
										<option value="<?=$data->kpi_name?>" 
											<?php
												if(@$ps_kpi){
													if($data->kpi_name == @$ps_kpi){
														echo "selected";
													}	
												}
												else if($data->kpi_name == $this->session->userdata('dashboard')){
													echo "selected";
												}
											?>
											><?=$data->kpi_name?></option>
									<?php endforeach; ?>
								</select>
						</div>
            		</div>
            		<div class="col-md-3">
            			<div class="input-group-prepend">
	  						  <span class="input-group-text" id="">Bulan</span>
	  					</div>
            			<div class="input-group input-group-sm">
                			<select class="form-control" name="month">
									<?php 
										for($i = 1;$i<=12;$i++){
											$dateObj   = DateTime::createFromFormat('!m', intval($i));?>
											<option value="<?=$i?>"
												<?php
													if($this->session->userdata('month') == $i){
														echo "selected";
													}
												?>
												><?=$dateObj->format('F')?></option>
										<?php }
									?>
							</select>
                    		<span class="input-group-btn">
                      			<button type="submit" class="btn btn-info btn-flat">Go!</button>
                    		</span>
              			</div>
            		</div>
            	</div>

            <br>
            <?php echo form_close();
            if($ikpi == null){
				echo "<center>NO DATA</center>";
			}else{?>
			<div class="btn-group-vertical" style="margin-bottom: 20px">
				<button type="button" onclick="generateModal()" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Input Score</button>
			</div>
			<div class="table table-responsive" style="max-width: 95%;margin: 10px">
			<table id="dt_score" class="pure table">
				<thead>
				<tr>
					<?php
					// if($skpi_name->status == "on progress"){
					// 	echo '<th align="center" style="text-align: center;width:30px">Action</th>';
					// }
					?>
					<th align="center" style="text-align: center;"></th>
					<th align="center" style="text-align: center;">KPI</th>
					<th align="center" style="text-align: center;">Bobot</th>
					<th align="center" style="text-align: center;">Target</th>
					<th align="center" style="text-align: center;">Actual</th>
					<th align="center" style="text-align: center;">Archievment</th>
				</tr>
				</thead>

			<?php
			/* Function using php
			<tbody>
			 foreach ($ikpi_all as $data): ?>
				<tr>
					<?php 
					if($skpi_name->status == "on progress"){?>
						<td align='center' style="background-color: <?=get_color($data->skor, $data->target)?>;color: white">
						<?php foreach ($ikpi as $row):
							 // && ($data->pic == $login['id_pegawai'])
						if(($data->kpi == $row->kpi)&& ($data->pic == $login['id_pegawai'])){?>
							<a href="#" onclick="generateModal(<?=$data->kpi_id?>)" data-target="#manageModal" data-toggle="modal"><span class="fa fa-pencil-square-o" style="color: white"></span></a><?php 
						}
					endforeach;
					echo "</td>";
					}?>
					<td style="background-color: <?=get_color($data->skor, $data->target)?>;color: white"><?=$data->kpi?></td>
					<td style="background-color: <?=get_color($data->skor, $data->target)?>;color: white"><?=($data->weight)*100?></td>
					<td style="background-color: <?=get_color($data->skor, $data->target)?>;color: white"><?=$data->target?></td>
					<td style="background-color: <?=get_color($data->skor, $data->target)?>;color: white"><?=$data->skor?></td>
					<td style="background-color: <?=get_color($data->skor, $data->target)?>;color: white"><?=($data->target*$data->skor)/100?></td>
				</tr>
			<?php endforeach; ?>
				</tbody>
				*/?>
			</table>
			</div>
			<hr>
			<?php } ?>
		</div>
        </div>

  		</div>
  	</div>
  </section>
</div>

<!-- Modal Manage structure -->
<div class="modal fade bd-example-modal-lg" id="manageModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 5px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Insert Score</h4>
      </div>
      <div class="modal-body">
		<?=form_open('gmf/score')?>
			<input type="hidden" name="month" value="<?=@$month?>">
			<div class="form-group">
				<label>KPI Name</label>
				<input class="form-control" type="text" name="kpi_name" value="<?=$this->session->userdata('dashboard')?>" readonly>
			</div>
			<div class="form-group">
				<label>KPI</label>
				<select name="kpi" id="kpi" class="form-control">
					<option hidden="">Select One</option>
					<?php
						foreach ($ikpi as $data) {
							if($data->pic == $login['id_pegawai']){
								echo "<option value='$data->kpi_id'>$data->kpi</option>";
							}
							?>
						<?php }
					?>
				</select>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Weight</label>
						<input type="text" class="form-control" name="weight" id="weight" readonly="">
					</div>
					<div class="form-group">
						<label>Target</label>
						<input type="text" class="form-control" name="target" id="target" readonly="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Remarks</label>
						<textarea class="form-control" style="height: 100px;" disabled="" id="remarks"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Actual</label>
						<input type="text" class="form-control" name="actual" id="actual" placeholder="Nilai Actual" required="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Archievment</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" name="arcv" id="arcv" readonly="">
							<input type="hidden" name="pre_act" id="pre_act">
							<input type="hidden" id="target">
							<span class="input-group-btn">
            		          	<button value="%" class="btn btn-default btn-xs">%</button>
            		        </span>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" id="formula" value="<?=$this->session->userdata('formula')?>">
			<button type="submit" class="btn btn-primary">Submit</button>
		<?=form_close()?>
      </div>
  </div>
</div>
</div>



</body>
</html>
<!-- jQuery 3 -->
<script src="<?=base_url()?>lte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<script type="text/javascript">
function generateModal(){
    $('#manageModal').modal().show();
}	

$(document).ready(function(){
	$("#kpi").change(function() {
		var id = $('#kpi').val();
  		$.ajax({
    		url: "<?php echo site_url('gmf/json_kpi/') ?>"+id,
        	dataType: "JSON",
        	success: function(data){
        		$('#weight').val(data.weight);
        		$('#target').val(data.target);
        		$('#remarks').val(data.remarks);
    		}
    	});
	});
	$("#actual").on('input', function(){
		var actual = $('#actual').val();
		var weight = $('#weight').val();
		var target = $('#target').val();
		var month = <?=$this->session->userdata('month')?>;
		var arcv;
		var formula = $('#formula').val();

		if(formula == 'arcv'){
			if(month < 2){
				arcv = actual/target;
				$('#arcv').val(arcv*100);
			}else{
				$.ajax({
    				url: "<?php echo site_url('gmf/json_formula_avg')?>",
    				type: "POST",
    				dataType: "JSON",
    				data:{
        				kpi: $('#kpi').val(),
    				},success: function(data){
    					var pre_act = parseInt(data.actual,10);
    					arcv = (parseInt(actual,10) + pre_act);
    					$('#pre_act').val(pre_act);
    					$('#arcv').val((arcv/target)*100);
    				}
    			});
			}
		}else{
			arcv = actual/target;
			$('#arcv').val(arcv*100);
		}
	});
});
</script>