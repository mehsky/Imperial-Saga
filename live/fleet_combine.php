<?php

  require_once('startsession.php');
  
  $page_title = 'Fleet Overview';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
          $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  
		  
		  $main_fleet_id = $_REQUEST["fleetid"];
		 
						
		  
		  
		  if (isset($_POST['patriarch'])) {
			  
			  
		  $main_fleet_x = $_REQUEST["x"];
		  $main_fleet_y = $_REQUEST["y"];
		  $main_fleet_fighters = $_REQUEST["fighters"];
		  $main_fleet_cue_fighters = $_REQUEST["cue_fighters"];
		  $main_fleet_frigates = $_REQUEST["frigates"];
		  $main_fleet_cue_frigates = $_REQUEST["cue_frigates"];
		  $main_fleet_carriers = $_REQUEST["carriers"];
		  $main_fleet_cue_carriers = $_REQUEST["cue_carriers"];
		  $main_fleet_armies_carried = $_REQUEST["armies_carried"];
		  $main_fleet_layer = $_REQUEST["layer"];
		  $main_fleet_cue = $_REQUEST["cue"];
	  	
	$query = "SELECT fleet_id, cue, fighters, cue_fighters, frigates, cue_frigates, carriers, cue_carriers, armies_carried FROM fleets WHERE player_id = '" . $user_playerid . "' AND x = '" . $main_fleet_x . "' AND y = '" . $main_fleet_y . "' AND layer = '" . $main_fleet_layer . "' AND fleet_id != '" . $main_fleet_id . "'"; 
	
				$data = mysqli_query($dbc, $query);
				if (mysqli_num_rows($data) >= 1) { 
				while($row = mysqli_fetch_array($data)) { 
					$temp_fleet_id = $row['fleet_id'];
					$temp_cue = $row['cue'];
					$temp_fighters = $row['fighters'];
					$temp_cue_fighters = $row['cue_fighters'];
					$temp_frigates = $row['frigates'];
					$temp_cue_frigates = $row['cue_frigates'];
					$temp_carriers = $row['carriers'];
					$temp_cue_carriers = $row['cue_carriers'];
					$temp_armies_carried = $row['armies_carried'];
				
				
							if(isset($_POST[$temp_fleet_id])) {
							
								$main_fleet_fighters = $main_fleet_fighters + $temp_fighters;
								$main_fleet_cue_fighters = $main_fleet_cue_fighters + $temp_cue_fighters;
								$main_fleet_frigates = $main_fleet_frigates + $temp_frigates;
								$main_fleet_cue_frigates = $main_fleet_cue_frigates + $temp_cue_frigates;
								$main_fleet_carriers = $main_fleet_carriers + $temp_carriers;
								$main_fleet_cue_carriers = $main_fleet_cue_carriers + $temp_cue_carriers;
								$main_fleet_armies_carried = $main_fleet_armies_carried + $temp_armies_carried;
								if ($temp_cue == 1) {
									$main_fleet_cue = 1;	
								}
								$query = "DELETE FROM fleets WHERE fleet_id = '" . $temp_fleet_id . "'";
								mysqli_query($dbc, $query);
							}
							
				}
						
					
					$query = "UPDATE fleets SET cue = '" . $main_fleet_cue . "', fighters = '" . $main_fleet_fighters . "', cue_fighters = '" . $main_fleet_cue_fighters . "', frigates = '" . $main_fleet_frigates . "', cue_frigates = '" . $main_fleet_cue_frigates . "', carriers = '" . $main_fleet_carriers . "', cue_carriers = '" . $main_fleet_cue_carriers . "', armies_carried = '" . $main_fleet_armies_carried . "' WHERE fleet_id = '" . $main_fleet_id . "'";
					mysqli_query($dbc, $query);
				}
	}
	
	
		  
		  
		  
		  
  

