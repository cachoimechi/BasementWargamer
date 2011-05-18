<?php
/***********************************************
File: edit_codex_unit.php
Author: Adam Krone
Description: Handles form to edit a codex unit's information.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	if ( isset($_GET['unit_id']) ) { $_SESSION['unit_id'] = $_GET['unit_id']; }
	
	$codex = new Codex();
	$details = $codex->getDetails($_SESSION['unit_id']);
	
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
							
			<div id="management">
			
				<form name="upgrades" method="post" action="add_upgrade.php">
			
						<h4>Add Unit Upgrade</h4>
						
						<p>Name</p>
						<p><input type="text" name="name"></p>
						
						<p>Points</p>
						<p><input type="text" name="points"></p>
										
						<p><input class="submit" type="submit" value="Submit!"></p>
					
					</form>
					
					<a href="manage_codex.php">Back to Codex</a>
			
			</div>
							
			<div id="management">
				
				<form name="edit_unit" action="update_codex_unit.php" method="post">
				
					<h3>Edit Codex Unit</h3>
				
					<p>Name</p>
					<p><input type="text" name="name" value="<?php echo $details['name']; ?>"></p>
					
					<p>Type</p>
					<p><select name="type">
						<option <?php if ( $details['type'] == "HQ" ) { echo "SELECTED"; } ?> value="HQ">HQ</option>
						<option <?php if ( $details['type'] == "Elite" ) { echo "SELECTED"; } ?> value="Elite">Elite</option>
						<option <?php if ( $details['type'] == "Troops" ) { echo "SELECTED"; } ?> value="Troops">Troops</option>
						<option <?php if ( $details['type'] == "Fast Attack" ) { echo "SELECTED"; } ?> value="Fast Attack">Fast Attack</option>
						<option <?php if ( $details['type'] == "Heavy Support" ) { echo "SELECTED"; } ?> value="Heavy Support">Heavy Support</option>
					</select></p>
					
					<p>Points Per Figure</p>
					<p><input type="text" name="points" value="<?php echo $details['points']; ?>"></p>
					
					<?php 
						$display = new Display();
						$display->upgrades($details['unit_id']);	
					?>
					
					<p><input class="submit" type="submit" value="Edit!" name="submit" ></p>
				
				</form>
				
			</div>
			
		</div>

		
	</body>
</html>	