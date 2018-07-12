<?php

  require_once('startsession.php');
  
  $page_title = 'Infrastructure Management';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
          $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  $fleet_id = $_REQUEST["fleetid"];
  $enter = 0;
  
  
  if (isset($_POST['patriarch'])) {
		  
	  			// How much they want to build
				$new_name = mysqli_real_escape_string($dbc, trim($_POST['name']));
				$new_armies = mysqli_real_escape_string($dbc, trim($_POST['new_armies']));
				if (empty($new_armies)){
					$new_armies = 0;
				}
				$new_fighters = mysqli_real_escape_string($dbc, trim($_POST['new_fighters']));
				if (empty($new_fighters)){
					$new_fighters = 0;
				}
				$new_frigates = mysqli_real_escape_string($dbc, trim($_POST['new_frigates']));
				if (empty($new_frigates)){
					$new_frigates = 0;
				}
				$new_carriers = mysqli_real_escape_string($dbc, trim($_POST['new_carriers']));
				if (empty($new_carriers)){
					$new_carriers = 0;
				}
				
				
				$player_id = mysqli_real_escape_string($dbc, trim($_POST['player_id']));
				$x = mysqli_real_escape_string($dbc, trim($_POST['x']));
				$y = mysqli_real_escape_string($dbc, trim($_POST['y']));
				$layer = mysqli_real_escape_string($dbc, trim($_POST['layer']));
				$posture = mysqli_real_escape_string($dbc, trim($_POST['posture']));
				
				
				$old_armies = mysqli_real_escape_string($dbc, trim($_POST['armies']));
				$old_fighters = mysqli_real_escape_string($dbc, trim($_POST['fighters']));
				$cue_fighters = mysqli_real_escape_string($dbc, trim($_POST['cue_fighters']));
				$old_frigates = mysqli_real_escape_string($dbc, trim($_POST['frigates']));
				$cue_frigates = mysqli_real_escape_string($dbc, trim($_POST['cue_frigates']));
				$old_carriers = mysqli_real_escape_string($dbc, trim($_POST['carriers']));
				$cue_carriers = mysqli_real_escape_string($dbc, trim($_POST['cue_carriers']));
				$old_armies = mysqli_real_escape_string($dbc, trim($_POST['armies_carried']));
				
				$go = 0;
				

				if (is_numeric($new_armies) && is_numeric($new_fighters) && is_numeric($new_frigates) && is_numeric($new_carriers) && (($new_armies>0) || ($new_fighters>0) || ($new_frigates>0) || ($new_carriers>0))) {	
				
				$new_armies = round($new_armies);
				$new_fighters = round($new_fighters);
				$new_frigates = round($new_frigates);
				$new_carriers = round($new_carriers);
				
				
				$r_armies = $old_armies - $new_armies;
				$r_fighters = $old_fighters - $new_fighters;
				$r_frigates = $old_frigates - $new_frigates;
				$r_carriers = $old_carriers - $new_carriers;
				
				
				
				

				if (strlen($new_name)>3){
				$query = "SELECT fleet_id FROM fleets WHERE fleet_name = '" . $new_name . "'";
						$data = mysqli_query($dbc, $query);
						while ($row = mysqli_fetch_array($data)) {
								$temp_id = $row['fleet_id'];
						}//end while ($row = mysqli_fetch_array($data)) {
						
				if (empty($temp_id)) {
					
				
					if (($new_armies<=$old_armies) && ($new_fighters<=$old_fighters) && ($new_frigates<=$old_frigates) && ($new_carriers<=$old_carriers)){
					
						if (($r_armies>0) && ($r_fighters==0) && ($r_frigates==0) && ($r_carriers==0)){
							$error = "You cannot leave armies behind without any ships to carry them";
						}//end if (($old_armies>0) && ($old_fighters==0) && ($old_frigates==0) && ($old_carriers==0)){
						else {
							if (($new_armies>0) && ($new_fighters==0) && ($new_frigates==0) && ($new_carriers==0)){
								$error = "You cannot move armies to a new fleet without ships to carry them";
							}//end if (($new_armies>0) && ($new_fighters==0) && ($new_frigates==0) && ($new_carriers==0)){
							else {
								$go = 1;
							
							}
							
						}
					
					
					
					
					}//end if (($new_armies<=$old_armies) && ($new_fighters<=$old_fighters) && ($new_frigates<=$old_frigates) && ($new_carriers<=$old_carriers)){
					else {
						$error = "You cannot split more ships or armies from the fleet than you have.";	
					}
				
				}//end if (empty($temp_id)) {
				else {
					$error = "A fleet with that name already exists";
				}
				}//end if (!empty($change_name)){
				else{
					$error = "You must have at least 4 character in your fleet name.";
				}
			
			}//end if (is_numeric($new_armies) && is_numeric($new_fighters) && is_numeric($new_frigates) && is_numeric($new_carriers)) {	
			
			else {
				$error = "Only whole numbers may be entered.";
			}
			
if ($go==1) {
	$error = "You have split off those ships and armies to form a new fleet called " . $new_name . "";
	$query = "INSERT INTO fleets (player_id, fleet_name, x, y, dx, dy, layer, dlayer, cue, posture, fighters, frigates, carriers, armies_carried) VALUE ('" . $user_playerid . "', '" . $new_name . "', '" . $x . "', '" . $y . "', '" . $x . "', '" . $y . "', '" . $layer . "', '" . $layer . "', '0', '" . $posture . "', '" . $new_fighters . "', '" . $new_frigates . "', '" . $new_carriers . "', '" . $new_armies . "')";
				mysqli_query($dbc, $query);
				
			if (($r_armies==0) && ($r_fighters==0) && ($r_frigates==0) && ($r_carriers==0) && ($cue_fighters==0) && ($cue_frigates==0) && ($cue_carriers==0)){
				$query = "DELETE FROM fleets WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query);
			}
			else {
				$query = "UPDATE fleets SET fighters = '" . $r_fighters . "', frigates = '" . $r_frigates . "', carriers = '" . $r_carriers . "', armies_carried = '" . $r_armies . "' WHERE fleet_id = '" . $fleet_id . "'";
				mysqli_query($dbc, $query);
			}

}//end if ($go==1) {

}//end  if (isset($_POST['submit'])) {
			
  
				
  
  $query = "SELECT player_id, fleet_id, fleet_name, x, y, layer, posture, fighters, cue_fighters, frigates, cue_frigates, carriers, cue_carriers, armies_carried FROM fleets WHERE fleet_id = '" . $fleet_id . "'";
  $data = mysqli_query($dbc, $query);
  		if (mysqli_num_rows($data) == 1) { 
		  while ($row = mysqli_fetch_array($data)) {
			
			$player_id = $row['player_id'];
			$fleet_id = $row['fleet_id'];
			$fleet_name = $row['fleet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$layer = $row['layer'];
			$posture = $row['posture'];
			$fighters = $row['fighters'];
			$cue_fighters = $row['cue_fighters'];
			$frigates = $row['frigates'];
			$cue_frigates = $row['cue_frigates'];
			$carriers = $row['carriers'];
			$cue_carriers = $row['cue_carriers'];
			$armies_carried = $row['armies_carried'];
			}
		}
		
		
		
				
echo '<div id="allcontent">';
	
		  		  
  // Checks to see if player owns planet, then pulls and displays proper info if he does
	  if ($user_playerid == $player_id) {
   echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
   echo '<h1>Split Fleet</h1>';
   echo '<fieldset>';
   echo '<legend>' . $fleet_name . '</legend>';
      
 
   echo '<p>Choose what you want to split off from this fleet and choose a name. You cannot split ships that are in cue away from this fleet.</p>';

	echo'<p class="error">' . $error . '</p>'; 
  echo '<table>';
  echo '<tr><td><label for="name">Name:</label></td><td><input type="text" maxlength="20" name="name" value="" /></td><td><a href="fleet_combine.php?fleetid=' . $fleet_id . '">Combine</a></td></tr>';
  echo '<tr><td>Ship Type</td><td>Quantity</td><td>In Fleet</td></tr>';
  
  echo '<tr><td><label for="armies">Armies:</label></td><td><input type="text" name="new_armies" value="0" /></td><td>' . $armies_carried . '</td></tr>';
  if ($fighters>0) {
  echo '<tr><td><label for="fighters">Fighters:</label></td><td><input type="text" name="new_fighters" value="0" /></td><td>' . $fighters . '</td></tr>';
  }
  if ($frigates>0) {
  echo '<tr><td><label for="frigates">Frigates:</label></td><td><input type="text" name="new_frigates" value="0" /></td><td>' . $frigates . '</td></tr>';
  }
  if ($carriers>0) {
  echo '<tr><td><label for="carriers">Carriers:</label></td><td><input type="text" name="new_carriers" value="0" /></td><td>' . $carriers . '</td></tr>';
  }
  echo '<input type="hidden" name="fleetid" value="' . $fleet_id . '" />';
  echo '<input type="hidden" name="player_id" value="' .  $player_id . '" />';
  echo '<input type="hidden" name="x" value="' .  $x . '" />';
  echo '<input type="hidden" name="y" value="' .  $y . '" />';
  echo '<input type="hidden" name="layer" value="' .  $layer . '" />';
  echo '<input type="hidden" name="posture" value="' .  $posture . '" />';
  echo '<input type="hidden" name="fighters" value="' .  $fighters . '" />';
  echo '<input type="hidden" name="cue_fighters" value="' .  $cue_fighters . '" />';
  echo '<input type="hidden" name="frigates" value="' .  $frigates . '" />';
  echo '<input type="hidden" name="cue_frigates" value="' .  $cue_frigates . '" />';
  echo '<input type="hidden" name="carriers" value="' .  $carriers . '" />';
  echo '<input type="hidden" name="cue_carriers" value="' .  $cue_carriers . '" />';
  echo '<input type="hidden" name="armies_carried" value="' .  $armies_carried . '" />';
  
  
  echo '<tr><td></td><td> <input type="submit" value="Split" name="patriarch" /></td><td></td><td></td></tr>';
  
  
  echo '</table>';



  
    
    echo '</fieldset>';
   
 echo '</form>';
  

  
  
  
			  
			  }
			
			else {
				//the check for fleets needs to go here once the table is up
				echo '<p>You do not own this planet, nice try.</p>';
			
			}
			
			
			
	
	
			
 mysqli_close($dbc);			
?>










</div>


</body>
</html>