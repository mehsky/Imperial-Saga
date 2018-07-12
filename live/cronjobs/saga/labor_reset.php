<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT population, labor, commercial, agricultural, mining, industry, factories, planet_id FROM planets WHERE active = 1";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$population = $row['population'];
		$labor = $row['labor'];
		$planet_id = $row['planet_id'];
		$commercial = $row['commercial'];
		$agricultural = $row['agricultural'];
		$mining = $row['mining'];
		$industry = $row['industry'];
		$factories = $row['factories'];
		$infrastructure = $commercial+$agricultural+$mining+$industry+$factories;
		
		
		$new_labor = (floor($population * .1))-$infrastructure;
		
		
		
		if (($new_labor < $labor) || ($new_labor > $labor)) {
			$query2 = "UPDATE planets SET labor = '$new_labor' WHERE planet_id = '$planet_id'";
		mysqli_query($dbc, $query2);
		}
		
		
		
		}	
		
		
	 mysqli_close($dbc);
  
 
?>
