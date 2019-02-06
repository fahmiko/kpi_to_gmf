<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      KPI's
      <small>List KPI</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Employee</li>
    </ol>
  </section>
  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data KPI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt_employee" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="60px">Action</th>
                  <th>KPI Name</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th>Nilai</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($kpi as $data):?>
                    <tr>
                      <td align="center">
                        <a href="<?=site_url()?>gmf/update_kpi/<?=urlencode($data->kpi_name)?>" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                        <a href="<?=site_url()?>gmf/delete/<?=urlencode($data->kpi_name)?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></td>
                      <td><?=$data->kpi_name?></td>
                      <td><?=$data->created_by?></td>
                      <td>
                      <?php echo($data->status == 'finish')? "<span class='label label-success'>finish</span>":"<span class='label label-primary'>on progress</span>";?>
                      </td>
                      <td>
                        <?php
                          $nilai = 0;
                          for($i = 1; $i<=intval(date('m'));$i++){
                            $score = $this->kpi->get_score_kpi_name($i,$data->kpi_name);
                            $nilai += $score['total'];
                          }
                          echo ($nilai/intval(date('m')));
                        ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
  </section>
</div>