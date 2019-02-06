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
                  <th width="40px">Action</th>
                  <th>KPI Name</th>
                  <th>Created By</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($kpi as $data):?>
                    <tr>
                      <td><a href="<?=site_url()?>gmf/delete/<?=urlencode($data->kpi_name)?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a></td>
                      <td><?=$data->kpi_name?></td>
                      <td><?=$data->created_by?></td>
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