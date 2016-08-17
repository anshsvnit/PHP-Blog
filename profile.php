<?php
//require 'session.php';
$id = $_SESSION['id'];
$sql = "SELECT `Id`, `userName`, `fname`, `lname`, `email`, `aboutme`, `contact`, `created_on`, `profile_pic` FROM `userdetails` WHERE "

?>