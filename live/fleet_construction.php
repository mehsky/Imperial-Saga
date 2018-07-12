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
  $enter = 0;

  
  
			
  if (isset($_POST['submit'])) {
	  
	  			// How much they want to build
				$fighters = mysqli_real_escape_string($dbc, trim($_POST['fighters']));
				$frigates = mysqli_real_escape_string($dbc, trim($_POST['frigates']));
				$carriers = mysqli_real_escape_string($dbc, trim($_POST['carriers']));
				$fleets = mysqli_real_escape_string($dbc, trim($_POST['fleets']));
				$metal_id = mysqli_real_escape_string($dbc, trim($_POST['metal_id']));


				if (is_numeric($fighters) && ($fighters>=0) && is_numeric($frigates) && ($frigates>=0) && is_numeric($carriers) && ($carriers>=0) && (($fighters>0) || ($frigates>0) || ($carriers>0))) {	
				
				$fighters = round($fighters);
				$frigates = round($frigates);
				$carriers = round($carriers);
				
				
				$credit_cost = (($fighters*900)+($frigates*2700)+($carriers*20250));
				$tg_cost = (($fighters*10)+($frigates*30)+($carriers*90));
				$metal_cost = (($fighters*1)+($frigates*3)+($carriers*9));
				$labor_cost = (($fighters*1)+($frigates*3)+($carriers*9));
				
				
				//IF PLAYER USES SCANDIUM METAL
				
				if ($metal_id==1) {
					 
					 
					$query5 = "SELECT planets.scandium, planets.trade_goods, planets.ship_labor, players.credits FROM planets INNER JOIN players USING (player_id) WHERE planet_id = '" . $planet_id . "'";
					$data5 = mysqli_query($dbc, $query5);
						while ($row = mysqli_fetch_array($data5)) {
							$scandium_quantity = $row['scandium'];
							$trade_goods = $row['trade_goods'];
							$ship_labor = $row['ship_labor'];
							$credits = $row['credits'];
							$scandium_cost = $metal_cost;
							
							$new_scandium = $scandium_quantity-$scandium_cost;
							$new_tgs = $trade_goods-$tg_cost;
							$new_sl = $ship_labor-$labor_cost;
							$new_credits = $credits-$credit_cost;
						}

					if (($credit_cost<=$credits) && ($tg_cost<=$trade_goods) && ($scandium_cost<=$scandium_quantity) && ($labor_cost<=$ship_labor)) {		
				
				
				if (!is_numeric($fleets)) {
					
					$query = "SELECT x, y FROM planets WHERE planet_id = '" . $planet_id . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
			  					$x = $row['x'];
								$y = $row['y'];
								$dx = $row['x'];
								$dy = $row['y'];
							}
					
					$fleet_name = 'no name';
					$query1 = "INSERT INTO fleets (player_id, fleet_name, x, y, dx, dy, cue_fighters, cue_frigates, cue_carriers) VALUE ('$user_playerid', '$fleet_name', '$x', '$y', '$dx', '$dy', '$fighters', '$frigates', '$carriers')";
					mysqli_query($dbc, $query1);
					
				}
				
				else {
					$query = "SELECT cue_fighters, cue_frigates, cue_carriers FROM fleets WHERE fleet_id = '" . $fleets . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
					
					$cue_fighters = $row['cue_fighters'];
					$cue_frigates = $row['cue_frigates'];
					$cue_carriers = $row['cue_carriers'];
					$new_fighters = $cue_fighters+$fighters;
					$new_frigates = $cue_frigates+$frigates;
					$new_carriers = $cue_carriers+$carriers;
				
							
							}
					
					
					
					$query1 = "UPDATE fleets SET cue_fighters = '$new_fighters', cue_frigates = '$new_frigates', cue_carriers = '$new_carriers', cue = 1 WHERE fleet_id = '" . $fleets . "'";
				mysqli_query($dbc, $query1);
				
					
					
				}
				
				
				
				
							
							
							
							
				$query1 = "UPDATE planets SET scandium = '$new_scandium', trade_goods = '$new_tgs', ship_labor = '$new_sl' WHERE planet_id = '" . $planet_id . "'";
				mysqli_query($dbc, $query1);
				
				$query1 = "UPDATE players SET credits = '$new_credits' WHERE player_id = '" . $user_playerid . "'";
				mysqli_query($dbc, $query1);
				
				$enter = 1;
				}
				
				else {
				$enter = 3;
			
			
			}
			
				}

