<?php

  require_once('startsession.php');
  
  $page_title = 'Fleet';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
           $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  $fleet_id = $_REQUEST["fleetid"];
  $planet_id = $_REQUEST["planetid"];
  
  $query = "SELECT player_id FROM fleets WHERE fleet_id = '" . $fleet_id . "'";
  $data = mysqli_query($dbc, $query);
  		if (mysqli_num_rows($data) == 1) { 
		  while ($row = mysqli_fetch_array($data)) {
			  
			  $player_id2 = $row['player_id'];
		  }

          
		}
		
				  ?>
<div id="allcontent">
	
		  <?php
		  	  
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  if ($user_playerid == $player_id2) {
				  
				  
			
			
			if (isset($_POST['submit4'])) {
	  
	  			
				$change_name = mysqli_real_escape_string($dbc, trim($_POST['change_name']));
				if (strlen($change_name)>3){
				$query = "SELECT fleet_id FROM fleets WHERE fleet_name = '" . $change_name . "'";
						$data = mysqli_query($dbc, $query);
						while ($row = mysqli_fetch_array($data)) {
								$temp_id = $row['fleet_id'];
						}//end while ($row = mysqli_fetch_array($data)) {
						
				if (empty($temp_id)) {
					$query = "UPDATE fleets SET fleet_name = '" . $change_name . "' WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query);
				}
				else {
					$error = "A fleet with that name already exists";
				}
				}//end if (!empty($change_name)){
				else{
					$error = "You must have at least 4 character in your fleet name.";
				}
				
			}//end if (isset($_POST['submit1'])) {
			//Updates if the first part of the form were submitted.
			
			if (isset($_POST['submit1'])) {
	  
	  			
				$d_type = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['d_type'])));
				$planets = mysqli_real_escape_string($dbc, trim($_POST['planets']));
				$fdx = mysqli_real_escape_string($dbc, trim($_POST['dx']));
				$fdy = mysqli_real_escape_string($dbc, trim($_POST['dy']));
				$atmosphere = mysqli_real_escape_string($dbc, trim($_POST['atmosphere']));
				$army_id = mysqli_real_escape_string($dbc, trim($_POST['army_id']));
				$new_posture = mysqli_real_escape_string($dbc, trim($_POST['new_posture']));
				
				
				$query = "SELECT fleet_name, dx, dy, dlayer FROM fleets WHERE fleet_id = '" . $fleet_id . "'";
						$data = mysqli_query($dbc, $query);
						while ($row = mysqli_fetch_array($data)) {
								$fleet_name = $row['fleet_name'];
								$dx = $row['dx'];
								$dy = $row['dy'];
								$dlayer = $row['dlayer'];
								$p_target_player = 0;
								$s_target_player = 0;
								$t_target_player = 0;
								
						}
			
				// if planet drop down was used
				if ($d_type==1) {
					if (is_numeric($planets)) {
						$query = "SELECT x, y FROM planets WHERE planet_id = '" . $planets . "'";
						$data = mysqli_query($dbc, $query);
						while ($row = mysqli_fetch_array($data)) {
							if (($atmosphere==0) || ($atmosphere==1)) {
								$dx = $row['x'];
								$dy = $row['y'];
								$dlayer = $atmosphere;
								
							}
							else {
								$error = "If you are selecting a planet you must select wether you want your fleet to maintain station in the outer or inner atmosphere.";	
							}
						}
											
					}
					else {
						if (($atmosphere==0) || ($atmosphere==1)) {
						$dlayer = $atmosphere;	
						}
					}
				}
				// if coordinate inpt was used		
				if ($d_type==2) {
					if (($fdx>-251) && ($fdx<251) && ($fdy>-251) && ($fdy<251)){
						
						$dlayer = 2;
						$query = "SELECT planet_id FROM planets WHERE x = '" . $fdx . "' AND y = '" . $fdy . "'";
							$data = mysqli_query($dbc, $query);
							if (mysqli_num_rows($data) == 1) {
								if (($atmosphere==0) || ($atmosphere==1)) {
									$dx = $fdx;
									$dy = $fdy;
									$dlayer = $atmosphere;
									
								}
								else {
								$error = "If you are entering the coordinates for a planet you must select wether you want your fleet to maintain in station in the outer or inner atmosphere.";	
								}
								
							}
							else {
								$dx = $fdx;
								$dy = $fdy;
								$dlayer = 2;
							}
					}
					else {
						$error = "The coordinates you chose for this fleet are outside of the galaxy. You cannot send them there or they would get lost.";
					}
					
				}
				//done with coordinate entering
				
				
				
								
				
				//Update fleet with variables
				$query1 = "UPDATE fleets SET dx = '" . $dx . "', dy = '" . $dy . "', dlayer = '" . $dlayer. "', posture = '" . $new_posture . "' WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query1);
				
				
				
				
				
				
				
				
			}
				  
			//Done with the first form update	  
			
			//Updates if second part of the form is submitted.
			
			if (isset($_POST['submit2'])) {
				$s_fighter_p_target = mysqli_real_escape_string($dbc, trim($_POST['s_fighter_p_target']));
				$s_fighter_s_target = mysqli_real_escape_string($dbc, trim($_POST['s_fighter_s_target']));
				$s_fighter_t_target = mysqli_real_escape_string($dbc, trim($_POST['s_fighter_t_target']));
				$s_frigate_p_target = mysqli_real_escape_string($dbc, trim($_POST['s_frigate_p_target']));
				$s_frigate_s_target = mysqli_real_escape_string($dbc, trim($_POST['s_frigate_s_target']));
				$s_frigate_t_target = mysqli_real_escape_string($dbc, trim($_POST['s_frigate_t_target']));
				$s_carriers_p_target = mysqli_real_escape_string($dbc, trim($_POST['s_carriers_p_target']));
				$s_carriers_s_target = mysqli_real_escape_string($dbc, trim($_POST['s_carriers_s_target']));
				$s_carriers_t_target = mysqli_real_escape_string($dbc, trim($_POST['s_carriers_t_target']));
				
				
			$query1 = "UPDATE fleets SET fighter_p_target = '" . $s_fighter_p_target . "', fighter_s_target = '" . $s_fighter_s_target . "', fighter_t_target = '" . $s_fighter_t_target . "', frigate_p_target = '" . $s_frigate_p_target . "', frigate_s_target = '" . $s_frigate_s_target . "', frigate_t_target = '" . $s_frigate_t_target . "', carriers_p_target = '" . $s_carriers_p_target . "', carriers_s_target = '" . $s_carriers_s_target . "', carriers_t_target = '" . $s_carriers_t_target . "' WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query1);	
				
				echo '<p>Your ships targeting priorities have been updated.</p>';
				
				
			}
			
			//Done with the second form updates.
			
			if (isset($_POST['submit3'])) {
				
				$army_move_quantity = mysqli_real_escape_string($dbc, trim($_POST['army_move_quantity']));
				$army_move = mysqli_real_escape_string($dbc, trim($_POST['army_move']));
				$armies_carried = mysqli_real_escape_string($dbc, trim($_POST['armies_carried']));
				$armies_below = mysqli_real_escape_string($dbc, trim($_POST['armies_below']));
				$army_id = mysqli_real_escape_string($dbc, trim($_POST['army_id']));
				
				
				if ($army_move==1) {
					
					//pick up
					$n_armies_carried = ($armies_carried+$army_move_quantity);
					$n_armies_below = ($armies_below-$army_move_quantity);
					
					if ($n_armies_below>=0) {
						
					$query1 = "UPDATE fleets SET armies_carried = '" . $n_armies_carried . "' WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query1);
					$query1 = "UPDATE armies SET quantity = '" . $n_armies_below . "' WHERE army_id = '" . $army_id . "'";
				mysqli_query($dbc, $query1);
				
				if ($n_armies_below==0) {
				$query = "DELETE FROM armies WHERE army_id='" . $army_id . "'";
					mysqli_query($dbc, $query);	
					
				}
				
				
					}
					else {
					echo '<p>You do not have that many armies on the ground.<p>';	
					}
				}
				
				else if ($army_move==2) {
					
					//drop off
					$n_armies_carried = ($armies_carried-$army_move_quantity);
					$n_armies_below = ($armies_below+$army_move_quantity);	
					
					if ($n_armies_carried>=0) {
						
						
					if ($armies_below>0){	
					$query1 = "UPDATE fleets SET armies_carried = '" . $n_armies_carried . "' WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query1);
					$query1 = "UPDATE armies SET quantity = '" . $n_armies_below . "' WHERE army_id = '" . $army_id . "'";
				mysqli_query($dbc, $query1);
					}
					else {
						
						
					$query1 = "UPDATE fleets SET armies_carried = '" . $n_armies_carried . "' WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query1);
					$query1 = "INSERT INTO armies (player_id, planet_id, quantity) VALUE ('" . $user_playerid . "', '" . $planet_id . "', '" . $n_armies_below . "')";
				mysqli_query($dbc, $query1);
						
					}
				
				
				
				
				}
					else {
					echo '<p>You do not have that many armies carried in your fleet.<p>';	
					}
				}
				else {
				echo '<p>You need to select whether to drop off or pick up the armies you are moving.</p>';	
				}
				
				
			}
			
		 //populate variables to show information and fill out forms
  					$query = "SELECT fleet_name, x, y, dx, dy, layer, dlayer, cue, posture, fighters, cue_fighters, fighter_p_target, fighter_s_target, fighter_t_target, frigates, frigate_p_target, frigate_s_target, frigate_t_target, cue_frigates, carriers, cue_carriers, carriers_p_target, carriers_s_target, carriers_t_target, armies_carried FROM fleets WHERE fleet_id = '" . $fleet_id . "'";
  					$data = mysqli_query($dbc, $query);
  
			
 	 		while ($row = mysqli_fetch_array($data)) {
			
			$fleet_name = $row['fleet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$dx = $row['dx'];
			$dy = $row['dy'];
			$x = $row['x'];
			$layer = $row['layer'];
			$dlayer = $row['dlayer'];
			$cue = $row['cue'];
			$posture = $row['posture'];
			$fighters = $row['fighters'];
			$cue_fighters = $row['cue_fighters'];
			$fighters_p_target = $row['fighters_p_target'];
			$fighters_s_target = $row['fighters_t_target'];
			$fighters_t_target = $row['fighters_t_target'];
			$frigates = $row['frigates'];
			$cue_frigates = $row['cue_frigates'];
			$frigate_p_target = $row['frigate_p_target'];
			$frigate_s_target = $row['frigate_t_target'];
			$frigate_t_target = $row['frigate_t_target'];
			$carriers = $row['carriers'];
			$cue_carriers = $row['cue_carriers'];
			$carriers_p_target = $row['carriers_p_target'];
			$carriers_s_target = $row['carriers_t_target'];
			$carriers_t_target = $row['carriers_t_target'];
			$armies_carried = $row['armies_carried'];
			$px = $x + 5;
			$nx = $x - 5;
			$py = $y + 5;
			$ny = $y - 5;
			
			
			
			
			
			
			
			
			
			
			
			
			//first player target defined
			$pt_player_name = "No Target";
			$st_player_name = "No Target";
			$tt_player_name = "No Target";
			
			
			if ($p_player_target>0) {
				$query = "SELECT user_name FROM players WHERE player_id = '" . $p_player_target . "'";
				$data = mysqli_query($dbc, $query);
				
				while ($row = mysqli_fetch_array($data)) {
					$pt_player_name = $row['user_name'];	
					}
					
					
					//second player target defined
					if ($p_player_target>0) {
				$query = "SELECT user_name FROM players WHERE player_id = '" . $s_player_target . "'";
				$data = mysqli_query($dbc, $query);
				
				while ($row = mysqli_fetch_array($data)) {
					$st_player_name = $row['user_name'];	
					}				
				
				
					//third player target defined
					if ($s_player_target>0) {
				$query = "SELECT user_name FROM players WHERE player_id = '" . $t_player_target . "'";
				$data = mysqli_query($dbc, $query);
				
				while ($row = mysqli_fetch_array($data)) {
					$tt_player_name = $row['user_name'];	
					}				
				
				
				
					}
						
					//close third target
							
				
					}
					
					//close second
				
				
			}
			
			//close primary
			
			
			
			
			
			$orbit = "";
				$location = "In Space";	
									
				$query1 = "SELECT planet_id, planet_name, planet_type_id FROM planets WHERE x = '" . $x . "' AND y = '" . $y . "'";
					$data1 = mysqli_query($dbc, $query1);
						while ($row = mysqli_fetch_array($data1)) {
						$planet_id = $row['planet_id'];
						$planet_type_id = $row['planet_type_id'];
						$location = '<a href="planet.php?planetid=' . $planet_id . '">' . $row['planet_name'] . '</a>';
						$planet_name = $row['planet_name'];
						$c_planet_id = $row['planet_id'];
						
						if ($layer==0) {
							$orbit = "High Orbit";
						}
						else {
							$orbit = "Low Orbit";
						}
						}
						
						if ($posture==0) {
							$posture_mode = "Tactical";	
							$posture_choice = '<option value=1>Aggresive</option>';
						}
						else {
							$posture_mode = "Aggresive";	
							$posture_choice = '<option value=0>Tactical</option>';
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
				//Finding out information complete
				
				
				//show fleet form

				echo '<h1><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a> (' . $x . ', ' . $y . ')</h1>';
				
				echo '<h3><form name="form4" method="post" action="' . $_SERVER['PHP_SELF'] . '"><input type="text" maxlength="20" name="change_name" value="' . $fleet_name . '" /><input type="hidden" name="fleetid" value="' . $fleet_id . '" /><input type="submit" value="Update" name="submit4" /></form></h3>';
				echo '<p class="menu"><a href="strategic_overview.php?x=' . $x . '&y=' . $y . '">Fleets in System</a>';
				echo ' - <a href="fleet_combine.php?fleetid=' . $fleet_id . '">Combine</a> - <a href="fleet_split.php?fleetid=' . $fleet_id . '">Split</a></p>';
				
				
				
				
				
				
				echo '<fieldset>';
				echo '<legend>Fleet Information</legend>';
				echo '<p class="error">' . $error . '</p>';;
				echo '<table>';
				
			
				echo '<form name="form1" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                
               
	   			echo '<tr><td>Location: ' . $location . '(' . $x . ', ' . $y . ')</br>' . $orbit . '</td><td>Status: ' . 	$status . '</td><td>Posture: <select name="new_posture"><option value=' . $posture . '>' . $posture_mode . '</option>' . $posture_choice . '</select></td>';
				
				
				
				
				
				
				//defining destination
			
			$dname = "Open Space";
			$destination = "Open Space ($dx, $dy)";
			$query1 = "SELECT planet_id, planet_name FROM planets WHERE x = '" . $dx . "' AND y = '" . $dy . "'";
					$data1 = mysqli_query($dbc, $query1);
						while ($row = mysqli_fetch_array($data1)) {
							
							$planet_name = $row['planet_name'];
							$dname = $planet_name;
							
						}
						
						if ($dlayer==0) {
							$orbit = 0;
						}
						else if ($dlayer==1) {
							$orbit = 1;
						}
						else {
							$orbit = 3;
						}
				
				
			
				
				
				echo '<tr><td>Destination:</br><input type="radio" name="d_type" value="1"><select name="planets"><option value="current location">' . $dname . ' (' . $dx . ',' . $dy . ')</option>';
                

  
$query = "SELECT planet_name, planet_id, x, y FROM planets WHERE x < '" . $px . "' AND x > '" . $nx . "' AND y < '" . $py . "' AND y > '" . $ny . "' AND active = 1";
  $data = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($data)) {
	
	$planet_id = $row['planet_id'];
	$planet_name = $row['planet_name'];
	$tx = $row['x'];
	$ty = $row['y'];

echo '<option value="' . $planet_id . '">' . $planet_name . ' (' . $tx . ',' . $ty . ')</option>';
}
                
             echo '</select></td><td><input type="radio" name="d_type" value="2">x:<input type="text" maxlength="3" size="1" name="dx" value="' . $dx . '" /> y:<input type="text" maxlength="3" size="1" name="dy" value="' . $dy . '" /></td>';
			 
			 
			 
			 
			 
			 echo '<input type="hidden" name="atmosphere" value=2/>';
			 
			 
			 
			   
               
                echo '<td><input type="radio" name="atmosphere" value="0"';
				
				if ($orbit==0) {
					echo 'checked';
					}
				echo '>High Orbit</br><input type="radio" name="atmosphere" value="1"';
				
				if ($orbit==1) {
					echo 'checked';
					}
				echo '>Low Orbit</td></tr>';
				
				
			
				
				
	   			
	  			echo '<tr><td><input type="submit" value="Update" name="submit1" /></td></tr>';
				echo '<input type="hidden" name="fleetid" value="' . $fleet_id . '" />';
				echo '</form>';
	  			echo '</table>';
   				echo '</fieldset>';







				//Show ships form
				
				echo '<fieldset>';
				echo '<legend>Ships</legend>';
				echo '<table>';
			
				echo '<form name="form2" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                
               
				
				
				$query = "SELECT fighters, cue_fighters, fighter_p_target, fighter_s_target, fighter_t_target, frigates, cue_frigates, frigate_p_target, frigate_s_target, frigate_t_target, carriers, cue_carriers, carriers_p_target, carriers_s_target, carriers_t_target FROM fleets WHERE fleet_id = '" . $fleet_id . "'";
  $data = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($data)) {
	
	$fighters = $row['fighters'];
	$cue_fighters = $row['cue_fighters'];
	$fighter_p_target = $row['fighter_p_target'];
	$fighter_s_target = $row['fighter_s_target'];
	$fighter_t_target = $row['fighter_t_target'];
	$frigates = $row['frigates'];
	$cue_frigates = $row['cue_frigates'];
	$frigate_p_target = $row['frigate_p_target'];
	$frigate_s_target = $row['frigate_s_target'];
	$frigate_t_target = $row['frigate_t_target'];
	$carriers = $row['carriers'];
	$cue_carriers = $row['cue_carriers'];
	$carriers_p_target = $row['carriers_p_target'];
	$carriers_s_target = $row['carriers_s_target'];
	$carriers_t_target = $row['carriers_t_target'];
	
	$ship_query = "SELECT name, ship_id FROM ships WHERE ship_id = 1 OR ship_id = 2 OR ship_id = 4";
	
	
	
	//fighter targeting selector

if (($fighters > 0) || ($cue_fighters>0)) {
	echo '<tr><td>Fighters: ' . $fighters . '</td><td>Fighters in Cue: ' . $cue_fighters . '</td><td></td><td></td>';
	
	
	//fighter primary target
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $fighter_p_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<tr><td>Primary Target: </br><select name="s_fighter_p_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td>';	


 	//fighter secondary target
	
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $fighter_s_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<td>Secondary Target: </br><select name="s_fighter_s_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td>';	



		//fighter tertiary target
	
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $fighter_t_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<td>Tertiary Target: </br><select name="s_fighter_t_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td></tr>';	

}



	//frigate targeting selector

if (($frigates > 0) || ($cue_frigates>0)) {
	echo '<tr><td>Frigates: ' . $frigates . '</td><td>Frigates in Cue: ' . $cue_frigates . '</td><td></td><td></td>';
	
	
	//frigate primary target
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $frigate_p_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<tr><td>Primary Target: </br><select name="s_frigate_p_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td>';	


 	//frigate secondary target
	
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $frigate_s_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<td>Secondary Target: </br><select name="s_frigate_s_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td>';	



		//frigate tertiary target
	
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $frigate_t_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<td>Tertiary Target: </br><select name="s_frigate_t_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td></tr>';	

}

	//carriers targeting selector

if (($carriers > 0) || ($cue_carriers>0)) {
	echo '<tr><td>Carriers: ' . $carriers . '</td><td>Carriers in Cue: ' . $cue_carriers . '</td><td></td><td></td>';
	
	
	//frigate primary target
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $carriers_p_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<tr><td>Primary Target: </br><select name="s_carriers_p_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td>';	


 	//carriers secondary target
	
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $carriers_s_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<td>Secondary Target: </br><select name="s_carriers_s_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td>';	



		//carriers tertiary target
	
	
		$ship_name = "No Target";
		$ship_id = 0;
		$query = "SELECT name, ship_id FROM ships WHERE ship_id = '" . $carriers_t_target . "'";
	  $data = mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($data)) {
			$ship_name = $row['name'];
			$ship_id = $row['ship_id'];
		}
	
	echo '<td>Tertiary Target: </br><select name="s_carriers_t_target"><option value="' . $ship_id . '">' . $ship_name . '</option>';
	echo '<option value="0">No Target</option>';
	
  $data = mysqli_query($dbc, $ship_query);
while ($row = mysqli_fetch_array($data)) {
	
	$ship_id = $row['ship_id'];
	$ship_name = $row['name'];



echo '<option value="' . $ship_id . '">' . $ship_name . '</option>';
}
 echo '</select></td></tr>';	

}





}

			echo '<tr><td><input type="submit" value="Update" name="submit2" /></td>		<td></td>	<td></td><td></td>';		
			echo '<input type="hidden" name="fleetid" value="' . $fleet_id . '" />';
			echo '</form>';		
			echo '</table>';
			echo '</fieldset>';
				
			
				
  
			  }
			  
	//Show Armies Form
				echo '<fieldset>';
				echo '<legend>Ground Forces</legend>';
				echo '<table>';
				
				
                
             
		 		
		
		
				
				$query = "SELECT planet_id FROM planets WHERE x = '" . $x . "' AND y = '" . $y . "'";
  $data = mysqli_query($dbc, $query);

  		if (mysqli_num_rows($data) == 1) { 
		  while ($row = mysqli_fetch_array($data)) {
				
			 if ($layer ==1) { 	
				if ($planet_type_id!=9) {
				
				$query = "SELECT quantity, army_id FROM armies WHERE planet_id = '" . $c_planet_id . "' AND player_id = '" . $user_playerid . "'";
				
  $data = mysqli_query($dbc, $query);
  if (mysqli_num_rows($data) == 1) { 
while ($row = mysqli_fetch_array($data)) {
				$army_id = $row['army_id'];
				$quantity = $row['quantity'];
				}//end while ($row = mysqli_fetch_array($data)) {
				}//end  if (mysqli_num_rows($data) == 1) { 
				else {
				$quantity = 0;	
				}//end else {
				if (($quantity > 0) || ($armies_carried > 0)) {
					
				echo '<form name="form3" method="post" action="' . $_SERVER['PHP_SELF'] . '">';	
				echo '<tr><td>Armies Carried</br>by Fleet:' . $armies_carried . '</td><td>Move Armies:</br><input type="text" size="13" name="army_move_quantity" value="0" /></br><input type="radio" name="army_move" value="1">Pick Up<input type="radio" name="army_move" value="2">Drop</td><td>Armies on</br>the Ground:' . $quantity . '</td></tr>';
				echo '<input type="hidden" name="armies_carried" value="' . $armies_carried . '" />';
				echo '<input type="hidden" name="armies_below" value="' . $quantity. '" />';
				echo '<input type="hidden" name="army_id" value="' . $army_id . '" />';
				echo '<input type="hidden" name="planetid" value="' . $c_planet_id  . '" />';
				echo '<tr><td></td><td><input type="submit" value="Move" name="submit3" /></td><td></td></tr>';
				echo '<input type="hidden" name="fleetid" value="' . $fleet_id . '" />';
			  	echo '</form>';
					
					
					
				}
				else {
					echo '<p>You have no armies on the ground or in the fleet to manage.</p>';	
				}
				}//end if ($planet_type_id!=8) {
					else{
					echo '<p>You cannot drop armies onto a gas planet.</p>';	
					}
				}//end  if ($layer ==1) { 
				 else{
				  echo '<p>This fleet is in high orbit and carrying ' . $armies_carried . ' armies. It cannot pick up or drop armies without being in a low orbit.</p>';
  				}	
			  
		  }
		}
		else {
			echo '<p> This fleet is in space and is carrying ' . $armies_carried . ' armies.</p>';
		}
			  
  
 
			  
			  	echo '</table>';
				echo '</fieldset>';
			  
			  
			  
			  
			  }
			
			else {
				
				echo '<p>You do not own this fleet, nice try.</p>';
			}
			
			
			
			
			
			
			
			
			
			
			
 mysqli_close($dbc);			
?>










</div>


</body>
</html>