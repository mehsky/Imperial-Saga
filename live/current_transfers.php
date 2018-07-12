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
				echo '<h1><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a>(' . $x . ', ' . $y . ') Current Transfers</h1><p align="right"><a href="transfer_goods.php?planetid=' . $planet_id . '">Set Up Transfer</a></p>';
   				
    				echo '<fieldset>';
      					echo '<legend>Outgoing Transfers</legend>';
						echo '<p>These are supplies that have left your planet and are en route to another.</p>';
						echo '<table border="0">';
						 $query2 = "SELECT transfer_id, planet_id, transfer_planet_id, product_id, quantity, time FROM transfer_goods WHERE planet_id = '" . $planet_id . "'";
						 
					
		$data2 = mysqli_query($dbc, $query2);
		  while ($row = mysqli_fetch_array($data2)) {
			
			$transfer_id = $row['transfer_id'];
			$planet_id = $row['planet_id'];
			$transfer_planet_id = $row['transfer_planet_id'];
			$product_id = $row['product_id'];
			$time = $row['time'];
			$quantity = $row['quantity'];
					
					$query3 = "SELECT planet_name, x, y FROM planets WHERE planet_id = '" . $transfer_planet_id . "'";
					
						$data3 = mysqli_query($dbc, $query3);
		  					while ($row = mysqli_fetch_array($data3)) {
									$transfer_planet_name = $row['planet_name'];
									$transfer_x = $row['x'];
									$transfer_y = $row['y'];


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
							
			
			
							echo '<tr bgcolor=' . $row_color . '><td>' . $product . '</td><td>Quantity: ' . $quantity . '</td><td></td></tr>';
							echo '<tr bgcolor=' . $row_color . '><td>En Route To: ' . $transfer_planet_name . ' (' . $transfer_x . ',' . $transfer_y . ')</td><td>ETA: ' . $time . ' days</td><td></td></tr>';
							echo '</br>';
						
			
			
			
			}//end while ($row = mysqli_fetch_array($data2)) {
	
						
						echo '</table>';
						echo '</fieldset>';
						
						
						
    				echo '<fieldset>';
      					echo '<legend>Incoming Transfers</legend>';
						echo '<p>These are supplies coming here from another planet.</p>';
						echo '<table border="0">';
						
						
						 $query2 = "SELECT transfer_id, planet_id, product_id, quantity, time FROM transfer_goods WHERE transfer_planet_id = '" . $planet_id . "'";
						 
					
		$data2 = mysqli_query($dbc, $query2);
		  while ($row = mysqli_fetch_array($data2)) {
			
			$transfer_id = $row['transfer_id'];
			$from_planet_id = $row['planet_id'];
			$product_id = $row['product_id'];
			$quantity = $row['quantity'];
			$time = $row['time'];
				
				$query3 = "SELECT planet_name, x, y FROM planets WHERE planet_id = '" . $from_planet_id . "'";
					$data3 = mysqli_query($dbc, $query3);
		  				while ($row = mysqli_fetch_array($data3)) {
								$from_planet_name = $row['planet_name'];
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
							
			
			
							echo '<tr bgcolor=' . $row_color . '><td>' . $product . '</td><td>Quantity: ' . $quantity . '</td><td></td></tr>';
							echo '<tr bgcolor=' . $row_color . '><td>From: ' . $from_planet_name . ' (' . $x . ',' . $y . ')</td><td>ETA: ' . $time . ' days</td><td></td></tr>';
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