<?php
require 'connect.php';
//header('content-type: image/jpeg');
if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$sql="SELECT `image` FROM `blog_detail` WHERE `blog_id`='$id'";
		$res=mysqli_query($db,$sql);
		$row=mysqli_fetch_assoc($res);
		
		$image=$row['image'];
		echo $image;	
	}
?>