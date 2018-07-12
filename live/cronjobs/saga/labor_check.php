<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT population, commercial, agricultural, mining, industry, factories, planet_id FROM planets WHERE active = 1";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$population = $row['population'];
		$planet_id = $row['planet_id'];
		$commercial = $row['commercial'];
		$agricultural = $row['agricultural'];
		$mining = $row['mining'];
		$industry = $row['industry'];
		$factories = $row['factories'];
		$infrastructure = $commercial+$agricultural+$mining+$industry+$factories;
	
		$work_force = floor($population * .1);
		
		
		
		if ($work_force < $infrastructure) {
			
			if ($commercial<5) {
				$new_commercial=0;
			}
			else {
				$new_commercial=$commercial-5;
			}
			
			
			if ($agricultural<5) {
				$new_agricultural=0;
			}
			else {
				$new_agricultural=$agricultural-5;
			}
			
			
			if ($mining<5) {
				$new_mining=0;
			}
			else {
				$new_mining=$mining-5;
			}
			
			
			if ($industry<5) {
				$new_industry=0;
			}
			else {
				$new_industry=$industry-5;
			}
			
			
			if ($factories<5) {
				$new_factories=0;
			}
			else {
				$new_factories=$factories-5;
			}
			
			
			
			
			$query2 = "UPDATE planets SET commercial = '$new_commercial', agricultural = '$new_agricultural', mining = '$new_mining', industry = '$new_industry', factories = '$new_factories' WHERE planet_id = '$planet_id'";
		mysqli_query($dbc, $query2);
		}
		
		
		
		}	
		
		
	 mysqli_close($dbc);
  
 
?>
