<!DOCTYPE html>
<html lang="en-US">
<body>

<h1 align = center >Welcome to KPI </h1>

<div id="piechart" align="center"></div>
<a href="<?=site_url()?>welcome/create" align="center">Buat KPI</a>

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
  var options = {'title':'KPI 2019', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
  google.visualization.events.addListener(chart, 'select', selectHandler);
}

function selectHandler(e) {
    location.href = "#";
}
</script>
</body>
</html>
