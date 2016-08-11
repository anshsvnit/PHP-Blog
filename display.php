<?php 
require 'connect.php';
//require 'session.php';

$id = $_SESSION['id'];
$user = $_SESSION['username'];


if(isset($_GET['chd']) && isset($_GET['fun'])){
	$var = $_GET['chd'];
	$var1 = $_GET['get'];
	$var3 = $_GET['fun'];
	
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
	$bloggerid = $arr_result[1];
	$db = $GLOBALS['db'];
	$sql1 = "SELECT `userName`FROM `userdetails` WHERE `Id` = '$bloggerid'";
	$result1 = mysqli_query($db,$sql1);
	$usernameblogger = mysqli_fetch_row($result1);
	//$status = $arr_result[5];
	$blog_id =  $arr_result[0];
	//echo $_SESSION['id'];
	//echo $arr_result[1];
	if($priviledge=="admin" || $arr_result[1]==$_SESSION['id']){
	


	echo "
	
	<div class='row'>
        <div style='margin: 0 auto;width:60%'>
          <div class='card'>
            <div class='card-image'>
              <img src='get_image.php?pic_source=blog&id=".$blog_id."'>
              <span class='card-title'>".$arr_result[2]."</span>
              <span class='card-title' style = 'left:85%'>".$usernameblogger[0]."</span>
            </div>
            <div class='card-content'>
            <p>".$arr_result[3]."</p>
            </div>
            <div class='card-action'>
             <a href='#'>This is a link</a>

            </div>
         </div>
       </div>
    </div>
   ";
	
	echo "</p></div>";
	if($priviledge == "admin" && $_SESSION['username']=="admin"){
		if($status == "A"){
			$var2 = $GLOBALS['tmp'];
			echo "<center><div>";
			echo "<div class='style-button'><i class='small material-icons'>thumb_down</i><a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=R'>Reject</a></div>";
			echo "<div class='style-button' style = 'padding-left : 15%;''><i class='small material-icons'>stop</i><a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=D'>DELETE</a></div>";
			echo "<div class='style-button' style = 'padding-left : 15%;''><i class='small material-icons'>mode_edit</i><a href = 'newblog.php?sender=A&edit=Y&blogid=".$arr_result[0]."'>Edit</a></div>";	
			echo "</div></center>";
		}
		elseif($status == "W"){
			$var2 = $GLOBALS['tmp'];
			echo "<center><div>";
			//echo "";
			echo "<div class='style-button'><i class='small material-icons'>thumb_up</i><a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=A'>Accept</a></div>";
			echo "<div class='style-button' style = 'padding-left : 15%;''><i class='small material-icons'>stop</i><a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=D'>DELETE</a></div>";
			echo "<div class='style-button' style = 'padding-left : 15%;''><i class='small material-icons'>mode_edit</i><a href = 'newblog.php?sender=A&edit=Y&blogid=".$arr_result[0]."'>Edit</a></div>";	
			echo "</div></center>";


		}
		elseif ($status == "R") {
			echo "<center><div>";

			$var2 = $GLOBALS['tmp'];
			echo "<div class='style-button'><i class='small material-icons'>thumb_up</i><a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=A'>Accept</a></div>";
			echo "<div class='style-button' style = 'padding-left : 15%;''><i class='small material-icons'>stop</i><a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=D'>DELETE</a></div>";
			echo "<div class='style-button' style = 'padding-left : 15%;''><i class='small material-icons'>mode_edit</i><a href = 'newblog.php?sender=A&edit=Y&blogid=".$arr_result[0]."'>Edit</a></div>";	
			echo "</div></center>";

		}
	}
		elseif($priviledge == $_SESSION['username']){
			$var2 = $GLOBALS['tmp'];

			echo "<center><div>";
			echo "<div class='style-button'><i class='small material-icons'>stop</i><a href = '?get=".$var2."&chd=".$arr_result[0]."&fun=D'>DELETE</a></div>";
			echo "<div class='style-button' style = 'padding-left : 18%;''><i class='small material-icons'>mode_edit</i><a href = 'newblog.php?sender=U&edit=Y&blogid=".$arr_result[0]."'>Edit</a></div>";	
			echo "</div></center>";

	}
}
}
	}


?>


<html>
 <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 		<link type="text/css" rel="stylesheet" href="css/style.css">
       <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
       <nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">Blogger</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      	<?php if(login()){
      		echo "<li>Hi ".$_SESSION['username']."</li>";
      		echo " <li><a class='modal-trigger' href="."#profile_modal".">My Profile</a></li>";
      	}?>

       
        <?php
        $name = $_SESSION['username'];
	    $sql = "SELECT `status` FROM `userdetails` WHERE `userName` = '$name'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <?php if($priviledge=="admin"){
        	$link = "edituser.php";
        	echo "<li><a href= ".$link." >Edit User</a></li>";
        }
        else
        	echo "<li><a href='message.php'>Contact Us</a></li>";
        	if($row['status']=='N'){
        		echo "<li><a href='newblog.php' class=disabled>Add Blog</a></li>";

        	}
        	else{
        echo "<li><a href='newblog.php'>Add Blog</a></li>";

        	}
        ?>
         <li><a href="signout.php">Sign Out</a></li>
      </ul>
    </div>
  </nav>



    </head>

<body>
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
     <script type="text/javascript" src="js/materialize.min.js"></script>
     <script>
     	$(document).ready(function(){
     		$('.modal-trigger').leanModal();
     	})	
    	 
     </script>
	<div>
		<p>
			<a class="waves-effect waves-light btn" style = 'font-size:30;width: 32%;'href = '?get=A'><i class="medium material-icons left">done</i>Accepted Blogs</a>
			<a class="waves-effect waves-light btn" style = 'font-size:30;width: 32%;'href = '?get=W'><i class="medium material-icons left">schedule</i>Waitlisted Blogs</a>
			<a class="waves-effect waves-light btn" style = 'font-size:30;width: 32%;'href = '?get=R'><i class="medium material-icons left">stop</i>Rejected Blogs</a>
		</p>
	</div>
	<div class = "modal" id = "profile_modal">
		
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


