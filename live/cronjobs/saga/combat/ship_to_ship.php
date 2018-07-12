<?php
while (($temp_attacker_ap>=1)&&($continue==1)){
					$temp_attacker_ap_mod = ($temp_attacker_ap*$ab);
					
					
					echo '<p>' . $ship_type . ' ap = ' . $temp_attacker_ap . ', modified based on target =  ' . $temp_attacker_ap_mod . '</p>';
				
				
				
				$query2 = "SELECT fleet_id, " . $ship_target . ", " . $ship_calc_lost . " FROM fleets WHERE x = '" . $x . "' AND y = '" . $y . "' AND layer = " . $layer . " AND " . $ship_target . " > '0' AND " . $ship_target . " > " . $ship_calc_lost . " AND(";
				
				
				foreach($attack_targets as $key => $value) {
							$query2 .= " fleet_id = '" . $key . "' OR"; 
						} //end foreach($attack_targets as $key => $value)
						
						$query2 = substr($query2, 0, strlen($query2)-3);
						$query2 .= ") ORDER BY RAND() LIMIT 1";
						echo $query2;
						
						
						$data2 = mysqli_query($dbc, $query2);
								if (mysqli_num_rows($data2) == 1) {
								while($row = mysqli_fetch_array($data2)) { 
										$def_fleet_id = $row['fleet_id'];
										$def_ship_t = $row[$ship_target]; 	
										$orig_def_ship_lost = $row[$ship_calc_lost];
										
										$def_ship_lost = ($temp_attacker_ap_mod/$target_health);
										$theory_killed = ($orig_def_ship_lost+$def_ship_lost);
										
										if ($def_ship_t>=$theory_killed) {
											$temp_attacker_ap = 0;
											$new_lost = ($orig_def_ship_lost+$def_ship_lost);
													
											echo '<p>not enough</p>';
											
										}//end if ($def_ship_q>$def_ship_lost) {
											
										else {
											$temp_attacker_ap = ((($temp_attacker_ap_mod-($target_health*$def_ship_t))/$ab)*.75);
											$new_lost = $def_ship_t;
											//ship health time ships lost then divided by attack bonus
											//update new lost
										
											
										}//end else {       for if ($def_ship_t>=$new_lost) {
											echo '<p>left over ap = ' . $temp_attacker_ap . '</p>';	
										echo '<p>def fleet id = ' . $def_fleet_id . ', ship quantity =  ' . $def_ship_t . ', ship health =  ' . $target_health . ', ship lost =  ' . $def_ship_lost . ', total ships lost = ' . $new_lost . '</p>';	
										
											$query3 = "UPDATE fleets SET " . $ship_calc_lost . " = '" . $new_lost . "' WHERE fleet_id = '" . $def_fleet_id . "'";
													mysqli_query($dbc, $query3);							
										
										
								}//end while($row = mysqli_fetch_array($data2)) { 
			
								}//end if (mysqli_num_rows($data2) == 1) {
								
								else {
									$continue = 0;
								}
			
				}// end while (($temp_attacker_ap>=1)&&($continue==1)){
					
					?>