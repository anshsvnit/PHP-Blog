<?php 
require 'connect.php';

	if($tmp=="A"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='A'";

	}
	elseif ($tmp=="W"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='W'";

	}
	elseif($tmp=="R"){
		$sql = "SELECT * FROM `blogs` WHERE `status`='R'";

	}

	$result = mysqli_query($db,$sql);
	$num_query = mysqli_num_rows($result);
	

?>