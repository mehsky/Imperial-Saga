<?php

  require_once('startsession.php');
  
  $page_title = 'Local Market';

  require_once('game_header.php');

  require_once('connectvars.php');
  
 
          $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  		  $color_code = 1;
  
  $planet_id = $_REQUEST["planetid"];
  
 		if (isset($_POST['submit'])) {

		$deleted_market_order = mysqli_real_escape_string($dbc, trim($_POST['order']));
		
		
$query = "SELECT planet_id, product_id, buyer_planet_id, quantity FROM market WHERE sale_id = " . $deleted_market_order . "";
			
					$data = mysqli_query($dbc, $query);
					if (mysqli_num_rows($data) == 1) { 
						while ($row = mysqli_fetch_array($data)) {
							
							$planet_id = $row['planet_id'];
							$product_id = $row['product_id'];
							$buyer_planet_id = $row['buyer_planet_id'];
							$quantity = $row['quantity'];
			
			
		  	}//end while ($row = mysqli_fetch_array($data)) {
		}//end if (mysqli_num_rows($data) == 1) { 
		
		if ($buyer_planet_id==0){
					if ($product_id==1){
						
						$sql_widget='ore_mined';
						$msg_widget='Ore';
					}
					if ($product_id==2){
						
						
						$sql_widget='trade_goods';
						$msg_widget='Trade goods';
					}
					if ($product_id==3){
						
						$sql_widget='scandium';
						$msg_widget='Scandium';
					}
					if ($product_id==4){
						
						$sql_widget='neodymium';
						$msg_widget='Neodymium';
					}
					if ($product_id==5){
					
						$sql_widget='promethium';
						$msg_widget='Promethium';
					}
					if ($product_id==6){
						
						$sql_widget='erbium';
						$msg_widget='Erbium';
					}
					if ($product_id==7){
						
						$sql_widget='yttrium';
						$msg_widget='Yttrium';
					}
					
					
					$query = "SELECT " . $sql_widget . " FROM planets WHERE planet_id = " . $planet_id . "";
			
					$data = mysqli_query($dbc, $query);
					if (mysqli_num_rows($data) == 1) { 
						while ($row = mysqli_fetch_array($data)) {
							
							$orig_quantity = $row[$sql_widget];
							
							$new_quantity = ($quantity+$orig_quantity);
			
		  	}//end while ($row = mysqli_fetch_array($data)) {
		}//end if (mysqli_num_rows($data) == 1) { 
					
					
		
		
		$query = "UPDATE planets SET " . $sql_widget . " = '" . $new_quantity . "' WHERE planet_id = '" . $planet_id . "'";
					mysqli_query($dbc, $query);
					
					
					
		$query = "DELETE FROM market WHERE sale_id='" . $deleted_market_order . "'";
					mysqli_query($dbc, $query);			
					
					

		
		}//end if ($buyer_planet_id==0){
			
		else {
			$message = 'That order has already been sold';
		}
		
	}//end if (isset($_POST['submit'])) {




 $query1 = "SELECT player_id, planet_name, x, y FROM planets WHERE planet_id = '" . $planet_id . "'";
  $data1 = mysqli_query($dbc, $query1);
  		if (mysqli_num_rows($data1) == 1) { 
		  while ($row = mysqli_fetch_array($data1)) {
			$planet_name = $row['planet_name'];
			$player_id2 = $row['player_id'];
			$x = $row['x'];
			$y = $row['y'];
			}//end while ($row = mysqli_fetch_array($data2)) {
		}//end if (mysqli_num_rows($data2) == 1) { 
		
		
			require_once('navmenu.php');
			
			echo '<div id="allcontent">';		
		
		  
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  if ($user_playerid == $player_id2) {
				echo '<h1><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a>(' . $x . ', ' . $y . ') Current Orders</h1><p align="right"><a href="market.php?planetid=' . $planet_id . '">Local Market</a></p>';
   				echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    				echo '<fieldset>';
      					echo '<legend>Current Sell Orders</legend>';
						echo '<p>You can cancel any sale orders here.</p>';
						echo '<table border="0">';
						 $query2 = "SELECT sale_id, planet_id, buyer_planet_id, product_id, price, quantity FROM market WHERE planet_id = '" . $planet_id . "' AND buyer_planet_id = 0";
						 
					
		$data2 = mysqli_query($dbc, $query2);
		  while ($row = mysqli_fetch_array($data2)) {
			
			$sale_id = $row['sale_id'];
			$planet_id = $row['planet_id'];
			$product_id = $row['product_id'];
			$price = $row['price'];
			$quantity = $row['quantity'];
		
			
							if ($product_id==1) {
								$product = 'Ore';
							}
							if ($product_id==2) {
								$product = 'Trade Goods';
							}
							if ($product_id==3) {
								$product = 'Scandium';
							}
							if ($product_id==4) {
								$product = 'Neodymium';
							}
							if ($product_id==5) {
								$product = 'Promethium';
							}
							if ($product_id==6) {
								$product = 'Erbium';
							}
							if ($product_id==7) {
								$product = 'Yttrium';
							}
							
							
				if ($color_code == 1) {
					$row_color = '#222222';	
					$color_code = 2;
				}
				else {
					$row_color = '#000000';	
					$color_code = 1;
				}
							
			
			
							echo '<tr bgcolor=' . $row_color . '><td>' . $product . '</td><td>Quantity: ' . $quantity . '</td><td>Price: ' . $price . '</td></tr>';
							echo '<tr bgcolor=' . $row_color . '><td>Confirm canceling of order<input type="radio" name="order" value="' . $sale_id . '" /></td><td><input type="submit" value="Cancel" name="submit" /></td><td></td></tr>';
							echo '<input type="hidden" name="planetid" value="' . $planet_id . '" />';
							echo '</br>';
						
			
			
			
			}//end while ($row = mysqli_fetch_array($data2)) {
	
						echo '</form>';
						
						echo '</table>';
						echo '</fieldset>';
						
						
						
    				echo '<fieldset>';
      					echo '<legend>Orders Purchased</legend>';
						echo '<p>Here you can see your purchases and their ETA.</p>';
						echo '<table border="0">';
						 $query2 = "SELECT sale_id, planet_id, product_id, price, quantity, time FROM market WHERE buyer_planet_id = '" . $planet_id . "'";
						 
					
		$data2 = mysqli_query($dbc, $query2);
		  while ($row = mysqli_fetch_array($data2)) {
			
			$sale_id = $row['sale_id'];
			$sell_planet_id = $row['planet_id'];
			$product_id = $row['product_id'];
			$price = $row['price'];
			$quantity = $row['quantity'];
			$time = $row['time'];
				
				$query3 = "SELECT planet_name, x, y FROM planets WHERE planet_id = '" . $sell_planet_id . "'";
					$data3 = mysqli_query($dbc, $query3);
		  				while ($row = mysqli_fetch_array($data3)) {
								$planet_name = $row['planet_name'];
								$x = $row['x'];
								$y = $row['y'];
						}
			
							if ($product_id==1) {
								$product = 'Ore';
							}
							if ($product_id==2) {
								$product = 'Trade Goods';
							}
							if ($product_id==3) {
								$product = 'Scandium';
							}
							if ($product_id==4) {
								$product = 'Neodymium';
							}
							if ($product_id==5) {
								$product = 'Promethium';
							}
							if ($product_id==6) {
								$product = 'Erbium';
							}
							if ($product_id==7) {
								$product = 'Yttrium';
							}
							
							
				if ($color_code == 1) {
					$row_color = '#222222';	
					$color_code = 2;
				}
				else {
					$row_color = '#000000';	
					$color_code = 1;
				}
							
			
			
							echo '<tr bgcolor=' . $row_color . '><td>' . $product . '</td><td>Quantity: ' . $quantity . '</td><td>Paid: ' . $price . ' credits</td></tr>';
							echo '<tr bgcolor=' . $row_color . '><td>From: ' . $planet_name . ' (' . $x . ',' . $y . ')</td><td>ETA: ' . $time . ' days</td><td></td></tr>';
							echo '<input type="hidden" name="planetid" value="' . $planet_id . '" />';
							echo '</br>';
						
			
			
			
			}//end while ($row = mysqli_fetch_array($data2)) {
	
						echo '</fieldset>';
						echo '</table>';
	   			
			
  
  
  
  
  
  
  				}//end if ($user_playerid == $player_id2) {
			
			else {
				//the check for fleets needs to go here once the table is up
				echo '<p>You do not own this planet, nice try.</p>';
			
			}
			
			
			
	
	
			
 mysqli_close($dbc);			
?>










</div>


</body>
</html>