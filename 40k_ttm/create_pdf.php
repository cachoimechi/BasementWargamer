<?php
/***********************************************
File: test.php
Author: Adam Krone
Description: Used for testing of functionality before final
implementation.
***********************************************/

	session_start();

	require "func.inc.php";
	
	$armyid = $_GET['army_id'];
	
	$display = new Display();
	$display->pdfOutput($armyid);