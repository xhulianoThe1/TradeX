
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
    
        
       
  <div id="container" style="width:100%; height:400px;"></div>  
    


<script>
var seriesOptions = [],
	seriesCounter = 0,
	names = ['MSFT', 'AAPL', 'GOOG'];
	
function createChart() {

  Highcharts.chart('container', {
    rangeSelector: {
      selected: 4
    },
	title: {
		text: 'Closing Values Bar Chart'
	},
	chart: {
		renderTo: 'container',
		type: 'bar'
	},
	xAxis: {
		categories: ['Stocks']
	},
    yAxis: {
      labels: {
        formatter: function() {
          return (this.value > 0 ? ' + ' : '') + this.value;
        }
      }
    },
    plotOptions: {
      bar: {
        dataLabels: {
			enabled: true
		}
      },
	  series: {
        compare: 'value',
        showInNavigator: true,
        turboThreshold: 0
      }
    },
    
    series: seriesOptions
  });
}

$.each(names, function(i, name) {

  $.getJSON('https://www.quandl.com/api/v1/datasets/WIKI/' + name.toLowerCase() + '.json?auth_token=W8yzMDsJZ_TEcrPjWxGn', function(data) {
    var newData = [];

    data.data.forEach(function(point) {
      newData.push([point[11]]);
    });

    //newData.reverse();
	
	newData2 = newData[0];
	

    seriesOptions[i] = {
		name: data.code,
		data: newData2
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