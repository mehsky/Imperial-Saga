<?php

  require_once('startsession.php');
  
  $page_title = 'Planet Management';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
          $user_playerid = $user->data['user_id'];
         
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  $planet_id = $_REQUEST["planetid"];
  
  if (isset($_POST['patriarch'])) {//naming planet
		$new_name = mysqli_real_escape_string($dbc, trim($_POST['new_name']));
		
		$query = "SELECT planet_id FROM planets WHERE planet_name = '" . $new_name . "'";
						$data = mysqli_query($dbc, $query);
					if (mysqli_num_rows($data) == 0) { 	
						
		$query = "UPDATE planets SET planet_name = '$new_name' WHERE planet_id = '" . $planet_id . "'";
				mysqli_query($dbc, $query);
					}
					
					
					else {
						echo '<p> That name is already used for another planet.</p>';	
					}
  }//end if (isset($_POST['submit'])) {
	  
	  if (isset($_POST['patriarch1'])) {//Claiming planet
	  $message = '<p>You have taken control of this planet. Congratulations!</p>';
	  
	  $query = "UPDATE planets SET player_id = '" . $user_playerid . "', housing = 8, agricultural = 1, commercial = 1, mining = 1, industry = 1, factories = 0, defense_batteries = 0, population = 80, slaves = 0, food = 100, trade_goods = 0, labor = 0, agricultural_labor = 0, mining_labor = 0, industry_labor = 0, ship_labor = 0  WHERE planet_id = '" . $planet_id . "'";
	  
				mysqli_query($dbc, $query);
					
	  
	  
	  
	  }//end if (isset($_POST['patriarch1'])) {//Claiming planet
	  if (isset($_POST['patriarch4'])) {//changing army stance
		$army_id = mysqli_real_escape_string($dbc, trim($_POST['armyid']));
		
		$query = "SELECT posture FROM armies WHERE army_id = '" . $army_id . "'";
						$data = mysqli_query($dbc, $query);
					if (mysqli_num_rows($data) == 1) { 	
						while ($row = mysqli_fetch_array($data)) {
							$posture = $row['posture'];
							if ($posture == 0) {
								$new_posture = 1;	
							}
							else {
								$new_posture = 0;	
							}
					
					
						
		$query = "UPDATE armies SET posture = '" . $new_posture . "' WHERE army_id = '" . $army_id . "'";
				mysqli_query($dbc, $query);
						}
					}
					
					
					else {
						echo '<p> That name is already used for another planet.</p>';	
					}
  }//end if (isset($_POST['submit'])) {
	  
	  
	  			$planet_menu_display = 0;
				$planet_attribute_display = 0;
				$planet_infrastructure_display = 0;
				$planet_resources_display = 0;
				$planet_fleet_display = 0;
				$planet_army_display = 0;
					  
  
$query = "SELECT player_id, planet_id, x, y FROM planets WHERE planet_id = '" . $planet_id . "'";
$data = mysqli_query($dbc, $query);
  		if (mysqli_num_rows($data) == 1) { 
		  while ($row = mysqli_fetch_array($data)) {
			  
			  $player_id2 = $row['player_id'];
			  $planet_id = $row['planet_id'];
			  $x = $row['x'];
			  $y = $row['y'];
			 }//end while ($row = mysqli_fetch_array($data)) {
		}//end if (mysqli_num_rows($data) == 1) {
$query = "SELECT army_id, quantity, posture FROM armies WHERE planet_id = " . $planet_id . " AND player_id = " . $user_playerid . "";
$army_data = mysqli_query($dbc, $query);			
				
		if ($user_playerid == $player_id2) {// if the player owns the planet display all information
		$planet_menu_display = 1;
		$planet_attribute_display = 1;
		$planet_infrastructure_display = 1;
		$planet_resources_display = 1;
		$planet_fleet_display = 1;
		$planet_army_display = 1;
		}//end if ($user_playerid == $player_id2) {// if the player owns the planet display all information
				else {//if the player doesn't own the planet, check to see if they have fleets or armies there
					$query = "SELECT fleet_id, layer FROM fleets WHERE x = " . $x . " AND y = " . $y . " AND player_id = " . $user_playerid . "";
  						$data = mysqli_query($dbc, $query);
  							if (mysqli_num_rows($data) > 0) { 
								$high_display = 0;
								$low_display = 0;
								while ($row = mysqli_fetch_array($data)) {//check position of fleet
									$layer = $row['layer'];
									if ($layer == 0) {
										$high_display = 1;
									}
									if ($layer == 1) {
										$low_display = 1;
									}
								}//end while ($row = mysqli_fetch_array($data)) {//check position of fleet
								
								if ($high_display==1) {
									$planet_attribute_display = 1;
									$planet_fleet_display = 1;
								}
								if ($low_display==1) {
									$planet_attribute_display = 1;
									$planet_infrastructure_display = 1;
									$planet_fleet_display = 1;
									$planet_army_display = 1;
								}
								
							}//end if (mysqli_num_rows($data) > 0) {
						
  							if (mysqli_num_rows($army_data) == 1) { 
							$planet_attribute_display = 1;
							$planet_infrastructure_display = 1;
							$planet_army_display = 1;
							}
					}//end else {//if the player doesn't own the planet, check to see if they have fleets or armies there
		
				  ?>
