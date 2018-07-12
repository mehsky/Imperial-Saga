<?php
 // Define database connection constants
 require_once('connectvars.php');
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT player_id FROM players";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		
		$player_id = $row['player_id'];
		
		echo '<h3>PLayer ID: ' . $player_id . '</h3>';
						
		$query2 = "SELECT SUM(commercial) AS 'total' FROM planets WHERE player_id = '$player_id'";
		$data2 = mysqli_query($dbc, $query2);
			while($row = mysqli_fetch_array($data2)) {
				
				$total = $row['total'];
				
				echo '<p>Commercial Buildings buit: ' . $total . '</p>';
				}
				
				$query3 = "SELECT credits FROM players WHERE player_id = '$player_id'";
				$data3 = mysqli_query($dbc, $query3);
				while($row = mysqli_fetch_array($data3)) {
			
				$credits = $row['credits'];
				echo '<p>Credits owned: ' . $credits . '</p>';
				$new_credits = ($total*100)+$credits;
				echo '<p>New Total Credits: ' . $new_credits . '</p>';
				}
				
				$query4 = "UPDATE players SET credits = '$new_credits' WHERE player_id = '$player_id'";
			mysqli_query($dbc, $query4);
			
			
			
			
			
			
			 
			
			
			
	
	}
	 mysqli_close($dbc);
  

?>
