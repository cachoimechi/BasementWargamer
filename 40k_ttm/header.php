<?php
/***********************************************
File: header.php
Author: Adam Krone
Description: Handles display of the navigation.
***********************************************/
?>

<div id="nav">
	<ul id="nav-links">
		<li><a <?php if (basename($_SERVER['PHP_SELF']) == "members.php") { echo "class=\"selected\""; } ?> href="members.php">Home</a></li>
		<li><a <?php if (basename($_SERVER['PHP_SELF']) == "armies.php") { echo "class=\"selected\""; } else if (basename($_SERVER['PHP_SELF']) == "manage_army.php"){ echo "class=\"selected\""; } ?> href="armies.php">Army Manager</a></li>
		<li><a <?php if (basename($_SERVER['PHP_SELF']) == "codices.php") { echo "class=\"selected\""; } else if (basename($_SERVER['PHP_SELF']) == "manage_codex.php"){ echo "class=\"selected\""; } ?> href="codices.php">Codex Manager</a></li>
		<li><a <?php if (basename($_SERVER['PHP_SELF']) == "search.php") { echo "class=\"selected\""; } else if (basename($_SERVER['PHP_SELF']) == "search_results.php" ) { echo "class=\"selected\""; } else if (basename($_SERVER['PHP_SELF']) == "view_army.php" ) { echo "class=\"selected\""; } ?> href="search.php">Search</a></li>
		<li><a <?php if (basename($_SERVER['PHP_SELF']) == "user_settings.php") { echo "class=\"selected\""; } ?> href="user_settings.php">Settings</a></li>
		<li><a <?php if (basename($_SERVER['PHP_SELF']) == "about.php") { echo "class=\"selected\""; } ?> href="about.php">About</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
	
	<h1>40k List Builder</h1>
	
</div>
