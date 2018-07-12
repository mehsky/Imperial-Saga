<?php

  require_once('startsession.php');
  
  $page_title = 'Infrastructure Management';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
          $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  if (!empty($user_playerid)) {
  
  	
  
  
 //Adding Friends 
  if (isset($_POST['submit1'])) {
	  
	  $new_friend = mysqli_real_escape_string($dbc, trim($_POST['new_friend']));
	  
	  
	  $query = "SELECT player_id, user_name FROM players WHERE user_name = '$new_friend'"; 
				$data = mysqli_query($dbc, $query);
				
				if (mysqli_num_rows($data) == 1) { 
				
		  while ($row = mysqli_fetch_array($data)) {
			  $player_id2 = $row['player_id'];
			  
			  if ($player_id2 != $user_playerid){
			  
			  
			  $query = "SELECT friends FROM players WHERE player_id = '$user_playerid'"; 
				$data = mysqli_query($dbc, $query);
				while($row = mysqli_fetch_array($data)) { 
				$friends = unserialize($row["friends"]); 
				}
				
				if(!empty($friends)){
				foreach($friends as $key => $value) {
				$friends[$key] = $value;	
				
				
				}
				}
			  	$friends[$player_id2] = $new_friend;
			  
			  	$new_friends = serialize($friends); 
				$query = "UPDATE players SET friends = ('$new_friends') WHERE player_id = '$user_playerid'";
				mysqli_query($dbc, $query);
			  
			  		}
					else {
				echo '<p>You can not be friends with yourself</p>';
				}
				}
				
			}
	  		else {
			echo '<p>That player does not exist</p>';	
			}
}
			
  //Adding Friends is complete
  
  
  //Removing Friends
  
  if (isset($_POST['submit2'])) {
	  	
	$query = "SELECT friends FROM players WHERE player_id = '$user_playerid'"; 
				$data = mysqli_query($dbc, $query);
				if (mysqli_num_rows($data) == 1) { 
				while($row = mysqli_fetch_array($data)) { 
				$friends = unserialize($row["friends"]); 
				}
						foreach($friends as $key => $value) {
							
							
							
							if(!isset($_POST[$key])) {
									$n_key = $_POST[$key];
										
								$query = "SELECT user_name FROM players WHERE player_id = '$key'"; 
									$data = mysqli_query($dbc, $query);
									while($row = mysqli_fetch_array($data)) {
											$friend = $row['user_name'];
											$n_friends[$key] = $friend;
					
					
								}
						}
					
					
					}
					$new_friends = serialize($n_friends); 
					$query = "UPDATE players SET friends = ('$new_friends') WHERE player_id = '$user_playerid'";
					mysqli_query($dbc, $query);
				}
	}
	
	
	
	
	
	 //Adding Enemies
  if (isset($_POST['submit3'])) {
	  
	  $new_enemy = mysqli_real_escape_string($dbc, trim($_POST['new_enemy']));
	  
	  
	  $query = "SELECT player_id, user_name FROM players WHERE user_name = '$new_enemy'"; 
				$data = mysqli_query($dbc, $query);
				
				if (mysqli_num_rows($data) == 1) { 
				
		  while ($row = mysqli_fetch_array($data)) {
			  $player_id2 = $row['player_id'];
			  
			  if ($player_id2 != $user_playerid){
			  
			  
			  $query = "SELECT enemies FROM players WHERE player_id = '$user_playerid'"; 
				$data = mysqli_query($dbc, $query);
				while($row = mysqli_fetch_array($data)) { 
				$enemies = unserialize($row["enemies"]); 
				}
				
				if(!empty($enemies)){
				foreach($enemies as $key => $value) {
				$enemies[$key] = $value;	
				
				
				}
				}
			  	$enemies[$player_id2] = $new_enemy;
			  
			  	$new_enemies = serialize($enemies); 
				$query = "UPDATE players SET enemies = ('$new_enemies') WHERE player_id = '$user_playerid'";
				mysqli_query($dbc, $query);
			  
			  		}
					else {
				echo '<p>You can not be enemies with yourself</p>';
				}
				}
				
			}
	  		else {
			echo '<p>That player does not exist</p>';	
			}
}
			
  //Adding Enemies is complete
  
  
  //Removing Enemies
  
  if (isset($_POST['submit4'])) {
	  	
	$query = "SELECT enemies FROM players WHERE player_id = '$user_playerid'"; 
				$data = mysqli_query($dbc, $query);
				if (mysqli_num_rows($data) == 1) { 
				while($row = mysqli_fetch_array($data)) { 
				$enemies = unserialize($row["enemies"]); 
				}
						foreach($enemies as $key => $value) {
							
							
							
							if(!isset($_POST[$key])) {
									$n_key = $_POST[$key];
										
								$query = "SELECT user_name FROM players WHERE player_id = '$key'"; 
									$data = mysqli_query($dbc, $query);
									while($row = mysqli_fetch_array($data)) {
											$enemy = $row['user_name'];
											$n_enemies[$key] = $enemy;
					
					
								}
						}
					
					
					}
					$new_enemies = serialize($n_enemies); 
					$query = "UPDATE players SET enemies = ('$new_enemies') WHERE player_id = '$user_playerid'";
					mysqli_query($dbc, $query);
				}
	}
		
				  ?>
<div id="allcontent">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
		  <?php
		  		  
		  
				//friends management
			
				
				echo '<div id="poverview">'; 
				echo '<fieldset>';
				echo '<p>Your fleets will attack everyone except players on your friends list when they are in aggresive stance.</p>';
     			echo '<legend>Friends</legend>';
   				echo '<table>';
	   			echo '<tr><td><label for="new_friend">Add Friend:</label><input type="text" name="new_friend"/></td></tr>';
				echo '<tr><td> <input type="submit" value="Submit" name="submit1" /></td><td></td><td></td></tr>';
	  			echo '</table>';
   				
				
				$query = "SELECT friends FROM players WHERE player_id = '$user_playerid'"; 
				$data = mysqli_query($dbc, $query);
				if (mysqli_num_rows($data) == 1) { 
				while($row = mysqli_fetch_array($data)) { 
				$friends = unserialize($row["friends"]); 
				}
				
				if(!empty($friends)){
				echo '<table>';
				

				foreach($friends as $key => $value) {
					
				echo '<tr><td><input type="checkbox" name=' . $key . ' value=' . $key . ' />' . $value . '</td></tr>';
					
			}
				echo '<tr><td> <input type="submit" value="Remove" name="submit2" /></td><td></td><td></td></tr>';
				
				echo '</table>';
		
			
				} 
				else {
				echo '<tr><td><p>You have no friends</p></td></tr>';
				}
				
				}
				
				echo '</fieldset>';
				
				
				
				//enemies management
				echo '<fieldset>';
				echo '<p>Your fleets will only attack players that are on your enemies list when they are in defensive stance.</p>';
     			echo '<legend>Enemies</legend>';
   				echo '<table>';
	   			echo '<tr><td><label for="new_enemy">Add Enemy:</label><input type="text" name="new_enemy"/></td></tr>';
				echo '<tr><td> <input type="submit" value="Submit" name="submit3" /></td><td></td><td></td></tr>';
	  			echo '</table>';
   				
				
				$query = "SELECT enemies FROM players WHERE player_id = '$user_playerid'"; 
				$data = mysqli_query($dbc, $query);
				if (mysqli_num_rows($data) == 1) { 
				while($row = mysqli_fetch_array($data)) { 
				$enemies = unserialize($row["enemies"]); 
				}
				
				if(!empty($enemies)){
				echo '<table>';
				

				foreach($enemies as $key => $value) {
					
				echo '<tr><td><input type="checkbox" name=' . $key . ' value=' . $key . ' />' . $value . '</td></tr>';
					
			}
				echo '<tr><td> <input type="submit" value="Remove" name="submit4" /></td><td></td><td></td></tr>';
				
		
			
				} 
				else {
				echo '<tr><td><p>You have no enemies. That won\'t last long.</p></td></tr>';
				}
				
				}
				echo '</form>';
				echo '</table>';
				echo '</fieldset>';
				echo '</div>';
  
  ?>
  
   
   
   
  </form>
  </div>
  <?php
  
  
  
			  
			
			
			
			
	
	
			
 mysqli_close($dbc);		
 
  }
  
  else {
	  echo '<p>You are not logged in.</p>';
  }
?>










</div>


</body>
</html>