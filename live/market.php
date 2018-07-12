<?php

  require_once('startsession.php');
  
  $page_title = 'Local Market';

  require_once('game_header.php');

  require_once('connectvars.php');
  
 
          $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  $planet_id = $_REQUEST["planetid"];
  
  
  
  
  
  	
  
		
	if (isset($_POST['submit1'])) {
		
		  $query1 = "SELECT player_id, planet_name, x, y, scandium, neodymium, promethium, erbium, yttrium, ore_mined, trade_goods FROM planets WHERE planet_id = '" . $planet_id . "'";
  $data1 = mysqli_query($dbc, $query1);
  		if (mysqli_num_rows($data1) == 1) { 
		  while ($row = mysqli_fetch_array($data1)) {
			
			$player_id2 = $row['player_id'];
			$planet_name = $row['planet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$scandium = $row['scandium'];
			$neodymium = $row['neodymium'];
			$promethium = $row['promethium'];
			$erbium = $row['erbium'];
			$yttrium = $row['yttrium'];
			$ore_mined = $row['ore_mined'];
			$trade_goods = $row['trade_goods'];
			
			
		  	}//end while ($row = mysqli_fetch_array($data1)) {
		}//end if (mysqli_num_rows($data2) == 1) { 
		
		
		
		
		
				$product = mysqli_real_escape_string($dbc, trim($_POST['product']));
				$quantity = mysqli_real_escape_string($dbc, trim($_POST['quantity']));
				$price = mysqli_real_escape_string($dbc, trim($_POST['price']));
				echo $product;
					if ($product==1){
						$widget=$ored_mined;
						$sql_widget='ore_mined';
						$msg_widget='Ore';
					}
					if ($product==2){
						
						$widget=$trade_goods;
						$sql_widget='trade_goods';
						$msg_widget='Trade goods';
					}
					if ($product==3){
						$widget=$scandium;
						$sql_widget='scandium';
						$msg_widget='Scandium';
					}
					if ($product==4){
						$widget=$neodymium;
						$sql_widget='neodymium';
						$msg_widget='Neodymium';
					}
					if ($product==5){
						$widget=$promethium;
						$sql_widget='promethium';
						$msg_widget='Promethium';
					}
					if ($product==6){
						$widget=$erbium;
						$sql_widget='erbium';
						$msg_widget='Erbium';
					}
					if ($product==7){
						$widget=$yttrium;
						$sql_widget='yttrium';
						$msg_widget='Yttrium';
					}
					
					if ($quantity<=$widget) {
						
						$new_amount = ($widget-$quantity);
						
						$query1 = "UPDATE planets SET " . $sql_widget . " = " . $new_amount . " WHERE planet_id = " . $planet_id . "";
			mysqli_query($dbc, $query1);
					
						
						
						$query1 = "INSERT INTO market (planet_id, product_id, price, quantity) VALUE ('" . $planet_id . "', '" . $product . "', '" . $price . "', '" . $quantity . "')";
			mysqli_query($dbc, $query1);					
					}//end if ($quantity<=$widget) {
					else {
					$error = 'You do not have that much ' . $msg_widget . '.';	
					}
					
		
		
	}//end if (isset($_POST['submit'])) {




 $query1 = "SELECT player_id, planet_name, x, y, scandium, neodymium, promethium, erbium, yttrium, ore_mined, trade_goods FROM planets WHERE planet_id = '" . $planet_id . "'";
  $data1 = mysqli_query($dbc, $query1);
  		if (mysqli_num_rows($data1) == 1) { 
		  while ($row = mysqli_fetch_array($data1)) {
			
			$player_id2 = $row['player_id'];
			$planet_name = $row['planet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$scandium = $row['scandium'];
			$neodymium = $row['neodymium'];
			$promethium = $row['promethium'];
			$erbium = $row['erbium'];
			$yttrium = $row['yttrium'];
			$ore_mined = $row['ore_mined'];
			$trade_goods = $row['trade_goods'];
			$px = $x + 5;
			$nx = $x - 5;
			$py = $y + 5;
			$ny = $y - 5;
			
			
		  	}//end while ($row = mysqli_fetch_array($data2)) {
		}//end if (mysqli_num_rows($data2) == 1) { 
		
		
		
			if (isset($_POST['submit2'])) {
		
			
		
		
		
		$bought_sale_id = mysqli_real_escape_string($dbc, trim($_POST['order']));
		
			$query2 = "SELECT planets.player_id, planets.planet_name, planets.x, planets.y, market.planet_id, market.product_id, market.price, market.quantity FROM planets INNER JOIN market USING (planet_id) WHERE sale_id = " . $bought_sale_id . "";
			
					$data2 = mysqli_query($dbc, $query2);
						while ($row = mysqli_fetch_array($data2)) {
							$seller_player_id = $row['player_id'];
							$bought_planet_name = $row['planet_name'];
							$bought_x = $row['x'];
							$bought_y = $row['y'];
							$seller_planet_id = $row['planet_id'];
							$bought_product_id = $row['product_id'];
							$bought_price = $row['price'];
							$bought_quantity = $row['quantity'];
							
							
							if ($bought_x>$x) {
								$dx = $bought_x-$x;	
							}
							else {
								$dx = $x-$bought_x;	
							}
							
							if ($bought_y>$y) {
								$dy = $bought_y-$y;	
							}
							else {
								$dy = $y-$bought_y;	
							}
							$eta = ceil((sqrt(($dx*$dx)+($dy*$dy))));
							
							if ($bought_product_id=1) {
								$bought_product = 'Ore';
							}
							if ($bought_product_id=2) {
								$bought_product = 'Trade Goods';
							}
							if ($bought_product_id=3) {
								$bought_product = 'Scandium';
							}
							if ($bought_product_id=4) {
								$bought_product = 'Neodymium';
							}
							if ($bought_product_id=5) {
								$bought_product = 'Promethium';
							}
							if ($bought_product_id=6) {
								$bought_product = 'Erbium';
							}
							if ($bought_product_id=7) {
								$bought_product = 'Yttrium';
							}
							$message = '<p>You have purchased ' . $bought_quantity . ' from planet ' . $bought_planet_name . ' for ' . $bought_price . ' credits. It will take ' . $eta . ' days to arrive to this planet ID #' . $planet_id . '</p>';
					
					
						}
					
					$query3 = "SELECT credits FROM players WHERE player_id = " . $player_id2 . "";
					$data3 = mysqli_query($dbc, $query3);
						while ($row = mysqli_fetch_array($data3)) {
							$orig_credits = $row['credits'];
							$new_credits = $orig_credits-$bought_price;
							$seller_new_credits = ($new_credits*.9);
						
						}
					if ($orig_credits>=$bought_price) {
					$query3 = "UPDATE players SET credits = '" . $new_credits . "' WHERE player_id = '" . $player_id2 . "'";
					mysqli_query($dbc, $query3);
					
						$query3 = "UPDATE market SET buyer_planet_id = '" . $planet_id . "', time = '" . $eta . "' WHERE sale_id = '" . $bought_sale_id . "'";
					mysqli_query($dbc, $query3);
					
					
					$query3 = "SELECT credits FROM players WHERE player_id = " . $seller_player_id . "";
										$data3 = mysqli_query($dbc, $query3);
						while ($row = mysqli_fetch_array($data3)) {
							
							$seller_orig_credits = $row['credits'];
							$seller_new_credits = ($seller_orig_credits+($new_credits*.9));
							echo $seller_new_credits;
						}
						$query3 = "UPDATE players SET credits = '" . $seller_new_credits . "' WHERE player_id = '" . $seller_player_id . "'";
						echo $query3;
					mysqli_query($dbc, $query3);
						
					
					
					}//end if ($orig_credits>=$bought_credits) {
						else {
						$message = 'You cannot afford to buy those goods.';	
						}
				}//end 	if (isset($_POST['submit2'])) {
			
			 require_once('navmenu.php');
			
			echo '<div id="allcontent">';		
		
		
		
		
		
		
		  		  
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  if ($user_playerid == $player_id2) {
				echo '<h1><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a>(' . $x . ', ' . $y . ') Local Market</h1><p align="right"><a href="current_orders.php?planetid=' . $planet_id . '">Current Orders</a></p>';
   				echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    				echo '<fieldset>';
      					echo '<legend>Setup a Sale</legend>';
						echo '<table>';
						
	   			
				echo '<tr><td>Scandium: ' . $scandium . '</td><td>Neodymium: ' . $neodymium . '</td><td>Promethium: ' . $promethium . '</td></tr>';
				echo '<tr><td>Erbium: ' . $erbium . '</td><td>Yttrium: ' . $yttrium . '</td><td></td></tr>';
				echo '<tr><td>Ore: ' . $ore_mined . '</td><td>Trade Goods: ' . $trade_goods . '</td><td</td></tr>';
				
				echo '</table>';
				
				
				echo '<p> Select a product to sell to other players. Quantity cannot exceed the amount you have possesion of on this planet.</p>';
				
				
				
				
				
				echo '<p><select name="product">';
				
				if ($ore_mined>0) {
				echo '<option value="1">Ore - Available: ' . $ore_mined .'</option>';
				}
				if ($trade_goods>0) {
				echo '<option value="2">Trade Goods - Available: ' . $trade_goods .'</option>';
				}
				if ($scandium>0) {
				echo '<option value="3">Scandium - Available: ' . $scandium .'</option>';
				}
				if ($neodymium>0) {
				echo '<option value="4">Neodymium - Available: ' . $neodymium .'</option>';
				}
				if ($promethium>0) {
				echo '<option value="5">Promethium - Available: ' . $promethium .'</option>';
				}
				if ($erbium>0) {
				echo '<option value="6">Erbium - Available: ' . $erbium .'</option>';
				}
				if ($yttrium>0) {
				echo '<option value="7">Yttrium - Available: ' . $yttrium .'</option>';
				}
				
				echo '</select></p>';
				echo '<table>';
				echo '<tr><td><label for="quantity">Quantity:</label></td><td><input type="text" name="quantity" value="0" /></td><td><label for="price">Price:</label></td><td><input type="text" name="price" value="0" /></td>';
				echo '<input type="hidden" name="planetid" value="' . $planet_id . '" />';
				echo '<td><input type="submit" value="Sell" name="submit1" /></td></tr>';

	  			echo '</table>';
      

		if ($enter==1) {
			echo '<p>Your buildings have been built.</p>';
		}
		if ($enter==2) {
			echo '<p>Only whole numbers may be entered.</p>';
		}
		if ($enter==3) {
			echo '<p>Either you do not have enough land to build all of this on or you are short on labor or trade goods.</p>';
		}
	

    echo '</fieldset>';
   				 echo '<fieldset>';
      					echo '<legend>Buy</legend>';
						echo $message;
						echo '<table>';
						$query2 = "SELECT planets.player_id, planets.planet_name, planets.x, planets.y, market.sale_id, market.product_id, market.price, market.quantity FROM planets INNER JOIN market USING (planet_id) WHERE x < " . $px . " AND x > " . $nx . " AND y < " . $py . " AND y > " . $ny . " AND player_id != " . $player_id2 . " AND player_id != 1 AND buyer_planet_id = 0";
					
					$data2 = mysqli_query($dbc, $query2);
						while ($row = mysqli_fetch_array($data2)) {
							$player_id = $row['player_id'];
							$seller_planet_name = $row['planet_name'];
							$ox = $row['x'];
							$oy = $row['y'];
							$sale_id = $row['sale_id'];
							$product_id = $row['product_id'];
							$price = $row['price'];
							$quantity = $row['quantity'];
							
							if ($ox>$x) {
								$dx = $ox-$x;	
							}
							else {
								$dx = $x-$ox;	
							}
							
							if ($oy>$y) {
								$dy = $oy-$y;	
							}
							else {
								$dy = $y-$oy;	
							}
							$eta = ceil((sqrt(($dx*$dx)+($dy*$dy))));
							
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
							
							echo '<tr><td>' . $product . '</td><td>Location: ' . $seller_planet_name . ' (' . $ox . ',' . $oy . ')</td><td>ETA: ' . $eta . ' Days</td></tr>';
							echo '<tr><td>Quantity: ' . $quantity . '</td><td>Price: ' . $price . '</td><td></td><tr>';
							echo '<tr><td>Confirm Purchase<input type="radio" name="order" value="' . $sale_id . '" /></td><td><input type="submit" value="Buy" name="submit2" /></td><td></td></tr>';
							echo '<input type="hidden" name="planetid" value="' . $planet_id . '" />';
							echo '</br>';
							
						}//end while ($row = mysqli_fetch_array($data2)) {
						
						echo '</table>';
   
   
  echo '</form>';
  
   echo '</fieldset>';
   			 
  
  
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