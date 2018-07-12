<?php

  require_once('startsession.php');
  
  $page_title = 'Transfer Goods';

  require_once('game_header.php');

  require_once('connectvars.php');
  
 
          $user_playerid = $user->data['user_id'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  $planet_id = $_REQUEST["planetid"];
  
  
  
  
  
  	
  
		
	if (isset($_POST['patriarch'])) {
		
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
				$dest_planet = mysqli_real_escape_string($dbc, trim($_POST['dest_planet']));
				
				$query1 = "SELECT x, y FROM planets WHERE planet_id = '" . $dest_planet . "'";
  $data1 = mysqli_query($dbc, $query1);
  		if (mysqli_num_rows($data1) == 1) { 
		  while ($row = mysqli_fetch_array($data1)) {
			
			$dx = $row['x'];
			$dy = $row['y'];
			
			}//end while ($row = mysqli_fetch_array($data1)) {
		}//end if (mysqli_num_rows($data2) == 1) { 
				
				
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
				
				
					if ($product==1){
						$widget=$ored_mined;
						$sql_widget='ore_mined';
						$msg_widget='Ore';
					}
					if ($product==2){
						
						$widget=$trade_goods;
						$sql_widget='trade_goods';
						$msg_widget='Trade Goods';
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
				
						
						
						$query1 = "INSERT INTO transfer_goods (planet_id, transfer_planet_id, product_id, quantity, time) VALUE ('" . $planet_id . "', '" . $dest_planet . "', '" . $product . "', '" . $quantity . "', '" . $eta . "')";
			mysqli_query($dbc, $query1);	
			
					$error = 'You have created a supply transfer successfully.';
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
		
		
		
			
			
			 require_once('navmenu.php');
			
			echo '<div id="allcontent">';		
		
		
		
		
		
		
		  		  
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  if ($user_playerid == $player_id2) {
				echo '<h1><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a>(' . $x . ', ' . $y . ') Supply Transfer</h1><p align="right"><a href="current_transfers.php?planetid=' . $planet_id . '">Current Transfers</a></p>';
   				echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    				echo '<fieldset>';
      					echo '<legend>Setup a Transfer</legend>';
						
						echo '<table>';
						
	   			echo '<tr><td><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a> (' . $x . ', ' . $y . ')</td><td>Ore: ' . $ore_mined . '</td><td>Trade Goods: ' . $trade_goods . '</td></tr>';
				echo '<tr><td>Scandium: ' . $scandium . '</td><td>Neodymium: ' . $neodymium . '</td><td>Promethium: ' . $promethium . '</td></tr>';
				echo '<tr><td>Erbium: ' . $erbium . '</td><td>Yttrium: ' . $yttrium . '</td><td></td></tr>';
				
				echo '</table>';
				
				
				echo '<p> Select a product to transfer to another planet of yours. Quantity cannot exceed the amount you have possesion of on this planet.</p>';
				
				
				
				
				
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
				echo '<p class="error">' . $error . '</p>';
				echo '<table>';
				echo '<tr><td><label for="quantity">Quantity:</label></td><td><input type="text" name="quantity" value="0" /></td><td><label for="planet">Planet:</label></td><td><p><select name="dest_planet">';
				
				$query1 = "SELECT planet_id, planet_name FROM planets WHERE planet_id != '" . $planet_id . "' AND player_id = '" . $user_playerid . "'";
  $data1 = mysqli_query($dbc, $query1); 
		  while ($row = mysqli_fetch_array($data1)) {
			
			$list_planet_id = $row['planet_id'];
			$list_planet_name = $row['planet_name'];
			echo '<option value=' . $list_planet_id . '>' . $list_planet_name .'</option>';
			
			
		  	}//end while ($row = mysqli_fetch_array($data1)) {

				
				
				
				
				
				
				echo '</select></td>';
				echo '<input type="hidden" name="planetid" value="' . $planet_id . '" />';
				echo '<td><input type="submit" value="Sell" name="patriarch" /></td></tr>';

	  			echo '</table>';
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