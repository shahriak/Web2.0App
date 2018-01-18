<?php 
include("shared.php");
# Shahria Kazi CSE 190m Section MK, Tyler Rigsby June 1st 2012
# This page logs the user out and directs them to the index page.
# prior to redirecting the user, the session ends.

# wipe out my session
session_destroy();
session_regenerate_id(TRUE);   # flushes out session ID number
session_start();
header("Location: index.php");
?>