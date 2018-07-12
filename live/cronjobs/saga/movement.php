<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT fleet_id, x, y, dx, dy, layer, dlayer FROM fleets WHERE cue = 0";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$fleet_id = $row['fleet_id'];
		$x = $row['x'];
		$y = $row['y'];
		$dx = $row['dx'];
		$dy = $row['dy'];
		$layer = $row['layer'];
		$dlayer = $row['dlayer'];
		
		
		
		if (($x!=$dx) || ($y!=$dy) || ($layer!=$dlayer)) {
			
			if ($x!=$dx){
				
				if (($dx>$x) && (($layer==0) || ($layer==2))) {
					//echo '<p>testing</p>';
				$new_x = ($x+1);
				$new_layer = 2;
				//echo '<p>greater than x</p>';
				//echo $new_x;
				}
				if (($dx<$x) && (($layer==0) || ($layer==2))) {
				$new_x = ($x-1);
				$new_layer = 2;
				//echo '<p>less than x</p>';
				//echo $new_x;	
				}
					
			}// end if ($x!=$dx){
				
				if (($dx==$x)) {
				$new_x = $x;
				//echo '<p>equal to x</p>';
				//echo $new_x;	
				}//end if ($dx==$x) {
				
				
			if ($y!=$dy){
				if (($dy>$y) && (($layer==0) || ($layer==2))) {
				$new_y = ($y+1);
				$new_layer = 2;
				//echo '<p>greater than y</p>';
				//echo $new_y;	
				}
				if (($dy<$y) && (($layer==0) || ($layer==2))) {
				$new_y = ($y-1);
				$new_layer = 2;
				//echo '<p>less than y</p>';
				//echo $new_y;	
				}
				
			}// end if ($y!=$dy){
				
				if ($dy==$y) {
				$new_y = $y;
				//echo '<p>equal to y</p>';
				//echo $new_y;	
				}//end if ($dy==$y) {
					
				
				
				
				
				
				if (($dlayer!=2) && ($x==$dx) && ($y==$dy) && ($layer!=$dlayer)){
					$new_layer = $dlayer;
				}//end if (($x==$dx) && ($y==$dy) && ($layer!=$dlayer)){
					
				if ((($x!=$dx) || ($y!=$dy)) && ($layer==1)){
					$new_layer = 0;
					$new_x = $x;
					$new_y = $y;
				}
				
				if ($new_layer==2){
				$query2 = "SELECT planet_id FROM planets WHERE x = '" . $new_x . "' AND y = '" . $new_y . "'";
					$data2 = mysqli_query($dbc, $query2);
  						if (mysqli_num_rows($data2) == 1) { 
		  				while ($row = mysqli_fetch_array($data2)) {
			  				
							$new_layer = 0;
			  			
		  				}
					}
				}
			
			
			//echo '<p>New Fleet</p>';
			
			$query2 = "UPDATE fleets SET x = '" . $new_x . "', y = '" . $new_y . "', layer = '" . $new_layer . "' WHERE fleet_id = '" . $fleet_id . "'";
		mysqli_query($dbc, $query2);
		}//end if (($x!=$dx) || ($y!=$dy) || ($layer!=$dlayer)) {
		
		
		
		}	
		
		
	 mysqli_close($dbc);
  
 
?>