//IF PLAYER USES neodymium METAL
				else if ($metal_id==2) {
					
					
					$query5 = "SELECT planets.neodymium, planets.trade_goods, planets.ship_labor, players.credits FROM planets INNER JOIN players USING (player_id) WHERE planet_id = '" . $planet_id . "'";
					$data5 = mysqli_query($dbc, $query5);
						while ($row = mysqli_fetch_array($data5)) {
							$neodymium_quantity = $row['neodymium'];
							$trade_goods = $row['trade_goods'];
							$ship_labor = $row['ship_labor'];
							$credits = $row['credits'];
							$neodymium_cost = $metal_cost;
							
							$new_neodymium = $neodymium_quantity-$neodymium_cost;
							$new_tgs = $trade_goods-$tg_cost;
							$new_sl = $ship_labor-$labor_cost;
							$new_credits = $credits-$credit_cost;
						}
					
					
					if (($credit_cost<=$credits) && ($tg_cost<=$trade_goods) && ($neodymium_cost<=$neodymium_quantity) && ($labor_cost<=$ship_labor)) {		
				
				
				if (!is_numeric($fleets)) {
					
					$query = "SELECT x, y FROM planets WHERE planet_id = '" . $planet_id . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
			  					$x = $row['x'];
								$y = $row['y'];
								$dx = $row['x'];
								$dy = $row['y'];
							}
					
					$fleet_name = 'no name';
					$query1 = "INSERT INTO fleets (player_id, fleet_name, x, y, dx, dy, cue_fighters, cue_frigates, cue_carriers) VALUE ('$user_playerid', '$fleet_name', '$x', '$y', '$dx', '$dy', '$fighters', '$frigates', '$carriers')";
					mysqli_query($dbc, $query1);
					
				}
				
				else {
					$query = "SELECT cue_fighters, cue_frigates, cue_carriers FROM fleets WHERE fleet_id = '" . $fleets . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
					
					$cue_fighters = $row['cue_fighters'];
					$cue_frigates = $row['cue_frigates'];
					$cue_carriers = $row['cue_carriers'];
					$new_fighters = $cue_fighters+$fighters;
					$new_frigates = $cue_frigates+$frigates;
					$new_carriers = $cue_carriers+$carriers;
				
							
							}
					
					
					
					$query1 = "UPDATE fleets SET cue_fighters = '$new_fighters', cue_frigates = '$new_frigates', cue_carriers = '$new_carriers', cue = 1 WHERE fleet_id = '" . $fleets . "'";
				mysqli_query($dbc, $query1);
				
					
					
				}
				
				
				
				
							
							
							
							
				$query1 = "UPDATE planets SET neodymium = '$new_neodymium', trade_goods = '$new_tgs', ship_labor = '$new_sl' WHERE planet_id = '" . $planet_id . "'";
				mysqli_query($dbc, $query1);
				
				$query1 = "UPDATE players SET credits = '$new_credits' WHERE player_id = '" . $user_playerid . "'";
				mysqli_query($dbc, $query1);
				
				$enter = 1;
				}
				
				else {
				$enter = 3;
			
			
			}
					
				 
				
				 
			 	}
				
				
				//IF PLAYER USES promethium METAL
			 	else if ($metal_id==3) {
					
					
					$query5 = "SELECT planets.promethium, planets.trade_goods, planets.ship_labor, players.credits FROM planets INNER JOIN players USING (player_id) WHERE planet_id = '" . $planet_id . "'";
					$data5 = mysqli_query($dbc, $query5);
						while ($row = mysqli_fetch_array($data5)) {
							$promethium_quantity = $row['promethium'];
							$trade_goods = $row['trade_goods'];
							$ship_labor = $row['ship_labor'];
							$credits = $row['credits'];
							$promethium_cost = $metal_cost;
							
							$new_promethium = $promethium_quantity-$promethium_cost;
							$new_tgs = $trade_goods-$tg_cost;
							$new_sl = $ship_labor-$labor_cost;
							$new_credits = $credits-$credit_cost;
						}
					
					
					if (($credit_cost<=$credits) && ($tg_cost<=$trade_goods) && ($promethium_cost<=$promethium_quantity) && ($labor_cost<=$ship_labor)) {		
				
				
				if (!is_numeric($fleets)) {
					
					$query = "SELECT x, y FROM planets WHERE planet_id = '" . $planet_id . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
			  					$x = $row['x'];
								$y = $row['y'];
								$dx = $row['x'];
								$dy = $row['y'];
							}
					
					$fleet_name = 'no name';
					$query1 = "INSERT INTO fleets (player_id, fleet_name, x, y, dx, dy, cue_fighters, cue_frigates, cue_carriers) VALUE ('$user_playerid', '$fleet_name', '$x', '$y', '$dx', '$dy', '$fighters', '$frigates', '$carriers')";
					mysqli_query($dbc, $query1);
					
				}
				
				else {
					$query = "SELECT cue_fighters, cue_frigates, cue_carriers FROM fleets WHERE fleet_id = '" . $fleets . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
					
					$cue_fighters = $row['cue_fighters'];
					$cue_frigates = $row['cue_frigates'];
					$cue_carriers = $row['cue_carriers'];
					$new_fighters = $cue_fighters+$fighters;
					$new_frigates = $cue_frigates+$frigates;
					$new_carriers = $cue_carriers+$carriers;
				
							
							}
					
					
					
					$query1 = "UPDATE fleets SET cue_fighters = '$new_fighters', cue_frigates = '$new_frigates', cue_carriers = '$new_carriers', cue = 1 WHERE fleet_id = '" . $fleets . "'";
				mysqli_query($dbc, $query1);
				
					
					
				}
				
				
				
				
							
							
							
							
				$query1 = "UPDATE planets SET promethium = '$new_promethium', trade_goods = '$new_tgs', ship_labor = '$new_sl' WHERE planet_id = '" . $planet_id . "'";
				mysqli_query($dbc, $query1);
				
				$query1 = "UPDATE players SET credits = '$new_credits' WHERE player_id = '" . $user_playerid . "'";
				mysqli_query($dbc, $query1);
				
				$enter = 1;
				}
				
				else {
				$enter = 3;
			
			
			}
					
					
				 
				 
			 	}
				
				
				
				//IF PLAYER USES erbium METAL
			 	else if ($metal_id==4) {
				 
				 
				 
				 $query5 = "SELECT planets.erbium, planets.trade_goods, planets.ship_labor, players.credits FROM planets INNER JOIN players USING (player_id) WHERE planet_id = '" . $planet_id . "'";
					$data5 = mysqli_query($dbc, $query5);
						while ($row = mysqli_fetch_array($data5)) {
							$erbium_quantity = $row['erbium'];
							$trade_goods = $row['trade_goods'];
							$ship_labor = $row['ship_labor'];
							$credits = $row['credits'];
							$erbium_cost = $metal_cost;
							
							$new_erbium = $erbium_quantity-$erbium_cost;
							$new_tgs = $trade_goods-$tg_cost;
							$new_sl = $ship_labor-$labor_cost;
							$new_credits = $credits-$credit_cost;
						}
					
					
					if (($credit_cost<=$credits) && ($tg_cost<=$trade_goods) && ($erbium_cost<=$erbium_quantity) && ($labor_cost<=$ship_labor)) {		
				
				
				if (!is_numeric($fleets)) {
					
					$query = "SELECT x, y FROM planets WHERE planet_id = '" . $planet_id . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
			  					$x = $row['x'];
								$y = $row['y'];
								$dx = $row['x'];
								$dy = $row['y'];
							}
					
					$fleet_name = 'no name';
					$query1 = "INSERT INTO fleets (player_id, fleet_name, x, y, dx, dy, cue_fighters, cue_frigates, cue_carriers) VALUE ('$user_playerid', '$fleet_name', '$x', '$y', '$dx', '$dy', '$fighters', '$frigates', '$carriers')";
					mysqli_query($dbc, $query1);
					
				}
				
				else {
					$query = "SELECT cue_fighters, cue_frigates, cue_carriers FROM fleets WHERE fleet_id = '" . $fleets . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
					
					$cue_fighters = $row['cue_fighters'];
					$cue_frigates = $row['cue_frigates'];
					$cue_carriers = $row['cue_carriers'];
					$new_fighters = $cue_fighters+$fighters;
					$new_frigates = $cue_frigates+$frigates;
					$new_carriers = $cue_carriers+$carriers;
				
							
							}
					
					
					
					$query1 = "UPDATE fleets SET cue_fighters = '$new_fighters', cue_frigates = '$new_frigates', cue_carriers = '$new_carriers', cue = 1 WHERE fleet_id = '" . $fleets . "'";
				mysqli_query($dbc, $query1);
				
					
					
				}
				

				
				
				
							
							
							
							
				$query1 = "UPDATE planets SET erbium = '$new_erbium', trade_goods = '$new_tgs', ship_labor = '$new_sl' WHERE planet_id = '" . $planet_id . "'";
				mysqli_query($dbc, $query1);
				
				$query1 = "UPDATE players SET credits = '$new_credits' WHERE player_id = '" . $user_playerid . "'";
				mysqli_query($dbc, $query1);
				
				$enter = 1;
				}
				
				else {
				$enter = 3;
			
			
			}
				 
				 
				 
				 
				 
				 
				
			 	}
				
				
				
				
				//IF PLAYER USES yttrium METAL
			 	else if ($metal_id==5) {
					
					
					
					$query5 = "SELECT planets.yttrium, planets.trade_goods, planets.ship_labor, players.credits FROM planets INNER JOIN players USING (player_id) WHERE planet_id = '" . $planet_id . "'";
					$data5 = mysqli_query($dbc, $query5);
						while ($row = mysqli_fetch_array($data5)) {
							$yttrium_quantity = $row['yttrium'];
							$trade_goods = $row['trade_goods'];
							$ship_labor = $row['ship_labor'];
							$credits = $row['credits'];
							$yttrium_cost = $metal_cost;
							
							$new_yttrium = $yttrium_quantity-$yttrium_cost;
							$new_tgs = $trade_goods-$tg_cost;
							$new_sl = $ship_labor-$labor_cost;
							$new_credits = $credits-$credit_cost;
						}
					
					
					if (($credit_cost<=$credits) && ($tg_cost<=$trade_goods) && ($yttrium_cost<=$yttrium_quantity) && ($labor_cost<=$ship_labor)) {		
				
				
				if (!is_numeric($fleets)) {
					
					$query = "SELECT x, y FROM planets WHERE planet_id = '" . $planet_id . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
			  					$x = $row['x'];
								$y = $row['y'];
								$dx = $row['x'];
								$dy = $row['y'];
							}
					
					$fleet_name = 'no name';
					$query1 = "INSERT INTO fleets (player_id, fleet_name, x, y, dx, dy, cue_fighters, cue_frigates, cue_carriers) VALUE ('$user_playerid', '$fleet_name', '$x', '$y', '$dx', '$dy', '$fighters', '$frigates', '$carriers')";
					mysqli_query($dbc, $query1);
					
				}
				
				else {
					$query = "SELECT cue_fighters, cue_frigates, cue_carriers FROM fleets WHERE fleet_id = '" . $fleets . "'";
						$data = mysqli_query($dbc, $query);
							while ($row = mysqli_fetch_array($data)) {
					
					$cue_fighters = $row['cue_fighters'];
					$cue_frigates = $row['cue_frigates'];
					$cue_carriers = $row['cue_carriers'];
					$new_fighters = $cue_fighters+$fighters;
					$new_frigates = $cue_frigates+$frigates;
					$new_carriers = $cue_carriers+$carriers;
				
							
							}
					
					
					
					$query1 = "UPDATE fleets SET cue_fighters = '$new_fighters', cue_frigates = '$new_frigates', cue_carriers = '$new_carriers', cue = 1 WHERE fleet_id = '" . $fleets . "'";
				mysqli_query($dbc, $query1);
				
					
					
				}
				
				
				
				
							
							
							
							
				$query1 = "UPDATE planets SET yttrium = '$new_yttrium', trade_goods = '$new_tgs', ship_labor = '$new_sl' WHERE planet_id = '" . $planet_id . "'";
				mysqli_query($dbc, $query1);
				
				$query1 = "UPDATE players SET credits = '$new_credits' WHERE player_id = '" . $user_playerid . "'";
				mysqli_query($dbc, $query1);
				
				$enter = 1;
				}
				
				else {
				$enter = 3;
			
			
			}
					
					
					
				 
			 	}
				
				
				
				
  	
					
				 
				 
				
			 	
				}
				
				
			
				 else {
				$enter = 2;
			
			
			}	
					
}
				
  
  
  
  
  
  
  
  $query2 = "SELECT player_id, planet_name, x, y, ship_labor, scandium, neodymium, promethium, erbium, yttrium, trade_goods FROM planets WHERE planet_id = '" . $planet_id . "'";
  $data2 = mysqli_query($dbc, $query2);
  		if (mysqli_num_rows($data2) == 1) { 
		  while ($row = mysqli_fetch_array($data2)) {
			  
			$player_id2 = $row['player_id'];
			$planet_name = $row['planet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$ship_labor = $row['ship_labor'];
			$scandium = $row['scandium'];
			$neodymium = $row['neodymium'];
			$promethium = $row['promethium'];
			$erbium = $row['erbium'];
			$yttrium = $row['yttrium'];
			$trade_goods = $row['trade_goods'];
			
		  	}
		
          
		}
		
				  		
				
		
	$query3 = "SELECT metal_id FROM players WHERE player_id = '" . $player_id2 . "'";
  	$data3 = mysqli_query($dbc, $query3);
  		
		  while ($row = mysqli_fetch_array($data3)) {
			 $metal_id = $row['metal_id']; 
		
			 if ($metal_id==1) {
				 $player_metal = $scandium;
				 $metal_name = "Scandium";
				
			 }
			 else if ($metal_id==2) {
				 $player_metal = $neodymium;
				 $metal_name = "Neodymium";
				 
			 }
			 else if ($metal_id==3) {
				 $player_metal = $promethium;
				 $metal_name = "Promethium";
			 }
			 else if ($metal_id==4) {
				 $player_metal = $erbium;
				 $metal_name = "Erbium";
			 }
			 else if ($metal_id==5) {
				 $player_metal = $yttrium;
				 $metal_name = "Yttrium";
				 }
			  
			  
		  }
				
		
		require_once('navmenu.php');
				  ?>
<div id="allcontent">
	
		  <?php
		  		
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  if ($user_playerid == $player_id2) {
				  
				

			
				
				echo '<div id="poverview">';
   				echo '<table>';
	   			echo '<tr><td><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a> (' . $x . ', ' . $y . ')</td><td>Ship Labor Available: ' . $ship_labor . '</td></tr><tr><td>Total ' . $metal_name . ': ' . $player_metal . '</td><td>Trade Goods Available: ' . $trade_goods . '</td></tr>';

	  			echo '</table>';
   				echo '</div>';
				
  
  ?>
  
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Build Fleets</legend>
      
      <?php
	  	echo '<p> What type of ships would you like to build. Ships will be added after the next combat tick. Fleets with ships in cue cannot move.</p>';

	  ?>
  <table>
  <tr><td>Type</td><td>Quantity Desired</td><td>Cost</td></tr>
  <tr><td><label for="fighter">Fighters:</label></td><td><input type="text" name="fighters" value="0" /><br /></td><td><p>Credits: 900</p><p>Trade Goods: 10</p><p><?php echo $metal_name ?>: 1</p><p>Ship Labor: 1</p></td></tr>
  
  <tr><td><label for="frigate"><p>Frigates:</p></label></td><td><input type="text" name="frigates" value="0" /><br /></td><td><p>Credits: 2700</p><p>Trade Goods: 30</p><p><?php echo $metal_name ?>: 3</p><p>Ship Labor: 3</p></td></tr>
  
  <tr><td><label for="carrier">Carriers:</label></td><td><input type="text" name="carriers" value="0" /><br /></td><td><p>Credits: 20250</p><p>Trade Goods: 90</p><p><?php echo $metal_name ?>: 9</p><p>Ship Labor: 9</p></td><td></td></tr>
  <tr><td></td><td>
  



<select name="fleets">
<option value="new_fleet">New Fleet</option>

<?php
$query = "SELECT fleet_id, fleet_name FROM fleets WHERE x = '" . $x . "' AND y = '" . $y . "' AND player_id = '" . $user_playerid . "'";
  $data = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($data)) {
	
	$fleet_id = $row['fleet_id'];
	$fleet_name = $row['fleet_name'];

echo '<option value="' . $fleet_id . '">' . $fleet_name . '</option>';
}
?>

</select>
 
  </td></tr>
    
  <tr><td></td><td> <input type="submit" value="Submit" name="submit" /></td><td></td><td></td></tr>
  
  <input type="hidden" name="planetid" value="<?php echo $planet_id; ?>" />


  <input type="hidden" name="metal_id" value="<?php echo $metal_id; ?>" />

  
  
  			
  
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