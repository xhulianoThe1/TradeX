
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
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/indicators/indicators.js"></script>


     
    
    </head>
<body>
    


    <!--Content Div's-->
    
        
       
	<div id="container" style="height: 400px; min-width: 310px"></div>
    


<script>
var ohlc = [],
	groupingUnits = [[
            'week',                         // unit name
            [1]                             // allowed multiples
        ], [
            'month',
            [1, 3, 6]
        ]],
	names = ['MSFT', 'AAPL'];
	
function createChart() {

  Highcharts.stockChart('container', {
    rangeSelector: {
      selected: 2
    },
	title: {
		text: 'HighLow Chart'
	},
	legend: {
		enabled: true
	},
	plotOptions: {
            series: {
                showInLegend: true
            }
        },
    yAxis: [{
            labels: {
                align: 'right',
                x: -3
            },
            title: {
                text: 'OHLC'
            },
            height: '100%',
            lineWidth: 2,
            resize: {
                enabled: true
            }
        }],
    series: [{
            type: 'ohlc',
			id: names[0],
            data: ohlc,
            dataGrouping: {
                units: groupingUnits
            }
        },{
            type: 'sma',
            linkedTo: names[0],
			getSelectedPoints: true,
            params: {
                period: 5000
            }
		}]
  });
}


$.getJSON('https://www.quandl.com/api/v1/datasets/WIKI/' + names[0].toLowerCase() + '.json?auth_token=W8yzMDsJZ_TEcrPjWxGn', function(data) {
    var newData = [];
	
    data.data.forEach(function(point) {
	  newData.push([new Date(point[0]), point[1], point[2], point[3], point[4]]);
    });
	
    newData.reverse();	
	
	
	ohlc = newData;
    


    createChart();
  });


</script>

</body>
</html>