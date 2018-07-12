<?php
  // Generate the navigation menu
  echo '<hr />';
  if (isset($user->data['user_id'])) {
	echo '<div id="loginmenu">';

    echo '<a href="planet_overview.php">Planet Overview</a> &#10084; ';
	echo '<a href="fleet_overview.php">Fleet Overview</a> &#10084; ';
	echo '<a href="friends.php">Friends/Enemies</a> &#10084; ';
    echo '<a href="forum/ucp.php?mode=logout">Log Out (' . $user->data['username_clean'] . ')</a>';
	echo '</div>';
  }
  else {
	  echo '<div id="loginmenu">';
    echo '<a href="login.php">Log In</a> &#10084; ';
    echo '<a href="signup.php">Sign Up</a>';
	echo '</div>';
  }
  echo '<hr />';
?>

<div id="banner">
			<img src="../images/header.png" alt="Imperial_Saga"/>
		</div>

<?php
		  
		  $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	  
		  
	$query = "SELECT players.user_name, players.empire_name, players.credits, metals.metal_name, atmospheres.atmosphere_name FROM players INNER JOIN atmospheres USING (atmosphere_id) INNER JOIN metals USING (metal_id) WHERE player_id = '" . $user_playerid . "'";
	$data = mysqli_query($dbc, $query);
  		if (mysqli_num_rows($data) == 1) { 
		  while ($row = mysqli_fetch_array($data)) {
			  
			  $user_name = $row['user_name'];
			  $empire_name = $row['empire_name'];
			  $credits = $row['credits'];
			  $metal_name = $row['metal_name'];
			  $atmosphere_name = $row['atmosphere_name'];
	

			echo '<div id="allcontent">';
			echo '<div id="header">';
			echo '<table>';
			echo '<tr><td>' . $user_name . '\'s information</td><td>Empire Name: ' . $empire_name . '</td><td>Credits: ' . $credits . '</td></tr>';
			echo '<tr><td>Metal Used: ' . $metal_name . '</td><td>Native Atmosphere: ' . $atmosphere_name . '</td><td></td></tr>'; 
			echo '</table>';
			echo '</div>';
		  }
		 	
		  
		  
		}
		
			
		
		
?>
</div>