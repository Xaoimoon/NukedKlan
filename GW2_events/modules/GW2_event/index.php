
<?php
//-------------------------------------------------------------------------//
//  Nuked-KlaN - PHP Portal                                                //
//  http://www.nuked-klan.org                                              //
//-------------------------------------------------------------------------//
//  This program is free software. you can redistribute it and/or modify   //
//  it under the terms of the GNU General Public License as published by   //
//  the Free Software Foundation; either version 2 of the License.         //
//-------------------------------------------------------------------------//
defined('INDEX_CHECK') or die ('You can\'t run this file alone.');
global $nuked;
	opentable();
	function index() {

		global $nuked;
		$ModName = basename( dirname( __FILE__ ) );
		
		echo '	<style type="text/css">
				td {
				display:block;
				width:400px;
				}
				
				#tp {
				display:inline-block;
				float: right;
				text-align:left;
				font-weight: bold;
				
				vertical-align: bottom; 
				}
				
				
				#name	{
				float: right;
				display:inline-block;
				text-align:right;
				font-weight: bold;
				width:300px;
				margin-top:10px;
				}
					
				#tirem {
				display:inline-block;
				float: left;
				text-align:left;
				font-weight: bold;
				width:50px;
				vertical-align: top; 
				}
				
				#event{
					margin-left: 21%;
				}
				
				#horloge	{
					font-weight: bold;
					text-align: center;
								}

				</style>
		
				<p style="text-align: center; margin-bottom: 20px"><big><b>GW2 World Boss Timer</b></big></p>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
				<script type="text/javascript">
					var auto_refresh = setInterval(
					function rafraichir() {
					$(\'#horloge\').load(\'/modules/GW2_event/src/hour.php\').fadeIn("slow");
					$(\'#event\').load(\'/modules/GW2_event/src/events.php\').fadeIn("slow");
					}, 1000); // refresh every 1000 milliseconds
				</script>		
					
					<div>
						<p><div id="horloge" style="text-align: right"></div></p>
						<p><div id="event"></div></p>
					</div>	
					<br>
					<div style="text-align: right">Developped By <A HREF="http://www.reddfonce.fr">Moon</A></div>
			';	
	}
	
			index();
	closetable();
?>
