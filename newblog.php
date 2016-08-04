<?php 
require 'connect.php';
require 'session.php';
?>
<?php
if(isset($_GET['edit'])){
	$tmp = $_GET['edit'];
	if($tmp == "Y"){
		$bid = $_GET['blogid'];
		echo $bid;
		$sql = "SELECT `blog_id`,`title`,`detail`,`category` FROM `blogs` WHERE `blog_id`= '$bid'";
		$result1 = mysqli_query($db,$sql);

		$num_query = mysqli_num_rows($result1);
		echo $num_query;
		$row=mysqli_fetch_array($result1);
	}
}

?>
<html>

<body>

	<form action = 
	"<?php  
		if(isset($_GET['edit'])){
	$tmp = $_GET['edit'];
	if($tmp == "Y"){
		echo 'newblog.php?sender='.$_GET['sender'].'&edit=Y&blogid='.$_GET['blogid'];
	}
}
else echo "newblog.php";
	?>"

	 method = "POST" enctype = "multipart/form-data"> 
		<p class="fieldset">
			<label for="signup-username">Blog Title</label>

			<input class="image-replace cd-username" type = "text" name = "blogtitle" value = "<?php if (isset($_GET['edit']))echo $row[1];?>" placeholder="Blog Title" maxlength = 30 required>
		</p>

		<p class="fieldset">
			<label for="signup-username">Details</label>
			<textarea rows="6" id="blog-detail" placeholder="Write your blog here. Max word limit is 5000" name="detail" maxlength="5000"><?php if (isset($_GET['edit']))echo $row[2];?> 
			</Textarea>
		</p>
		<p class="fieldset">
			<label for="signup-username">HashTags</label>

			<input class="image-replace cd-username" type = "text" name = "tags" value = "<?php if (isset($_GET['edit']))echo $row[3];?>" placeholder="HashTags" maxlength = 30 required>
		</p>

		<p class="fieldset">
			<label for="signup-username">Upload a file</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			<input name="file" type="file" id="file"> 
		</p>

		<p class="fieldset">
			<input class="full-width" type="submit" name="submit" value="Submit">
		</p>
	</form>

</body>

</html>


<?php

function getTags($string){
	preg_match_all ("/(#(.*)\s)|(#(.*)$)/U", $string, $tagarray);
	if(!empty($tagarray)){
		$string = $tagarray[0][0];
		$i=1;
		while(!empty($tagarray[0][$i])){
			$string.=" ";
			$string.=$tagarray[0][$i];
			$i++;
		}
		return $string;
	}
	else
		return NULL;
}

if (isset($_POST['submit']) && $_FILES['file']['size'] > 0){

	if(empty($_POST['blogtitle'])){
		echo"<script>alert('Please give Title to the Blog')</script>";
	}
	elseif(empty($_POST['detail'])){
		echo"<script>alert('Blog cannot be empty')</script>";
	}
	elseif(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) 
	{
		echo "<script>alert('Please upload image.')</script>";}

	else{

			$allowed = array('gif','png' ,'jpg');
			$filename = $_FILES['file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed)) 
				echo "<script>alert('".$ext." file format is not allowed. Upload jpg, png or gif format only.')</script>";
			else{
				$file=addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
				$t=$_POST['blogtitle'];
				$c=$_POST['detail'];
				$id=$_SESSION['id'];

			$tags = getTags($_POST['tags']);

			if(isset($_GET['edit'])){
	$tmp = $_GET['edit'];
	$sender = $_GET['sender'];
	$bid = $_GET['blogid'];

	if($tmp == "Y"){
		$sql = "UPDATE `blogs` SET `title`='$t', `detail`='$c', `category`='$tags', `status`='W', `editedBy`='$sender' WHERE `blog_id` = '$bid'";
		$sql1 = "UPDATE `blog_detail` SET `image`='$file' WHERE `blog_id` = '$bid'";
		mysqli_query($db,$sql);
		if(mysqli_query($db,$sql1)){
				echo"<script>alert('Blog Updated Successfully')</script>";
				header('Location: ' . $_SERVER['HTTP_REFERER']);			
			}
			else
			{
				echo"<script>alert('There was a problem in updating the blog')</script>";
			}
}
	else{
			$sql = "INSERT INTO `blogs`(`blogger_id`, `title`, `detail`, `category`, `status`, `editedBy`) VALUES ('$id','$t','$c','$tags','W','U')";
			$sql1 = "SELECT `blog_id` from `blogs` ORDER BY `blog_id` DESC";


			mysqli_query($db,$sql);
			
			$r=mysqli_query($db,$sql1);
			$row=mysqli_fetch_array($r,MYSQLI_NUM);
			$last_id=$row[0];
			$sql2 = "INSERT INTO `blog_detail`(`blog_id`,`image`) VALUES('$last_id','$file')";
			if(mysqli_query($db,$sql2)){
				echo"<script>alert('Blog Added Successfully')</script>";
			}
			else
			{
				echo"<script>alert('There was a problem in posting the blog')</script>";

			}
		}
		}

	}
}
}


?>