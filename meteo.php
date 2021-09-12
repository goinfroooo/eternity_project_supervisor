<html>
  <head>

<?php

	

		function convert_jour ($jour){

			$retour;

			$jour_modulo=$jour % 7;

			switch ($jour_modulo) {
				case 0:
					$retour = "Dimanche";
					break;
				case 1:
					$retour = "Lundi";
					break;
				case 2:
					$retour = "Mardi";
					break;
				case 3:
					$retour = "Mercredi";
					break;
				case 4:
					$retour = "Jeudi";
					break;
				case 5:
					$retour = "Vendredi";
					break;
				case 6:
					$retour = "Samedi";
					break;

				
				default:
					$retour="error";
					break;
			}

			return $retour;
		}

		function moyenne_temperature(array $temp, array $jour_bin){

			$temp_moy[0]=0;
			$jour_apres=$jour_bin[0];
			$j =0;
			$diviseur=1;

			for ($i=0;$i<sizeof($jour_bin);$i++){

				$jour_avant=$jour_apres;
				$jour_apres=$jour_bin[$i];
				

				if ($jour_avant==$jour_apres){

					$temp_moy[$j]+=$temp[$i];}

				else{
					$temp_moy[$j]=round($temp_moy[$j]/$diviseur,1);
					$j++;
					$temp_moy[$j]=0;
					$diviseur=1;

					
				}

				$diviseur++;

			}

			return $temp_moy;
		}



		//mulhouse ID = 6441541
		$url = "http://api.openweathermap.org/data/2.5/forecast?id=6441541&appid=76ebe6d388f9bffed2cd41f82e485382";


		$contents = file_get_contents($url);
		$clima=json_decode($contents);
	
		setlocale(LC_TIME, 'french.UTF-8', 'fr_FR.UTF-8');

		for ($i=0;$i<40;$i++){
	
		$date[$i]=$clima->list[$i]->dt_txt;
		$timestamp[$i]=strtotime($date[$i]);
		$jour_bin[$i]=date("w",$timestamp[$i]);
		$jour[$i]=convert_jour($jour_bin[$i]);
		$temp_moy[$i] = $clima->list[$i]->main->temp-273.15;
		$temp_max[$i] = $clima->list[$i]->main->temp_max-273.15;
		$temp_min[$i] = $clima->list[$i]->main->temp_min-273.15;
		$temp_min[$i] = $clima->list[$i]->main->temp_min-273.15;
		$pressure[$i] = $clima->list[$i]->main->pressure;
		$humidity[$i] = $clima->list[$i]->main->humidity;
		$wind_speed[$i] = $clima->list[$i]->wind->speed;
		$weather[$i] = $clima->list[$i]->weather[0]->main;
		$weather_description[$i] = $clima->list[$i]->weather[0]->description;

}

$temp_display=moyenne_temperature($temp_moy,$jour_bin);
$humidity_display=moyenne_temperature($humidity,$jour_bin);



	
		//Affichage lignes d' entête

if (false){
for ($i=0;$i<40;$i++){

		echo $date[$i]."   ";
		echo $jour_bin[$i]."   ";
		echo $temp_moy[$i]."   ";
		echo $temp_max[$i]."   ";
		echo $temp_min[$i]."   ";
		echo $pressure[$i]."   ";
		echo $humidity[$i]."   ";
		echo $wind_speed[$i]."   ";
		echo $weather[$i]."   ";
		echo $weather_description[$i]."<br />";
	
	
	}}
	
		?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        
        var chartDiv = document.getElementById('chart_temperature');

        var data = google.visualization.arrayToDataTable([
          ['Jour', 'Température'],
          ['<?php echo(convert_jour($jour_bin[0]))?>', <?php echo($temp_display[0] )?>],
          ['<?php echo(convert_jour($jour_bin[0]+1))?>',  <?php echo($temp_display[1] )?> ],
          ['<?php echo(convert_jour($jour_bin[0]+2))?>',  <?php echo($temp_display[2 ] )?>],
          ['<?php echo(convert_jour($jour_bin[0]+3))?>',  <?php echo($temp_display[3] )?>],
          ['<?php echo(convert_jour($jour_bin[0]+4))?>',  <?php echo($temp_display[4] )?>]
        ]);

        var materialOptions = {
          width: 900,
          chart: {
            title: 'Meteo sur 5 jours',
            subtitle: 'Température à gauche Humidité à droite'
          },
          series: {
            0: { axis: 'Température_max' }, // Bind series 0 to an axis named 'distance'.
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
           
           
           
          },
          title: 'Meteo sur 5 jours',
          vAxes: {
            // Adds titles to each axis.
            0: {title: '°C'},
            
           
          }
        };

       

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
         
        }


        

        drawClassicChart();
        
    };

    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        
        var chartDiv = document.getElementById('chart_humidity');

        var data = google.visualization.arrayToDataTable([
          ['Jour', 'Humidité'],
          ['<?php echo(convert_jour($jour_bin[0]))?>', <?php echo($humidity_display[0] )?>],
          ['<?php echo(convert_jour($jour_bin[0]+1))?>',  <?php echo($humidity_display[1] )?> ],
          ['<?php echo(convert_jour($jour_bin[0]+2))?>',  <?php echo($humidity_display[2 ] )?>],
          ['<?php echo(convert_jour($jour_bin[0]+3))?>',  <?php echo($humidity_display[3] )?>],
          ['<?php echo(convert_jour($jour_bin[0]+4))?>',  <?php echo($humidity_display[4] )?>]
        ]);

        var materialOptions = {
          width: 900,
          chart: {
            title: 'Meteo sur 5 jours',
            subtitle: 'Température à gauche Humidité à droite'
          },
          series: {
            0: { axis: 'Température_max' }, // Bind series 0 to an axis named 'distance'.
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
           
           
           
          },
          title: 'Meteo sur 5 jours',
          vAxes: {
            // Adds titles to each axis.
            0: {title: '%'},
            
           
          }
        };

       

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
         
        }


        

        drawClassicChart();
        
    };

    </script>
  </head>
  <body>
    
    <br><br>
    <div id="chart_temperature" style="width: 800px; height: 500px;"></div>
    <div id="chart_humidity" style="width: 800px; height: 500px;"></div>
    
  </body>
</html>
