    <?php
	

  

   require_once('startsession.php');
   
     $page_title = 'Imperial Saga';

  require_once('game_header.php');

  require_once('connectvars.php');

		  $user_playerid = $user->data['user_id'];
		  $user_name = $user->data['username_clean'];
		  $user_id = $user->data['user_id'];
		  
		 
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	

	
	
	if (isset($_POST['patriarch1'])) {//abbandon and retreat
	
	
		 $query = "SELECT metal_id, atmosphere_id FROM players WHERE player_id = '" . $user_playerid . "'";
        $data = mysqli_query($dbc, $query);
        
        while ($row = mysqli_fetch_array($data)) {
        	$metal_id = $row['metal_id'];
			$atmosphere_id = $row['atmosphere_id'];
        }
	
	$query3 = "UPDATE planets SET player_id = '" . $user_playerid . "', active = 1, housing = 115, agricultural = 0, commercial = 20, mining = 25, industry = 25, factories = 15, ore_mined = 40, scandium = 4, neodymium = 4, promethium = 4, erbium = 4, yttrium = 4, trade_goods = 40, population = 1150, labor = 30, ship_labor = 15 WHERE (planet_type_id = 3 OR planet_type_id = 4 OR planet_type_id = 5 OR planet_type_id = 6) AND metal_id = '" . $metal_id . "' AND atmosphere_id = '" . $atmosphere_id . "' AND active = 0 ORDER BY rank ASC LIMIT 1";
        	mysqli_query($dbc, $query3);

	
	$query = "DELETE FROM fleets WHERE player_id='" . $user_playerid . "'";
					mysqli_query($dbc, $query);	
	
	
	
	
	
	
	
		
		
		
	}//end if (isset($_POST['patriarch1'])) {//abbandon and retreat
	if (isset($_POST['patriarch2'])) {//just retreat
	 $query = "SELECT metal_id, atmosphere_id FROM players WHERE player_id = '" . $user_playerid . "'";
        $data = mysqli_query($dbc, $query);
        
        while ($row = mysqli_fetch_array($data)) {
        	$metal_id = $row['metal_id'];
			$atmosphere_id = $row['atmosphere_id'];
        }
	
	$query3 = "UPDATE planets SET player_id = '" . $user_playerid . "', active = 1, housing = 115, agricultural = 0, commercial = 20, mining = 25, industry = 25, factories = 15, ore_mined = 40, scandium = 4, neodymium = 4, promethium = 4, erbium = 4, yttrium = 4, trade_goods = 40, population = 1150, labor = 30, ship_labor = 15 WHERE (planet_type_id = 3 OR planet_type_id = 4 OR planet_type_id = 5 OR planet_type_id = 6) AND metal_id = '" . $metal_id . "' AND atmosphere_id = '" . $atmosphere_id . "' AND active = 0 ORDER BY rank ASC LIMIT 1";
        	mysqli_query($dbc, $query3);
	echo $query3;
		
	}//end if (isset($_POST['patriarch2'])) {//just retreat
	if (isset($_POST['patriarch3'])) {//Start New	
	
			$empirename = mysqli_real_escape_string($dbc, trim($_POST['empirename']));
	
	
			$query = "SELECT * FROM players WHERE empire_name = '$empirename'";
     		$data = mysqli_query($dbc, $query);
     		if (mysqli_num_rows($data) == 0) {
		  
		   $query = "INSERT INTO players (player_id, user_name, empire_name, credits) VALUES ('" . $user_id . "', '" . $user_name . "', '" . $empirename . "', '10000')";
        mysqli_query($dbc, $query);
        
        
        	$query3 = "UPDATE planets SET player_id = '" . $user_playerid . "', active = 1, housing = 115, agricultural = 0, commercial = 20, mining = 25, industry = 25, factories = 15, ore_mined = 40, scandium = 4, neodymium = 4, promethium = 4, erbium = 4, yttrium = 4, trade_goods = 40, population = 1150, labor = 30, ship_labor = 15 WHERE (planet_type_id = 3 OR planet_type_id = 4 OR planet_type_id = 5 OR planet_type_id = 6) AND active = 0 ORDER BY rank ASC LIMIT 1";
        	mysqli_query($dbc, $query3);
			
		 $query = "SELECT metal_id, atmosphere_id FROM planets WHERE player_id = '" . $user_playerid . "'";
        $data = mysqli_query($dbc, $query);
        
        while ($row = mysqli_fetch_array($data)) {
        	$metal_id = $row['metal_id'];
			$atmosphere_id = $row['atmosphere_id'];
        }
        
        	$query5 = "UPDATE players SET metal_id = '" . $metal_id . "', atmosphere_id = '" . $atmosphere_id . "' WHERE player_id = '" . $user_playerid . "'";
        	mysqli_query($dbc, $query5);
        
        
        
        
		$query6 = "UPDATE planets SET active = 1 WHERE active = 0 ORDER BY rank ASC LIMIT 8";
        	mysqli_query($dbc, $query6);
        

        // Confirm success with the user
 
		}//end if (mysqli_num_rows($data) == 0) {
	  else {// An account already exists for this empire name, so display an error message
        echo '<p class="error">An account already exists with this empire name. Please use a different Empire name.</p>';
        $empirename = "";
	  }//end else {// An account already exists for this empire name, so display an error message
		
		
	}//end if (isset($_POST['patriarch3'])) {//Start New	
		
	
	







	
	echo '<div id="allcontentguest">';
		
		echo '<div id="banner">';
			echo '<img src="../images/header.png" alt="Imperial_Saga"/>';
		echo '</div>';
		
		echo '<div id="homemaincontent">';
	
	
	
	if (empty($user_playerid)||($user_playerid==1)) {
	
			
		
			echo '<h1>Choose Your Fate</h1>';
			
			echo '<p>You have successfully unified your planet under your rule. Now you must build and expand your empire amongst the stars, under the rule of the Earthen Empire. How you rule your people is up to you, but be aware that every decision you make will have advantages and disadvantages.<br /> ';
echo '<br />';
echo 'Imperial Saga is a strategy game in which you may ally with your neighbors or conquer them. Follow the laws of the Earthen Empire or disobey for ultimate power and face the consequences. <br /><br />Choose Your Fate</p>';

			echo '<div id="menu">';
			echo '<p><a href="forum/ucp.php?mode=login">Log In - <a href="forum/ucp.php?mode=register">Sign Up</a></p>';
			echo '</div>';
		
		
	}//end if (empty($user_username)) {
		if ($user_playerid>1) {
			
			$query1 = "SELECT * FROM zzz_user_group WHERE user_id = " . $user_playerid . " AND group_id = 8";
  $data1 = mysqli_query($dbc, $query1);
  		if (mysqli_num_rows($data1) == 1) { 
		while ($row = mysqli_fetch_array($data1)) {
			
			$user_id = $row['user_id'];
			$group_id = $row['group_id'];
			$beta_tester = 2;

		}
		}
			echo $user_groupid;
			if ($beta_tester==2) {//user is administrator
				
				$query = "SELECT planet_id FROM planets WHERE player_id = '" . $user_playerid . "'";
  					$data = mysqli_query($dbc, $query);
  
				if (mysqli_num_rows($data) >= 1) {//player has planets
 	 			$menu = '<div id="menu"><p><a href="planet_overview.php">View Planets - <a href="fleet_overview.php">View Fleets - <a href="forum/">Forum - </a><a href="index.php">Logout</a></p></div>';
			
				
				}//end if (mysqli_num_rows($data1) >= 1) {
					else {//player has no planets
				
					$query = "SELECT fleet_id FROM fleets WHERE player_id = '" . $user_playerid . "'";
  					$data = mysqli_query($dbc, $query);
  
					if (mysqli_num_rows($data) >= 1) {//player has fleets
					$button = '<input type="submit" value="Abbandon and Retreat" name="patriarch1" />';
					$message = '<p>You have lost all of your planets. However you still have at least one fleet of ships. You can either try to take over a planet with your remaining forces or abbandon them to retreat to your backup planet.</p>';
 	 				$menu = '<div id="menu"><p><a href="fleet_overview.php">View Fleets - <a href="forum/">Forum - </a><a href="claim_planet.php">Logout</a></p></div>';
				
					}//end if (mysqli_num_rows($data) >= 1) {//player has fleets
				
				
						else {//player has no fleets
							$query = "SELECT user_name FROM players WHERE player_id = '" . $user_playerid . "'";
  								$data = mysqli_query($dbc, $query);
  
								if (mysqli_num_rows($data)==1) {//player lost planets
								$button = '<input type="submit" value="Retreat" name="patriarch2" />';
							$message = '<p>You have lost all of your fleets and planets. You have retreated to your backup planet.</p>';
 	 						$menu = '<div id="menu"><p><a href="forum/">Forum - </a><a href="claim_planet.php">Logout</a></p></div>';
				
							}//end if (mysqli_num_rows($data) >= 1) {//player lost planets
									else{//player never had planets
									$button = '	<label for="empirename">Desired Empire Name:</label><br />
      											<input type="text" name="empirename" /><br />
												<input type="submit" value="Start Game" name="patriarch3" />';
									$message = '<p>To start building your empire select a name for it and press Start Game. Have fun!</p>';
 	 								$menu = '<div id="menu"><p><a href="forum/">Forum - </a><a href="claim_planet.php">Logout</a></p></div>';
									
									
									}//else{//player never had planets
				
					}//end else {//player has no fleets
				
			
			}//end else {//player has no planets
				
				

				
			echo '<h1>Choose Your Fate</h1>';
			echo $menu;
			echo '<p>Welcome to the Imperial Saga alpha.<p/>';
			echo $message;
			echo '<form method="post" action=' . $_SERVER['PHP_SELF'] . '>';
			echo $button;
			echo '</form>';
			 
			
			}//end if ($user_groupid==5) {player is administrator
			else {
				
				echo '<h1>Choose Your Fate</h1>';
				
				echo '<p>You are registered for the beta. Updates will be made on the <a href="phpBB3/">forum</a>.<br /> ';
echo '<br />';
echo 'Imperial Saga is a strategy game in which you may ally with your neighbors or conquer them. Follow the laws of the Earthen Empire or disobey for ultimate power and face the consequences. <br /><br />Choose Your Fate</p>';
				
				
				
			}//end else {
			
			
		}//end if ($user_playerid>1) {
		echo '</div>';
		
		echo '<div id="footer">';
		echo '<p>footer test</p>';
		echo '</div>';
            
              mysqli_close($dbc);
      
            ?>
	</div>
	
	</body>	
</html>
