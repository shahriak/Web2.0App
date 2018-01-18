<?php
include("shared.php");
# Shahria Kazi CSE 190m Section MK, Tyler Rigsby June 1st 2012
# This page logs the user in given the correct username and password
# and starts a new session with the user. If the username or password
# is incorrect, the user gets redirected to the index page otherwise
# if the password and username are correct then the user gets directed to the todolist page

if(!isset($_POST["name"]) || !isset($_POST["password"])) {
	header("HTTP/1.1 400 Invalid Request");
	die();
}

$username = $_POST["name"];
$password = $_POST["password"];

# checking for correct username and password and based on this
# the user gets redirected to the proper page
if($username != "wastar09" || $password != "12345") {
	header("Location: index.php?name=$username&password=$password"); # redirecting to index.php
} else {
	$_SESSION["name"] = $username;
	$_SESSION["password"] = $password;
	header("Location: todolist.php");
}
?>