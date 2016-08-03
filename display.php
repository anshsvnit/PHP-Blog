<?php 
require 'connect.php';
require 'session.php';

if(isset($_GET['chd']) && isset($_GET['fun'])){
	$var = $_GET['chd'];
	$var1 = $_GET['get'];
	$var3 = $_GET['fun'];
	//echo $var1;
	if($var3=="D"){
		$sql = "DELETE FROM `blogs` WHERE `blog_id` = '$var'";
		$sql1 = "DELETE FROM `blog_detail` WHERE `blog_id` = '$var'";
		$db = $GLOBALS['db'];
		if(mysqli_query($db,$sql1) && mysqli_query($db,$sql)){
			echo "query running";
			header('location:'."?get=".$var1);
		}
		else{
			echo "<script>alert('There was some error');</script>";
			header('location:'."?get=".$var1);

		}
	}
	elseif($var3=="A"){
		$sql = "UPDATE `blogs` SET `status` = 'A' WHERE `blog_id` = '$var'";
		$db = $GLOBALS['db'];

		if(mysqli_query($db,$sql)){
			echo "query running";
			header('location:'."?get=".$var1);
		}
		else{
			echo "<script>alert('There was some error');</script>";
			header('location:'."?get=".$var1);

		}
	}
	elseif($var3=="R"){
		$sql = "UPDATE `blogs` SET `status` = 'R' WHERE `blog_id` = '$var'";
		$db = $GLOBALS['db'];

		if(mysqli_query($db,$sql)){
			echo "query running";
			header('location:'."?get=".$var1);
		}
		else{
			echo "<script>alert('There was some error');</script>";
			header('location:'."?get=".$var1);

		}


	}
}

if(isset($_GET['get']))
{
	$tmp = $_GET['get'];
}
else
	$tmp ="A";

require 'blog_request.php';


$priviledge = $GLOBALS['priviledge'];
function display_blogs($priviledge){
	$num_query = $GLOBALS['num_query'];
	$result = $GLOBALS['result'];
	for($i=0;$i<$num_query;$i++){
	echo "<div><p>";
	$arr_result = mysqli_fetch_row($result);
	$status = $arr_result[5];

	echo "<br><br>";
	echo $arr_result[0];
		echo "<br>";

	echo $arr_result[1];
		echo "<br>";

	echo $arr_result[2];
	echo "<br>";

	echo $arr_result[3];
	echo "<br>";

	echo $arr_result[4];
	echo "<br>";

	echo $arr_result[5];
	echo "<br>";

	echo $arr_result[6];
	echo "<br>";
	//echo $priviledge;
	echo "</p></div>";
	if($priviledge == "admin" && $_SESSION['username']=="admin"){
		if($status == "A"){
			$var2 = $GLOBALS['tmp'];

			echo "<a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=R'>Reject</a>";
			echo "<a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=D'>DELETE</a>";
		}
		elseif($status == "W"){
			$var2 = $GLOBALS['tmp'];
			echo "<a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=A'>Accept</a>";
			echo "<a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=D'>DELETE</a>";

		}
		elseif ($status == "R") {
			$var2 = $GLOBALS['tmp'];
			echo "<a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=A'>Accept</a>";
			echo "<a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=D'>DELETE</a>";
		}
	}
}
	}


?>


<html>
<body>
	<div>
		<p>
			<a href = '?get=A'>Accepted List</a>
			<a href = '?get=W'>Waiting List</a>
			<a href = '?get=R'>Rejected List</a>
		</p>
	</div>

<div>
	<?php

	function redirect(){

		header('location:display.php?get=A');
	}


	?>
</div>
	</body>
	</html>


