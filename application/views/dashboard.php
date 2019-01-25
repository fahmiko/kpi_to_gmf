  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="#" title="Dashboard KPI"><i class="icon-home"></i> Home</a></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
            <div class="span6">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-tasks"></i> </span>
                <h5>Data KPI <?=date('Y')?></h5>
              </div>
              <div class="widget-content">
                    <table id="tb_kpi" class="table table-bordered">
                        <thead>
                          <tr>
                              <th>KPI</th>
                              <th>Bobot</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($kpi_all as $data):?>
                          <tr>
                            <td><?=$data->kpi?></td>
                            <td><?=$data->weight?></td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                    </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="span6">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-tasks"></i> </span>
                <h5>Grafik Chark KPI <?=date('Y')?></h5>
              </div>
              <div class="widget-content">
                <div id="piechart" align="center"></div>
                <?php
                  if($kpi == null){
                    echo "<center>NO DATA</center>";
                  }
                ?>
            </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="span12">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-tasks"></i> </span>
               <h5>Data KPI <?=date('Y')?></h5>
              </div>
              <div class="widget-content">
                      
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
    </div>
    </div>
 </div>

<script src="<?=base_url()?>resources/js/loader.js"></script>

<script type="text/javascript">
// Load google charts

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  <?php foreach ($kpi as $data) {?>
  ['<?=$data->kpi?>',parseFloat(<?=(float)$data->weight?>)],
  <?php } ?>
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'KPI <?=date('Y')?>',
                 'legend':'left',
                 'is3D':true,
                 'width':550, 
                 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
  google.visualization.events.addListener(chart, 'select', selectHandler);
}
$(document).ready(function () {
    $('#tb_kpi').DataTable();
} );
</script>
</body>
</html>
