<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>Untitled Document</title>
	</head>
	<body>
Build land ore and minerals on planets?<br />
<?php
require_once('connectvars.php');
	if (isset($_POST['submit'])) {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die('Error connecting to MySQL server.');
		$query1 = "SELECT * FROM planets";
		$data1 = mysqli_query($dbc, $query1);
		
		
				
				$query = "UPDATE planets 
				SET land = 300+ RAND()*300, ore = 600+ RAND()*400, metal = 500+ RAND()*200
				WHERE planet_type_id=1";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 400+ RAND()*300, ore = 400+ RAND()*600, metal = 50+ RAND()*50
				WHERE planet_type_id=2";
				mysqli_query($dbc, $query);
				
				$query = "UPDATE planets 
				SET land = 200+ RAND()*600, ore = 600+ RAND()*400, metal = 500+ RAND()*200
				WHERE planet_type_id=3";
				mysqli_query($dbc, $query);
				
				
				$query = "UPDATE planets 
				SET land = 200+ RAND()*400, ore = 600+ RAND()*400, metal = 500+ RAND()*200
				WHERE planet_type_id=4";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 200+ RAND()*400, ore = 600+ RAND()*400, metal = 500+ RAND()*200
				WHERE planet_type_id=5";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 200+ RAND()*400, ore = 600+ RAND()*400, metal = 500+ RAND()*200
				WHERE planet_type_id=6";
				mysqli_query($dbc, $query);
					
				
			
				$query = "UPDATE planets 
				SET land = 50+ RAND()*150, ore = 100+ RAND()*50, metal = 75+ RAND()*50
				WHERE planet_type_id=7";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 5+ RAND()*25, ore = 1500+ RAND()*200, metal = 150+ RAND()*50
				WHERE planet_type_id=8";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets
				SET land = 0, ore = 100+ RAND()*100, metal = 1600+ RAND()*400
				WHERE planet_type_id=9";
				mysqli_query($dbc, $query);
			
				
				
				$query = "UPDATE planets
				SET land = 75+ RAND()*100, ore = 50+ RAND()*50, metal = 800+ RAND()*400
				WHERE planet_type_id=10";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 200+ RAND()*400, ore = 50+ RAND()*50, metal = 25+ RAND()*50
				WHERE planet_type_id=11";
				mysqli_query($dbc, $query);
			
				
				
				$query = "UPDATE planets 
				SET land = 700+ RAND()*200, ore = 50+ RAND()*50, metal = 25+ RAND()*25
				WHERE planet_type_id=12";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 150+ RAND()*100, ore = 800+ RAND()*400, metal = 50+ RAND()*50
				WHERE planet_type_id=13";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 175+ RAND()*50, ore = 150+ RAND()*150, metal = 1000+ RAND()*200
				WHERE planet_type_id=14";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 1600+ RAND()*400, ore = 300+ RAND()*200, metal = 200+ RAND()*150
				WHERE planet_type_id=15";
				mysqli_query($dbc, $query);
				
				
				
				$query = "UPDATE planets 
				SET land = 5+ RAND()*5, ore = 1800+ RAND()*400, metal = 150+ RAND()*50
				WHERE planet_type_id=16";	
				mysqli_query($dbc, $query);
				
			
		
		
		
		mysqli_close($dbc);
	}
?>
<hr />
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="submit" value="SUBMIT" name="submit" />
	</body>
</html>
