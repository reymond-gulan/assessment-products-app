@if(isset($dataPoints) > 0)
<div class="row">
    <div class="container">
        <div class="row">
            <div class="container border p-5 shadow-lg rounded rounded-5 bg-white">
                <div id="column" style="height: 100vh; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function () {
    var chart = new CanvasJS.Chart("column", {
        title:{
            text: "Products",
            fontSize:30,              
        },
        axisX:{
            labelFontSize: 10,
            labelAngle:-80,
            margin:0,
            interval:1,  
        },
        data: [{
            type: "column",
            dataPoints: <?=json_encode($dataPoints, JSON_NUMERIC_CHECK) ?>
        }]
    });
    chart.render();
});
</script>
@endif