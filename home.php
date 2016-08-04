<?php
//require 'session.php';
$priviledge = $_SESSION['username'];

require 'display.php';

display_blogs($priviledge);

?>