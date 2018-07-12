<?php
 // Define database connection constants
require_once('connectvars.php');
  
 
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "SELECT transfer_id, planet_id, transfer_planet_id, product_id, quantity, time FROM transfer_goods WHERE transfer_planet_id != 0";
	$data1 = mysqli_query($dbc, $query1);
	
	while($row = mysqli_fetch_array($data1)) {
		$transfer_id = $row['transfer_id'];
		$planet_id = $row['planet_id'];
		$transfer_planet_id = $row['transfer_planet_id'];
		$product_id = $row['product_id'];
		
		$quantity = $row['quantity'];
		$time = $row['time'];
		
		
		
					if ($product_id==1){
						$widget=$ored_mined;
						$sql_widget='ore_mined';
						$msg_widget='Ore';
					}
					if ($product_id==2){
						
						$widget=$trade_goods;
						$sql_widget='trade_goods';
						$msg_widget='Trade goods';
					}
					if ($product_id==3){
						$widget=$scandium;
						$sql_widget='scandium';
						$msg_widget='Scandium';
					}
					if ($product_id==4){
						$widget=$neodymium;
						$sql_widget='neodymium';
						$msg_widget='Neodymium';
					}
					if ($product_id==5){
						$widget=$promethium;
						$sql_widget='promethium';
						$msg_widget='Promethium';
					}
					if ($product_id==6){
						$widget=$erbium;
						$sql_widget='erbium';
						$msg_widget='Erbium';
					}
					if ($product_id==7){
						$widget=$yttrium;
						$sql_widget='yttrium';
						$msg_widget='Yttrium';
					}
					$new_time = ($time-1);
					
					echo $sql_widget;
		
		echo '<h1>New sale order</h1>';
		echo '<p>' . $transfer_id . ' - ' . $planet_id . ', seller id - ' . $transfer_planet_id . ', product = ' . $msg_widget . ', quantity - ' . $quantity . ' and time ' . $time . '</p>';
		
		
		
		if ($new_time>=1) {
			
			$query2 = "UPDATE transfer_goods SET time = '" . $new_time . "'WHERE transfer_id = '" . $transfer_id . "'";
		mysqli_query($dbc, $query2);
			echo $query2;
		}//end if ($new_time>=1) {
		
		
				
				
				
				else {
			
			
					if ($product_id==1){
						
						$query1 = "SELECT ore_mined FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
						$data1 = mysqli_query($dbc, $query1);
	
						while($row = mysqli_fetch_array($data1)) {
							$product = $row['ore_mined'];
							}//end while($row = mysqli_fetch_array($data1)) {
						
					}
					if ($product_id==2){
						
						$query1 = "SELECT trade_goods FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
						$data1 = mysqli_query($dbc, $query1);
	
						while($row = mysqli_fetch_array($data1)) {
							$product = $row['trade_goods'];
							}//end while($row = mysqli_fetch_array($data1)) {
						
					}
					if ($product_id==3){
						
						$query1 = "SELECT scandium FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
						$data1 = mysqli_query($dbc, $query1);
	
						while($row = mysqli_fetch_array($data1)) {
							$product = $row['scandium'];
							}//end while($row = mysqli_fetch_array($data1)) {
						
					}
					if ($product_id==4){
						
						$query1 = "SELECT neodymium FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
						$data1 = mysqli_query($dbc, $query1);
	
						while($row = mysqli_fetch_array($data1)) {
							$product = $row['neodymium'];
							}//end while($row = mysqli_fetch_array($data1)) {
						
					}
					if ($product_id==5){
						
						$query1 = "SELECT promethium FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
						$data1 = mysqli_query($dbc, $query1);
	
						while($row = mysqli_fetch_array($data1)) {
							$product = $row['promethium'];
							}//end while($row = mysqli_fetch_array($data1)) {
						
					}
					if ($product_id==6){
						
						$query1 = "SELECT erbium FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
						$data1 = mysqli_query($dbc, $query1);
	
						while($row = mysqli_fetch_array($data1)) {
							$product = $row['erbium'];
							}//end while($row = mysqli_fetch_array($data1)) {
						
					}
					if ($product_id==7){
						
						$query1 = "SELECT yttrium FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
						$data1 = mysqli_query($dbc, $query1);
	
						while($row = mysqli_fetch_array($data1)) {
							$product = $row['yttrium'];
							}//end while($row = mysqli_fetch_array($data1)) {
						
					}
					$new_total = ($product+$quantity);
					
					
					
					$query2 = "UPDATE planets SET " . $sql_widget . " = " . $new_total . " WHERE planet_id = '" . $transfer_planet_id . "'";
						mysqli_query($dbc, $query2);
					echo $query2;
			
					$query = "DELETE FROM transfer_goods WHERE transfer_id='" . $transfer_id . "'";
					mysqli_query($dbc, $query);				
					
		}//end else {
		
		
		}//end while($row = mysqli_fetch_array($data1)) {	
		
		
	 mysqli_close($dbc);
  
 
?>
