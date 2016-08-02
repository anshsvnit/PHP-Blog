<?php 
require 'connect.php';
require 'session.php';
?>

<html>

<body>

	<form action = "newblog.php" method = "POST" enctype = "multipart/form-data"> 
		<p class="fieldset">
			<label for="signup-username">Blog Title</label>

			<input class="image-replace cd-username" type = "text" name = "blogtitle" placeholder="Blog Title" maxlength = 30 required>
		</p>

		<p class="fieldset">
			<label for="signup-username">Details</label>
			<textarea rows="6" id="blog-detail" placeholder="Write your blog here. Max word limit is 5000" name="detail" maxlength="5000">
			</Textarea>
		</p>
		<p class="fieldset">
			<label for="signup-username">HashTags</label>

			<input class="image-replace cd-username" type = "text" name = "tags" placeholder="HashTags" maxlength = 30 required>
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
			$string.=",";
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

			$sql = "INSERT INTO `blogs`(`blogger_id`, `title`, `detail`, `category`, `status`, `editedBy`) VALUES ('$id','$t','$c','$tags','W','U')";


			mysqli_query($db,$sql);
			$sql1 = "SELECT `blog_id` from `blogs` ORDER BY `blog_id` DESC";
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


?>