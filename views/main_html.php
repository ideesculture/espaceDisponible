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

    $result=exec("du /var/www -h --max-depth=0"); 
    $result=explode("	",$result);
    $result[0]=str_replace('M', '000', $result[0]);
    $result[0]=str_replace('G', '000000', $result[0]);

    $result2=exec("echo $(($(stat -f --format=\"%a*%S\" .)))");
    $result2=$result2/1000;

    echo"Quota: ".$result[0]." KO utilisé / ".round($result2) ." KO"." <BR/>";

   //var_dump($result[0]);
   // die();
  
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="piechart" style="width: 100%; height: 250px;"></div>



<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Répertoire', 'KO'],
            ['Utilisé', <?php print $result[0];?>],
            ['Disponible', <?php print $result2;?>]
        ]);

        var options = {
            title: 'Espace de stockage (KO)',
            colors: ['#cccccc', '#00B3CA']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>