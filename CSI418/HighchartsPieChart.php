
<!DOCTYPE html>
<html>
<head>
	<title>Testing highcharts</title>
  <!--Bootstrap v4 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
     
    
    </head>
<body>
    


    <!--Content Div's-->
    
        
       
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div> 
    


<script>
var values = [],
	seriesCounter = 0,
	names = ['MSFT', 'AAPL'];
	
function createChart() {

  Highcharts.chart('container', {
	chart: {
		plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
		type: 'pie'
	},
    title: {
        text: 'Pie Chart'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },    
    series: [{
		name: 'Value',
		data: values
		}]
  });
}

$.each(names, function(i, name) {

  $.getJSON('https://www.quandl.com/api/v1/datasets/WIKI/' + name.toLowerCase() + '.json?auth_token=W8yzMDsJZ_TEcrPjWxGn', function(data) {
    var newData = [];

    data.data.forEach(function(point) {
      newData.push([point[2]]);
    });

    //newData.reverse();
	
	newData2 = newData[0];
	

    values[i] = {
		name: name,
		y: Number(newData2)
    };
    // As we're loading the data asynchronously, we don't know what order it will arrive. So
    // we keep a counter and create the chart when all the data is loaded.
    seriesCounter += 1;

    if (seriesCounter === names.length) {
      createChart();
    }
  });
});
</script>

</body>
</html>