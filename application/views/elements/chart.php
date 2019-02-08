<script>
window.onload = function () {

console.log(<?=json_encode($chart)?>);
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