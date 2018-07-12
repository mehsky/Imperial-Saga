<?php
 // Define database connection constants
require_once('connectvars.php');
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	
$query = "SELECT army_id, player_id, planet_id, quantity, posture FROM armies";
	$data = mysqli_query($dbc, $query);
echo $query;	
	while($row = mysqli_fetch_array($data)) {
		$army_id = $row['army_id'];
		$player_id = $row['player_id'];
		$planet_id = $row['planet_id'];
		$quantity = $row['quantity'];
		$posture = $row['posture'];
		
		$attack_targets=array();

		//test
		echo '<p>Player id = ' . $player_id . ', ' . $army_id . '</p>';
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
				}
				
				//test
				
				
				
				//test
				if(!empty($enemies)){
					echo '<p>attackable targets are:</p>';
				foreach($enemies as $key => $value) {
							echo '<p>' . $key. ', ' . $value . '</p>'; 
						} //end if(!empty($enemies)){
						
						$query2 = "SELECT army_id FROM armies WHERE planet_id = '" . $planet_id . "' AND";
						foreach($enemies as $key => $value) {
							$query2 .= " player_id = '" . $key . "' OR"; 
						} // end foreach($enemies as $key => $value) {
						
						$query2 = substr($query2, 0, strlen($query2)-3);
						echo $query2;
						$data2 = mysqli_query($dbc, $query2);
						
						while($row = mysqli_fetch_array($data2)) {
							$key = $row['army_id'];
							$value = $row['army_id'];
						
						$attack_targets[$key] = $value;
	
							
						}//end while($row = mysqli_fetch_array($data2)) {
						
				}//end if(!empty($enemies)){
				}
			}
		//end if in defensive mode
		
		
		
		
		
		
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
						
						$query2 = "SELECT army_id FROM armies WHERE planet_id = '" . $planet_id . "' AND player_id != '" . $player_id . "' AND";
						foreach($friends as $key => $value) {
							$query2 .= " player_id != '" . $key . "' AND"; 
						}
						
						$query2 = substr($query2, 0, strlen($query2)-4);
						echo $query2;
						$data2 = mysqli_query($dbc, $query2);
						
						while($row = mysqli_fetch_array($data2)) {
							$key = $row['army_id'];
							$value = $row['army_id'];
						
						$attack_targets[$key] = $value;
	
							
						}
						
				}
				
				// friends empty
				else {
					$query2 = "SELECT army_id FROM armies WHERE planet_id = '" . $planet_id . "' AND player_id != '" . $player_id . "'";
					echo $query2;
						$data2 = mysqli_query($dbc, $query2);
						
						while($row = mysqli_fetch_array($data2)) {
							$key = $row['army_id'];
							$value = $row['army_id'];
						
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
		$temp_attacker_ap = ceil($quantity/4);
		echo $temp_attacker_ap;
		$continue = 1;
	
		
		while (($temp_attacker_ap>=1)&&($continue==1)){
					
					
					
					echo '<p>HEY HEY HEY</p>';
				
				
				
				$query2 = "SELECT army_id, quantity, calc_lost FROM armies WHERE planet_id = '" . $planet_id . "' AND quantity > calc_lost AND(";
				
				
				foreach($attack_targets as $key => $value) {
							$query2 .= " army_id = '" . $key . "' OR"; 
						} //end foreach($attack_targets as $key => $value)
						
						$query2 = substr($query2, 0, strlen($query2)-3);
						$query2 .= ") ORDER BY RAND() LIMIT 1";
						echo $query2;
						
						
						$data2 = mysqli_query($dbc, $query2);
								if (mysqli_num_rows($data2) == 1) {
									echo '<p>tried</p>';
								while($row = mysqli_fetch_array($data2)) { 
										$def_army_id = $row['army_id'];
										$def_army_t = $row['quantity']; 	
										$orig_def_army_lost = $row['calc_lost'];
										
										$def_army_lost = ($quantity/4);
										$theory_killed = ($orig_def_army_lost+$def_army_lost);
										
										if ($def_army_t>=$theory_killed) {
											$temp_attacker_ap = 0;
											$new_lost = ($orig_def_army_lost+$def_army_lost);
													
											echo '<p>not enough</p>';
											
										}//end if ($def_ship_q>$def_ship_lost) {
											
										else {
											$temp_attacker_ap = ($temp_attacker_ap-$def_army_t);
											$new_lost = $def_army_t;
											//ship health time ships lost then divided by attack bonus
											//update new lost
										
											
										}//end else {       for if ($def_ship_t>=$new_lost) {
											echo '<p>left over ap = ' . $temp_attacker_ap . '</p>';	
										echo '<p>def army id = ' . $def_army_id . ', army quantity =  ' . $def_army_t . ', ship lost =  ' . $def_army_lost . ', total ships lost = ' . $new_lost . '</p>';	
										
											$query3 = "UPDATE armies SET calc_lost = '" . $new_lost . "' WHERE army_id = '" . $def_army_id . "'";
													mysqli_query($dbc, $query3);							
										
										echo $query3;
								}//end while($row = mysqli_fetch_array($data2)) { 
			
								}//end if (mysqli_num_rows($data2) == 1) {
								
								else {
									$continue = 0;
								}
			
				}// end while (($temp_attacker_ap>=1)&&($continue==1)){
		
			
	
		}//closes out if there are any targets
		echo '<p>BREAK_____________________________________________________________</p>';
	}									
		
		//subtract lost ships
	$query = "SELECT army_id, quantity, calc_lost FROM armies";
	$data = mysqli_query($dbc, $query);
	
	while($row = mysqli_fetch_array($data)) {
		$army_id = $row['army_id'];
		$quantity = $row['quantity'];
		$calc_lost = $row['calc_lost'];
		
		
		
		$new_armies = ($quantity-floor($calc_lost));
			if ($new_armies<1) {
			$new_armies = 0;
			}
		
		
		$query2 = "UPDATE armies SET quantity = '" . $new_armies . "', calc_lost = '0' WHERE army_id = '" . $army_id . "'";
													mysqli_query($dbc, $query2);
		
	}
		$query2 = "DELETE FROM armies WHERE quantity = 0";
		mysqli_query($dbc, $query2);
		
		
		
		
		
		
	
	 mysqli_close($dbc);
  

?>
