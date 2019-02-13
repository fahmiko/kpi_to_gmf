  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>KPI</h3>

              <p><?=sizeof($tb_kpi_name)?> KPI Registered</p>
            </div>
            <div class="icon">
              <i class="fa fa-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer" id="select-kpi">Select KPI <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$score?><sup style="font-size: 20px"></sup></h3>

              <p>Score KPI</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?=site_url()?>gmf/list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=sizeof($tb_employee)?></h3>

              <p>Employee Registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?=site_url()?>gmf/employee" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?=sizeof($on_progress)?></h3>

              <p>On Progress KPI</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?=site_url()?>gmf/list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      
      <!-- Content -->
      <div class="row">
        <div class="col-md-6">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-pie-chart"></i>

              <h3 class="box-title">Chart KPI</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <?php if($kpi == null) {
                echo "<center>NO DATA</center>";
              }else{ ?>
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
              <?php } ?>
            </div>
            <!-- /.box-body-->
          </div>
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-table"></i>

              <h3 class="box-title">Data KPI</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <?php if($kpi == null) {
                echo "<center>NO DATA</center>";
              }else{ ?>
              <table id="dashboard_1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>KPI</th>
                    <th>PIC</th>
                    <th>Target</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($kpi as $data):?>
                    <tr>
                      <td><?=$data->kpi?></td>
                      <td><?=$data->nama?></td>
                      <td><?=$data->target?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            <?php } ?>
            </div>
          </div>
          <!-- /.box -->
        </div>

        <!-- /.col -->
      </div>
      <!-- /.box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Progress month <?=$month?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if($kpi == null) {
                echo "<center>NO DATA</center>";
              }else{ ?>
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>KPI</th>
                  <th>Bobot</th>
                  <th>Archievment</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                  <?php
                  // print_r($nilai_kpi);
                   foreach ($nilai_kpi as $data) :?>
                    <tr>
                    <td><?=$data->kpi?></td>
                    <td><?=($data->weight)*100?>%</td>
                    <td><?=($data->arcv == null)? "0" : $data->arcv ?>%</td>
                  <?php endforeach ?>
                  </tr>
                </tbody>
              </table>
            <?php }?>
            </div>
            <!-- /.box-body -->
          </div>

      <!-- Content -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal select KPI -->
  <div class="modal modal-default fade" id="modal-select-kpi">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih KPI</h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
          	<div class="input-group-addon">
             	<i class="fa fa-indent"></i>
            </div>
            <div class="input-group input-group-md">
            <form method="get" action="<?=site_url()?>gmf/index">
                <select name="select-kpi" id="select-kpi-option" class="form-control" style="width: 180px">
                	<option hidden="">--Pilih KPI--</option>
                </select>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Go!</button>
                    </span>
              </div>
          </form>
         </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="<?=base_url()?>lte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>