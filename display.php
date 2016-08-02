<?php 
require 'connect.php';
require 'session.php';


if(isset($_GET['get']))
{
	$tmp = $_GET['get'];
}
else
	$tmp ="A";

require 'blog_request.php';
?>


<html>
<body>
	<div>
		<p><button name = "acc_but" value ="Accepted" onclick = "redirect()"></button><button name = "rej_but" value ="Rejected"></button><button name = "wait_but" value ="Waiting"></button></p>
	</div>

<div>
	<?php

	function redirect(){
		
		header('location:display.php?get=A');
	}


	for($i=0;$i<$num_query;$i++){
	echo "<div><p>";
	$arr_result = mysqli_fetch_row($result);
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

	echo "</p></div>";

	}

	?>
</div>
	</body>
	</html>


