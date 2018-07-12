<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>Untitled Document</title>
	</head>
	<body>
Reset Game?<br />
<?php
require_once('connectvars.php');
	if (isset($_POST['submit'])) {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die('Error connecting to MySQL server.');
		$query1 = "UPDATE planets
				SET active = 0, player_id = 3, planet_name = 'unnamed', housing = 0, agricultural = 0, commercial = 0, mining = 0, industry = 0, factories = 0, defense_batteries = 0, population = 0, 
				slaves = 0, food = 0, ore_mined = 0, trade_goods = 0, scandium = 0, neodymium = 0, promethium = 0, erbium = 0, yttrium = 0, labor = 0, agricultural_labor = 0, mining_labor = 0,
				industry_labor = 0, ship_labor = 0
				WHERE active = 1";
		$data1 = mysqli_query($dbc, $query1);
		
		
				
				$query = "TRUNCATE TABLE armies";
				mysqli_query($dbc, $query);
				
				
				
				$query = "TRUNCATE TABLE fleets";
				mysqli_query($dbc, $query);
				
				
				
				$query = "TRUNCATE TABLE market";
				mysqli_query($dbc, $query);
				
				
				
				$query = "TRUNCATE TABLE transfer_goods";
				mysqli_query($dbc, $query);
				
				
				
				$query = "DELETE FROM players WHERE player_id != 3";
				mysqli_query($dbc, $query);
					
				
			
				
				
			
		
		
		
		mysqli_close($dbc);
	}
?>
<hr />
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="submit" value="SUBMIT" name="submit" />
	</body>
</html>
