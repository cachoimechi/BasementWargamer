<?php
/***********************************************
File: view_army.php
Author: Adam Krone
Description: Handles viewing of armies.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$armyid = $_GET['army_id'];
	//$_SESSION['army_id'] = $armyid;
	
	$army = new Army();
	$details = $army->getDetails($armyid);
	
	$user = new User();
	$username = $user->getUsername($details['user_id']);
	
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
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="search.php">Search</a> > <a href="search_results.php?<?php echo $_SESSION['last_search']; ?>">Results</a> > <a href="<?php echo basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING']; ?>"><?php echo $details['army_name']; ?></a></h4>
					
				<div id="army_info">
				
					<h4>Army Information</h4>
					
					<div class="padding"><p>Army Name: <?php echo $details['army_name']; ?></p></div><hr/>
					<div class="padding"><p>Creator: <?php echo $username; ?></p></div><hr/>
					<div class="padding"><p>Comments: <?php echo stripslashes($details['comments']); ?></p></div>
				
				</div>
				
				<div id="display">
					
					<?php
						
						$display = new Display();
						$armyTotal = $display->viewUnits($armyid, $details['user_id']);
						if ( $armyTotal > $details['points'] ) {
							$class = "total_over";
						} else {
							$class = "total_under";
						}
						echo "<hr/><h6>Army Total: <span class=\"" . $class . "\">" . $armyTotal . "/" . $details['points'] . "<span></h6>";
					
					?>
										
				</div> 
			
			</div>
			
			<?php include "sidebar.php"; ?>
		
		</div> <!-- End Container -->
	
	</body>
</html>