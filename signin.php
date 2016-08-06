<?php 
require 'connect.php';
require 'session.php';
if(login()){
	if($_SESSION['username']=="admin")
		header('location:admin.php');
	else
		header('location:home.php');
}

function checkuser ($username,$password,$caller){
			$db = $GLOBALS['db'];
			if($caller == "login"){
			$sql = "SELECT `Id`,`userName`,`password` FROM `userdetails` WHERE `username`= '$username' and `password`= '$password'";}
			else
			{
				$sql = "SELECT `Id`,`userName`,`password` FROM `userdetails` WHERE `username`= '$username'";}
			$result = mysqli_query($db,$sql);
			$num=mysqli_num_rows($result);
			/*echo $username;
			echo $caller;
			echo $num;*/
			//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			return $num;
			}
?>


<html>
<head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>


<body>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<div class="row" style= 'width:50%;'>
		<form class="col s12" action = "signin.php" method = "POST" enctype = "utf-8"> 
			<div class="row">
				<div class="input-field col s12">

					<label for="signup-username">Username</label>

					<input class="validate" type = "text" name = "username" placeholder="User Name" maxlength = 30 required>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<label for="signup-username">Password</label>

					<input class="validate" type = "password" name = "password" placeholder="Password" required> 
				</div>
			</div>
			<div class="row">

				<a href="forget.php">Forgot your password?</a>
			</div>

			<input  type="submit" name="login" value="Login">
		</form>
	</div>
	<div>
		<form action = "signin.php" method = "POST" enctype = "utf-8"> 
			<div class="row">
				<div class="input-field col s12">
				<label for="signup-username">Username</label>

				<input class="image-replace cd-username" type = "text" name = "username" placeholder="User Name" maxlength = 30 required>
			</div>
		</div>
			<p class="fieldset">
				<input class="full-width" type="submit" name="check" value="check">
			</p>
		</form>


	</div>

</body>

</html>


<?php

if(isset($_POST['check'])){
	$u = $_POST['username'];
	if (checkuser($u,"","check")>=1)
	{ 
		echo "<script>alert('The username is taken')</script>";
		unset($_POST['check']);
	} 
	else {
		echo "<script>alert('Username is available')</script>";
				unset($_POST['check']);

	}
}



if (isset($_POST['login'])){
	echo "inside if";
	$GLOBALS['checkstatus']=0;
	if(empty($_POST['username']))
		echo "<script>alert('Please enter username')</script>";

		elseif (empty($_POST['password']))
			{echo "<script>alert('Please enter password')</script>";}

		else{
			$u = $_POST['username'];
			$p = $_POST['password'];

			$num = checkuser($u,$p, "login");
			if($num>1){
				echo "<script>alert('The database is inconsistent Please Contact Administrator')</script>";
				header('location:contact_admin.php');	
			}
			else if($num==1){
				$_SESSION['username']= $u;
				$_SESSION['id'] = $row['Id'];
				$_SESSION['login-with-blog'] = 1;
				setcookie("username",$u,time()+60*60*24);

				/*if ($rm == "on"){
					setcookie("	username",$_POST['username'],time()+60*60*24);
				}
				*/
				if($_SESSION["username"]=="admin")
					header("location:admin.php");
				else {
					header("location:home.php");
				}
			}

			else{
				echo "<script>alert('Either username or password is Incorrect')</script>";
			}
		}
	}

	?>