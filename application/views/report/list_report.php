<style type="text/css">
  th{
    color: white;
    background-color: gray;
    text-align: center;
    vertical-align: middle;
  }
  td{
    text-align: center;
  }
</style>
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
            <div class="box-body" style="margin:10px">
              <!-- Table Report -->
              <?php if($report == null){
                  echo "<center>NO DATA, SELECT KPI</center>";
                }else{
                ?>
                <a href="<?=site_url()?>gmf/print_report" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Print</a>
                  <br><br>
                  <table class="table table-bordered table-stripped table-responsive">
                    <tr>
                      <th rowspan="2" style="vertical-align: middle;">NO</th>
                      <th rowspan="2" style="vertical-align: middle;">KPI</th>
                      <th colspan="2"><?=DateTime::createFromFormat('!m', intval(date('m')))->format('F')?></th>
                      <th colspan="2">YTD <?=DateTime::createFromFormat('!m', intval(date('m')))->format('F')?></th>
                    </tr>
                    <tr>
                      <th width="15%">Target</th>
                      <th width="15%">Act</th>
                      <th width="15%">Target</th>
                      <th width="15%">Act</th>
                    </tr>
                      <?php
                        $no = 1;
                        $row = 0;
                        foreach ($report as $data) {
                          if($data->month == intval(date('m'))){?>
                            <tr>
                              <td><?=$no?></td>
                              <td style="text-align: left;"><?=$data->kpi?></td>
                              <td><?=$data->target?>%</td>
                              <td style="background-color: <?=($data->arcv >= $data->target) ? '#00FF00' : '#CC1559'?>"><?=$data->arcv?>%</td>
                              <td><?=$data->target?>%</td>
                              <td style="background-color: <?=($report_all[$row]->avg >= $data->target) ? '#00FF00' : '#CC1559'?>"><?=number_format($report_all[$row]->avg,1)?></td>
                            </tr>
                            <?php
                            $no++;
                          }
                        }
                      ?>
                </table>
                <?php }?>
                <br><br>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>