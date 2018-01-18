<?php
# Shahria Kazi CSE 190m Section MK, Tyler Rigsby June 1st 2012
# This webservice saves the contens given in the POST query parameters
# to a file if it was a post request. On a get request, the webservice
# fetches all the contents of the file and outputs them. if the required parameters
# are not set on any requests, an HTTP 400 error message is issued.
$jsonFile = "list.json";

# checking if the parameters are set on a post request
if(!isset($_POST["todolist"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
	header("HTTP/1.1 400 Invalid Request");
	die();
}

# putting contents onto the file
if($_SERVER["REQUEST_METHOD"] == "POST") {
	# creating a new file given the file name
	file_put_contents($jsonFile, $_POST["todolist"]);
}

# retrieving contents from list.json and outputting them
header("Content-type: application/json");
if(file_exists($jsonFile)) {
	$contents = file_get_contents($jsonFile, FILE_IGNORE_NEW_LINES);
	print $contents;
}
?>