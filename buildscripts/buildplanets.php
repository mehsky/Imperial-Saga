<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>Untitled Document</title>
	</head>
	<body>
Build planets?<br />
<?php
require_once('connectvars.php');
	if (isset($_POST['submit'])) {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die('Error connecting to MySQL server.');
				
		
		for ($y = -250; $y < 250; $y++) {
			$x = -250;
			while ($x < 250){
				$z = RAND(1,10);
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
				
				if ($x < 251) {
				$query = "INSERT INTO planets (x, y, planet_type_id, atmosphere_id, metal_id, rank)
				VALUES ('" . $x . "', '" . $y . "', 1 + RAND()*15, 1 + RAND()*4, 1 + RAND()*4, '" . $w . "')";
				mysqli_query($dbc, $query);
				echo $query;
				echo '<p>________________________</p>';
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
