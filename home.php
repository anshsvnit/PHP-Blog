<?php
require 'session.php';
if(login()){
	if($_SESSION['username']=="admin")
		header('location:admin.php');
}

$priviledge = $_SESSION['username'];

require 'display.php';

display_blogs($priviledge);

?>