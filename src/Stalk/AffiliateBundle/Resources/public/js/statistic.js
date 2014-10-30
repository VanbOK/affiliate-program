AmCharts.loadJSON = function(url) {
    if (window.XMLHttpRequest) {
      var request = new XMLHttpRequest();
    } else {
      var request = new ActiveXObject('Microsoft.XMLHTTP');
    }
    request.open('GET', url, false);
    request.send();
    return eval(request.responseText);
};

var chart;
var chartData = AmCharts.loadJSON('/app_dev.php/stat/get');

AmCharts.ready(function () {

    chart = new AmCharts.AmSerialChart();
    chart.dataProvider = chartData;
    chart.categoryField = "title";
    chart.startDuration = 1;
    chart.plotAreaBorderColor = "#DADADA";
    chart.plotAreaBorderAlpha = 1;
    chart.rotate = true;
    chart.creditsPosition = "bottom-right";

    // AXES
    // Category
    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridPosition = "start";
    categoryAxis.gridAlpha = 0.1;
    categoryAxis.axisAlpha = 0;

    // Value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.position = "top";
    valueAxis.gridAlpha = 0.1;
    valueAxis.axisAlpha = 0;                
    chart.addValueAxis(valueAxis);

    // GRAPHS
    // first graph
    var graph1 = new AmCharts.AmGraph();
    graph1.type = "column";
    graph1.title = "Кол-во переходов";
    graph1.valueField = "firstEl";
    graph1.balloonText = "Кол-во переходов: <b>[[value]]</b>";
    graph1.lineAlpha = 0;
    graph1.fillColors = "#F09500";
    graph1.fillAlphas = 1;
    chart.addGraph(graph1);

    // second graph
    var graph2 = new AmCharts.AmGraph();
    graph2.type = "column";
    graph2.title = "Кол-во действий";
    graph2.valueField = "secondEl";
    graph2.balloonText = "Кол-во действий: <b>[[value]]</b>";
    graph2.lineAlpha = 0;
    graph2.fillColors = "#2B9AC8";
    graph2.fillAlphas = 1;
    chart.addGraph(graph2);

    // third graph
    var graph3 = new AmCharts.AmGraph();
    graph3.type = "column";
    graph3.title = "Кол-во сделок";
    graph3.valueField = "thirdEl";
    graph3.balloonText = "Кол-во сделок: <b>[[value]]</b>";
    graph3.lineAlpha = 0;
    graph3.fillColors = "#C60C30";
    graph3.fillAlphas = 1;
    chart.addGraph(graph3);

    // LEGEND
    var legend = new AmCharts.AmLegend();
    chart.addLegend(legend);

    // WRITE
    chart.write("chartdiv");

});


(function($, undefined){
    $(function(){

        $('.input-daterange').datepicker({
            language: "ru",
            autoclose: true,
            format: "dd.mm.yyyy"
        });
        
        $('.clearForm').click(function(){
            var form = $(this).closest('form');
            form.find('input[name="dateFrom"], input[name="dateTo"]').val('');
            form.find('select[name="userId"] option[value=""]').attr('selected','selected');
            form.submit();
        });

    });
})(jQuery);