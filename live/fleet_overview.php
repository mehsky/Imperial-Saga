<?php

  require_once('startsession.php');
  
  $page_title = 'Fleet Overview';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
           $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
  
?>
<div id="allcontent">
<h1>Fleet Overview</h1>

<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT fleet_id, fleet_name, x, y, dx, dy, layer, posture, fighters, cue_fighters, frigates, cue_frigates, carriers, cue_carriers, armies_carried FROM fleets WHERE player_id = '" . $user_playerid . "' ORDER BY x, y DESC ";
  $data = mysqli_query($dbc, $query);
  
	
 	 		while ($row = mysqli_fetch_array($data)) {
				
				$fleet_id = $row['fleet_id'];
				$fleet_name = $row['fleet_name'];
				$x = $row['x'];
				$y = $row['y'];
				$dx = $row['dx'];
				$dy = $row['dy'];
				$fighters = $row['fighters'];
				$cue_fighters = $row['cue_fighters'];
				$frigates = $row['frigates'];
				$cue_frigates = $row['cue_frigates'];
				$carriers = $row['carriers'];
				$cue_carriers = $row['cue_carriers'];
				$armies_carried = $row['armies_carried'];
				$layer = $row['layer'];
				$posture = $row['posture'];
				
			
				
				$orbit = "";
				$location = "In Space";	
									
				$query1 = "SELECT planet_id, planet_name FROM planets WHERE x = '" . $x . "' AND y = '" . $y . "'";
					$data1 = mysqli_query($dbc, $query1);
						while ($row = mysqli_fetch_array($data1)) {
						$planet_id = $row['planet_id'];
						$link = $row['planet_name'];
						$location = '<a href="planet.php?planetid=' . $planet_id . '">' . $link . '</a>';
						if ($layer==0) {
							$orbit = "High Orbit";
						}
						else {
							$orbit = "Low Orbit";
						}
						}
						
						
						if ($posture==0) {
							$posture_mode = "Tactical";	
						}
						else {
							$posture_mode = "Aggresive";	
						}
						
						
						
						if (($cue_fighters>0) || ($cue_frigates>0) || ($cue_carriers>0)) {
							$status = "Ships in Cue";
						}
						else {
							
							if (($x==$dx) && ($y==$dy)) {
							$status = "Ready to Fly";
							}
							else {
							$status = "In Transit";	
							}
						}
						
						
						
						
				echo '<fieldset>';
				echo '<legend><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a> (' . $x . ', ' . $y . ')</legend>';
   				echo '<table>';
	   			echo '<tr><td>Location: ' . $location . '</br>' . $orbit . '</td><td>Status: ' . 	$status . '<br />Armies: ' . $armies_carried . '</td><td>Posture: ' . $posture_mode . '<br /><a href="strategic_overview.php?x=' . $x . '&y=' . $y . '"> View fleets in system</a></td></tr>';
				echo '<tr><td></td><td></td><td></td></tr>';
				
				if (($fighters>0) || ($cue_fighters>0)) {
					
					echo '<tr><td>Fighters: ' . $fighters . '</td><td>Fighters in Cue: ' . $cue_fighters . '</td><td></td></tr>';
					
				}
				if (($frigates>0) || ($cue_frigates>0)) {
					
					echo '<tr><td>Frigates: ' . $frigates . '</td><td>Frigates in Cue: ' . $cue_frigates . '</td><td></td></tr>';
					
				}
				if (($carriers>0) || ($cue_carriers>0)) {
					
					echo '<tr><td>Carriers: ' . $carriers . '</td><td>Carriers in Cue: ' . $cue_carriers . '</td><td></td></tr>';
					
				}
				
				
	   			
	  			echo '</table>';
   				echo '</fieldset>';
	   
  }
  
   mysqli_close($dbc);
	   

  
?>

</div>


</body>
</html>