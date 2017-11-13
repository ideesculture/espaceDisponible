<?php
/* ----------------------------------------------------------------------
 * app/widgets/links/views/main_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2010-2017 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
 
 	$po_request	= $this->getVar('request');
 	//Récupère valeur quota
 	$quota	= $this->getVar('quota');
 	
 	//Espace utilisé
    $result=exec("du /var/www -h --max-depth=0"); 
    $result=explode("	",$result);
    $result[0]=$result[0]*1;
 

   if (!$quota || ($quota == 0)){
	   //Espace max du serveur
	   $quota=exec("echo $(($(stat -f --format=\"%a*%S\" .)))");
    //Transfomre Tera en Giga
    $quota=$result2/1000000000;
   }
   
   echo"".$result[0]." GO utilisé sur un quota totale de ".round($quota) ." GO"." <BR/>";

   // var_dump($result[0]);
   // die();
  
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="piechart" style="width: 100%; height: 250px;"></div>



<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Répertoire', 'GO'],
            ['Utilisé', <?php print $result[0];?>],
            ['Disponible', <?php print $quota;?>]
        ]);

        var options = {
            title: 'Espace de stockage (GO)',
            colors: ['#cccccc', '#00B3CA']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>