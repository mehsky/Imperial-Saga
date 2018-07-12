<?php
			

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT fleet_name, fleet_id, layer, fighters, frigates, carriers, armies_carried FROM fleets WHERE player_id = '" . $user_playerid . "' AND x = '" . $x . "' AND y = '" . $y . "' ORDER BY layer DESC";
  $data = mysqli_query($dbc, $query);
  
	if (mysqli_num_rows($data) > 0){
		echo '<h3>My fleets at coordinates ' . $x . ', ' . $y . '</h3>';
 	 		while ($row = mysqli_fetch_array($data)) {
				
				$fleet_name = $row['fleet_name'];
				$fleet_id = $row['fleet_id'];
				$layer = $row['layer'];
				$fighters = $row['fighters'];
				$frigates = $row['frigates'];
				$carriers = $row['carriers'];
				$armies_carried = $row['armies_carried'];
				
				
				
				
				
				echo '<p><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a></p>';
				echo '<table id="strategic_friends">';
				
				if ($fighters > 0) {
						echo '<tr><td>Fighters: ' . $fighters . '</td></tr>';
						}
				if ($frigates > 0) {
						echo '<tr><td>Frigates: ' . $frigates . '</td></tr>';
						}
				if ($carriers > 0) {
						echo '<tr><td>Carriers: ' . $carriers . '</td></tr>';
						}
				if ($armies_carried > 0) {
						echo '<tr><td>Armies Carried: ' . $armies_carried . '</td></tr>';
						}
				
	  			echo '</table>';
   				
	   
  		}//end while ($row = mysqli_fetch_array($data)) {
	}//end if (mysqli_num_rows($data) > 0){
		else {
				echo '<p>You have no fleets here.</p>';	
		}
		
		//Dsiplay friendly fleets
		
  			
  
 $query = "SELECT player_id, fleet_name, fleet_id, layer, posture, fighters, frigates, carriers FROM fleets WHERE player_id != '" . $user_playerid . "' AND x = '" . $x . "' AND y = '" . $y . "' ORDER BY layer DESC";
  $data = mysqli_query($dbc, $query);
  			if (mysqli_num_rows($data) >= 1) {	
			echo '<h3>Friendly fleets at coordinates ' . $x . ', ' . $y . '</h3>';
 	 		while ($row = mysqli_fetch_array($data)) { 
				
				$player_id1 = $row['player_id'];
  				$fleet_name = $row['fleet_name'];
				$fleet_id = $row['fleet_id'];
				$layer = $row['layer'];
				$posture = $row['posture'];
				$fighters = $row['fighters'];
				$frigates = $row['frigates'];
				$carriers = $row['carriers'];
				
			
			
			//if fleet is in passive stance check enemies list
			if ($posture==0) {
			
					$report = 1;
					$query1 = "SELECT enemies FROM players WHERE player_id = '" . $player_id1 . "'"; 
					$data1 = mysqli_query($dbc, $query1);
					if (mysqli_num_rows($data1) == 1) { 
					while($row = mysqli_fetch_array($data1)) { 
					$enemies = unserialize($row["enemies"]); 
					}
				
					if(!empty($enemies)){
						
						foreach($enemies as $key => $value) {
						
							if ($key==$user_playerid) {
							$report = 0;
							
							}
							
						}
						
					}
					}
					
					if ($report==1) {
					
					echo '<p><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a></p>';
				echo '<table id="strategic_friends">';
				
				if ($fighters > 0) {
						echo '<tr><td>Fighters: ' . $fighters . '</td></tr>';
						}
				if ($frigates > 0) {
						echo '<tr><td>Frigates: ' . $frigates . '</td></tr>';
						}
				if ($carriers > 0) {
						echo '<tr><td>Carriers: ' . $carriers . '</td></tr>';
						}
				
	  			echo '</table>';
						
					}
					
					
					}
					//end checking enemies list
					
					//if fleet is agressive check friends list
					else if($posture==1) {
						
			
					$query1 = "SELECT friends FROM players WHERE player_id = '" . $player_id1 . "'"; 
					$data1 = mysqli_query($dbc, $query1);
					if (mysqli_num_rows($data1) == 1) { 
					while($row = mysqli_fetch_array($data1)) { 
					$friends = unserialize($row["friends"]); 
					}
				
					if(!empty($friends)){
						
						foreach($friends as $key => $value) {
							
							
							
							if ($key==$user_playerid) {
							
							
							echo '<p><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a></p>';
				echo '<table id="strategic_friends">';
				
				if ($fighters > 0) {
						echo '<tr><td>Fighters: ' . $fighters . '</td></tr>';
						}
				if ($frigates > 0) {
						echo '<tr><td>Frigates: ' . $frigates . '</td></tr>';
						}
				if ($carriers > 0) {
						echo '<tr><td>Carriers: ' . $carriers . '</td></tr>';
						}
				
	  			echo '</table>';
							
								
							}
							
						}
						
					}
					
					}
						
					}
					
					//end checking friends list
			
  
			}
			
  
			}
			else {
				echo '<p>There are no Friendly fleets here</p>';
			}
			
			// end friendly fleets
			
			
			//display enemyfleets
			
			
  
 $query = "SELECT player_id, fleet_name, fleet_id, layer, posture, fighters, frigates, carriers FROM fleets WHERE player_id != '" . $user_playerid . "' AND x = '" . $x . "' AND y = '" . $y . "' ORDER BY layer DESC";
  $data = mysqli_query($dbc, $query);
  			if (mysqli_num_rows($data) >= 1) {	
			echo '<h3>Enemy fleets at coordinates ' . $x . ', ' . $y . '</h3>';
 	 		while ($row = mysqli_fetch_array($data)) { 
				
				$player_id1 = $row['player_id'];
  				$fleet_name = $row['fleet_name'];
				$fleet_id = $row['fleet_id'];
				$layer = $row['layer'];
				$posture = $row['posture'];
				$fighters = $row['fighters'];
				$frigates = $row['frigates'];
				$carriers = $row['carriers'];
			
			
			//if fleet is in agressive stance check enemies list
			if ($posture==1) {
			
					$report = 1;
					$query1 = "SELECT friends FROM players WHERE player_id = '" . $player_id1 . "'"; 
					$data1 = mysqli_query($dbc, $query1);
					if (mysqli_num_rows($data1) == 1) { 
					while($row = mysqli_fetch_array($data1)) { 
					$friends = unserialize($row["friends"]); 
					}
				
					if(!empty($friends)){
						
						foreach($friends as $key => $value) {
						
							if ($key==$user_playerid) {
							$report = 0;
							
							}
							
						}
						
					}
					}
					
					if ($report==1) {
					
					echo '<p><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a></p>';
				echo '<table id="strategic_friends">';
				
				if ($fighters > 0) {
						echo '<tr><td>Fighters: ' . $fighters . '</td></tr>';
						}
				if ($frigates > 0) {
						echo '<tr><td>Frigates: ' . $frigates . '</td></tr>';
						}
				if ($carriers > 0) {
						echo '<tr><td>Carriers: ' . $carriers . '</td></tr>';
						}
				
	  			echo '</table>';
						
					}
					
					
					}
					//end checking enemies list
					
					//if fleet is agressive check friends list
					else if($posture==0) {
						
			
					$query1 = "SELECT enemies FROM players WHERE player_id = '" . $player_id1 . "'"; 
					$data1 = mysqli_query($dbc, $query1);
					if (mysqli_num_rows($data1) == 1) { 
					while($row = mysqli_fetch_array($data1)) { 
					$enemies = unserialize($row["enemies"]); 
					}
				
					if(!empty($enemies)){
						
						foreach($enemies as $key => $value) {
							
							
							
							if ($key==$user_playerid) {
							
							
							echo '<p><a href="fleet.php?fleetid=' . $fleet_id . '">' . $fleet_name . '</a></p>';
				echo '<table id="strategic_friends">';
				
				if ($fighters > 0) {
						echo '<tr><td>Fighters: ' . $fighters . '</td></tr>';
						}
				if ($frigates > 0) {
						echo '<tr><td>Frigates: ' . $frigates . '</td></tr>';
						}
				if ($carriers > 0) {
						echo '<tr><td>Carriers: ' . $carriers . '</td></tr>';
						}
				
	  			echo '</table>';
							
								
							}
							
						}
						
					}
					
					}
						
					}
					
					//end checking friends list
			
  
			}
			
  
			}
			else {
				echo '<p>There are no enemy fleets here</p>';
			}
			
			//end enemy fleets
			
			?>