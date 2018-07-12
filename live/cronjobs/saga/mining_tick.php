<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
$query1 = "SELECT planets.planet_id, planets.mining, planets.ore_mined, planets.ore_left, planets.metal_left, planets.scandium, planets.neodymium, planets.promethium, planets.erbium, planets.yttrium, planets.metal_id, metals.metal_name FROM planets INNER JOIN metals USING (metal_id) WHERE active = 1";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		
		
		
		
		$mining = $row['mining'];
		$ore_mined = $row['ore_mined'];
		$ore_left = $row['ore_left'];
		$metal_left = $row['metal_left'];
		$scandium = $row['scandium'];
		$neodymium = $row['neodymium'];
		$promethium = $row['promethium'];
		$erbium = $row['erbium'];
		$yttrium = $row['yttrium'];
		$metal_name = $row['metal_name'];
		$metal_id = $row['metal_id'];
		$planet_id = $row['planet_id'];
		
		if (($ore_left>0) || ($metal_left>0)) {
			
			
		if ($ore_left<$mining) {
		$r_ore = $ore_left;	
		}
		else {
			$r_ore = $mining;
		}
		if ($metal_left<$mining) {
		$r_metal = $metal_left;	
		}
		else {
			$r_metal = $mining;
		}	
		
		
			
		$new_ore = ($r_ore)+$ore_mined;
		
		
		if ($metal_id==1) {
			$new_metal = ($r_metal)+$scandium;
			
		}
		else if ($metal_id==2) {
			$new_metal = ($r_metal)+$neodymium;
			
		}
		else if ($metal_id==3) {
			$new_metal = ($r_metal)+$promethium;
			
		}
		else if ($metal_id==4) {
			$new_metal = ($r_metal)+$erbium;
			
		}
		else {
			$new_metal = ($r_metal)+$yttrium;
			
		}		
		
		
		$nr_ore = $ore_left-$r_ore;
		$nr_metal = $metal_left-$r_metal;

		

		if ($metal_id==1) {
			$query2 = "UPDATE planets SET scandium = '$new_metal', ore_mined = '$new_ore', ore_left = '$nr_ore', metal_left = '$nr_metal' WHERE planet_id = '$planet_id'";
	
		echo '<p>a</p>';
		}
		else if ($metal_id==2) {
			$query2 = "UPDATE planets SET neodymium = '$new_metal', ore_mined = '$new_ore', ore_left = '$nr_ore', metal_left = '$nr_metal' WHERE planet_id = '$planet_id'";
	
		echo '<p>b</p>';
		}
		else if ($metal_id==3) {
			$query2 = "UPDATE planets SET promethium = '$new_metal', ore_mined = '$new_ore', ore_left = '$nr_ore', metal_left = '$nr_metal' WHERE planet_id = '$planet_id'";
	
		echo '<p>c</p>';
		}
		else if ($metal_id==4) {
			$query2 = "UPDATE planets SET erbium = '$new_metal', ore_mined = '$new_ore', ore_left = '$nr_ore', metal_left = '$nr_metal' WHERE planet_id = '$planet_id'";
		
		echo '<p>d</p>';
		}
		else {
			$query2 = "UPDATE planets SET yttrium = '$new_metal', ore_mined = '$new_ore', ore_left = '$nr_ore', metal_left = '$nr_metal' WHERE planet_id = '$planet_id'";
		
		echo '<p>e</p>';
		}
		
		mysqli_query($dbc, $query2);		
		
		}	
		
	}	
	 mysqli_close($dbc);
  
 
?>
