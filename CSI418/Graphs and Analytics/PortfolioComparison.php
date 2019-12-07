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
	counter = 0,
	Tot1 = 0,
	Tot2 = 0,
	P1 = ["K", "AAPL"],
	P2 = ["AMZN", "AAPL"];
	
function createChart() {

  Highcharts.chart('container', {
	chart: {
		plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
		type: 'pie'
	},
    title: {
        text: 'Pie Chart for '
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
		name: 'Total Value',
		data: values
		}]
  });
}

$.each(P1, function(i, name) {

  $.getJSON('https://www.quandl.com/api/v3/datasets/WIKI/' + name.toLowerCase() + '.json?start_date=2015-05-01&column_index=11&auth_token=W8yzMDsJZ_TEcrPjWxGn', function(data) {
    var newData = []
		NumberOfStocks = 5;

    data.dataset.data.forEach(function(point) {
      newData.push([point[1]]);
    });

    //newData.reverse();
	
	newData2 = newData[0];
	
	Tot1 = Tot1 + Number(newData2)*NumberOfStocks;
    
    // As we're loading the data asynchronously, we don't know what order it will arrive. So
    // we keep a counter and create the chart when all the data is loaded.
    seriesCounter += 1;

    if (seriesCounter === P1.length) {
		values[0] = {
		name: 'Portfolio 1',
		y: Tot1
    };
    }
  });
});



$.each(P2, function(i, name) {

  $.getJSON('https://www.quandl.com/api/v3/datasets/WIKI/' + name.toLowerCase() + '.json?start_date=2015-05-01&column_index=11&auth_token=W8yzMDsJZ_TEcrPjWxGn', function(data) {
    var newData = []
		NumberOfStocks = 5;

    data.dataset.data.forEach(function(point) {
      newData.push([point[1]]);
    });

    //newData.reverse();
	
	newData2 = newData[0];
	
	Tot2 = Tot2 + Number(newData2)*NumberOfStocks;
    
    // As we're loading the data asynchronously, we don't know what order it will arrive. So
    // we keep a counter and create the chart when all the data is loaded.
    counter += 1;

    if (counter === P2.length) {
		values[1] = {
		name: 'Portfolio 2',
		y: Tot2
    };
      createChart();
    }
  });
});
</script>


   

</body>
</html>
