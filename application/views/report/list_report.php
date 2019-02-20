<!-- <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous"> -->
<!-- <link href="<?=base_url()?>resources/assets/css/style_table.css" rel="stylesheet"> -->

<!-- Content Wrapper. Contains page content -->
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
                <a href="<?=site_url()?>gmf/print_report" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Print</a>
                  <br><br>
                  <div class="responsive-table">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th rowspan="2" width="20%" style="vertical-align: middle;text-align: center;">KPI</th>
                      <th rowspan="2" width="10%" style="vertical-align: middle;text-align: center;">Target</th>
                      <th colspan="<?=($this->session->userdata('month'))?>" style="text-align: center">Actual</th>
                      <th rowspan="2" width="10%" style="vertical-align: middle; text-align: center">Archievment<br>YTD</th>
                    </tr>
                    <tr>
                      <?php for($i = 1; $i <= $this->session->userdata('month'); $i++){?>
                        <th width="10%"><?=DateTime::createFromFormat('!m', $i)->format('F')?></th>
                      <?php }?>
                    </tr>
                    <?php
                    // print_r($report_all);
                    $no = 1;
                    foreach ($table as $data) {
                      echo "<tr><td style='text-align:left'>$data->kpi</td>";
                      echo "<td>$data->target</td>";
                    for($i = 1; $i <= $this->session->userdata('month'); $i++){
                      foreach ($report[$i] as $row) {
                          if($row->kpi == $data->kpi){?>
                            <td><?=$row->actual?></td>
                          <?php }
                        }
                      }
                      foreach ($report_ytd as $row2) {
                        if($row2->kpi == $data->kpi){
                          if($this->session->userdata('formula') == 'avg'){
                              echo "<td>$row2->avg %</td>";
                          }else{
                            echo "<td>$row2->arcv %</td>";
                          }
                        }
                      }
                    }
                    echo "</tr>";
                    ?>
                </table>
              </div>
              <br><br>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>