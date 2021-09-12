<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        var button = document.getElementById('change-chart');
        var chartDiv = document.getElementById('chart_div');

        var data = google.visualization.arrayToDataTable([
          ['Jour', 'Temperature_max', 'Temperature_min','Humidity'],
          ['Lundi', 12, 10,86],
          ['Mardi', 12, 10,86],
          ['Mercredi', 12, 10,86],
          ['Jeudi', 12, 10,86],
          ['Vendredi', 12, 10,86]
        ]);

        var materialOptions = {
          width: 900,
          chart: {
            title: 'Meteo sur 5 jours',
            subtitle: 'Température à gauche Humidité à droite'
          },
          series: {
            0: { axis: 'Température_max' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'Température_min' }, // Bind series 0 to an axis named 'distance'.
            2: { axis: 'Humidity' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
              Temperature: {label: 'Temp'}, // Left y-axis.
              Humidity: {side: 'right', label: '%'} // Right y-axis.
            }
          }
        };

        var classicOptions = {
          width: 900,
          series: {
            0: {targetAxisIndex: 0},
            2: {targetAxisIndex: 2},
           
           
          },
          title: 'Meteo sur 5 jours',
          vAxes: {
            // Adds titles to each axis.
            0: {title: '°C'},
            2: {title: '%'}
           
          }
        };

        function drawMaterialChart() {
          var materialChart = new google.charts.Bar(chartDiv);
          materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
          button.innerText = 'Change to Classic';
          button.onclick = drawClassicChart;
        }

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
          button.innerText = 'Change to Material';
          button.onclick = drawMaterialChart;
        }


        

        drawClassicChart();
        
    };

    </script>
  </head>
  <body>
    <button id="change-chart">Change to Classic</button>
    <br><br>
    <div id="chart_div" style="width: 800px; height: 500px;"></div>
    <div>    <?php 
        function test_php(){

include ("menu.php") ;

}
test_php();?></div>
  </body>
</html>
