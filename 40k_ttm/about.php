<?php
/***********************************************
File: about.php
Author: Adam Krone
Description: Overview of the Tabletop Manager.
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
		
		<a id="top"></a>
	
		<?php include "leaderboard.php"; ?>
	
		<div id="container" class="box_shadow box_round">
		
			<?php include_once "header.php"; ?>
		
			<div id="main">
			
				<h4 class="heading"><a href="members.php">Home</a> > <a href="about.php">About</a></h4>
				
				<div id="news">
				
					<h2>About Basement Wargamer's 40k List Builder</h2>
					<p>Basement Wargamer is dedicated to bringing you tools that make managing your hobby easier. We
					comply with Games Workshop policy, and do not provide you with any information that isn't available on their
					site.  In order to use our list builder, you must use your codex to fill out the relevant points costs.</p>
					<p>Our services are provided at no cost, and will always remain that way.  If you would like to make a donation,
					we would be very grateful.  Please send donations to: [insert paypal info here]</p>
					<h2>Walkthrough</h2>
					<p><a href="#cm">1. Codex Manager</a></p>
					<p><a href="#am">2. Army Manager</a></p>
					<p><a href="#search">3. Search</a></p>
					<h7><a id="cm">Using Codex Manager</a></h7> - <a href="#top">To Top</a>
					<iframe width="560" height="349" src="http://www.youtube.com/embed/dfgKg69IDIs" frameborder="0" allowfullscreen></iframe>
					<p>After creating an account you will automatically be logged in.  You we see several items in the navigation
					to choose from.  The two items you will find yourself returning to often are the Army Manager and Codex Manager
					pages.</p>
					<img src="img/walkthrough/codex_manager.png">
					<p>Before starting an army, you must first fill out your codex units.  Navigate to the Codex Manager page and
					select the codex you would like to manage from the drop down.</p>
					<img src="img/walkthrough/manage_codex_form.png">
					<p>Use the Add New Unit form to fill out the details of the first unit you would like to add.</p>
					<img src="img/walkthrough/add_codex_unit_form.png">
					<p>You can now add any unit upgrades to this unit, or go back to the codex manager to add more units.</p>
					<img src="img/walkthrough/edit_codex_unit.png">
					<p>Upgrades will be displayed below the unit information and can be edited or deleted as you wish.</p>
					<img src="img/walkthrough/codex_unit_upgrades.png">
					<p>When you are finished with your changes, click edit and you will return to the codex manager. Your units
					will be displayed by force organization type, and clicking on each heading will collapse the units below.  This is
					especially useful when you have a lot of units entered and you want to quickly find a unit to make a change.</p>
					<img src="img/walkthrough/codex_unit_display.png">
					<p>We recommend that you only add the units and upgrades that you feel you will use at first.  You can
					always return later and make any necessary additions or changes.  Entering all that information can seem
					daunting at first, but once you do, you're only a handful of clicks away from creating a new army and testing
					out your options.</p>
					<h7><a id="am">Using the Army Manger</a></h7> - <a href="#top">To Top</a>
					<img src="img/walkthrough/army_manager.png">
					<p>Now it's time to create your first army!  Navigate to the Army Manager page and fill out the Create New Army
					form. The public checkbox will allow other users to view your army on the search page.</p>
					<img src="img/walkthrough/create_army_form.png">
					<p>You will see a list of your armies in the Manage Army form.  Select the army you just made and click
					manage.</p>
					<img src="img/walkthrough/manage_army_form.png">
					<p>This page is similar to the Codex Manager.  In the upper left you will see the army details you just filled
					out.  As you are building your army, you may want to change your comments section to reflect changes in your
					army's strategy, or add fluff if you have written one.</p>
					<img src="img/walkthrough/army_details.png">
					<p>Let's add our first unit.  Select a unit from the drop down in the Add Unit form.</p>
					<img src="img/walkthrough/add_unit.png">
					<p> You will be redirected to the edit unit page.  You can change the unit's name if you like to give your units
					special names, or to make it easier to identify multiple units based off of the same codex entry. Select any
					upgrades you want to give the unit, and specify the number of copies if multiple models can have it. Copies
					will default to 1, so in most cases you will only need to check the upgrades you want.</p>
					<img src="img/walkthrough/edit_unit_form.png">
					<p>Units will be broken into their force organization slots, and points will automatically be calculated for you
					and displayed at the bottom of each section.  You can see the overall army total at the bottom, which will display
					in red if you have gone over your points limit.</p>
					<img src="img/walkthrough/army_total.png">
					<p>Below the army totals you will see the Save As PDF and Show Forum Tags links.  These will generate a pdf
					of your army to print out, and a BBCode formatted army list you can copy into a post on your favorite 40k
					forum, respectively.</p>
					<img src="img/walkthrough/pdf_forum.png">
					<h7><a id="search">Using the Search Functionality</a></h7> - <a href="#top">To Top</a>
					<p>Coming soon...</p>
				
				</div>
			
			</div>
			
			<?php include "sidebar.php"; ?>
	
	</body>
</html>