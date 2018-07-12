<?php

  require_once('startsession.php');
  
  $page_title = 'Strategic Overview';

  require_once('game_header.php');

  require_once('connectvars.php');
  
  require_once('navmenu.php');
          $user_playerid = $user->data['user_id'];
          $user_username = $_SESSION['username'];
  
?>
<div id="allcontent">
<h1>Strategic Overview</h1>



<?php

$x = $_REQUEST["x"];
$y = $_REQUEST["y"];


echo '<form name="form1" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<p>Select different coordinates</p>';
echo '<input type="text" name="x" value="' . $x . '" /><input type="text" name="y" value="' . $y . '" /><input type="submit" value="Submit" name="submit" />';
echo '</form>';

require_once('strategic_code.php');

			


  
   mysqli_close($dbc);
	   

  
?>

</div>


</body>
</html>