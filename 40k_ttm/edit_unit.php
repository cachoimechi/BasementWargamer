<?php
/***********************************************
File: edit_unit.php
Author: Adam Krone
Description: Handles form to edit a unit's info.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	if ( isset($_GET['unit_id']) ) { $_SESSION['unit_id'] = $_GET['unit_id']; }
	
	$unit = new Unit();
	$details = $unit->getDetails($_SESSION['unit_id']);
	
	if ( $_SESSION['uid'] != $details['user_id'] ) {
		header("Location:manage_army.php");
	}
	
	$upgradeNames = explode("|", $details['active_upgrades']);
	$upgradeCopies = explode("|", $details['upgrade_copies']);
	$upgrades = array_combine($upgradeNames, $upgradeCopies);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "head_tags.php"; ?>
	</head>
	<body>
	
		<div id="leaderboard" class="box_shadow">
		
			<h2>Leaderboard Ad Here</h2>
		
		</div> <!-- End Leaderboad Ad -->
	
		<div id="container" class="box_shadow box_round">
	
			<?php include_once "header.php"; ?>
						
			<div id="content">
							
				<form name="edit_unit" action="update_unit.php" method="post" id="edit" class="center">
				
					<h3>Edit Unit</h3>
					
					<p>Name</p>
					<p><input type="text" name="name" value="<?php echo $details['name']; ?>"></p>
					
					<p>Type</p>
					<p><select name="type">
						<option <?php if ( $details['type'] == "HQ" ) { echo "SELECTED"; } ?> value="HQ">HQ</option>
						<option <?php if ( $details['type'] == "Elite" ) { echo "SELECTED"; } ?> value="Elite">Elite</option>
						<option <?php if ( $details['type'] == "Troops" ) { echo "SELECTED"; } ?> value="Troops">Troops</option>
						<option <?php if ( $details['type'] == "Fast Attack" ) { echo "SELECTED"; } ?> value="Fast Attack">Fast Attack</option>
						<option <?php if ( $details['type'] == "Heavy Support" ) { echo "SELECTED"; } ?> value="Heavy Support">Heavy Support</option>
						<option <?php if ( $details['type'] == "Transport" ) { echo "SELECTED"; } ?> value="Transport">Transport</option>
					</select></p>
					
					<p>Upgrades</p>
						<?php
						
							$display = new Display();
							$display->upgradeCheckboxes($details['codex_unit_id'], $upgrades);
							
						?>
					
					<p>Number in Unit</p>
					<p><input type="text" name="copies" value="<?php echo $details['copies']; ?>"></p>
					
					<p><input class="submit" type="submit" value="Edit!" name="submit" ></p>
				
				</form>
				
			</div>
			
		</div>

		
	</body>
</html>	