<?php
/***********************************************
File: func.inc.php
Author: Adam Krone
Description: Includes all functions  and classes to be used in
the tabletop manager application.
***********************************************/

/***********************
Functions
***********************/

	//Sanitize Strings
	function sanitize($string) {
		$sanitized = trim(strip_tags(addslashes($string)));
		return $sanitized;
	}
	
	//Redirect
	function redirect($url) {
	
		header("refresh:2;url=$url");
		
		return "<p>You are being redirected.  If your browser doesn't support this,
		<a href=\"$url\">click here</a> to continue.</p></div>";
	
	}
	
	
/****************************************************************************************/
	
	
/***********************
Classes
***********************/

	//USER MANAGEMENT
	class User {
	
		//Login
		function login($username, $password) {
		
			//sanitize strings
			$username = sanitize($username);
			$password = sanitize($password);
			$password = md5($password);
			
			//return values
			$nouser = "<h3>The username you specified does not exist!</h3><div class=\"padding\">";
			$nomatch = "<h3>Incorrect password.</h3><div class=\"padding\">";
			$success = "<h3>You have been logged in.</h3><div class=\"padding\"><p>Welcome back, $username!</p>";
			
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM users WHERE user_name = '$username'";
			$result = $mydb->query($sql);
			$row = $result->fetch_assoc();
			
			//check if user exists
			if ( $result->num_rows == 0 ) {
			
				$output = redirect("login_form.php");
				return $nouser . $output;
			
			//check if passwords match
			} else if ( $row['password'] != $password ) {
			
				$output = redirect("login_form.php");
				return $nomatch . $output;
			
			//setup session info
			} else {
			
				session_start();
				
				$_SESSION['username'] = $username;
				$_SESSION['uid'] = $row['user_id'];
				
				$output = redirect("members.php");
				return $success . $output;
			
			}
			
			$result->close();
			
			$mydb->close();
		
		}
		
		//Logout
		function logout() {
		
			$_SESSION['username'] = '';
		
			session_destroy();
			
			$output = redirect("index.php");
			
			return "<h3>You have been successfully logged out.</h3><div class=\"padding\">" . $output;
		
		}
		
		//Create User
		function create($username, $password, $email) {
		
			//sanitize strings
			$username = sanitize($username);
			$password = sanitize($password);
			$email = sanitize($email);
			
			//encrypt password
			$password = md5($password);
			
			//return values
			$success = "<h3>User created successfully!</h3>";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			$used = "<h3>That user name is already being used.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM users WHERE user_name = '$username'";
			$result = $mydb->query($sql);
			
			//check if user exists
			if ( $result->num_rows != 0 ) {
				
				return $used . redirect("register_form.php");
			
			//setup user
			} else {
			
				$sql = "INSERT INTO users (user_name, password, email)
				VALUES ('$username', '$password', '$email')";
						
				//error handling
				if ($mydb->query($sql) == TRUE) {
				
					return $success;
				
				} else {
				
					return $failure . redirect("register_form.php");
				
				}
			
			}
			
			$mydb->close();
		
		}
		
		//Change Password
		function changePassword($userid, $oldPassword, $newPassword) {
		
			//sanitize strings
			$oldPassword = sanitize($oldPassword);
			$newPassword = sanitize($newPassword);
			$newPassword = md5($newPassword);
			
			//return values
			$nomatch = "<h3>The old password you specified does not match our records.</h3><div class=\"padding\">";
			$success = "<h3>Password successfully changed!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM users WHERE user_id = '$userid'";
			$result = $mydb->query($sql);
			$checkPassword = $result->fetch_assoc();
			
			//check if passwords match
			if ( $checkPassword['password'] == md5($oldPassword) ) {
		
				$sql = "UPDATE users SET password = '$newPassword' WHERE user_id = '$userid' ";
				
				//error handling
				if($mydb->query($sql) == TRUE) {
				
					return $success;
				
				} else {
				
					return $failure;
				
				}
				
			//passwords do not match
			} else {
			
				return $nomatch;
			
			}
			
			$result->close();
		
			$mydb->close();
			
		}
		
		//Change Email
		function changeEmail($userid, $email) {
		
			//sanitize strings
			$email = sanitize($email);
			
			//return values
			$success = "<h3>Email updated successfully!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "UPDATE users SET email = '$email' WHERE user_id = '$userid'";
			
			//error handling
			if($mydb->query($sql) == TRUE) {
			
				return $success;
			
			} else {
			
				return $failure;
			
			}
			
			$mydb->close();
		
		}
		
		//Get username
		function getUsername($userid) {
			
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM users WHERE user_id = '$userid'";
			$result = $mydb->query($sql);
			$row = $result->fetch_assoc();
			$username = $row['user_name'];
			
			return $username;
			
		}
			
	}
	
	/********************************************************************/
	
	//ARMY MANAGEMENT
	class Army {
	
		//Create Army
		function create($userid, $armyname, $codex, $points, $comments, $public) {
		
			//sanitize strings
			$armyname = sanitize($armyname);
			$codex = sanitize($codex);
			$points = sanitize($points);
			$comments = sanitize($comments);
			$public = sanitize($public);
		
			//return values
			$success = "<h3>Army created successfully!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "INSERT INTO armies (user_id, army_name, codex, points, comments, public)
			VALUES ('$userid', '$armyname', '$codex', '$points', '$comments', '$public')";
					
			//error handling
			if ($mydb->query($sql) == TRUE) {
			
				return $success;
			
			} else {
			
				return $failure;
			
			}
		
		}
		
		//Update Army
		function update($armyid, $armyname, $codex, $points, $comments, $public) {
			
			//sanitize strings
			$armyname = sanitize($armyname);
			$codex = sanitize($codex);
			$points = sanitize($points);
			$comments = sanitize($comments);
			$public = sanitize($public);
			
			//return values
			$success = "<h3>Army successfully updated!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "UPDATE armies SET army_name = '$armyname', codex = '$codex', 
			points = '$points', comments = '$comments', public = '$public' WHERE army_id = '$armyid'";
			
			//error handling
			if($mydb->query($sql) == TRUE) {
				
				return $success;
			
			} else {
			
				return $failure;
			
			}
			
			$mydb->close();
		
		}
		
		//Delete Army
		function delete($armyid) {
		
			//return values
			$success = "<h3>Army successfully deleted.</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "DELETE FROM armies WHERE army_id = '$armyid'";
			
			//error handling
			if($mydb->query($sql) == TRUE) {
			
				$sql = "DELETE FROM units WHERE army_id = '$armyid'";
				
				if ($mydb->query($sql) == TRUE) {
					return $success;
				} else {
					return $failure;
				}
			
			} else {
			
				return $failure;
				
			}
			
			$mydb->close();
		
		}
	
		//Get Army Details
		function getDetails($armyid) {
	
		//query db
		include "db.inc.php";
		$sql = "SELECT * FROM armies WHERE army_id = '$armyid'";
		
		$result = $mydb->query($sql);
		
		$row = $result->fetch_assoc();
		
		return $row;
	
		}
	
	}
	
	
	/********************************************************************/


	//UNIT MANAGEMENT
	 
	class Unit {
	
		//Create Unit
		function create($armyid, $userid, $name, $codex, $type, $points, $upgrades, $copies) {
		
			//sanitize strings
			$name = sanitize($name);
			$points = sanitize($points);
			$upgrades = sanitize($upgrades);
			
			
			//return values
			$success = "<h3>Unit successfully created!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "INSERT INTO units (army_id, user_id, name, codex, type, points, upgrades, copies)
			VALUES ('$armyid', '$userid', '$name', '$codex', '$type', '$points', '$upgrades', '$copies')";
			
			//error handling
			if($mydb->query($sql) == TRUE) {
			
				return $success;
			
			} else {
			
				return $failure;
			
			}
			
			$mydb->close();
		
		}
		
		//Update Unit
		function update($armyid, $unitid, $name, $type, $upgrades, $upgradecopies, $copies) {
		
			//sanitize strings
			$name = sanitize($name);
			$type = sanitize($type);
			$upgrades = sanitize($upgrades);
			
			
			//return values
			$success = "<h3>Unit successfully updated!</h3><div class=\"padding\">";
			$failure = "Error: Please try again later.";
			
			//query db
			include "db.inc.php";
			$sql = "UPDATE units SET name = '$name',
			type = '$type', active_upgrades = '$upgrades', upgrade_copies = '$upgradecopies', copies = '$copies' WHERE army_id = '$armyid' AND unit_id = '$unitid'";
			
			//error handling
			if ($mydb->query($sql) == TRUE) {
			
				return $success;
			
			} else {
			
				return $failure;
			
			}
			
			$mydb->close();
		
		}
		
		//Delete Unit
		function delete($unitid) {
		
			//return values
			$success = "<h3>Unit successfully deleted!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "DELETE FROM units WHERE unit_id = '$unitid'";
			
			//error handling
			if ($mydb->query($sql) == TRUE ) {
				
				return $success;
			
			} else {
			
				return $failure;
			
			}
			
			$mydb->close();
		
		}
		
		//Copy Codex Unit
		function codexUnit($armyid, $unitid) {
		
			//return values
			$success = "<h3>Codex Unit successfully added!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "INSERT INTO units (codex_unit_id, army_id, user_id, name, codex, type, points)
			SELECT unit_id, '$armyid', user_id, name, codex, type, points FROM codex_units WHERE unit_id = '$unitid'";
			
			if ( $mydb->query($sql) == TRUE ) {
				$output = $success;
				$string = "edit_unit.php?unit_id=" . $mydb->insert_id;
				$output .= redirect($string);
				return $output;
			} else {
				$output = $failure;
				$output .= redirect("manage_army.php");
				return $output;
			}
			
			$mydb->close();
		
		}
		
		//Get Unit Details
		function getDetails($unitid) {
	
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM units WHERE unit_id = '$unitid'";
			
			$result = $mydb->query($sql);
			
			$row = $result->fetch_assoc();
			
			return $row;
	
		}
	
	}
	
	
	/********************************************************************/
	
	
	//CODEX UNIT MANAGEMENT
	class Codex {
	
		//Create Codex Unit
		function create($userid, $codex, $name, $type, $points) {
		
			//sanitize strings
			$name = sanitize($name);
			$points = sanitize($points);
			
			//return values
			$success = "<h3>Codex Unit successfully created!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "INSERT INTO codex_units (user_id, codex, name, type, points)
			VALUES ('$userid', '$codex', '$name', '$type', '$points')";
			
			//error handling
			if($mydb->query($sql) == TRUE) {
				$id = $mydb->insert_id;
				$string = "edit_codex_unit.php?unit_id=" . $id;
				$output = $success;
				$output .= redirect($string);
				return $output;
			} else {
				$output = $failure;
				$output .= redirect("manage_codex.php");
				return $output;
			
			}
			
			$mydb->close();
		
		}
		
		//Update Codex Unit
		function update($unitid, $name, $type, $points) {
		
			//sanitize strings
			$name = sanitize($name);
			$type = sanitize($type);
			$points = sanitize($points);
			
			
			//return values
			$success = "<h3>Codex Unit successfully updated!</h3><div class=\"padding\">";
			$failure = "Error: Please try again later.";
			
			//query db
			include "db.inc.php";
			$sql = "UPDATE codex_units SET name = '$name',
			type = '$type', points = '$points' WHERE unit_id = '$unitid'";
			
			//error handling
			if ($mydb->query($sql) == TRUE) {
			
				//query db
				$sql = "UPDATE units SET points = '$points' WHERE codex_unit_id = '$unitid'";
				
				if ($mydb->query($sql) == TRUE) {
					return $success;
				} else {
					return $failure;
				}
			
			} else {
			
				return $failure;
			
			}
			
			$mydb->close();
			
		}
		
		//Delete Codex Unit
		function delete($unitid) {
		
			//return values
			$success = "<h3>Codex Unit successfully deleted!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "DELETE FROM codex_units WHERE unit_id = '$unitid'";
			
			//error handling
			if ($mydb->query($sql) == TRUE ) {
				
				return $success;
			
			} else {
			
				return $failure;
			
			}
			
			$mydb->close();
		
		}
		
		//Update Upgrade
		function updateUpgrade($unitid, $string) {
		
			//query db
			include "db.inc.php";
			$sql = "UPDATE codex_units SET upgrades = '$string' WHERE unit_id = '$unitid'";
			$mydb->query($sql);
		
		}
		
		//Get Codex Unit Details
		function getDetails($unitid) {
	
		//query db
		include "db.inc.php";
		$sql = "SELECT * FROM codex_units WHERE unit_id = '$unitid'";
		
		$result = $mydb->query($sql);
		
		$row = $result->fetch_assoc();
		
		return $row;
	
		}
		
		
	
	}
	
	
	/********************************************************************/

	
	//UPGRADE HANDLING
	class Upgrade {
	
		//Add
		function add($userid, $unitid, $name, $points) {
		
			//sanitize strings
			$name = sanitize($name);
			$points = sanitize($points);
		
			//return values
			$success = "<h3>Upgrade successfully added!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
		
			//query db
			include "db.inc.php";
			$sql = "INSERT INTO upgrades (user_id, unit_id, name, points) VALUES('$userid', '$unitid', '$name', '$points')";
			
			//error handling
			if ( $mydb->query($sql) == TRUE ) {
				return $success;
			} else {
				return $failure;
			}
		
		}
		
		//Update
		function update($upgradeid, $name, $points) {
		
			//sanitize strings
			$name = sanitize($name);
			$points = sanitize($points);
			
			//return values
			$success = "<h3>Upgrade successfully updated!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "UPDATE upgrades SET name = '$name', points = '$points' WHERE upgrade_id = '$upgradeid'";
			
			if ( $mydb->query($sql) == TRUE ) {
				return $success;
			} else {
				return $failure;
			}
		
		}
		
		//Delete
		function delete($upgradeid) {
		
			//return values
			$success = "<h3>Upgrade successfully deleted!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "DELETE FROM upgrades WHERE upgrade_id = '$upgradeid'";
			
			if ( $mydb->query($sql) == TRUE ) {
				return $success;
			} else {
				return $failure;
			}
			
		}
		
		//Get Upgrade From ID
		function id($upgradeid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM upgrades WHERE upgrade_id = '$upgradeid'";
			$result = $mydb->query($sql);
			$row = $result->fetch_assoc();
			
			return $row;
		
		}
		
		//Get Upgrade Info
		function getUpgrade($userid, $unitid, $name) {
		
			$name = sanitize($name);
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM upgrades WHERE user_id = '$userid' AND unit_id = '$unitid' AND name = '$name'";
			$result = $mydb->query($sql);
			$row = $result->fetch_assoc();
			
			return $row;
		
		}
		
		//Make Upgrade String
		function makeString($unitid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM upgrades WHERE unit_id = '$unitid'";
			$result = $mydb->query($sql);
			
			$string = "";
			
			while ( $row = $result->fetch_assoc() ) {
				$string .= $row['name'] . "|";
			}
			
			return $string;
		
		}
	
	}
	
	
	/********************************************************************/
	
	
	//COMMENT HANDLING
	class Comment {
	
		//Post Comment
		function post($armyid, $username, $comment) {
		
			//return values
			$success = "<h3>Thank you for your comment!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
		
			//query db
			include "db.inc.php";
			$sql = "INSERT INTO comments (army_id, user_name, date, comment)
			VALUES ('$armyid', '$username', NOW(), '$comment')";
			
			//error handling
			if ( $mydb->query($sql) == TRUE ) {
				
				return $success;
			
			} else {
			
				return $failure;
			
			}
		
		}
		
		//Edit Comment
		function edit($commentid, $comment) {
		
			//return values
			$success = "<h3>Comment successfully updated!</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
		
			//query db
			include "db.inc.php";
			$sql = "UPDATE comments SET comment = '$comment' WHERE comment_id = '$comment_id'";
			
			//error handling
			if ( $mydb->query($sql) == TRUE ) {
			
				return $success;
			
			} else {
			
				return $failure;
			
			}
		
		}
	
		//Delete Comment
		function delete($commentid) {
		
			//return values
			$success = "<h3>Comment successfully deleted.</h3><div class=\"padding\">";
			$failure = "<h3>Error: Please try again later.</h3><div class=\"padding\">";
			
			//query db
			include "db.inc.php";
			$sql = "DELETE FROM comments WHERE comment_id = '$commentid'";
			
			//error handling
			if ( $mydb->query($sql) == TRUE ) {
			
				return $success;
			
			} else {
			
				return $failure;
			
			}
		
		}
	
	}
	
	
	/********************************************************************/
	
	
	//DISPLAY HANDLING
	class Display {
	
		//Display Army Anchor Tags
		function armiesAnchor($userid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM armies WHERE user_id = '$userid' ORDER BY army_name";
			$result = $mydb->query($sql);
			
			//echo results
			while( $row = $result->fetch_assoc() ) {
			
				echo "<a href=\"manage_army.php?&army_id=" . $row['army_id'] . "\">" . $row['army_name'] . "</a>";
			
			}
			
			$result->close();
			
			$mydb->close();
		
		}
		
		//Display Army Option Tags
		function armiesOption($userid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM armies WHERE user_id = '$userid' ORDER BY army_name";
			$result = $mydb->query($sql);
			
			//echo results
			while( $row = $result->fetch_assoc() ) {
			
				echo "<option value=\"" . $row['army_id'] . "\">" . $row['army_name'] . "</option>";
			
			}
			
			$result->close();
			
			$mydb->close();
		
		}
		
		//Units
		function units($armyid) {
			 
			$type = array("HQ", "Elite", "Troops", "Fast Attack", "Heavy Support", "Transport");
			$armyTotal = 0;
		
			//setup db
			include "db.inc.php";
			
			for( $i = 0; $i < 6; $i++ ) {
			
				$typeTotal = 0;
			
				//query db
				$sql = "SELECT * FROM units WHERE army_id = '$armyid' AND type = '$type[$i]' ORDER BY name";
				$result = $mydb->query($sql);
				
				//echo type heading if entries exist
				if ( $result->num_rows != 0 ) {
				
					echo "<h3><a class=\"toggle\" href=\"#\">" . $type[$i] . "</a></h3><div class=\"toggle_div\">";
				
				}
				
				//display units
				while( $row = $result->fetch_assoc() ) {
				
					$name = $row['name'];
					$id = $row['unit_id'];
					$points = $row['points'] * $row['copies'];
					$codexid = $row['codex_unit_id'];
					
					//check if multiple copies exist
					if ( $row['copies'] != 1 ) {
					
						$name = $name . " x" . $row['copies'];
					
					}
					
					if ( $row['active_upgrades'] != "" ) {
						$upgradeNames = explode("|", $row['active_upgrades']);
						array_pop($upgradeNames);
						$upgradeCopies = explode("|", $row['upgrade_copies']);
						array_pop($upgradeCopies);
						$upgrades = array_combine($upgradeNames, $upgradeCopies);
						
						foreach ($upgrades as $key => $value) {
							$upgrade = new Upgrade();
							$info = $upgrade->getUpgrade($_SESSION['uid'], $codexid, $key);
							$points += $info['points'] * $value;
						}
					}
		
					echo "<div class=\"padding\"><p>" . stripslashes($name) . " - " . $points . " points</p>";
			
					if ( $row['active_upgrades'] != "" ) {
						foreach ($upgrades as $key => $value) {
							if ( $value != "1" ) {
								$value = "x" . $value;
							} else { $value = ""; }
							$upgrade = new Upgrade();
							$info = $upgrade->getUpgrade($_SESSION['uid'], $codexid, $key);
							echo "<p class=\"indent\">" . stripslashes($info['name']) . " $value</p>";
						}
					}
					
					echo "<p><span class=\"manage\"><a href=\"edit_unit.php?unit_id=" . $id . "\">Edit</a>
					| <a href=\"delete_unit.php?unit_id=" . $id . "\">Delete</a></span></p></div><hr/>";
					
					$typeTotal += $points;
					$armyTotal += $points;
				
				}
				
				//display type total if entries exist
				if ( $result->num_rows != 0 ) {
				
					echo "<div class=\"padding\"><p><strong>$type[$i] Total: " . $typeTotal . "</strong></p></div></div>";
					
				}
				
				$result->close();
			
			}
			
			return $armyTotal;
						
			$mydb->close();
		
		}
		
		//View Units
		function viewUnits($armyid, $userid) {
			 
			$type = array("HQ", "Elite", "Troops", "Fast Attack", "Heavy Support", "Transport");
			$armyTotal = 0;
		
			//setup db
			include "db.inc.php";
			
			for( $i = 0; $i < 6; $i++ ) {
			
				$typeTotal = 0;
			
				//query db
				$sql = "SELECT * FROM units WHERE army_id = '$armyid' AND type = '$type[$i]' ORDER BY name";
				$result = $mydb->query($sql);
				
				//echo type heading if entries exist
				if ( $result->num_rows != 0 ) {
				
					echo "<h3><a class=\"toggle\" href=\"#\">" . $type[$i] . "</a></h3><div class=\"toggle_div\">";
				
				}
				
				//display units
				while( $row = $result->fetch_assoc() ) {
				
					$name = $row['name'];
					$id = $row['unit_id'];
					$points = $row['points'] * $row['copies'];
					$codexid = $row['codex_unit_id'];
					
					//check if multiple copies exist
					if ( $row['copies'] != 1 ) {
					
						$name = $name . " x" . $row['copies'];
					
					}
										
					if ( $row['active_upgrades'] != "" ) {
						$upgradeNames = explode("|", $row['active_upgrades']);
						array_pop($upgradeNames);
						$upgradeCopies = explode("|", $row['upgrade_copies']);
						array_pop($upgradeCopies);
						$upgrades = array_combine($upgradeNames, $upgradeCopies);
						
						foreach ($upgrades as $key => $value) {
							$upgrade = new Upgrade();
							$info = $upgrade->getUpgrade($userid, $codexid, $key);
							$points += $info['points'] * $value;
						}
					}
		
					echo "<div class=\"padding\"><p>" . stripslashes($name) . " - " . $points . " points</p>";
			
					if ( $row['active_upgrades'] != "" ) {
						foreach ($upgrades as $key => $value) {
							if ( $value != "1" ) {
								$value = "x" . $value;
							} else { $value = ""; }
							$upgrade = new Upgrade();
							$info = $upgrade->getUpgrade($userid, $codexid, $key);
							echo "<p class=\"indent\">" . stripslashes($info['name']) . " $value</p>";
						}
					}
					
					echo "</div><hr/>";
									
					$typeTotal += $points;
					$armyTotal += $points;
				
				}
				
				//display type total if entries exist
				if ( $result->num_rows != 0 ) {
				
					echo "<div class=\"padding\"><p><strong>$type[$i] Total: " . $typeTotal . "</strong></p></div></div>";
					
				}
				
				$result->close();
			
			}
			
			return $armyTotal;
						
			$mydb->close();
		
		}

		
		//Codex Units
		function codexUnits($userid, $codex) {
		
			$type = array("HQ", "Elite", "Troops", "Fast Attack", "Heavy Support", "Transport");
			
			//query db
			include "db.inc.php";
			
			$totalUnits = 0;
			
			for ( $i = 0; $i < 6; $i++ ) {
	
				$sql = "SELECT * FROM codex_units WHERE user_id = '$userid' AND codex = '$codex' AND type = '$type[$i]' ORDER BY name";
				$result = $mydb->query($sql);
				
				$typeUnits = $result->num_rows;
				
				//echo type heading if entries exist
				if ( $result->num_rows != 0 ) {
				
					echo "<h3><a class=\"toggle\" href=\"#\">" . $type[$i] . "</a></h3><div class=\"toggle_div\">";
					
					$totalUnits += $result->num_rows;
				
				}
				
				//display units
				while( $row = $result->fetch_assoc() ) {
				
					$name = $row['name'];
					$id = $row['unit_id'];
					$points = $row['points'];
					
					echo "<div class=\"padding\"><p>" . stripslashes($name) . " - " . $points . " points</p>";
					
					$upgrades = new Display();
					$upgrades->upgradesNoAnchor($id);
					
					echo "<p><span class=\"manage\"><a href=\"edit_codex_unit.php?unit_id=" . $id . "\">Edit</a>
					| <a href=\"delete_codex_unit.php?unit_id=" . $id . "\">Delete</a></span></p></div>";
					
					echo "<hr/>";
				
				}
				
				if ( $result->num_rows != 0 ) { 
					echo "<div class=\"padding\"><p><strong>Units: " . $typeUnits . "</strong></p></div></div>";
				}
			}
			
			echo "<hr/><div class=\"padding\">Total Number of Units in Codex: " . $totalUnits . "</div>";
		
		}
		
		//Codex Units With Option Tags
		function codexUnitsOption($userid, $codex) {
		
			//query db
			include "db.inc.php";
			
			$type = array("HQ", "Elite", "Troops", "Fast Attack", "Heavy Support", "Transport");
			
			for ($i = 0; $i < 6; $i++) {
			
				//separate by type
				echo "<optgroup label=\"" . $type[$i] . " Units\">";
				
				//query db
				$sql = "SELECT * FROM codex_units WHERE user_id = '$userid' AND codex = '$codex' AND type = '" . $type[$i] . "' ORDER BY name";
				$result = $mydb->query($sql);
				
				if ( $result->num_rows == 0 ) {
					echo "<option value=\"no entry\">no entries...</option>";
				}
			
				//display units in option tags
				while( $row = $result->fetch_assoc() ) {
			
				echo "<option value=\"" . $row['unit_id'] . "\">" . $row['name'] . "</option>";
			
				}
				
				echo "</optgroup>";
			
			}
			
		
			$result->close();
			
			$mydb->close();
		
		}
		
		//Upgrades
		function upgrades($unitid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM upgrades WHERE unit_id = '$unitid' ORDER BY name";
			$result = $mydb->query($sql);
	
			if ( $result->num_rows != 0 ) {
				
				echo "<div class=\"padding\"><p class=\"indent\">Upgrades:</p>";
			
				while( $row = $result->fetch_assoc() ) {
					echo "<hr class=\"half\"/><p class=\"indent\">" . $row['name'] . " - " . $row['points'] . " points</p>";
					echo "<p class=\"indent\"><a href=\"edit_upgrade.php?upgrade_id=" . $row['upgrade_id'] . "\">Edit</a> | <a href=\"delete_upgrade.php?upgrade_id=" . $row['upgrade_id'] . "\">Delete</a></p>";
				}
				
				echo "</div>";
			}
		}
		
		//Upgrades No Anchor
		function upgradesNoAnchor($unitid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM upgrades WHERE unit_id = '$unitid' ORDER BY name";
			$result = $mydb->query($sql);
	
			if ( $result->num_rows != 0 ) {
				
				echo "<div class=\"padding\"><p class=\"indent\">Upgrades:</p>";
			
				while( $row = $result->fetch_assoc() ) {
					echo "<p class=\"indent\">" . stripslashes($row['name']) . " - " . $row['points'] . " points</p>";
				}
				
				echo "</div>";
			}
		}
		
		//Upgrades with checkboxes 
		function upgradeCheckboxes($codexunitid, $upgrades) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM upgrades WHERE unit_id = '$codexunitid'";
			$result = $mydb->query($sql);
			
			while ( $row = $result->fetch_assoc() ) {
				$checked = "";
				$disabled = "disabled=\"disabled\"";
				$value = "1";
				if (array_key_exists($row['name'], $upgrades)) { $checked = "checked=\"checked\""; $disabled = ""; $value = $upgrades[ $row['name'] ]; }
				echo "<p><input class=\"checkbox\" type=\"checkbox\" name=\"upgrades[]\" value=\"" . stripslashes($row['name']) . "\" $checked> " . stripslashes($row['name']) . " - " . $row['points'] . " points - <input $disabled class=\"number\" type=\"textbox\" name=\"upgrade_copies[]\" value=\"$value\"> copies</p>";
			}
		}
		
		//Pdf Output
		function pdfOutput($armyid) {
		
			require "fpdf.php";
			include "db.inc.php";
			
			$type = array("HQ", "Elite", "Troops", "Fast Attack", "Heavy Support", "Transport");
			$armyTotal = 0;
			
			$army = new Army();
			$details = $army->getDetails($armyid);
			
			//PDF Creation
			$pdf = new FPDF();
			$filename = $details['army_name'] . ".pdf";
			
			$pdf->AddPage();
			
			//Page Formatting
			$pdf->SetFont('Arial', 'B', 14);
			$pdf->SetFillColor(255);
			$pdf->SetTextColor(50);
			$pdf->SetLineWidth(1);
			$pdf->SetTopMargin(40);
			$pdf->SetLeftMargin(30);
			$pdf->SetRightMargin(30);
			$pdf->SetAutoPageBreak(true, 35);
			
			//Document Formatting
			$pdf->SetAuthor($_SESSION['username']);
			$pdf->SetTitle($details['army_name']);
			
			//Output
			$pdf->Cell(0, 10, $details['army_name'], 0, 1, 'C', true);
			for ($i = 0; $i < 6; $i++) {
			
				$typeTotal = 0;
				$sql = "SELECT * FROM units WHERE army_id = '$armyid' and type = '$type[$i]'";
				$result = $mydb->query($sql);
				
				//only display a type section if it has entries
				if ($result->num_rows != 0) {
				
					$pdf->SetX(40);
					$pdf->SetRightMargin(40);
					$pdf->SetFont('Arial', 'B', 12);
					$pdf->SetTextColor(255);
					$pdf->SetFillColor(100);
					$pdf->Cell(0, 8, $type[$i], 0, 1, 'C', true);
					
					while($row = $result->fetch_assoc()) {
					
						$pdf->SetFont('Arial', '', 12);
						$pdf->SetFillColor(255);
						$pdf->SetTextColor(50);
						$name = $row['name'];
						$points = $row['points'];
						
						//check if unit has multiple copies
						if ( $row['copies'] != 1 ) {
							$name .= " x" . $row['copies'];
							$points *= $row['copies'];
						}
						
						if ( $row['active_upgrades'] != "" ) {
							$upgradeNames = explode("|", $row['active_upgrades']);
							array_pop($upgradeNames);
							$upgradeCopies = explode("|", $row['upgrade_copies']);
							array_pop($upgradeCopies);
							$upgrades = array_combine($upgradeNames, $upgradeCopies);
							
							foreach ($upgrades as $key => $value) {
								$upgrade = new Upgrade();
								$info = $upgrade->getUpgrade($_SESSION['uid'], $key);
								$points += $info['points'] * $value;
							}
						}
						
						$unitInfo = $name . " - " . $points . " Points";
						$pdf->SetX(50);	
						$pdf->Cell(0, 6, $unitInfo, 0, 1, 'L', true);
				
						if ( $row['active_upgrades'] != "" ) {
							foreach ($upgrades as $key => $value) {
								if ( $value != "1" ) {
									$value = "x" . $value;
								} else { $value = ""; }
								$upgrade = new Upgrade();
								$info = $upgrade->getUpgrade($_SESSION['uid'], $key);
								$upgradeLine = stripslashes($info['name']);
								$pdf->SetX(60);
								$pdf->Cell(0,5, $upgradeLine, 0, 1, 'L', true);
							}
						}
						
						//add up units
						$typeTotal += $points;
						$armyTotal += $points;

					}
					
					$pdf->SetFont('Arial', 'B', 12);
					$totalLine = $type[$i] . " Total: " . $typeTotal;
					$pdf->SetX(50);
					$pdf->Cell(0, 8, $totalLine, 0, 1, 'L', true);
				}
			}
			$pdf->SetFont('Arial', 'B', 15);
			$armyTotal = "Army Total: " . $armyTotal;
			$pdf->Cell(0, 10, $armyTotal, 0, 1, 'C', true);
			$pdf->Output($filename, 'D');	
		}
		
		//Forum Output
		function forumOutput($armyid) {
		
			include "db.inc.php";
			
			$army = new Army();
			$details = $army->getDetails($armyid);
			
			echo "<h3>Copy the text below and paste into the forum of your choice.</h3>";
			
			echo "<p>[b]" . stripslashes($details['army_name']) . "[/b]</p>";
			if ( $details['comments'] != "" ) { echo "<p>Army Comments: " . stripslashes($details['comments']) . "</p>"; }
			
			$type = array("HQ", "Elite", "Troops", "Fast Attack", "Heavy Support", "Transport");
			
			$armyTotal = 0;
			
			for ($i = 0; $i < 6; $i++) {
			
				//query db
				$sql = "SELECT * FROM units WHERE army_id = '$armyid' AND type = '$type[$i]'";
				$result = $mydb->query($sql);
				
				if ($result->num_rows != 0 ) {
				
					echo "<p>[b]" . $type[$i] . ":[/b]</p>";
					
					$typeTotal = 0;
					
					
					
					while ($row = $result->fetch_assoc()) {
					
						$name = $row['name'];
						$points = $row['points'];
						$copies = $row['copies'];
						
						
						if ($copies != 1) {
							$name .= " x" . $copies;
							$points *= $copies;
						}
						
						if ( $row['active_upgrades'] != "" ) {
							$upgradeNames = explode("|", $row['active_upgrades']);
							array_pop($upgradeNames);
							$upgradeCopies = explode("|", $row['upgrade_copies']);
							array_pop($upgradeCopies);
							$upgrades = array_combine($upgradeNames, $upgradeCopies);
							
							foreach ($upgrades as $key => $value) {
								$upgrade = new Upgrade();
								$info = $upgrade->getUpgrade($_SESSION['uid'], $key);
								$points += $info['points'] * $value;
							}
						}
					
						echo "<p>" . $name . " - " . $points . " Points<br/>";
						
						if ( $row['active_upgrades'] != "") {
							foreach ($upgrades as $key => $value) {
								$upgrade = new Upgrade();
								$info = $upgrade->getUpgrade($_SESSION['uid'], $key);
								echo "<p>- " . $info['name'] . "</p>";
							}
						}
						
						$typeTotal += $points;
						$armyTotal += $points;
						
					}
					
					echo "<p>" . $type[$i] . " Total: " . $typeTotal . "</p>";

				}
			
			}
			
			echo "<p>[b]Army Total: " . $armyTotal . "[/b]</p>";
			echo "<p>This army was generated using Tabletop Manager.</p>"; 
			echo "Join free today
			at [url]www.enork.com/ankrone/v1[/url]!</p>";
		
		}
		
		//User Info
		function userInfo($userid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM users WHERE user_id = '$userid'";
			$result = $mydb->query($sql);
			$row = $result->fetch_assoc();
			
			//display
			echo "<h3>User Information</h3>";
			echo "<div class=\"padding\"><p>Username: " . $row['user_name'] . "</p>";
			echo "<p>Email: " . $row['email'] . "</p></div>";
		
		}
		
		//Search Results
		function searchResults($codex, $points) {
		
			$codex = $_GET['codex'];
			$points = $_GET['points'];
			$queryString = "codex=" . $codex . "&points=" . $points;
			$page = 1;
			if ( isset($_GET['page']) ) { $page = $_GET['page']; }
			$start = (($page - 1) * 20); 
		
			if ( $codex == "All" ) {
				$codex = "";
			} else {
				$codex = "codex = '" . $codex . "' AND";
			}
			
			if ( $points == "" ) {
				$points = "";
			} else {
				$points = "points = '" . $points . "' AND";
			}
		
			//query db
			include "db.inc.php";
			
			$sql = "SELECT * FROM armies WHERE $codex $points public = 'yes' ORDER BY army_name";
			$result = $mydb->query($sql);
			$results = $result->num_rows;
			$numPages = $results / 20;
			
			$sql = "SELECT * FROM armies WHERE $codex $points public = 'yes' ORDER BY army_name LIMIT $start, 20";
			
			$result = $mydb->query($sql);
			
			echo "<div class=\"padding\"><p><strong>Total Results: " . $results . "</strong></p></div><hr/>";
			
			if ( $result->num_rows == 0 ) {
				echo "<div class=\"padding\"><p>No matches...</p></div>";
				return false;
			}
			
			while ( $row = $result->fetch_assoc() ) {
			
				//get username
				$user = new User();
				$username = $user->getUsername($row['user_id']);
			
				echo "<div class=\"padding\"><p><strong><a href=\"view_army.php?army_id=" . $row['army_id'] . "\">" . $row['army_name'] . " | " . $row['points'] . " Points</a></strong></p><p>Codex: " . $row['codex'] . "</p><p>Creator: " . $username . "</p></div><hr/>";
			
			}
				
			echo "<div class=\"padding\"><p>Page: ";
				
			for ( $i = 0; $i < $numPages; $i++) {
				$class = "class=\"pagination\"";
				$num = $i + 1;
				if ($page == $num) { $class = "class=\"pagination_selected\""; }
				echo "<a $class href=\"search_results.php?" . $queryString . "&page=$num\">$num</a>";
			}
			
			echo "</div>";
			
			$result->close();
			
			$mydb->close();
		
		}
		
		//Comments
		function comments($armyid) {
		
			//query db
			include "db.inc.php";
			$sql = "SELECT * FROM comments WHERE army_id = '$armyid' ORDER BY date DESC";
			$result = $mydb->query($sql);
			
			echo "<div id=\"comments\">";
			echo "<h4>Comments</h4>";
			
			//display comments
			while ( $row = $result->fetch_assoc() ) {
			
				echo "<div class=\"comment\">";
				echo "<p class=\"comment_head\">" . $row['user_name'] . " | " . $row['date'] . "</p>";
				echo "<div class=\"padding\"><p>" . $row['comment'] . "</p></div>";
				echo "</div>";
			
			}
			
			echo "</div>";
			
			$result->close();
			
			$mydb->close();
		
		}
	
	}
	