<?php
require 'session.php';
require 'connect.php';

if(isset($_SESSION['username'])){

}

if(isset($_GET['hash'])){
	$hash = $_GET['hash'];

	$sql = "SELECT `blog_id`, `blogger_id`, `title`, `detail`,`category`,`updated_on` FROM `blogs` WHERE `status` = 'A' AND `category` LIKE '%'$hash'%' ORDER BY updated_on DESC";
	$result = mysqli_query($db,$sql);
	$num_query = mysqli_num_rows($result);
}
else{
  $sql = "SELECT `blog_id`, `blogger_id`, `title`, `detail`,`category`,`updated_on` FROM `blogs` WHERE `status` = 'A' ORDER BY updated_on DESC";
  $result = mysqli_query($db,$sql);
  $num_query = mysqli_num_rows($result);
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
      <a href="#" class="brand-logo">Blogger</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php if(login()){
          echo "<li>Hi ".$_SESSION['username']."</li>";
          echo "<li><a href='signout.php'>Sign Out</a></li>";
          echo "<li><a href='newblog.php'>Add Blog</a></li>";
          if($_SESSION['username']=="admin"){
          $link = "edituser.php";
          echo "<li><a href= ".$link." >Edit Users</a></li>";
        }
      }
        else {
          echo "<li>Hi guest</li>";
          echo "<li><a href='signin.php'>Sign In</a></li>";
        }?>
        
        <li><a href="message.php">Contact Us</a></li>
      </ul>
    </div>
  </nav>


</head>

<body>
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>


 <?php
 for($i=0;$i<$num_query;$i++){
   echo "<div><p>";
   $arr_result = mysqli_fetch_row($result);
   $bloggerid = $arr_result[1];
   $sql1 = "SELECT `userName`FROM `userdetails` WHERE `Id` = '$bloggerid'";
   $result1 = mysqli_query($db,$sql1);
   $usernameblogger = mysqli_fetch_row($result1);
	//$status = $arr_result[5];
	//$blog_id =  $arr_result[0];
	//echo $_SESSION['id'];
	//echo $arr_result[1];?>

	
	<div class='row'>
    <div style='margin: 0 auto;width:60%'>
      <div class='card'>
        <div class='card-image'>
          <img src="get_image.php?pic_source=blog&id="<?php echo $arr_result[0];?>>
          <span class='card-title'><?php echo $arr_result[2]?></span>
          <span class='card-title' style = 'left:85%'><?php echo $usernameblogger[0]?></span>

        </div>
        <div class='card-content'>
          <p><?php echo $arr_result[3]?></p>
        </div>
        <div class='card-action'>
         <a href='#'>This is a link</a>

       </div>
     </div>
   </div>
 </div>
 <?php }
 ?>


</body>
</html>