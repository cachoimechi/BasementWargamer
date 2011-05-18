<?php
/***********************************************
File: manage_codex.php
Author: Adam Krone
Description: Handles management of codex units.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	if ( isset($_POST['codex']) ) { 
		$_SESSION['codex'] = $_POST['codex']; 
	}
	
	if ( ! isset($_SESSION['codex']) ) {
		header("Location: codex.php");
	}
	
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
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="codices.php">Codex Manager</a> > <a href="manage_codex.php"><?php echo $_SESSION['codex']; ?> Codex</a></h4>
			
				<div id="management">
				
					<form name="new_codex_unit" action="new_codex_unit.php" method="post">
					
						<h4>Add New Unit</h4>
						
						<p>Name</p>
						<p><input type="text" name="name"></p>
						
						<p>Type</p>
						<p><select name="type">
							<option value="HQ">HQ</option>
							<option value="Elite">Elite</option>
							<option value="Troops">Troops</option>
							<option value="Fast Attack">Fast Attack</option>
							<option value="Heavy Support">Heavy Support</option>
							<option value="Transport">Transport</option>
						</select></p>
						
						<p>Points Per Figure</p>
						<p><input type="text" name="points"></p>
						
						<p><input class="submit" type="submit" name="submit" value="Add!"></p>
					
					</form>

					
				</div> <!-- End Management -->
						
				<div id="display">
					
					<?php 
					
						echo "<h5>" . $_SESSION['codex'] . "</h5>";
						$display = new Display();
						$display->codexUnits($_SESSION['uid'], $_SESSION['codex']);
											
					?>
					
				</div> <!-- End Army List -->
							
			</div>
			
			<div id="ads">
			
				<h3>Ads Here</h3>
			
			</div> <!-- End Ads -->
		
		</div> <!-- End Container -->
	
	</body>
</html>