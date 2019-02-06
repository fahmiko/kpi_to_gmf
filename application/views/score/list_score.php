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
            		<div class="col-md-2">
            			<div class="input-group-prepend">
	  						  <span class="input-group-text" id="">Cari KPI</span>
	  					</div>
            			<div class="input-group input-group-sm">
								<select class="form-control" name="kpi" style="width: 200%">
									<?php 
									if($kpi_name == null){
										echo "<option>NO DATA</option>";
									}
									foreach ($kpi_name as $data): ?>
										<option value="<?=$data->kpi_name?>"><?=$data->kpi_name?></option>
									<?php endforeach; ?>
								</select>
						</div>
            		</div>
            		<div class="col-md-3">
            			<div class="input-group-prepend">
	  						  <span class="input-group-text" id="">Cari KPI</span>
	  					</div>
            			<div class="input-group input-group-sm">
                			<select class="form-control" name="month">
									<?php 
										for($i = 1;$i<=12;$i++){
											$dateObj   = DateTime::createFromFormat('!m', intval($i));?>
											<option value="<?=$i?>" <?=(intval(date('m')) == $i) ? "selected" : ""?>><?=$dateObj->format('F')?></option>
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
			<table id="dt_table" class="table table-bordered">
				<thead>
				<tr>
					<?php
					if($skpi_name->status == "on progress"){
						echo '<th align="center" style="text-align: center;width:30px">Action</th>';
					}
					?>
					<th align="center" style="text-align: center;">KPI</th>
					<th align="center" style="text-align: center;">Bobot</th>
					<th align="center" style="text-align: center;">Target</th>
					<th align="center" style="text-align: center;">Nilai</th>
					<th align="center" style="text-align: center;">Skor</th>
				</tr>
				</thead>
				<tbody>
			<?php foreach ($ikpi_all as $data): ?>
				<tr>
					<?php 
					if($skpi_name->status == "on progress"){
						echo "<td align='center'>";
						foreach ($ikpi as $row):
						if($data->kpi == $row->kpi){?>
							<a href="#" onclick="generateModal(<?=$data->kpi_id?>)" data-target="#manageModal" data-toggle="modal"  class="btn btn-primary btn-sm" style="color: white;"><span class="fa fa-pencil-square-o"></span></a><?php 
						}
					endforeach;
					echo "</td>";
					}?>
					<td><?=$data->kpi?></td>
					<td><?=($data->weight)*100?></td>
					<td><?=$data->target?></td>
					<td><?=($data->skor/$data->weight)?></td>
					<td><?=$data->skor?></td>
				</tr>
			<?php endforeach; ?>
				</tbody>
			</table>
			<hr>
				<label style="margin-left: 20px">SKOR KPI <?php echo $score_kpi['total']?></label>
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
    <div class="modal-content">
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
				<input type="text" class="form-control" name="kpi_name" id="kpi_name"  readonly="">
			</div>
			<div class="form-group">
				<label>KPI</label>
				<input type="text" class="form-control" name="kpi" id="kpi" readonly="">
			</div>
			<div class="form-group">
				<label>Bobot</label>
				<input type="text" class="form-control" name="weight" id="bobot" readonly="">
			</div>
			<div class="form-group">
				<label>Actual</label>
				<input type="number" class="form-control" name="nilai" id="nilai" placeholder="Nilai Actual" oninput="generateScore()" required="">
			</div>
			<div class="form-group">
				<label>Skor</label>
				<input type="text" class="form-control" name="skor" id="skor" readonly="">
				<input type="hidden" id="target">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		<?=form_close()?>
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
        	document.getElementById('bobot').value = data.target;
        	document.getElementById('target').value = (data.target/100);
        	}
    	});
	}

	function generateScore(){
		var bobot = $('#target').val();
		var nilai = $('#nilai').val();
		var skor;
		skor = nilai*bobot;
		document.getElementById('skor').value = skor;

	}
</script>