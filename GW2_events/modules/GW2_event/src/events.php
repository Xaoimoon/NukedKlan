<?php

global $nuked;

$date = date("d-m-y H:i:s");
$day = date("d-m-y");

include('../../../conf.inc.php');

$db_host  = $global['db_host'];
$db_user  = $global['db_user'];
$db_pass  = $global['db_pass'];
$db_name = $global['db_name'];


function getIDTime ($day, $date, $db_host, $db_user, $db_pass, $db_name, $db_prefix) {
$db = mysql_connect($db_host, $db_user, $db_pass);

mysql_select_db($db_name,$db);
$sql = "SELECT * FROM ".$db_prefix."_events";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

while($data = mysql_fetch_array($req, MYSQL_ASSOC))
     {
        $timer = new DateTime($day . " " . $data['IDTime']);
		$diff = $timer->diff(new DateTime($date), $absolute = false);
		$remaining = $diff->format('%H').":".$diff->format('%I').":".$diff->format('%S');
		  
		if ($diff->format('%R') != "+" && $diff->format('%H') <4)
			if ($diff->format('%R') != "+" && $diff->format('%H') <1 && $diff->format('%I') < 5)
			echo '<tr><td style="color:red;font-weight:bold;" background="modules/GW2_event/src/img/'.$data['IDEvent'].'.png" width=400px; height=50px;><div id="tirem" style="color:red;">'.$remaining.'</div><div id="tp" style="color:yellow;">'.$data['TP'].'</div><div id="name" style="color:white;">'.str_replace("?","é",utf8_decode($data['Events'])).'</div></td></tr>';
			else
			echo '<tr><td id="time" style="color:white;" background="modules/GW2_event/src/img/'.$data['IDEvent'].'.png" width=400px; height=50px;><div id="tirem" height=10px;>'.$remaining.'</div><div id="tp" style="color:yellow;">'.$data['TP'].'</div><div id="name" height=10px;>'.str_replace("?","é",utf8_decode($data['Events'])).'</div></td></tr>';
		else if ($diff->format('%H') < 1 && $diff->format('%I') < 5)
			echo '<tr><td style="color:red;font-weight:bold;" background="modules/GW2_event/src/img/'.$data['IDEvent'].'.png" width=400px; height=50px;><div id="tirem" style="color:red;">'."En cours".'</div><div id="tp" style="color:yellow;">'.$data['TP'].'</div><div id="name" style="color:white;">'.str_replace("?","é",utf8_decode($data['Events'])).'</div></td></tr>';
     } 
mysql_close();
}

echo '<table>';
getIDTime($day, $date, $db_host, $db_user, $db_pass, $db_name, $db_prefix);
echo'</table>';

?>
