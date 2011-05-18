<?php
/***********************************************
File: search.php
Author: Adam Krone
Description: Handles user searches for armies.
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
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="search.php">Search</a></h4>
				
				<div id="search">
								
					<form class="center" name="search" action="search_results.php" method="get">
					
						<h4>Search</h4>
						
						<p>Codex</p>
						<p><select name="codex">
							<option value="All">All</option>
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
						
						<p><input class="submit" type="submit" name="submit" value="Search!"></p>
					
					</form>
				
				</div>
							
			</div>
			
			<?php include_once "sidebar.php"; ?>
	
	</body>
</html>