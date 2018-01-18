<?php
# Shahria Kazi CSE 190m Section MK, Tyler Rigsby June 1st 2012
# This page contains shared code/functions between all pages
session_start(); # intializing session data

# takes three parameters, a session name, a session password, and a url
# if the sessions are set, then redirects the user to the destination page
function redirect($name, $othername, $redirecturl) {
	if($name && $othername) {
		header("Location: $redirecturl");
		die();
	}
}
?>