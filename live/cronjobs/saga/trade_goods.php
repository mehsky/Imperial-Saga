<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT ore_mined, trade_goods, industry, planet_id FROM planets WHERE active = 1";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$ore_mined = $row['ore_mined'];
		$trade_goods = $row['trade_goods'];
		$planet_id = $row['planet_id'];
		$industry = $row['industry'];
		
		
		if (($ore_mined)>=$industry) {
			$ore_used = ($industry);
			$new_tgs = ($industry)*10;
		}
		else {
			$ore_used = $ore_mined;       //(floor($ore_mined/10))*10;			
			$new_tgs = $ore_used*10;	
		}
		$ore_remaining = $ore_mined-$ore_used;
		$total_tgs = $trade_goods+$new_tgs;
		
		
	
			$query2 = "UPDATE planets SET ore_mined = '$ore_remaining', trade_goods = '$total_tgs' WHERE planet_id = '$planet_id'";
		mysqli_query($dbc, $query2);
		
		
		
		
		}	
		
		
	 mysqli_close($dbc);
  
 
?>
