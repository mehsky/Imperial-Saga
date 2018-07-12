<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
		
		$query1 = "SELECT ore, metal, planet_id FROM planets";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$ore = $row['ore'];
		$metal = $row['metal'];
		$planet_id = $row['planet_id'];
		
		
		

			$query2 = "UPDATE planets SET ore_left = '$ore', metal_left = '$metal' WHERE planet_id = '$planet_id'";
		mysqli_query($dbc, $query2);
		
		
		
		
		}
		
	 mysqli_close($dbc);
  
 
?>
