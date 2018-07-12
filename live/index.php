<?php
 require_once('startsession.php');
   
     $page_title = 'Home';

  require_once('game_header.php');

  require_once('connectvars.php');

		  $user_playerid = $user->data['user_id'];
		 
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	

	
	
	
	echo '<div id="allcontentguest">';
		
		echo '<div id="banner">';
			echo '<img src="../images/header.png" alt="Imperial_Saga"/>';
		echo '</div>';
		
		echo '<div id="homemaincontent">';
	
echo '<h1>Choose Your Fate</h1>';
			
			echo '<p>You have successfully unified your planet under your rule. Now you must build and expand your empire amongst the stars, under the rule of the Earthen Empire. How you rule your people is up to you, but be aware that every decision you make will have advantages and disadvantages.<br /> ';
echo '<br />';
echo 'Imperial Saga is a strategy game in which you may ally with your neighbors or conquer them. Follow the laws of the Earthen Empire or disobey for ultimate power and face the consequences. <br /><br />Choose Your Fate</p>';

			echo '<div id="menu">';
			echo '<p><a href="forum/ucp.php?mode=login">Log In - <a href="forum/ucp.php?mode=register">Sign Up</a></p>';
			echo '</div>';
		
		
	
		echo '</div>';
		?>
		<div id="footer">
			<p>footer test</p>
			</div>
	</div>
	
	</body>	
</html>
