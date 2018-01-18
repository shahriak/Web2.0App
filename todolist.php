<?php 
include("top.html");
include("shared.php");
?>
	<?php
		# Shahria Kazi CSE 190m Section MK, Tyler Rigsby June 1st 2012
		# the user is sent to this page after successfully logging in
		# checks if the user is logged in using session data. If the user did not log in
		# and tries to access this page, they get redirected to the main login page
		redirect(!isset($_SESSION["name"]), !isset($_SESSION["password"]), "index.php");
	?>
			<h2> <?= $_SESSION["name"] ?>'s To-Do List</h2>

			<ul id="todolist"></ul>

			<div id="buttons">
				<input id="itemtext" type="text" size="30" autofocus="autofocus" />
				<button id="add">Add to Bottom</button>
				<button id="delete">Delete Top Item</button>
			</div>

			<ul>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</div>
<?php include("bottom.html"); ?>
