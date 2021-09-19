<!DOCTYPE html>
<html>



<?php

	
		

		function moyenne_heure_temperature_capteur(array $temp, array $date){

     // $heure_actuelle = time();
      $heure_actuelle = strtotime('2021-09-06 00:00:00');
      

      $j=0;
      $intermediaire=0.0;
      $tableau_temp;
      $tableau_date;
      $tableau_retour;
      $diviseur=0;


      for ($i=0;$i<sizeof($date);$i++){

        $timestamp = strtotime($date[$i]);

        if ($timestamp>($heure_actuelle-3600*($j+1))) {
          $intermediaire+=$temp[$i];
          $diviseur++;
         

        }
        else {

          if ($diviseur==0) {
            $tableau_temp[$j]=0;
          }
          else{

            $tableau_temp[$j]=round($intermediaire/$diviseur,1);
          }

            
            $tableau_date[$j]=date('H:i',$heure_actuelle-3600*($j+1));
            $diviseur=0;
            $intermediaire=0;
            $j++;
            $i--;
        }
      }

      $tableau_retour[0]=$tableau_temp;
      $tableau_retour[1]=$tableau_date;

      return $tableau_retour;
		}

		try
{
	$bdd = new PDO('mysql:host=localhost;dbname=eternity_db;charset=utf8', 'root', '' , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer
//$date_limite = date('d-m-Y H:i:s' ,(time()-3600*24));
//echo ($date_limite);
$date_limite ='2021-09-05 00:00:00';
$test = 'SELECT Value,Date FROM  temperature_maison WHERE Room=\'Chambre\' AND Date >\' '.$date_limite .'\' ORDER BY Date DESC';
echo ($test);

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT Value, Date FROM  temperature_maison WHERE Room=\'chambre\' AND Date >\''.$date_limite .'\' ORDER BY Date DESC');


// On affiche chaque entrée une à une

?>


<head>
  <meta charset="utf-8">
  <title>temperature_maison</title>
</head>
<body>
    <p>
     <?php  

     $i=0;

     while ($donnees = $reponse->fetch()){

        $t1[$i]=$donnees['Value'];
        $t2[$i]=$donnees['Date'];

        echo ($i);
        echo "            |         ";
        echo $t1[$i];
        echo ("            |         ");
        echo  $t2[$i];
        ?> <br><?php 
        $i++;

      }
     
     $test_fonction = moyenne_heure_temperature_capteur($t1,$t2);
     $t1_bis=$test_fonction[0];
     $t2_bis=$test_fonction[1];

     for ($i=0; $i <sizeof($test_fonction[0]) ; $i++) { 
       echo($t1_bis[$i]);
       echo ("   ");
       echo($t2_bis[$i]);

       ?><br><?php
     }

     ?>

     <?php 
      $reponse->closeCursor(); // Termine le traitement de la requête ?>
    

   </p>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        
        var chartDiv = document.getElementById('chart_temperature');

        var data = google.visualization.arrayToDataTable([
          ['Jour', 'Température'],
          ['<?php echo($t2_bis[0])?>', <?php echo($t1_bis[0] )?>],
          ['<?php echo($t2_bis[1])?>', <?php echo($t1_bis[1] )?>],
          ['<?php echo($t2_bis[2])?>', <?php echo($t1_bis[2] )?>],
          ['<?php echo($t2_bis[3])?>', <?php echo($t1_bis[20] )?>],
          ['<?php echo($t2_bis[4])?>', <?php echo($t1_bis[21] )?>],
          ['<?php echo($t2_bis[5])?>', <?php echo($t1_bis[22] )?>]
          
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
          ['Jour', 'Température'],
          ['<?php echo($t1_bis[0])?>', <?php echo($t2_bis[0] )?>],
          ['<?php echo($t1_bis[1])?>', <?php echo($t2_bis[1] )?>],
          ['<?php echo($t1_bis[2])?>', <?php echo($t2_bis[2] )?>],
          ['<?php echo($t1_bis[3])?>', <?php echo($t2_bis[3] )?>],
          ['<?php echo($t1_bis[4])?>', <?php echo($t2_bis[4] )?>],
          ['<?php echo($t1_bis[5])?>', <?php echo($t2_bis[5] )?>]
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

    <div id="chart_temperature" style="width: 800px; height: 500px;"></div>
    <div id="chart_humidity" style="width: 800px; height: 500px;"></div>
    
  </body>
</html>

  
</body>
</html>

