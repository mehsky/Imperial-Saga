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
				$housing = mysqli_real_escape_string($dbc, trim($_POST['housing']));
				$commercial = mysqli_real_escape_string($dbc, trim($_POST['commercial']));
				$agricultural = mysqli_real_escape_string($dbc, trim($_POST['agricultural']));
				$mining = mysqli_real_escape_string($dbc, trim($_POST['mining']));
				$industry = mysqli_real_escape_string($dbc, trim($_POST['industry']));
				$factories = mysqli_real_escape_string($dbc, trim($_POST['factories']));

				if (is_numeric($housing) && is_numeric($commercial) && is_numeric($agricultural) && is_numeric($mining) && is_numeric($industry) && is_numeric($factories)) {	
				
				$housing = round($housing);
				$commercial = round($commercial);
				$agricultural = round($agricultural);
				$mining = round($mining);
				$industry = round($industry);
				$factories = round($factories);
				
				
				
				
				$query4 = "SELECT player_id, planet_name, x, y, land, housing, agricultural, commercial, mining, industry, factories, labor, trade_goods FROM planets WHERE planet_id = '" . $planet_id . "'";
  $data4 = mysqli_query($dbc, $query4);
  		if (mysqli_num_rows($data4) == 1) { 
		  while ($row = mysqli_fetch_array($data4)) {
			  
			$player_id2 = $row['player_id'];
			$planet_name = $row['planet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$land = $row['land'];
			$trade_goods = $row['trade_goods'];
			//New or pre-existing amount built. i.e. original amount.
			$c_housing = $row['housing'];
			$c_agricultural = $row['agricultural'];
			$c_commercial = $row['commercial'];
			$c_mining = $row['mining'];
			$c_industry = $row['industry'];
			$c_factories = $row['factories'];
			$labor = $row['labor'];
		  	}
		
          
		}

				
				
				

			
			
			$l_housing = $housing;
			$l_commercial = $commercial;
			$l_agricultural = $agricultural;
			$l_mining = $mining;
			$l_industry = $industry;
			$l_factories = $factories;
			
			if ($housing<=0) {$l_housing = 0;}
			if ($commercial<=0) {$l_commercial = 0;}
			if ($agricultural<=0) {$l_agricultural = 0;}
			if ($mining<=0) {$l_mining = 0;}
			if ($industry<=0) {$l_industry = 0;}
			if ($factories<=0) {$l_factories = 0;}			
				
				$total_tobebuilt = $l_housing + $l_commercial + $l_agricultural + $l_mining + $l_industry + $l_factories;
				$total_built = $l_housing + $l_commercial + $l_agricultural + $l_mining + $l_industry + $l_factories + $c_housing + $c_commercial + $c_agricultural + $c_mining + $c_industry + $c_factories;
				
			
			if (($total_tobebuilt<=$labor)&&($total_tobebuilt<=($trade_goods/10))&&($total_built<=$land)) {
			
			// will be new amount of built infrastructure if entered properly
			
		
			
			$n_housing = $c_housing+$housing;
			$n_commercial = $c_commercial+$commercial;
			$n_agricultural = $c_agricultural+$agricultural;
			$n_mining = $c_mining+$mining;
			$n_industry = $c_industry+$industry;
			$n_factories = $c_factories+$factories;
			$n_labor = $labor-$total_tobebuilt;
			$n_trade_goods = $trade_goods-($total_tobebuilt*10);
			
			
			
			
			$query3 = "UPDATE planets SET housing = '$n_housing', commercial = '$n_commercial', agricultural = '$n_agricultural', mining = '$n_mining', industry = '$n_industry', factories = '$n_factories', labor = '$n_labor', trade_goods = '$n_trade_goods' WHERE planet_id = $planet_id";
			mysqli_query($dbc, $query3);
			
			
			
			
			$enter = 1;
			
			

			//Enter SQL queries for update here.
			//
				
			}
			else {$enter = 3;}
			
			}
			else {
				$enter = 2;
			
			
			}
				
  }
			
  
				
  
  $query = "SELECT player_id, planet_name, x, y, land, housing, agricultural, commercial, mining, industry, factories, labor, trade_goods FROM planets WHERE planet_id = '" . $planet_id . "'";
  $data = mysqli_query($dbc, $query);
  		if (mysqli_num_rows($data) == 1) { 
		  while ($row = mysqli_fetch_array($data)) {
			  
			$player_id2 = $row['player_id'];
			$planet_name = $row['planet_name'];
			$x = $row['x'];
			$y = $row['y'];
			$land = $row['land'];
			
			//New or pre-existing amount built. i.e. original amount.
			$current_housing = $row['housing'];
			$current_agricultural = $row['agricultural'];
			$current_commercial = $row['commercial'];
			$current_mining = $row['mining'];
			$current_industry = $row['industry'];
			$current_factories = $row['factories'];
			$labor = $row['labor'];
			$trade_goods = $row['trade_goods'];
			$current_total_built = + $current_housing + $current_agricultural + $current_commercial + $current_mining + $current_industry + $current_factories;
		  	}
		
          
		}
		
		
		
				  ?>
