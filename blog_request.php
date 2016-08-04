<?php 
require 'connect.php';
echo $_SESSION['username'].'<br>';
echo $priviledge;
if($priviledge == "admin"){
	if($tmp=="A"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='A'";
		//echo "access A ";
	}
	elseif ($tmp=="W"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='W'";

	}
	elseif($tmp=="R"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='R'";

	}

	$result = mysqli_query($db,$sql);
	$num_query = mysqli_num_rows($result);
}
elseif($priviledge == $_SESSION['username']){
	$id = $_SESSION['id'];

	if($tmp=="A"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='A' AND `blogger_id`= '$id'";
	}
	elseif ($tmp=="W"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='W' AND `blogger_id`= '$id'";

	}
	elseif($tmp=="R"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='R' AND `blogger_id`= '$id'";

	}

	$result = mysqli_query($db,$sql);
	$num_query = mysqli_num_rows($result);

}
else{
	$sql = "SELECT * FROM `blogs` WHERE `status`='A'";
	$result = mysqli_query($db,$sql);
	$num_query = mysqli_num_rows($result);

}

?>