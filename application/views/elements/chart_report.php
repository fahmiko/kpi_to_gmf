<?php
$month = intval(date('m'));
$dateObj   = DateTime::createFromFormat('!m', $month)->format('F');
$kpi = $this->session->userdata('dashboard');

$data = array();
?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "<?=$this->session->userdata('dashboard')?>"
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: function(e){
          generate_chart_2nd(e.dataSeries.name);
        }
	},
	data: [
	// Start For Data
	<?php foreach ($report as $row){?>
	{
		type: "column",
		click: onClick,
		name: "<?=$row->kpi?>",
		legendText: "<?=$row->kpi?>",
		showInLegend: true, 
		dataPoints:[
		<?php for($j = 0;$j < $this->session->userdata('month');$j++){?>
			{ label: "<?=DateTime::createFromFormat('!m', ($j+1))->format('F');?>",
			  y: <?=$this->kpi->get_score_chart($this->session->userdata('dashboard'),$row->kpi,($j+1))->arcv?>
			},
		<?php 
			} 

		?>
		]
	},
	<?php } ?>
	// End For Data
	]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}
function onClick(e) {
		generate_chart_2nd(e.dataSeries.name);
	}
}
// Chart Donut Level 2
function generate_chart_2nd(id){
$('#modal-kpi-chart').modal().show();
$('#donutChart2').hide();

var dataChart = [];
$.ajax({
    url: "<?php echo site_url('gmf/json_chart')?>",
    dataType: "JSON",
    type: "POST",
    data:{
        id: id,
    },
    success: function(data){
    	$.each(data, function(key, value){
        	dataChart.push({y: parseInt(value['y']),label: value['label']});
    	});
    	var chart2 = new CanvasJS.Chart("donutChart", {
			animationEnabled: true,
			title:{
				text: id,
				horizontalAlign: "left"
			},
			data: [{
				type: "doughnut",
				startAngle: 60,
				// innerRadius: 60,
				click: onClick2,
				explodeOnClick: false,
				indexLabelFontSize: 15,
				indexLabel: "{label} - #percent%",
				toolTipContent: "<b>{label}:</b> {y} (#percent%)",
				dataPoints: dataChart
			}]
		});
		chart2.render();

		function onClick2(e) {
			generate_chart_3rd(e.dataPoint.label);
		}
     }
 });
}

function generate_chart_3rd(id){
$('#donutChart2').show();
// $('#modal-kpi-chart').modal().hide();
// $('#modal-kpi-chart').modal().show();

var dataChart = [];
$.ajax({
    url: "<?php echo site_url('gmf/json_chart')?>",
    dataType: "JSON",
    type: "POST",
    data:{
        id: id,
    },
    success: function(data){
    	$.each(data, function(key, value){
        	dataChart.push({y: parseInt(value['y']),label: value['label']});
    	});
    	var chart3 = new CanvasJS.Chart("donutChart2", {
			animationEnabled: true,
			title:{
				text: id,
				horizontalAlign: "left"
			},
			data: [{
				type: "doughnut",
				explodeOnClick: false,
				indexLabelPlacement: "outside",        
        		radius: "90%", 
        		innerRadius: "75%",
				dataPoints: dataChart
			}]
		});
		chart3.render();
     }
 });
}

</script>