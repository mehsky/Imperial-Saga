<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>Untitled Document</title>
	</head>
	<body>
Build systems?<br />
<?php
require_once('connectvars.php');
	if (isset($_POST['submit'])) {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die('Error connecting to MySQL server.');
				
		
		$query = "SELECT region_name, region_id, x, y FROM regions";
		
  $data = mysqli_query($dbc, $query);
 
	
 	 		while ($row = mysqli_fetch_array($data)) {
			$region_id = $row['region_id'];	
				for ($y = 0; $y < 10; $y++) {
			$x = 0;
			while ($x < 10){
				$z = RAND(1,3);
				$x2 = $x;
				$x = $x2 + $z;
				
				if ($y < 0) {
					$a = $y * -1;	
				}
				else {
					$a = $y;	
				}
				
				if ($x < 0) {
					$b = $x * -1;	
				}
				else {
					$b = $x;	
				}
				$w = $a + $b;
				
				if ($x < 10) {
		
				
				
			$query = "INSERT INTO systems (x, y, system_id, system_name, region_id)
				VALUES ('" . $x . "', '" . $y . "', '" . $sector_id . "', 'unnamed', '" . $region_id . "')";
				mysqli_query($dbc, $query);	
			
			echo $query;
			
			
			}
			
			}
		
			
			}
			
			}
		
		
		
		mysqli_close($dbc);
	}
?>
<hr />
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="submit" value="SUBMIT" name="submit" />
	</body>
</html>
