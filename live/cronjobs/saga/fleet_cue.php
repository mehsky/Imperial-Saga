<?php
 // Define database connection constants
require_once('connectvars.php');
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT fleet_id, fighters, cue_fighters, frigates, cue_frigates, carriers, cue_carriers FROM fleets WHERE cue = 1";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$fleet_id = $row['fleet_id'];
		$fighters = $row['fighters'];
		$cue_fighters = $row['cue_fighters'];
		$frigates = $row['frigates'];
		$cue_frigates = $row['cue_frigates'];
		$carriers = $row['carriers'];
		$cue_carriers = $row['cue_carriers'];
		
	

		
		
		
		
		
		if (($cue_fighters>0) || ($cue_frigates>0) || ($cue_carriers>0)) {
			$new_fighters = $fighters+$cue_fighters;
			$new_frigates = $frigates+$cue_frigates;
			$new_carriers = $carriers+$cue_carriers;
			
			
			$query2 = "UPDATE fleets SET cue = 0, fighters = '$new_fighters', cue_fighters = 0, frigates = '$new_frigates', cue_frigates = 0, carriers = '$new_carriers', cue_carriers = 0 WHERE fleet_id = '$fleet_id'";
			echo $query2;
		mysqli_query($dbc, $query2);
		}
		
		
		
		}	
		
		
	 mysqli_close($dbc);
  
 
?>
