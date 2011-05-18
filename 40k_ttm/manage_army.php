<?php
/***********************************************
File: manage_army.php
Author: Adam Krone
Description: Handles management of user army.
***********************************************/

	session_start();
	
	include "auth.inc.php";
	require "func.inc.php";
	
	if ( isset($_POST['armies']) ) {
		$_SESSION['army_id'] = $_POST['armies'];
	} elseif ( ! isset($_SESSION['army_id']) ) {
		header("Location: armies.php");
	}
	$army = new Army();
	$details = $army->getDetails($_SESSION['army_id']);
	
	$_SESSION['codex'] = $details['codex'];
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "head_tags.php"; ?>
	</head>
	<body>
	
		<?php include_once "leaderboard.php"; ?>
	
		<div id="container" class="box_shadow box_round">
		
			<?php include_once "header.php"; ?>
		
			<div id="main">
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="armies.php">Army Manager</a> > <a href="manage_army.php"><?php echo $details['army_name']; ?></a></h4>
			
				<div id="management">
				
					<form name="update_army" action="update_army.php" method="post">
					
						<h4>Army Details</h4>
						
						<p>Name</p>
						<p><input type="text" name="army_name" value="<?php echo $details['army_name']; ?>"></p>
						
						<p>Codex</p>
						<p><select name="codex">
							<option <?php if ( $details['codex'] == "Blood Angels" ) { echo "SELECTED"; } ?> value="Blood Angels">Blood Angels</option>
							<option <?php if ( $details['codex'] == "Chaos Daemons" ) { echo "SELECTED"; } ?> value="Chaos Daemons">Chaos Daemons</option>
							<option <?php if ( $details['codex'] == "Chaos Space Marines" ) { echo "SELECTED"; } ?> value="Chaos Space Marines">Chaos Space Marines</option>
							<option <?php if ( $details['codex'] == "Dark Eldar" ) { echo "SELECTED"; } ?> value="Dark Eldar">Dark Eldar</option>
							<option <?php if ( $details['codex'] == "Eldar" ) { echo "SELECTED"; } ?> value="Eldar">Eldar</option>
							<option <?php if ( $details['codex'] == "Grey Knights" ) { echo "SELECTED"; } ?> value="Grey Knights">Grey Knights</option>
							<option <?php if ( $details['codex'] == "Imperial Guard" ) { echo "SELECTED"; } ?> value="Imperial Guard">Imperial Guard</option>
							<option <?php if ( $details['codex'] == "Necrons" ) { echo "SELECTED"; } ?> value="Necrons">Necrons</option>
							<option <?php if ( $details['codex'] == "Orks" ) { echo "SELECTED"; } ?> value="Orks">Orks</option>
							<option <?php if ( $details['codex'] == "Space Marines" ) { echo "SELECTED"; } ?> value="Space Marines">Space Marines</option>
							<option <?php if ( $details['codex'] == "Space Wolves" ) { echo "SELECTED"; } ?> value="Space Wolves">Space Wolves</option>
							<option <?php if ( $details['codex'] == "Tau Empire" ) { echo "SELECTED"; } ?> value="Tau Empire">Tau Empire</option>
							<option <?php if ( $details['codex'] == "Tyranids" ) { echo "SELECTED"; } ?> value="Tyranids">Tyranids</option>
							<option <?php if ( $details['codex'] == "Witch Hunters" ) { echo "SELECTED"; } ?> value="Witch Hunters">Witch Hunters</option>
						</select></p>
					
						<p>Points</p>
						<p><input type="text" name="points" value="<?php echo $details['points']; ?>"></p>
						
						<p>Comments</p>
						<p><textarea cols="25" rows="5" name="comments"><?php echo stripslashes($details['comments']); ?></textarea></p>
						
						<p>Public? <input class="checkbox" type="checkbox" name="public" value="public"<?php if ( $details['public'] == "yes" ) { echo "checked=\"checked\"";} ?>></p>
					
						<p><input class="submit" type="submit" name="submit" value="Update!">
						
						<a class="delete" onclick="return confirm('Are you sure you want to delete this army?')"href="delete_army.php?army_id=<?php echo $_SESSION['army_id']; ?>">Delete Army</a></p>

						
					</form>
					
					<form name="codex_unit" action="codex_unit.php" method="post">
					
						<h4>Add Unit</h4>
						
						<p>Select Unit</p>
						<p><select name="unit">
							<?php
								$display = new Display();
								$display->codexUnitsOption($_SESSION['uid'], $details['codex']);
							?>
						</select></p>
						
						<p><input class="submit" type="submit" name="submit" value="Add!"></p>
					
					</form>
									
				</div> <!-- End Management -->
			
				<div id="display">
					
					<?php 
					
						echo "<h5>" . stripslashes($details['army_name']) . "</h5>";
						$display = new Display();
						$armyTotal = $display->units($_SESSION['army_id']);
						if ( $armyTotal > $details['points'] ) {
							$class = "total_over";
						} else {
							$class = "total_under";
						}
						echo "<hr/><h6>Army Total: <span class=\"" . $class . "\">" . $armyTotal . "/" . $details['points'] . "<span></h6>";
						echo "<hr/><div class=\"padding\"><p><a href=\"create_pdf.php?army_id=" . $_SESSION['army_id'] . "\" target=\"_blank\">Save As PDF</a></p></div>";
						echo "<div class=\"padding\"><p><a href=\"forum_output.php?army_id=" . $_SESSION['army_id'] . "\" target=\"_blank\">Show Forum Tags</a></p></div>";
					
					?>
					
				</div> <!-- End Army List -->
							
			</div>
			
			<?php include "sidebar.php" ?>
		
		</div> <!-- End Container -->
	
	</body>
</html>