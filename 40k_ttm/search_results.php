<?php
/***********************************************
File: search_results.php
Author: Adam Krone
Description: Displays search results.
***********************************************/


	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$codex = $_GET['codex'];
	$points = $_GET['points'];
	
	$_SESSION['last_search'] = $_SERVER['QUERY_STRING'];
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "head_tags.php"; ?>
	</head>
	<body>
	
		<?php include_once("leaderboard.php"); ?>
	
		<div id="container" class="box_shadow box_round">
		
			<?php include_once "header.php"; ?>
		
			<div id="main">
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="search.php">Search</a> > <a href="search_results.php?<?php echo $_SESSION['last_search']; ?>">Results</a></h4>
				
				<div id="management">
				
					<form name="search" action="search_results.php" method="get">
					
						<h4>Search</h4>
						
						<p>Codex</p>
						<p><select name="codex">
							<option <?php  if ( $_GET['codex'] == "All" ) { echo "SELECTED"; } ?> value="All">All</option>
							<option <?php  if ( $_GET['codex'] == "Blood Angels" ) { echo "SELECTED"; } ?> value="Blood Angels">Blood Angels</option>
							<option <?php  if ( $_GET['codex'] == "Chaos Daemons" ) { echo "SELECTED"; } ?> value="Chaos Daemons">Chaos Daemons</option>
							<option  <?php  if ( $_GET['codex'] == "Chaos Space Marines" ) { echo "SELECTED"; } ?> value="Chaos Space Marines">Chaos Space Marines</option>
							<option <?php  if ( $_GET['codex'] == "Dark Eldar" ) { echo "SELECTED"; } ?> value="Dark Eldar">Dark Eldar</option>
							<option <?php  if ( $_GET['codex'] == "Eldar" ) { echo "SELECTED"; } ?> value="Eldar">Eldar</option>
							<option <?php  if ( $_GET['codex'] == "Grey Knights" ) { echo "SELECTED"; } ?> value="Grey Knights">Grey Knights</option>
							<option <?php  if ( $_GET['codex'] == "Imperial Guard" ) { echo "SELECTED"; } ?> value="Imperial Guard">Imperial Guard</option>
							<option <?php  if ( $_GET['codex'] == "Necrons" ) { echo "SELECTED"; } ?> value="Necrons">Necrons</option>
							<option <?php  if ( $_GET['codex'] == "Orks" ) { echo "SELECTED"; } ?> value="Orks">Orks</option>
							<option <?php  if ( $_GET['codex'] == "Space Marines" ) { echo "SELECTED"; } ?> value="Space Marines">Space Marines</option>
							<option <?php  if ( $_GET['codex'] == "Space Wolves" ) { echo "SELECTED"; } ?> value="Space Wolves">Space Wolves</option>
							<option <?php  if ( $_GET['codex'] == "Tau Empire" ) { echo "SELECTED"; } ?> value="Tau Empire">Tau Empire</option>
							<option <?php  if ( $_GET['codex'] == "Tyranids" ) { echo "SELECTED"; } ?> value="Tyranids">Tyranids</option>
							<option <?php  if ( $_GET['codex'] == "Witch Hunters" ) { echo "SELECTED"; } ?> value="Witch Hunters">Witch Hunters</option>
						</select></p>
						
						<p>Points</p>
					 	<p><input type="text" name="points" value="<?php echo $_GET['points']; ?>"></p>
						
						<p><input class="submit" type="submit" name="submit" value="Search!"></p>
					
					</form>

				</div>
				
				<div id="display">
				
					<h4>Results</h4>
					
					<?php
					
						$display = new Display();
						$display->searchResults($codex, $points);
					
					?>
										
				</div> 
			
			</div>
			
			<?php include "sidebar.php"; ?>
		
		</div> <!-- End Container -->
	
	</body>
</html>