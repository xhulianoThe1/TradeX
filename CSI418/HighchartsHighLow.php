
<!DOCTYPE html>
<html>
<head>
	<title>Testing highcharts</title>
  <!--Bootstrap v4 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/drag-panes.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


     
    
    </head>
<body>
    


    <!--Content Div's-->
    
        
       
	<div id="container" style="height: 400px; min-width: 310px"></div>
    


<script>
var ohlc = [],
    volume = [],
	groupingUnits = [[
            'week',                         // unit name
            [1]                             // allowed multiples
        ], [
            'month',
            [1, 3, 6]
        ]],
	seriesCounter = 0,
	names = ['AAPL'];
	
function createChart() {

  Highcharts.stockChart('container', {
    rangeSelector: {
      selected: 1
    },
	title: {
		text: 'HighLow Chart'
	},
    yAxis: [{
            labels: {
                align: 'right',
                x: -3
            },
            title: {
                text: 'OHLC'
            },
            height: '60%',
            lineWidth: 2,
            resize: {
                enabled: true
            }
        }, {
            labels: {
                align: 'right',
                x: -3
            },
            title: {
                text: 'Volume'
            },
            top: '65%',
            height: '35%',
            offset: 0,
            lineWidth: 2
    }],
	tooltip: {
            split: true
    },
    series: [{
            type: 'candlestick',
            name: 'AAPL',
            data: ohlc,
            dataGrouping: {
                units: groupingUnits
            }
        }, {
            type: 'column',
            name: 'Volume',
            data: volume,
            yAxis: 1,
            dataGrouping: {
                units: groupingUnits
            }
        }]
  });
}

$.each(names, function(i, name) {

  $.getJSON('https://www.quandl.com/api/v1/datasets/WIKI/' + name.toLowerCase() + '.json?auth_token=W8yzMDsJZ_TEcrPjWxGn', function(data) {
    var newData = [],
	newData2 = [];
	
    data.data.forEach(function(point) {
	  newData.push([new Date(point[0]), point[1], point[2], point[3], point[4]]);
	  newData2.push([new Date(point[0]), point[5]]);
    });
	
    newData.reverse();	
	newData2.reverse();
	//document.write(newData.length - 1);
	//document.write(newData.length - 1);
	
	
	ohlc = newData;
	volume = newData2;
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