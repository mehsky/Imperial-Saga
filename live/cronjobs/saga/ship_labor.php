<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT factories, ship_labor, planet_id FROM planets WHERE active = 1";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		
		$planet_id = $row['planet_id'];
		$ship_labor = $row['ship_labor'];
		$factories = $row['factories'];
		$max_labor = $factories*240;
		$labor_tick = $factories*10;
		
		
		if (($ship_labor+$labor_tick)<$max_labor) {
			$new_labor = (floor($ship_labor*.9))+$labor_tick;
		}
		else {
			$new_labor = $max_labor;	
		}
		
		
		
		
		
		
		if ($new_labor!=$labor) {
			$query2 = "UPDATE planets SET ship_labor = '$new_labor' WHERE planet_id = '$planet_id'";
		mysqli_query($dbc, $query2);
		}
		
		
		
		}	
		
		
	 mysqli_close($dbc);
  
 
?>
