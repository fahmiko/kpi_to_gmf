<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>report_<?=strtolower(str_replace('+', '_', urlencode($this->session->userdata('dashboard'))))?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>lte/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    th{
      background-color: #666666;
      color: white;
      text-align: center;
      vertical-align: middle;
      font-size: 15px;
    }
    td{
      text-align: center;
    }
  </style>
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
          <div class="pull-left"><h3>Kerja Dinas</h2>
            <h4 style="color: gray;"> Pencapaian <?=$this->session->userdata('dashboard')?> & YTD <?=DateTime::createFromFormat('!m', intval(date('m')))->format('F')?></h4>
          </div>
          <div class="pull-right"><img width="300px" src="<?=base_url()?>resources/img/gmf_logo.jpg"></div>
      </div>
      <!-- /.col -->
    </div><br>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-bordered">
          <tr>
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
                  <td align="center"><?=$data->kpi?></td>
                  <td><?=$data->target?>%</td>
                  <td><?=$data->actual?>%</td>
                  <td><?=$data->target?>%</td>
                  <td><?=number_format($report_all[$row]->avg,1)?>%</td>
                            </tr>
                            <?php
                            $no++;
                          }
                        }
                      ?>
          </table>
      </div>
      <!-- /.col -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
