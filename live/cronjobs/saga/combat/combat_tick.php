<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	
	//call in ship stats into variables
	
	//fighters first
	$query = "SELECT health, armor, shield, ap, class1_ab, class2_ab, class3_ab, class4_ab, class5_ab, class6_ab, class7_ab FROM ships WHERE ship_id = '1'";
	$data = mysqli_query($dbc, $query);
	
	while($row = mysqli_fetch_array($data)) {
		$fighter_health = $row['health'];
		$fighter_armor = $row['armor'];
		$fighter_shield = $row['shield'];
		$fighter_ap = $row['ap'];
		$fighter_class1_ab = ($row['class1_ab']/100);
		$fighter_class2_ab = ($row['class2_ab']/100);
		$fighter_class3_ab = ($row['class3_ab']/100);
		$fighter_class4_ab = ($row['class4_ab']/100);
		$fighter_class5_ab = ($row['class5_ab']/100);
		$fighter_class6_ab = ($row['class6_ab']/100);
		$fighter_class7_ab = ($row['class7_ab']/100);
		
	
	}
	
	//frigate
	$query = "SELECT health, armor, shield, ap, class1_ab, class2_ab, class3_ab, class4_ab, class5_ab, class6_ab, class7_ab FROM ships WHERE ship_id = '2'";
	$data = mysqli_query($dbc, $query);
	
	while($row = mysqli_fetch_array($data)) {
		$frigate_health = $row['health'];
		$frigate_armor = $row['armor'];
		$frigate_shield = $row['shield'];
		$frigate_ap = $row['ap'];
		$frigate_class1_ab = ($row['class1_ab']/100);
		$frigate_class2_ab = ($row['class2_ab']/100);
		$frigate_class3_ab = ($row['class3_ab']/100);
		$frigate_class4_ab = ($row['class4_ab']/100);
		$frigate_class5_ab = ($row['class5_ab']/100);
		$frigate_class6_ab = ($row['class6_ab']/100);
		$frigate_class7_ab = ($row['class7_ab']/100);
		
	
	}
	
	
	//carriers
	
	$query = "SELECT health, armor, shield, ap, class1_ab, class2_ab, class3_ab, class4_ab, class5_ab, class6_ab, class7_ab FROM ships WHERE ship_id = '4'";
	$data = mysqli_query($dbc, $query);
	
	while($row = mysqli_fetch_array($data)) {
		$carriers_health = $row['health'];
		$carriers_armor = $row['armor'];
		$carriers_shield = $row['shield'];
		$carriers_ap = $row['ap'];
		$carriers_class1_ab = ($row['class1_ab']/100);
		$carriers_class2_ab = ($row['class2_ab']/100);
		$carriers_class3_ab = ($row['class3_ab']/100);
		$carriers_class4_ab = ($row['class4_ab']/100);
		$carriers_class5_ab = ($row['class5_ab']/100);
		$carriers_class6_ab = ($row['class6_ab']/100);
		$carriers_class7_ab = ($row['class7_ab']/100);
		
	
	}
	
	//ship variables in place
	
	
	
	
	
	
	
	
	$query = "SELECT fleet_id, player_id, x, y, layer, posture, fighters, fighter_p_target, fighter_s_target, fighter_t_target, frigates, frigate_p_target, frigate_s_target, frigate_t_target, carriers, carriers_p_target, carriers_s_target, carriers_t_target, armies_carried FROM fleets";
	$data = mysqli_query($dbc, $query);
	
	while($row = mysqli_fetch_array($data)) {
		$fleet_id = $row['fleet_id'];
		$player_id = $row['player_id'];
		$x = $row['x'];
		$y = $row['y'];
		$layer = $row['layer'];
		$posture = $row['posture'];
		$fighters = $row['fighters'];
		$fighter_p_target = $row['fighter_p_target'];
		$fighter_s_target = $row['fighter_s_target'];
		$fighter_t_target = $row['fighter_t_target'];
		$frigates = $row['frigates'];
		$frigate_p_target = $row['frigate_p_target'];
		$frigate_s_target = $row['frigate_s_target'];
		$frigate_t_target = $row['frigate_t_target'];
		$carriers = $row['carriers'];
		$carriers_p_target = $row['carriers_p_target'];
		$carriers_s_target = $row['carriers_s_target'];
		$carriers_t_target = $row['carriers_t_target'];
		$armies_carried = $row['armies_carried'];
		$attack_targets=array();

		//test
		echo '<p>Player id = ' . $player_id . ', ' . $fleet_id . '</p>';
		// Create list of attackable fleets
		
		
		// If in defensive mode
		if ($posture == 0) {
			
			//test
			echo '<p>Posture is defensive</p>';
			
			$query1 = "SELECT enemies FROM players WHERE player_id = '" . $player_id . "'";
			$data1 = mysqli_query($dbc, $query1);
				
				if (mysqli_num_rows($data1) == 1) { 
				
				while($row = mysqli_fetch_array($data1)) { 
				$enemies = unserialize($row["enemies"]); 
				}//end while($row = mysqli_fetch_array($data1)) { 
				
				//test
				
				
				
				//test
				if(!empty($enemies)){
					echo '<p>attackable targets are:</p>';
				foreach($enemies as $key => $value) {
							echo '<p>' . $key. ', ' . $value . '</p>'; 
						} //end if(!empty($enemies)){
						
						$query2 = "SELECT fleet_id, fleet_name FROM fleets WHERE x = '" . $x . "' AND y = '" . $y . "' AND layer = '" . $layer . "' AND";
						foreach($enemies as $key => $value) {
							$query2 .= " player_id = '" . $key . "' OR"; 
						} // end foreach($enemies as $key => $value) {
						
						$query2 = substr($query2, 0, strlen($query2)-3);
						echo $query2;
						$data2 = mysqli_query($dbc, $query2);
						
						while($row = mysqli_fetch_array($data2)) {
							$key = $row['fleet_id'];
							$value = $row['fleet_name'];
						
						$attack_targets[$key] = $value;
	
							
						}//end while($row = mysqli_fetch_array($data2)) {
						
				}//end if(!empty($enemies)){
				}//end if (mysqli_num_rows($data1) == 1) { 
				}//end if in defensive mode
			
		
		
		
		
		
		
		
		// If in aggresive mode
		if ($posture == 1) {
			
			//test
			echo '<p>Posture is aggresive</p>';
			echo $player_id;
			$query1 = "SELECT friends FROM players WHERE player_id = '" . $player_id . "'";
			$data1 = mysqli_query($dbc, $query1);
				
				if (mysqli_num_rows($data1) == 1) { 
				
				while($row = mysqli_fetch_array($data1)) { 
				$friends = unserialize($row["friends"]); 
				}
				
				//test
				
				
				
				//test
				if(!empty($friends)){
					echo '<p>attackable targets are not:</p>';
				foreach($friends as $key => $value) {
							echo '<p>' . $key. ', ' . $value . '</p>'; 
						}
						
						$query2 = "SELECT fleet_id, fleet_name FROM fleets WHERE x = '" . $x . "' AND y = '" . $y . "' AND layer = '" . $layer . "' AND player_id != '" . $player_id . "' AND";
						foreach($friends as $key => $value) {
							$query2 .= " player_id != '" . $key . "' AND"; 
						}
						
						$query2 = substr($query2, 0, strlen($query2)-4);
						echo $query2;
						$data2 = mysqli_query($dbc, $query2);
						
						while($row = mysqli_fetch_array($data2)) {
							$key = $row['fleet_id'];
							$value = $row['fleet_name'];
						
						$attack_targets[$key] = $value;
	
							
						}
						
				}
				
				// friends empty
				else {
					$query2 = "SELECT fleet_id, fleet_name FROM fleets WHERE x = '" . $x . "' AND y = '" . $y . "' AND layer = '" . $layer . "' AND player_id != '" . $player_id . "'";
					echo $query2;
						$data2 = mysqli_query($dbc, $query2);
						
						while($row = mysqli_fetch_array($data2)) {
							$key = $row['fleet_id'];
							$value = $row['fleet_name'];
						
						$attack_targets[$key] = $value;
	
							
						}
				}
				
				
				}
				
			}
		//end if in aggresive mode
		
		
		
		
		
		
		
		
		if(!empty($attack_targets)){
		foreach($attack_targets as $key => $value) {
							echo '<p>' . $key. ', ' . $value . '</p>'; 
						}
		}
		
		
		
		// list made
		
		//If there are targets start calculating attacks
		if(!empty($attack_targets)){
		//
		
		
		 
		
		if ($fighters>=1) {
			$ship_type = 'fighter';
			$temp_attacker_ap = ($fighters*$fighter_ap);
			$continue = 1;
			$attacking_ship_p_target = $fighter_p_target;
			$attacking_ship_s_target = $fighter_s_target;
			$attacking_ship_t_target = $fighter_t_target;
			$attacking_ship_class1_ab = $fighter_class1_ab;
			$attacking_ship_class2_ab = $fighter_class2_ab;
			$attacking_ship_class4_ab = $fighter_class4_ab;
			
			
			require('targeting.php');
		
			echo '<p>check_ BREAK_____________________________________________________________</p>';
		}//end if ($fighters>=1) {
			
		if ($frigates>=1) {
			$ship_type = 'frigate';
			$temp_attacker_ap = ($frigates*$frigate_ap);
			$continue = 1;
			$attacking_ship_p_target = $frigate_p_target;
			$attacking_ship_s_target = $frigate_s_target;
			$attacking_ship_t_target = $frigate_t_target;
			$attacking_ship_class1_ab = $frigate_class1_ab;
			$attacking_ship_class2_ab = $frigate_class2_ab;
			$attacking_ship_class4_ab = $frigate_class4_ab;
			
			
			
			require('targeting.php');
		
			echo '<p>check_BREAK_____________________________________________________________</p>';
		}//end if ($fighters>=1) {
			
		
		
		
		if ($carriers>=1) {
			$ship_type = 'carrier';
			$temp_attacker_ap = ($carriers*$carriers_ap);
			$continue = 1;
			$attacking_ship_p_target = $carriers_p_target;
			$attacking_ship_s_target = $carriers_s_target;
			$attacking_ship_t_target = $carriers_t_target;
			$attacking_ship_class1_ab = $carriers_class1_ab;
			$attacking_ship_class2_ab = $carriers_class2_ab;
			$attacking_ship_class4_ab = $carriers_class4_ab;
			
			
			
			
			require('targeting.php');
		
			echo '<p>check_BREAK_____________________________________________________________</p>';
		}//end if ($carriers>=1) {	
			
	
		}//closes out if there are any targets
		
	
		
		//subtract lost ships
	$query4 = "SELECT fleet_id, fighters, fighter_calc_lost, frigates, frigate_calc_lost, carriers, carriers_calc_lost FROM fleets";
	$data4 = mysqli_query($dbc, $query4);
	
	while($row = mysqli_fetch_array($data4)) {
		$fleet_id = $row['fleet_id'];
		$fighters = $row['fighters'];
		$fighter_calc_lost = $row['fighter_calc_lost'];
		$frigates = $row['frigates'];
		$frigate_calc_lost = $row['frigate_calc_lost'];
		$carriers = $row['carriers'];
		$carriers_calc_lost = $row['carriers_calc_lost'];
		
		
		$new_fighters = ($fighters-floor($fighter_calc_lost));
			if ($new_fighters<1) {
			$new_fighters = 0;
			}
		$new_frigates = ($frigates-floor($frigate_calc_lost));
		if ($new_frigates<1) {
			$new_frigates = 0;
			}
		$new_carriers = ($carriers-floor($carriers_calc_lost));
		if ($new_carriers<1) {
			$new_carriers = 0;
			}
		
		$query2 = "UPDATE fleets SET fighters = '" . $new_fighters . "', fighter_calc_lost = '0', frigates = '" . $new_frigates . "', frigate_calc_lost = '0', carriers = '" . $new_carriers . "', carriers_calc_lost = '0' WHERE fleet_id = '" . $fleet_id . "'";
			mysqli_query($dbc, $query2);
			
		
	}
	}
		$query2 = "DELETE FROM fleets WHERE fighters = 0 AND cue_fighters = 0 AND frigates = 0 AND cue_frigates = 0 AND carriers = 0 AND cue_carriers = 0";
		mysqli_query($dbc, $query2);
		
		
		
		echo '<p>BREAK_____________________________________________________________</p>';
		
		
	
	 mysqli_close($dbc);
  

?>
