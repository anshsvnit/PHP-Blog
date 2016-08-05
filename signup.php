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
		 <div class="row">
    <form action = "signup.php" method = "POST" enctype = "utf-8" class="col s12">
      <div class="row">
        <div class="input-field col s6">
		<div >
			
					

					<input  type = "text" name = "fname" placeholder="First Name" maxlength = 30 required>
					<label for="First">First name</label>
				</div>

					<label for="Last-Name">Last name</label>

					<input class="image-replace cd-username" type = "text" name = "lname" placeholder="Last Name" maxlength = 30 required>
				</div>
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
<p class="fieldset">
			<label for="signup-username">Upload a file</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			<input name="file" type="file" id="file"> 
		</p>

		<p class="fieldset">
			<button class="btn waves-effect waves-light" Value = "submit" type="submit" name="cre">
   				 <i class="material-icons right">send</i>
 			 </button>
        
			
		</p>

			</form>
		</div>
	</center>
</body>


</html>	

<?php
function checkduplicate($u,$e){
			$db=mysqli_connect("localhost","root","","datablog") or die("Can not connect right now!");

			$sql1="SELECT `userName` FROM `userdetails` WHERE `username` = '$u'";
			$sql2 = "SELECT `email` FROM `userdetails` WHERE `email` = '$e'";

			$result1 = mysqli_query($db,$sql2);
			$num1=mysqli_num_rows($result1);
			$result = mysqli_query($db,$sql1);
			$num = mysqli_num_rows($result);
			if($num>0){
				echo "<script>alert('Username already taken please select other username');</script>";
				return "FALSE";
			}

			elseif($num1>0){
					echo "<script>alert('Email is already in use');</script>";
					return "FALSE";
				}
			
			else{
			return "TRUE";
	}
		}

if(isset($_POST["cre"]) && $_FILES['file']['size'] > 0){
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
	elseif(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) 
	{
		echo "<script>alert('Please upload image.')</script>";}

	else{
		$u = $_POST['username'];
		$f = $_POST["fname"];
		$l = $_POST["lname"];
		$e = $_POST["emailaddr"];
		$p = $_POST["password"];

			$allowed = array('gif','png' ,'jpg');
			$filename = $_FILES['file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed)) 
				echo "<script>alert('".$ext." file format is not allowed. Upload jpg, png or gif format only.')</script>";
			else{
				$file=addslashes(file_get_contents($_FILES["file"]["tmp_name"]));}


		if(empty($_POST["contact"]))
			$c=NULL;
		else
			$c = $_POST["contact"];
		
		if(checkduplicate($u,$e)=="TRUE"){
			$sql = "INSERT INTO `userdetails`(`userName`,`fname`,`lname`,`password`,`email`,`contact`,`profile_pic`) VALUES ('$u','$f','$l','$p','$e','$c','$file')";
			if(mysqli_query($db,$sql)){
				echo "<script>alert('Your blog account is created.');</script>";
				header('Refresh: 2;URL= contact_admin.php');
			}
			else
			{
				echo "<script>alert('Something went wrong.Please try again');</script>";

			}

		}
		
	}
}

?>