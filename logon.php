<?php

$EMAIL_ID = 788375004; // 9-digit integer value (i.e., 123456789)

require_once '/home/common/php/dbInterface.php'; // Add database functionality
require_once '/home/common/php/mail.php'; // Add email functionality
require_once '/home/common/php/p4Functions.php'; // Add Project 4 base functions

processPageRequest(); 

function authenticateUser($username, $password) 
{
	
	$arr = validateUser($username, $password);
	if (!empty($arr) ) {
		session_start();
		

		$_SESSION["userId"] = $arr[0];
		$_SESSION["displayName"] = $arr[1];
		$_SESSION["emailAddress"] = $arr[2];
		return true;
	}
	else{
		return false;
	}

}

function displayLoginForm($message = "")
{
	require_once("./templates/logon_form.html"); 
}

function processPageRequest()
{
	
	if(session_status() == PHP_SESSION_ACTIVE)
	{
		session_destroy();
	}
	if(empty($_POST)) {
		displayLoginForm();
	} 
	if (isset($_POST) and isset($_POST['action'])) {
		if($_POST['action'] === "login") {
				authenticateUser($_POST["username"], $_POST["password"]);
				if(authenticateUser($_POST["username"], $_POST["password"])) {
						header("Location: index.php");
						exit();
				} else {
						displayLoginForm("Error, the  user is not authenticated.");
				}
		}
	}
	
}