<div id="allcontent">
	
		  <?php
		  		  
		  // Checks to see if player owns planet, then pulls and displays proper info if he does
			  if ($user_playerid == $player_id2) {
				  
				

			
				
				echo '<div id="poverview">';
   				echo '<table>';
	   			echo '<tr><td><a href="planet.php?planetid=' . $planet_id . '">' . $planet_name . '</a> (' . $x . ', ' . $y . ')</td><td>Labor Available: ' . $labor . '</td></tr><tr><td>Total Land: ' . $land . '</td><td>Trade Goods Available: ' . $trade_goods . '</td></tr>';

	  			echo '</table>';
   				echo '</div>';
				
  
  ?>
  
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Build Infrastructure</legend>
      
      <?php
	  	echo '<p> What type of structures would you like to build. You can build as many as you have labor. Labor will be reset once per day. You can destroy buildings by entering a negative number, however you will not gain any labor or trade goods back.</p><p>The cost to build 1 infrastructure is 1 labor and 10 trade goods.';

	  ?>
  <table>
  <tr><td>Type</td><td>Quantity Desired</td><td>Currently Installed</td></tr>
  <tr><td><label for="housing">Housing:</label></td><td><input type="text" name="housing" value="0" /><br /></td><td><?php echo $current_housing ?></td></tr>
  
  <tr><td><label for="commercial">Commercial:</label></td><td><input type="text" name="commercial" value="0" /><br /></td><td><?php echo $current_commercial ?></td></tr>
  
  <tr><td><label for="agricultural">Agricultural:</label></td><td><input type="text" name="agricultural" value="0" /><br /></td><td><?php echo $current_agricultural ?></td></tr>
  
  <tr><td><label for="mining">Mining:</label></td><td><input type="text" name="mining" value="0" /><br /></td><td><?php echo $current_mining ?></td></tr>
  
  <tr><td><label for="industry">Industry:</label></td><td><input type="text" name="industry" value="0" /><br /></td><td><?php echo $current_industry ?></td></tr>
  
    <tr><td><label for="factories">Factories:</label></td><td><input type="text" name="factories" value="0" /><br /></td><td><?php echo $current_factories ?></td></tr>
    <tr><td><p>Total: </p></td><td></td><td><?php echo $current_total_built ?></td></tr>
    
  <tr><td></td><td> <input type="submit" value="Submit" name="submit" /></td><td></td><td></td></tr>
  
  <input type="hidden" name="planetid" value="<?php echo $planet_id; ?>" />

  <input type="hidden" name="labor" value="<?php echo $labor; ?>" />
  
  
  			
  
  </table>
<?php

		if ($enter==1) {
			echo '<p>Your buildings have been built.</p>';
		}
		if ($enter==2) {
			echo '<p>Only whole numbers may be entered.</p>';
		}
		if ($enter==3) {
			echo '<p>Either you do not have enough land to build all of this on or you are short on labor or trade goods.</p>';
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