<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT housing, population, planet_id FROM planets WHERE active = 1";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$housing = $row['housing'];
		$population = $row['population'];
		$planet_id = $row['planet_id'];
		$max_pop = $housing * 10;
		$add_pop = round($population * .1);
		$new_pop = $population + $add_pop;
		
		if ($new_pop < $max_pop) {
			$query2 = "UPDATE planets SET population = '$new_pop' WHERE planet_id = '$planet_id'";
		mysqli_query($dbc, $query2);
		}
		
		if ($new_pop > $max_pop) {
			$query3 = "UPDATE planets SET population = '$max_pop' WHERE planet_id = '$planet_id'";
		mysqli_query($dbc, $query3);
		}
		
		
		
		}	
		
		
	 mysqli_close($dbc);
  
 
?>
