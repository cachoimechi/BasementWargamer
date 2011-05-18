<?php
/***********************************************
File: index.php
Author: Adam Krone
Description: Index for Tabletop Manager.
***********************************************/
	
	require "func.inc.php";

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "head_tags.php"; ?>
	</head>
	<body>
	
		<?php include "leaderboard.php"; ?>
	
		<div id="container" class="box_shadow box_round">
	
			<div id="nav">
				<ul id="nav-links">
					<li><a class="selected" href="index.php">Home</a></li>
					<li><a href="login_form.php">Login</a></li>
					<li><a href="register_form.php">Register</a></li>
				</ul>
				
				<h1>40k List Builder</h1>
			
			</div> <!-- End Navigation -->
			
			<div id="main">
			
				<h4 class="heading"><a href="index.php">Home</a></h4>
			
				<div id="news">
				
					<p>Welcome to Basement Wargamer's 40k List Builder!  To access the features you must <a href="login_form.php">login</a>.
					Don't have an account?  <a href="register_form.php">Register</a> today, it's free!</p>
					<iframe width="560" height="349" src="http://www.youtube.com/embed/dfgKg69IDIs" frameborder="0" allowfullscreen></iframe>
				
				</div>
			
			</div> <!-- End Main -->
			
			<?php include "sidebar.php"; ?>
		
		</div>
	
	</body>
</html>