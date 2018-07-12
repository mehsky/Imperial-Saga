<?php
			




$query = "SELECT army_id, quantity, posture FROM armies WHERE player_id = '" . $user_playerid . "' AND planet_id = '" . $planet_id . "'";
	while ($row = mysqli_fetch_array($army_data)) {
		$quantity = $row['quantity'];
		$army_id = $row['army_id'];
		$posture = $row['posture'];
		if ($posture == 1) {
		$stance = 'aggresive';
		}
		if ($posture == 0) {
		$stance = 'defensive';
		}
		}
  $data = mysqli_query($dbc, $query);
  $claim = 0;
	if (mysqli_num_rows($data) == 1){
		
 	 		while ($row = mysqli_fetch_array($data)) {
				
				$quantity = $row['quantity'];
				echo '<form name="form4" method="post" action="' . $_SERVER['PHP_SELF'] . '"><p>You have ' . $quantity . ' armies on the surface and they are in ' . $stance . ' stance.';
				echo '<input type="hidden" name="planetid" value="' . $planet_id . '" /><input type="hidden" name="armyid" value="' . $army_id . '" /><input type="submit" value="Switch?" name="patriarch4" /></p></form>';
				
				if ($conquer==1) {
				echo '<p>The owner of this planet has no defending armies and you have more armies on the surface than anyone else. You may claim this planet.</p>';
				
				$claim = 1;	
				}
				
				
				
   				
	   
  		}//end while ($row = mysqli_fetch_array($data)) {
	}//end if (mysqli_num_rows($data) > 0){
		else {
				echo '<p>You have no armies on the surface.</p>';	
		}
		
		//Dsiplay friendly armies
		
  			
  
 $query2 = "SELECT players.user_name, players.player_id, armies.army_id, armies.quantity, armies.posture FROM players INNER JOIN armies USING (player_id) WHERE player_id != '" . $user_playerid . "' AND planet_id = " . $planet_id . "";
  $data2 = mysqli_query($dbc, $query2);
  			if (mysqli_num_rows($data2) >= 1) {	
			echo '<h3>Friendly armies at coordinates ' . $x . ', ' . $y . '</h3>';
 	 		while ($row = mysqli_fetch_array($data2)) { 
				
				$friend_name = $row['user_name'];
  				$friend_id = $row['player_id'];
				$army_id = $row['army_id'];
				$quantity = $row['quantity'];
				$army_posture = $row['posture'];
				
				
			
			
			//if fleet is in passive stance check enemies list
			if ($army_posture==0) {
			
					$report = 1;
					$query1 = "SELECT enemies FROM players WHERE player_id = '" . $friend_id . "'"; 
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
					
					echo '<p>' . $friend_name . ' - ' . $quantity . ' armies</p><br />';
				
						
					}
					
					
					}
					//end checking enemies list
					
					//if fleet is agressive check friends list
					else if($posture==1) {
						
			
					$query1 = "SELECT friends FROM players WHERE player_id = '" . $friend_id . "'"; 
					$data1 = mysqli_query($dbc, $query1);
					if (mysqli_num_rows($data1) == 1) { 
					while($row = mysqli_fetch_array($data1)) { 
					$friends = unserialize($row["friends"]); 
					}
				
					if(!empty($friends)){
						
						foreach($friends as $key => $value) {
							
							
							
							if ($key==$user_playerid) {
							
							
							echo '<p>' . $friend_name . ' - ' . $quantity . ' armies</p><br />';
							
								
							}
							
						}
						
					}
					
					}
						
					}
					
					//end checking friends list
			
  
			}
			
  
			}
			else {
				echo '<p>There are no Friendly armies here</p>';
			}
			
			// end friendly fleets
			
			
			//display enemyfleets
			
			
  
$query2 = "SELECT players.user_name, players.player_id, armies.army_id, armies.quantity, armies.posture FROM players INNER JOIN armies USING (player_id) WHERE player_id != '" . $user_playerid . "' AND planet_id = " . $planet_id . "";
  $data2 = mysqli_query($dbc, $query2);
  			if (mysqli_num_rows($data2) >= 1) {	
			echo '<h3>Enemy armies at coordinates ' . $x . ', ' . $y . '</h3>';
 	 		while ($row = mysqli_fetch_array($data2)) { 
				
				$enemy_name = $row['user_name'];
  				$enemy_id = $row['player_id'];
				$army_id = $row['army_id'];
				$quantity = $row['quantity'];
				$army_posture = $row['posture'];
			
			
			//if fleet is in agressive stance check enemies list
			if ($posture==1) {
			
					$report = 1;
					$query1 = "SELECT friends FROM players WHERE player_id = '" . $enemy_id . "'"; 
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
					
					echo '<p>' . $enemy_name . ' - ' . $quantity . ' armies</p><br />';
						
					}
					
					
					}
					//end checking enemies list
					
					//if fleet is agressive check friends list
					else if($posture==0) {
						
			
					$query1 = "SELECT enemies FROM players WHERE player_id = '" . $enemy_id . "'"; 
					$data1 = mysqli_query($dbc, $query1);
					if (mysqli_num_rows($data1) == 1) { 
					while($row = mysqli_fetch_array($data1)) { 
					$enemies = unserialize($row["enemies"]); 
					}
				
					if(!empty($enemies)){
						
						foreach($enemies as $key => $value) {
							
							
							
							if ($key==$user_playerid) {
							
							
							echo '<p>' . $enemy_name . ' - ' . $quantity . ' armies</p><br />';
							
								
							}
							
						}
						
					}
					
					}
						
					}
					
					//end checking friends list
			
  
			}
			
  
			}
			else {
				echo '<p>There are no enemy armies here</p>';
			}
			
			//end enemy fleets
			
			?>