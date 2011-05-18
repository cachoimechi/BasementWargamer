<?php
/***********************************************
File: login_form.php
Author: Adam Krone
Description: Form for user login.
***********************************************/
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
					<li><a href="index.php">Home</a></li>
					<li><a class="selected" href="login_form.php">Login</a></li>
					<li><a href="register_form.php">Register</a></li>
				</ul>
				
				<h1>40k List Builder</h1>
			
			</div> <!-- End Navigation -->	
				
			<div id="content">	
			
				<form name="login" action="login.php" method="post" class="center">
				
					<h3>Login</h3>
				
					<p>Username</p>
					<p><input type="text" name="username"></p>
					
					<p>Password</p>
					<p><input type="password" name="password"></p>
					
					<p><input class="submit" type="submit" value="Login!" name="submit"></p>
				
				</form>
				
			</div>
			
		</div>
		
	</body>
</html>