<?php

  require_once('startsession.php');
  
  $page_title = 'Infrastructure Management';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
          $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  $planet_id = $_REQUEST["planetid"];


  
  
			
  if (isset($_POST['patriarch'])) {
	  
	  			
				
				
				$population = mysqli_real_escape_string($dbc, trim($_POST['population']));
				$trade_goods = mysqli_real_escape_string($dbc, trim($_POST['trade_goods']));
				$current_armies = mysqli_real_escape_string($dbc, trim($_POST['current_armies']));
				$new_armies = mysqli_real_escape_string($dbc, trim($_POST['new_armies']));
				$current_armies = mysqli_real_escape_string($dbc, trim($_POST['current_armies']));
				
			
			

				$population_cost = ($new_armies*10);
				$trade_goods_cost = ($new_armies*100);
				$currency_cost = ($new_armies*1500);

				
				$updated_population = ($population-$population_cost);
				$updated_trade_goods = ($trade_goods-$trade_goods_cost);
				$updated_currency = ($credits-$currency_cost);
				$updated_armies = ($new_armies+$current_armies);
						
				
				
				if (($updated_population>=0)&&($updated_trade_goods>=0)&&($updated_currency>=0)) {
					
				$query3 = "UPDATE players SET credits = '" . $updated_currency . "' WHERE player_id = '" . $user_playerid . "'";
					mysqli_query($dbc, $query3);	
					
				$query3 = "UPDATE planets SET population = '" . $updated_population . "', trade_goods = '" . $updated_trade_goods . "' WHERE planet_id = '" . $planet_id . "'";
					mysqli_query($dbc, $query3);
					if ($current_armies==0) {
							$query1 = "INSERT INTO armies (player_id, planet_id, quantity) VALUE ('" . $user_playerid . "', '" . $planet_id . "', '" . $updated_armies . "')";
			mysqli_query($dbc, $query1);	
						
					}
					else {
						$query3 = "UPDATE armies SET quantity = '" . $updated_armies . "' WHERE player_id = '" . $user_playerid . "' AND planet_id = '" . $planet_id . "'";
						mysqli_query($dbc, $query3);
						
					}
					
				}

				
}//end if (isset($_POST['patriarch'])) {
				
  
  
  
  
  
  
  
  $query2 = "SELECT player_id, planet_name, x, y, population, trade_goods FROM planets WHERE planet_id = '" . $planet_id . "'";
  $data2 = mysqli_query($dbc, $query2);
  		if (mysqli_num_rows($data2) == 1) { 
		  while ($row = mysqli_fetch_array($data2)) {
			  
			$player_id2 = $row['player_id'];
			$planet_name = $row['planet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$population = $row['population'];
			$trade_goods = $row['trade_goods'];
			
		  	}
		
          
		}
		
	$query2 = "SELECT quantity FROM armies WHERE planet_id = '" . $planet_id . "' and player_id = '" . $user_playerid . "'";
  $data2 = mysqli_query($dbc, $query2);
  		if (mysqli_num_rows($data2) == 1) { 
		  while ($row = mysqli_fetch_array($data2)) {
			  
			$quantity = $row['quantity'];
			
		  	}
		
          
		}	
		else {
			$quantity = 0;	
		}
		
		
		
		require_once('navmenu.php');
				  ?>
<div id="allcontent">
	
		  <?php
		  		
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  if ($user_playerid == $player_id2) {
				  
				

			
				
				echo '<div id="poverview">';
   				echo '<table>';
	   			echo '<tr><td><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a> (' . $x . ', ' . $y . ')</td><td>Armies: ' . $quantity . '</td></tr><tr><td>Population: ' . $population . '</td><td>Trade Goods Available: ' . $trade_goods . '</td></tr>';

	  			echo '</table>';
   				echo '</div>';
				
  
  ?>
  
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Build Fleets</legend>
      
      <?php
	  	echo '<p>Here you can recruit more armies.</p>';

	  ?>
  <table>
  <tr><td><label for="armies">New armies:</label></td><td><input type="text" name="new_armies" value="0" /><br /></td><td><p>Credits: 1500</p><p>Trade Goods: 100</p><p>Population: 10</p></td></tr>

  </td></tr>
    
  <tr><td></td><td> <input type="submit" value="Submit" name="patriarch" /></td><td></td><td></td></tr>
  
  <input type="hidden" name="planetid" value="<?php echo $planet_id; ?>" />


  <input type="hidden" name="population" value="<?php echo $population; ?>" />
  
  <input type="hidden" name="trade_goods" value="<?php echo $trade_goods; ?>" />
  <input type="hidden" name="current_armies" value="<?php echo $quantity; ?>" />


  
  
  			
  
  </table>
<?php

		if ($enter==1) {
			echo '<p>Your ships have been built.</p>';
		}
		if ($enter==2) {
			echo '<p>Only positive whole numbers may be entered.</p>';
		}
		if ($enter==3) {
			echo '<p>Either you do not have enough credits, ship labor, trade goods or metal to build that many ships.</p>';
		}
		
		
?>
  
    
    </fieldset>
   
  </form>
  
  <?php
  
  
  
			  
			  }
			
			else {
				//the check for fleets needs to go here once the table is up
				echo '<p>You do not own this planet, nice try.</p>';
			
			}
			
			
			
	
	
			
 mysqli_close($dbc);			
?>










</div>


</body>
</html>