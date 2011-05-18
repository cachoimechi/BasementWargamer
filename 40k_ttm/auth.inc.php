<?php
/***********************************************
File: auth.inc.php
Author: Adam Krone
Description: Validates if the user is logged in or not.
***********************************************/

if( !isset($_SESSION['username']) ) {

	header('Location: index.php');

}