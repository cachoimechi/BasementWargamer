<?php
/***********************************************
File: edit_upgrade.php
Author: Adam Krone
Description: Handles edit upgrades form.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$_SESSION['upgrade_id'] = $_GET['upgrade_id'];
	
	$upgrade = new Upgrade();
	$details = $upgrade->id($_SESSION['upgrade_id']);
	
	if ( $_SESSION['uid'] != $details['user_id'] ) {
		header("Location:manage_codex.php");
	}

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
		
			<div id="content">
		
				<form class="center" name="edit_upgrades" method="post" action="update_upgrade.php">
					
								<h4>Edit Unit Upgrade</h4>
								
								<p>Name</p>
								<p><input type="text" name="name" value="<?php echo $details['name']; ?>"></p>
								
								<p>Points</p>
								<p><input type="text" name="points" value="<?php echo $details['points']; ?>"></p>
												
								<p><input class="submit" type="submit" value="Submit!"></p>				
				
				</form>
	
			</div>
		
		</div>
		
	</body>
</html>