<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="<?=base_url()?>resources/vendors/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<h1 align = center >Welcome to KPI </h1>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <?php echo form_open('welcome/index')?>
    <select id="kpi_name" class="form-control" name="kpi_name">
      <option hidden="" selected="">Pilih KPI</option>
      <?php
        foreach ($kpi_name as $data) {
          echo "<option value='$data->kpi_name'>$data->kpi_name</option>";
        }
      ?>
    </select><br>
    <input type="submit" value="tampilkan" class="btn btn-success">
    <?php echo form_close();?>
    </div>
    <div class="col-md-4" align="center">
        <div id="piechart" align="center"></div>
        <?=form_open('welcome/show')?>
          <input type="hidden" id="url" name="kpi_name" value="<?=$kpi_index?>">
          <input type="submit" class="btn btn-primary" value="Struktur">
        <?=form_close()?>
    </div>
    <div class="col-md-4">
        
    </div>
  </div>
</div>
<a href="<?=site_url()?>welcome/create" align="center">Buat KPI</a>
<a href="<?=site_url()?>">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
  var options = {'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
  google.visualization.events.addListener(chart, 'select', selectHandler);
}

function selectHandler(e) {
    // location.href = "<?=site_url()?>welcome/show/"+$('#url').val();
    // alert("<?=$kpi_name[0]->kpi_name?>");
}
</script>
</body>
</html>
