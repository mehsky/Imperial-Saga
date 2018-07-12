<?php

  require_once('startsession.php');
  
  $page_title = 'Planet Overview';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
           $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
  
?>
<div id="allcontent">
<h1>Planet Overview</h1>

<?php







$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT planets.planet_name, planets.planet_id, planets.x, planets.y,  planets.population, planet_types.planet_type_name, atmospheres.atmosphere_name, metals.metal_name " .
			"FROM planets " .
			"INNER JOIN planet_types USING (planet_type_id) " .
			"INNER JOIN atmospheres USING (atmosphere_id) " .
			"INNER JOIN metals USING (metal_id) " .
			"WHERE player_id = '" . $user_playerid . "' ORDER BY planet_id DESC ";
			
  $data = mysqli_query($dbc, $query);
  
	
 	 		while ($row = mysqli_fetch_array($data)) {
				$planet_id = $row['planet_id'];
				$planet_name = $row['planet_name'];
				$x = $row['x'];
				$y = $row['y'];
				$planet_type_name = $row['planet_type_name'];
				$atmosphere_name = $row['atmosphere_name'];
				$population = $row['population'];
				$metal_name = $row['metal_name'];
				
echo '<fieldset>';
echo '<legend><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a> (' . $x . ', ' . $y . ')</legend>';
echo '<table>';
echo '<tr><td>Planet Type: ' . $planet_type_name . '	</td><td><a href="strategic_overview.php?x=' . $x . '&y=' . $y . '"> View fleets in system</a></td></tr>';
echo '<tr><td>Atmosphere:  ' . $atmosphere_name . '		</td><td><p>Population: ' . $population . ' mil</p></td></tr>';
echo '<tr><td>Metal Type:  ' . $metal_name . '			</td><td></td></tr>';
echo '</table>';
echo '</fieldset>';
	   
  }
  
   mysqli_close($dbc);
	   

  
?>

</div>


</body>
</html>