<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Report
      <small>List Report</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Report</li>
    </ol>
  </section>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Report</h3>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>