echo '<div id="allcontent">';
echo '<h1>Combine Fleets</h1>';


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT player_id, fleet_id, fleet_name, x, y, layer, cue, fighters, cue_fighters, frigates, cue_frigates, carriers, cue_carriers, armies_carried FROM fleets WHERE fleet_id = '" . $main_fleet_id . "'";
  $data = mysqli_query($dbc, $query);
  
	
 	 		while ($row = mysqli_fetch_array($data)) {
				
				$player_id = $row['player_id'];
				$fleet_id = $row['fleet_id'];
				$fleet_name = $row['fleet_name'];
				$x = $row['x'];
				$y = $row['y'];
				$fighters = $row['fighters'];
				$cue_fighters = $row['cue_fighters'];
				$frigates = $row['frigates'];
				$cue_frigates = $row['cue_frigates'];
				$carriers = $row['carriers'];
				$cue_carriers = $row['cue_carriers'];
				$armies_carried = $row['armies_carried'];
				$layer = $row['layer'];
				$cue = $row['cue'];
				
			if ($user_playerid == $player_id) {
				
echo '<fieldset>';
echo '<legend><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a> (' . $x . ', ' . $y . ')</legend>';
echo '<table>';

echo '<tr><td>Armies: ' . $armies_carried . '</td><td><a href="strategic_overview.php?x=' . $x . '&y=' . $y . '"> View fleets in system</a></td><td><a href="fleet_split.php?fleetid=' . $fleet_id . '">Split</a></td></tr>';
		
if (($fighters>0) || ($cue_fighters<0)) {
	echo '<tr><td>Fighters: ' . $fighters . '</td><td>Fighters in Cue: ' . $cue_fighters . '</td><td></td></tr>';
}
if (($frigates>0) || ($cue_frigate<0)) {
	echo '<tr><td>Frigates: ' . $frigates . '</td><td>Frigates in Cue: ' . $cue_frigates . '</td><td></td></tr>';
}
if (($carriers>0) || ($cue_carriers<0)) {
	echo '<tr><td>Carriers: ' . $carriers . '</td><td>Carriers in Cue: ' . $cue_carriers . '</td><td></td></tr>';
}
echo '</table>';
echo '</fieldset>';
				
				
				
				
				
				$query2 = "SELECT fleet_id, fleet_name, x, y, layer, posture, fighters, cue_fighters, frigates, cue_frigates, carriers, cue_carriers, armies_carried FROM fleets WHERE player_id = '" . $user_playerid . "' AND x = '" . $x . "' AND y = '" . $y . "' AND layer = '" . $layer . "' AND fleet_id != '" . $fleet_id . "'";
				$data2 = mysqli_query($dbc, $query2);
				
				if (mysqli_num_rows($data2) >= 1) { 
					
					echo '<h2>Fleets That Can be Added</h3>';
					echo '<p>Added fleets will assume the destination and posture of ' .$fleet_name . '.</p>';
					echo '<form name="form1" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
				
		  			while ($row = mysqli_fetch_array($data2)) {
						$temp_fleet_id = $row['fleet_id'];
						$temp_fleet_name = $row['fleet_name'];
						$temp_fighters = $row['fighters'];
						$temp_cue_fighters = $row['cue_fighters'];
						$temp_frigates = $row['frigates'];
						$temp_cue_frigates = $row['cue_frigates'];
						$temp_carriers = $row['carriers'];
						$temp_cue_carriers = $row['cue_carriers'];
						$temp_armies_carried = $row['armies_carried'];
						
						
						
						echo '<fieldset>';
						echo '<legend><a href="fleet.php?fleetid=' . $temp_fleet_id . '">' . $temp_fleet_name . '</a><input type="checkbox" name=' . $temp_fleet_id . ' value=' . $temp_fleet_id . ' /> Add</legend>';
						
   						echo '<table>';
						if ($temp_armies_carried>0) {
							echo '<tr><td>Armies: ' . $temp_armies_carried . '</td><td></td><td></td></tr>';
						}
	   					if (($temp_fighters>0) || ($temp_cue_fighters>0)) {
							echo '<tr><td>Fighters: ' . $temp_fighters . '</td><td>Fighters in Cue: ' . $temp_cue_fighters . '</td><td></td></tr>';
						}
						if (($temp_frigates>0) || ($temp_cue_frigates>0)) {
							echo '<tr><td>Frigates: ' . $temp_frigates . '</td><td>Frigates in Cue: ' . $temp_cue_frigates . '</td><td></td></tr>';
						}
						if (($temp_carriers>0) || ($temp_cue_carriers>0)) {
							echo '<tr><td>Carriers: ' . $temp_carriers . '</td><td>Carriers in Cue: ' . $temp_cue_carriers . '</td><td></td></tr>';
						}
						
						echo '</table>';
   						echo '</fieldset>';
					}//end while ($row = mysqli_fetch_array($data2)) {
						echo '<input type="hidden" name="x" value="' . $x . '" />';
						echo '<input type="hidden" name="y" value="' . $y . '" />';
						echo '<input type="hidden" name="fighters" value="' . $fighters . '" />';
						echo '<input type="hidden" name="cue_fighters" value="' . $cue_fighters . '" />';
						echo '<input type="hidden" name="frigates" value="' . $frigates . '" />';
						echo '<input type="hidden" name="cue_frigates" value="' . $cue_frigates . '" />';
						echo '<input type="hidden" name="carriers" value="' . $carriers . '" />';
						echo '<input type="hidden" name="cue_carriers" value="' . $cue_carriers . '" />';
						echo '<input type="hidden" name="armies_carried" value="' . $armies_carried . '" />';
						echo '<input type="hidden" name="layer" value="' . $layer . '" />';
						echo '<input type="hidden" name="cue" value="' . $cue . '" />';
						echo '<input type="hidden" name="fleetid" value="' . $fleet_id . '" />';
						echo '<tr><td><input type="submit" value="Combine" name="patriarch" /></td></tr>';
						echo '</form>';
						
				}//end if (mysqli_num_rows($data2) == 1) { 
				
				else {
				echo '<p>There are no fleets that are in the same place as this one.</p>';	
				}
				
				
				}//end if ($user_playerid == $player_id) {
			
			else {
				
				echo '<p>You do not own this fleet, nice try.</p>';
			}
			
	   
  }
  
   mysqli_close($dbc);
	   

  
?>

</div>


</body>
</html>