<div id="allcontent">
	
		  <?php
		  		  
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  
  					$query = "SELECT planets.planet_name, planets.housing, planets.agricultural, planets.commercial, planets.mining, planets.industry, planets.factories, planets.planet_id, planets.x, planets.y,  planets.population, planets.slaves, planets.ore_mined, planets.scandium, planets.neodymium, planets.promethium, planets.erbium, planets.yttrium, planets.labor, planets.trade_goods, planets.ship_labor, planet_types.planet_type_name, atmospheres.atmosphere_name, metals.metal_name " .
			"FROM planets " .
			"INNER JOIN planet_types USING (planet_type_id) " .
			"INNER JOIN atmospheres USING (atmosphere_id) " .
			"INNER JOIN metals USING (metal_id) " .
			"WHERE planet_id = '" . $planet_id . "' ORDER BY planet_id DESC ";
  					$data = mysqli_query($dbc, $query);
  
	
 	 		while ($row = mysqli_fetch_array($data)) {
			$planet_id = $row['planet_id'];
			$planet_name = $row['planet_name'];
			
			$x = $row['x'];
			$y = $row['y'];
			$housing = $row['housing'];
			$agricultural = $row['agricultural'];
			$commercial = $row['commercial'];
			$mining = $row['mining'];
			$industry = $row['industry'];
			$factories = $row['factories'];
			$population = $row['population'];
			$slaves = $row['slaves'];
			$ore_mined = $row['ore_mined'];
			$planet_type_name = $row['planet_type_name'];
			$atmosphere_name = $row['atmosphere_name'];
			$metal_name = $row['metal_name'];
			$scandium = $row['scandium'];
			$neodymium = $row['neodymium'];
			$promethium = $row['promethium'];
			$erbium = $row['erbium'];
			$yttrium = $row['yttrium'];
			$labor = $row['labor'];
			$credits = $row['credits'];
			$trade_goods = $row['trade_goods'];
			$ship_labor = $row['ship_labor'];
			
			 }//end while ($row = mysqli_fetch_array($data)) {
				
				

				echo '<h1><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a> (' . $x . ', ' . $y . ')</h1>';
			if ($planet_menu_display == 1) {
				echo $message;
				if ($planet_name=='unnamed') {
				echo '<form method="post" action=' . $_SERVER['PHP_SELF'] . '>';	
				echo '<p class="menu">Update name:<input type="text" name="new_name" value="" /><input type="submit" value="Change" name="patriarch" /> This change will be permament.</p>';
				echo '<input type="hidden" name="planetid" value=' . $planet_id . ' />';
				echo '</form>';	
				}
				
				echo '<p class="menu"><a href="infrastructure.php?planetid=' . $planet_id . '">Infrastructure</a> - <a href="fleet_construction.php?planetid=' . $planet_id . '">Shipyard</a> - <a href="barracks.php?planetid=' . $planet_id . '">Barracks</a> - <a href="strategic_overview.php?x=' . $x . '&y=' . $y . '">Fleets in System</a> - <a href="market.php?planetid=' . $planet_id . '">Local Market</a> - <a href="transfer_goods.php?planetid=' . $planet_id . '">Move Goods</a></p>';
				
			}//end if ($planet_menu_display == 1) {
			if ($planet_attribute_display == 1) {
				echo '<fieldset>';
				echo '<legend>Attributes</legend>';
				echo '<table>';
				echo '<tr class="uline"><td>Planet Type				</td><td>Atmosphere					</td><td>Metal Available		</td></tr>';
				echo '<tr><td>' . $planet_type_name . '	</td><td>' . $atmosphere_name . '	</td><td>' . $metal_name . '	</td></tr>';
	  			echo '</table>';
   				echo '</fieldset>';
			}//end if ($planet_attribute_display == 1) {
			if ($planet_infrastructure_display == 1) {	
				echo '<fieldset>';
				echo '<legend>Infrastructure</legend>';
				echo '<table>';
	   			echo '<tr><td>Housing:		</td><td>' . $housing . '		</td><td>Mining:	</td><td> ' . $mining . ' 		</td></tr>';
	   			echo '<tr><td>Agricultural: </td><td>' . $agricultural . '	</td><td>Industry:	</td><td> ' . $industry . ' 	</td></tr>';
	  			echo '<tr><td>Commercial:	</td><td>' . $commercial . '	</td><td>Factories:	</td><td> ' . $factories . ' 	</td></tr>';
				echo '</table>';
   				echo '</fieldset>';
			}//end if ($planet_infrastructure_display == 1) {	
			if ($planet_resources_display == 1) {	
				echo '<fieldset>';
				echo '<legend>Resources</legend>';
				echo '<table>';
	   			echo '<tr><td>Population:		</td><td>' . $population . ' mil</td><td>Scandium:	</td><td> ' . $scandium . ' 	</td></tr>';
	   			echo '<tr><td>Labor:			</td><td>' . $labor . '			</td><td>Neodymium:	</td><td> ' . $neodymium . ' 	</td></tr>';
	  			echo '<tr><td>Ship Labor:  		</td><td>' . $ship_labor . '	</td><td>Promethium:</td><td> ' . $promethium . ' 	</td></tr>';
				echo '<tr><td>Ore:				</td><td>' . $ore_mined . '		</td><td>Erbium:	</td><td> ' . $erbium . ' 		</td></tr>';
				echo '<tr><td>Trade Goods:		</td><td>' . $trade_goods . '	</td><td>Yttrium:	</td><td> ' . $yttrium . ' 		</td></tr>';
				echo '</table>';
   				echo '</fieldset>';
			}//end if ($planet_resources_display = 1) {	
			if ($planet_fleet_display == 1) { 
				echo '<fieldset>';
				echo '<legend>Fleets in System</legend>';
				require_once('strategic_code.php');
          		echo '</fieldset>';
			}//end if (mysqli_num_rows($data) > 0) {
			if ($planet_army_display == 1) { 
						if (mysqli_num_rows($army_data) == 1) {
							if ($user_playerid != $player_id2)	{
									$conquer == 0;
										$query1 = "SELECT army_id, quantity FROM armies WHERE planet_id = " . $planet_id . " AND player_id = " . $player_id2 . "";
  										$data1 = mysqli_query($dbc, $query1);
												if (mysqli_num_rows($data1) == 1) { 
													while ($row = mysqli_fetch_array($data1)) {
													$defender_army_id = $row['army_id'];
													$defender_quantity = $row['quantity'];	
													
													if ($defender_quantity == 0) {
														$conquer = 1;
													}//end if ($defender_quantity == 0) {
													}//end while ($row = mysqli_fetch_array($data)) {
												}//end if (mysqli_num_rows($data) == 1) { 
												else {
													$conquer = 1;	
												}
											if ($conquer == 1){
												$query2 = "SELECT army_id, quantity FROM armies WHERE planet_id = " . $planet_id . " AND player_id != " . $user_playerid . "";
												$data2 = mysqli_query($dbc, $query2);
												while ($row = mysqli_fetch_array($data2)) {
													
													$attacker_army_id = $row['army_id'];
													$attacker_quantity = $row['quantity'];	
													if ($attacker_quantity >= $quantity){
														
													$conquer = 2;	
													}
												}//end while ($row = mysqli_fetch_array($data)) {
											}//end if ($conquer == 1){
										}//end if ($user_playerid != $player_id2)	{
										}//end if (mysqli_num_rows($army_data) == 1) {
		 					 echo '<fieldset>';
							echo '<legend>Armies on Ground</legend>';
						require_once('army_strategic_code.php');
          					echo '</fieldset>';
							if ($claim == 1) {
								echo '<form method="post" action=' . $_SERVER['PHP_SELF'] . '>';
								echo '<input type="submit" value="Claim Planet" name="patriarch1" />';
								echo '<input type="hidden" name="planetid" value=' . $planet_id . ' />';
								echo '</form>';
							}
          
						}//end if (mysqli_num_rows($data) > 0) {
			
			
			
			
			
			
 mysqli_close($dbc);			
?>










</div>


</body>
</html>