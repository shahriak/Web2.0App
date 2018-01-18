<?php 
include("top.html");
include("shared.php");
?>
	<?php
		# Shahria Kazi CSE 190m Section MK, Tyler Rigsby June 1st 2012
		# This is the index page in which the user get to login using the form.
		# if the user tries to access this page after logged in,
		# the user gets reidrected to the todolist page

		# user loggged in trying to access the index page gets redirected to todolist page
		redirect(isset($_SESSION["name"]), isset($_SESSION["password"]), "todolist.php");
	?>
			<p>
				The best way to manage your tasks. <br />
				Never forget the cow (or anything else) again!
			</p>

			<p>
				Log in now to manage your to-do list:
			</p>

			<form id="loginform" action="login.php" method="post">
				<div>
					<input id="name" name="name" type="text" size="12" autofocus="autofocus" /> 
					<strong>User Name</strong>
				</div>
				<div>
					<input id="password" name="password" type="password" size="12" /> 
					<strong>Password</strong>
				</div>
				<div><input id="submitbutton" type="submit" value="Log in" /></div>
			</form>
			<?php
				# if user types in incorrect username/password, a message gets printed
				if(isset($_GET["name"]) && isset($_GET["password"])) { ?>
					<p id="incorrect">Incorrect user name / password. Please try again.</p>
			<?php } ?>
		</div>
<?php include("bottom.html"); ?>