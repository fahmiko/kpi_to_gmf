<script>
window.onload = function () {

var options = {
    theme: "light2",
    title: {
        text: "Chart KPI "
    },
    animationEnabled: true,
    data: [{
        type: "pie",
        startAngle: 40,
        toolTipContent: "<b>{label}</b>: {y}%",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - {y}%",
        dataPoints: <?=json_encode($chart)?>
    }]
};
$("#chartContainer").CanvasJSChart(options);
}
</script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>