<?php
/***********************************************
File: user_settings.php
Author: Adam Krone
Description: Handles changes to user settings.
***********************************************/

	session_start();
	
	include "auth.inc.php";
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
		
			<?php include_once "header.php"; ?>
		
			<div id="main">
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="user_settings.php">User Settings</a></h4>
			
				<div id="management">			
			
					<form name="change_password.php" action="change_password.php" method="post">
					
						<h4>Change Password</h4>
						
						<p>Old Password</p>
						<p><input type="password" name="old_password"></p>
						
						<p>New Password</p>
						<p><input type="password" name="new_password"></p>
						
						<p>Repeat New Password</p>
						<p><input type="password" name="repeat_password"></p>
						
						<p><input class="submit" type="submit" name="submit" value="Submit!"></p>
					
					</form>		
					
					<form name="change_email" action="change_email.php" method="post">
					
						<h4>Change Email</h4>
						
						<p>Email</p>
						<p><input type="text" name="email"></p>
						
						<p><input class="submit" type="submit" name="submit" value="Submit!"></p>
					
					</form>		
				
				</div>
				
				<div id="display">
				
					<?php 
						
						$display = new Display();
						$display->userInfo($_SESSION['uid']);
					
					?>
				
				</div>
			
			</div>
			
			<?php include "sidebar.php"; ?>
	
	</body>
</html>