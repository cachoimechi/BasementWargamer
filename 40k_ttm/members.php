<?php
/***********************************************
File: members.php
Author: Adam Krone
Description: Homepage for registered members.
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
			
				<h4 class="heading"><a href="members.php">Home</a></h4>
				
				<div id="news">
				
					<?php echo "<p><em>Welcome, " . $_SESSION['username'] . "!</em></p>"; ?>
					<p>If this is your first time visiting, please take the time to read through the <a href="about.php">guide</a>.
					It will walk you through the features of the site, and get you up and running quickly. Alternatively, you can
					watch the video version below:</p>
					<iframe width="560" height="349" src="http://www.youtube.com/embed/dfgKg69IDIs" frameborder="0" allowfullscreen></iframe>
					
					<!--
					<h2>Latest News:</h2>
					
					<p><strong>Beta Testing</strong><br/>
					<em>Posted: 4.20.2011</em></p>
					<p>We are currently preparing for beta testing! Preliminary documentation and video walkthroughs will be posted 
					this week. Stay tuned for more updates!</p>
					-->
		
				</div> 
			
			</div>
			
			<?php include "sidebar.php"; ?>
		
		</div> <!-- End Container -->
	
	</body>
</html>