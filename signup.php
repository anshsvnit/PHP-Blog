<?php 
	require 'connect.php';
	require 'session.php';
	if(login()){
		if($_SESSION['username']=="admin")
			header('location:admin.php');
		else
			header('location:home.php');
	}
?>


<html>
<head>
	<title>Sign In User</title>
</head>

<body>
	<center>
	<div >
		<form action = "" method = "POST" enctype = "utf-8"> 
			<p class="fieldset">
				<label for="signup-username">First name</label>

				<input class="image-replace cd-username" type = "text" name = "fname" placeholder="First Name" maxlength = 30 required>
			</p>

			<p class="fieldset">
				<label for="signup-username">Last name</label>

				<input class="image-replace cd-username" type = "text" name = "lname" placeholder="Last Name" maxlength = 30 required>
			</p>
			<p class="fieldset">
				<label for="signup-username">Email Address </label>

				<input class="image-replace cd-username" type = "email" name = "emailaddr" placeholder="Email Address" required> 
			</p>
			<p class="fieldset">
				<label for="signup-username">Username</label>

				<input class="image-replace cd-username" type = "text" name = "username" placeholder="User Name" maxlength = 30 required>
			</p>

			<p class="fieldset">
				<label for="signup-username">Password</label>

				<input class="image-replace cd-username" type = "password" name = "password" placeholder="Password" required> 
			</p>
			<p class="fieldset">
				<label for="signup-username">Contact</label>

				<input class="image-replace cd-username" type = "number" name = "contact" placeholder="Contact Number"> 
			</p>
			<p class="fieldset">

				<input class="full-width has-padding" type="submit" value="Create account" name="cre">
			</p>


		</form>
	</div>
</center>
</body>


</html>	

<?php

	if(isset($_POST["cre"])){
		if(empty($_POST["username"]))
			echo "<script>alert('Please enter username');</script>";
		else if(empty($_POST["fname"]))
			echo "<script>alert('Please enter firstname');</script>";
		else if(empty($_POST["lname"]))
			echo "<script>alert('Please enter lastname');</script>";
		else if(empty($_POST["emailaddr"]))
			echo "<script>alert('Please enter E-mail ID');</script>";
		else if(empty($_POST["password"]))
			echo "<script>alert('Please enter Password');</script>";
		else 
			header('location:signup_success.php');
	}

?>