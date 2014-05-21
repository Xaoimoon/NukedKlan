<?php
//------------------------------------------------------------------------------//
//  Nuked-KlaN - PHP Portal					                            		//
//  http://www.nuked-klan.org	                        						//
//------------------------------------------------------------------------------//
//  This program is free software. you can redistribute it and/or modify    	//
//  it under the terms of the GNU General Public License as published by    	//
//  the Free Software Foundation; either version 2 of the License.           	//
//------------------------------------------------------------------------------//

define("INDEX_CHECK", 1);

if (is_file('globals.php')) include ("globals.php");
else die('<br /><br /><div style=\"text-align: center;\"><b>install.php must be near globals.php</b></div>');
if (is_file('conf.inc.php')) include ("conf.inc.php");
else die('<br /><br /><div style=\"text-align: center;\"><b>install.php must be near conf.inc.php</b></div>');
if (is_file('nuked.php')) include('nuked.php');
else die('<br /><br /><div style=\"text-align: center;\"><b>install.php must be near nuked.php</b></div>');

function top() {

	global $nuked;

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    	<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>' . $nuked['name'] . ' - Installation</title>
        <link rel="stylesheet" href="modules/Admin/css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="modules/Admin/css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="modules/Admin/css/invalid.css" type="text/css" media="screen" />
        <style type="text/css">
			.css3button {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #050505;
				padding: 5px 20px;
				background: -moz-linear-gradient(top,#ffffff 0%,#c7d95f 50%,#add136 50%,#6d8000);
				background: -webkit-gradient(linear, left top, left bottom,from(#ffffff),color-stop(0.50, #c7d95f),color-stop(0.50, #add136),to(#6d8000));
				border-radius: 12px;
				-moz-border-radius: 12px;
				-webkit-border-radius: 12px;
				border: 1px solid #6d8000;
				-moz-box-shadow:0px 1px 3px rgba(000,000,000,0.5),inset 0px 0px 2px rgba(255,255,255,1);
				-webkit-box-shadow:0px 1px 3px rgba(000,000,000,0.5),inset 0px 0px 2px rgba(255,255,255,1);
				text-shadow:0px -1px 0px rgba(000,000,000,0.2),0px 1px 0px rgba(255,255,255,0.4);
			}
		</style>';
}

function index() {

	global $nuked;

	top();

        echo '<body id="login">
        <div id="login-wrapper" class="png_bg">
        <div id="login-top">
        <h1>' . $nuked['name'] . ' - Installation</h1>
        <img id="logo" src="modules/Admin/images/logo.png" alt="NK Logo" />
        </div>';
	$version = $nuked['version'];
	$last = $version[0] . '.' . $version[2] . '.' . $version[4];

    	if ($last == '1.7.9') {

		echo '<div class="content-box" style="width:700px!important;margin:auto;">',"\n" //<!-- Start Content Box -->
        	. '<div class="content-box-header"><h3>Installation Module GW2 Events</h3></div>',"\n"
        	. '<div class="tab-content" id="tab2"><table style="margin:auto;width:80%;color:black;" cellspacing="0" cellpadding="0" border="0">';

		//Vérification si INSTALLATION ou REINSTALLATION du module afin de ne pas dupliquer le liens dans l'admin
		$test = mysql_query("SELECT id FROM " . $nuked['prefix'] . "_modules WHERE nom='GW2_event'");
		$req = mysql_num_rows($test);
		if($req == 1) echo '<tr><td style="text-align:center;"><span style="color:red; font-weight:bold;">Attention L\'installation remettra la configuration par défault du module.</span></td></tr>';

		echo '<tr>
		<td>
		Vous allez installer le module <strong>GW2 Events</strong> <br /><br />
		Developpé par <a href="http://www.reddfonce.fr" target="_blank">Xaoi Moon</a> Pour <a href="http://www.nuked-klan.eu" target="_blank">Nuked-Klan</a><br /><br />
		
		</td>
		</tr>
		<tr>
		<td style="text-align:center;">
		<input type="button" name="yes" onclick="document.location.href=\'install.php?op=update\';" value="Installer" class="css3button"/>&nbsp;&nbsp;
		<input type="button" name="No" onclick="document.location.href=\'install.php?op=nan\';" value="Ne pas installer" class="css3button"/>
		</td>
		</tr>
		</table>
		</div></div>
		</div>
        	</body>
    		</html>';
	}
	else echo 'Bad version, Only for NK 1.7.9';
}

function update() {

	global $nuked;

	//Efface les tables si déjà existantes
	$req = mysql_query("DROP TABLE IF EXISTS ". $nuked['prefix'] ."_events");
	$req = mysql_query("DELETE FROM ". $nuked['prefix'] ."_block WHERE module = 'GW2_event'");
	$req = mysql_query("DELETE FROM ". $nuked['prefix'] ."_modules WHERE nom = 'GW2_event'");

	$sql = "CREATE TABLE IF NOT EXISTS `".$nuked['prefix']."_events` (
  	`IDTime` varchar(8) NOT NULL,
  	`Events` varchar(250) NOT NULL,
  	`IDEvent` varchar(8) NOT NULL,
	`TP` varchar(11) NOT NULL,
  	KEY `IDTime` (`IDTime`)
  	) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
	$req = mysql_query($sql);

	$sql_insert = mysql_query("INSERT INTO `".$nuked['prefix']."_events` (`IDTime`, `Events`, `IDEvent`, `TP`) VALUES
		('00:00:00', 'Griffe de Jormag', '00000001', '[&BHoCAAA=]'),
('00:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('00:30:00', 'Taidha Covington', '00000003', '[&BKgBAAA=]'),
('00:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('01:00:00', 'Mégadestructeur', '00000005', '[&BM0CAAA=]'),
('01:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('01:30:00', 'A déterminer', '00000007', ''),
('01:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('02:00:00', 'Le Destructeur', '00000009', '[&BE4DAAA=]'),
('02:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('02:30:00', 'Le Destructeur', '00000010', '[&BE4DAAA=]'),
('02:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('03:00:00', 'Reine karka', '00000011', '[&BNcGAAA=]'),
('03:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('03:30:00', 'Golem Marque II', '00000013', '[&BNQCAAA=]'),
('03:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('04:00:00', 'Tequatl', '00000012', '[&BNABAAA=]'),
('04:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('04:30:00', 'Griffe de Jormag', '00000001', '[&BHoCAAA=]'),
('04:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('05:00:00', 'Grande guivre de la jungle', '00000014', '[&BKoBAAA=]'),
('05:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('05:30:00', 'Taidha Covington', '00000003', '[&BKgBAAA=]'),
('05:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('06:00:00', 'Mégadestructeur', '00000005', '[&BM0CAAA=]'),
('06:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('06:30:00', 'A déterminer', '00000007', ''),
('06:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('07:00:00', 'Le Destructeur', '00000009', '[&BE4DAAA=]'),
('07:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('07:30:00', 'Ulgoth le Modniir', '00000010', '[&BLEAAAA=]'),
('07:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('08:00:00', 'Golem Marque II', '00000013', '[&BNQCAAA=]'),
('08:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('08:30:00', 'Griffe de Jormag', '00000001', '[&BHoCAAA=]'),
('08:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('09:00:00', 'Le Destructeur', '00000009', '[&BE4DAAA=]'),
('09:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('09:30:00', 'Ulgoth le Modniir', '00000010', '[&BLEAAAA=]'),
('09:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('10:00:00', 'Golem Marque II', '00000013', '[&BNQCAAA=]'),
('10:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('10:30:00', 'Griffe de Jormag', '00000001', '[&BHoCAAA=]'),
('10:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('11:00:00', 'Taidha Covington', '00000003', '[&BKgBAAA=]'),
('11:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('11:30:00', 'Mégadestructeur', '00000005', '[&BM0CAAA=]'),
('11:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('12:00:00', 'A déterminer', '00000007', ''),
('12:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('12:30:00', 'Reine karka', '00000011', '[&BNcGAAA=]'),
('12:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('13:00:00', 'Le Destructeur', '00000009', '[&BE4DAAA=]'),
('13:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('13:30:00', 'Tequatl', '00000012', '[&BNABAAA=]'),
('13:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('14:00:00', 'Ulgoth le Modniir', '00000010', '[&BLEAAAA=]'),
('14:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('14:30:00', 'Grande guivre de la jungle', '00000014', '[&BKoBAAA=]'),
('14:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('15:00:00', 'Golem Marque II', '00000013', '[&BNQCAAA=]'),
('15:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('15:30:00', 'Griffe de Jormag', '00000001', '[&BHoCAAA=]'),
('15:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('16:00:00', 'Taidha Covington', '00000003', '[&BKgBAAA=]'),
('16:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('16:30:00', 'Mégadestructeur', '00000005', '[&BM0CAAA=]'),
('16:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('17:00:00', 'A déterminer', '00000007', ''),
('17:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('17:30:00', 'Le Destructeur', '00000009', '[&BE4DAAA=]'),
('17:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('18:00:00', 'Reine karka', '00000011', '[&BNcGAAA=]'),
('18:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('18:30:00', 'Ulgoth le Modniir', '00000010', '[&BLEAAAA=]'),
('18:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('19:00:00', 'Tequatl', '00000012', '[&BNABAAA=]'),
('19:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('19:30:00', 'Golem Marque II', '00000013', '[&BNQCAAA=]'),
('19:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('20:00:00', 'Grande guivre de la jungle', '00000014', '[&BKoBAAA=]'),
('20:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('20:30:00', 'Griffe de Jormag', '00000001', '[&BHoCAAA=]'),
('20:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('21:00:00', 'Taidha Covington', '00000003', '[&BKgBAAA=]'),
('21:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('21:30:00', 'Mégadestructeur', '00000005', '[&BM0CAAA=]'),
('21:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]'),
('22:00:00', 'A déterminer', '00000007', ''),
('22:15:00', 'Chamane de Svanir', '00000002', '[&BH4BAAA=]'),
('22:30:00', 'Le Destructeur', '00000009', '[&BE4DAAA=]'),
('22:45:00', 'Elémentaire de feu', '00000004', '[&BEYAAAA=]'),
('23:00:00', 'Ulgoth le Modniir', '00000010', '[&BLEAAAA=]'),
('23:15:00', 'Guivre de la jungle', '00000006', '[&BEEFAAA=]'),
('23:30:00', 'Golem Marque II', '00000013', '[&BNQCAAA=]'),
('23:45:00', 'Béhémoth des ombres', '00000008', '[&BPwAAAA=]');");
		


	$sql = mysql_query("INSERT INTO ". $nuked['prefix'] ."_block (`bid`, `active`, `position`, `module`, `titre`, `content`, `type`, `nivo`, `page`) VALUES ('', '1', '0', 'GW2_event', 'Events', '', 'module', '0', 'Tous');");
	$sql = mysql_query("INSERT INTO ". $nuked['prefix'] ."_modules (`id`, `nom`, `niveau`, `admin`) VALUES ('', 'GW2_event', '0', '9');");

        top();
        echo '<div class="tab-content" id="tab2" style="width:700px!important;margin:auto;">'
        . "<br /><br /><div class=\"notification success png_bg\"><div>Le module GW2 Events a été installé correctement.<br />Redirection en cours vers l'administration ...</div></div>";

	//Supression automatique du fichier install.php
	if(@!unlink("install.php")) echo "<br /><br /><div class=\"notification error png_bg\"><div>Penser à supprimer le fichier install.php de votre FTP .</div></div>";

        echo '</div></body></html>';
	redirect("index.php?file=Admin", 2);
}

function nan() {

	top();
        echo '<div class="tab-content" id="tab2" style="width:700px!important;margin:auto;">'
	. "<br /><br /><div class=\"notification error png_bg\"><div>Installation annulé .</div></div>";

	if(@!unlink("install.php")) echo "<br /><br /><div class=\"notification error png_bg\"><div>Penser à supprimer le fichier install.php de votre FTP .</div></div>";

        echo '</div></body></html>';

    	redirect("index.php", 2);
}

switch($_GET['op']) {
	case"index":
	index();
	break;

	case"update":
	update();
	break;

	case"nan":
	nan();
	break;

	default:
	index();
	break;
}

?>