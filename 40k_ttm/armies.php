<?php
/***********************************************
File: armies.php
Author: Adam Krone
Description: Handles management of user armies.
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
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="armies.php">Army Manager</a></h4>
			
				<div id="left">
					
					<form name="manage_army" action="manage_army.php" method="post">
						
						<h4>Manage Army</h4>
					
						<p>Select Army</p>
						<p><select name="armies">
							<?php
							
								$display = new Display();
								$display->armiesOption($_SESSION['uid']);
							
							?>
						</select></p>
						
						<p><input class="submit" type="submit" name="submit" value="Manage!"></p>
										
					</form>
					
				</div>
				
				<div id="right">
					
					<form name="create_army" action="new_army.php" method="post">
					
						<h4>Create New Army</h4>
					
						<p>Name</p>
						<p><input type="text" name="army_name"></p>
						
						<p>Codex</p>
						<p><select name="codex">
							<option value="Blood Angels">Blood Angels</option>
							<option value="Chaos Daemons">Chaos Daemons</option>
							<option value="Chaos Space Marines">Chaos Space Marines</option>
							<option value="Dark Eldar">Dark Eldar</option>
							<option value="Eldar">Eldar</option>
							<option value="Grey Knights">Grey Knights</option>
							<option value="Imperial Guard">Imperial Guard</option>
							<option value="Necrons">Necrons</option>
							<option value="Orks">Orks</option>
							<option value="Space Marines">Space Marines</option>
							<option value="Space Wolves">Space Wolves</option>
							<option value="Tau Empire">Tau Empire</option>
							<option value="Tyranids">Tyranids</option>
							<option value="Witch Hunters">Witch Hunters</option>
						</select></p>
					
						<p>Points</p>
						<p><input type="text" name="points"></p>
						
						<p>Comments (optional)</p>
						<p><textarea cols="25" rows="5" name="comments"></textarea></p>
						
						<p>Public? <input class="checkbox" type="checkbox" name="public" value="public"></p>
					
						<p><input class="submit" type="submit" name="submit" value="Create!"></p>
					
					</form>
					
				</div>
							
			</div>
			
			<?php include "sidebar.php"; ?>
		
		</div> <!-- End Container -->
	
	</body>
</html>