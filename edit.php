<?php
require 'connect.php';
require 'session.php';
if(login()){
	if($_SESSION['username']=="admin")
		header('location:admin.php');
	else
		header('location:home.php');
}

function getTags($string){
	preg_match_all ("/(#(.*)\,)|(#(.*)$)/U", $string, $tagarray);
	if(!empty($tagarray)){
		$tag_arr = array();
		$i=0;
		while(!empty($tagarray[0][$i])){
			array_push($tag_arr, $tagarray[0][$i]);
			$i++;
		}
		return $tag_arr;
	}
	else
		return NULL;
}

function printTags($arr_hashtags){
	$j=0;
	while($j<sizeof($arr_hashtags)){
		echo arr_hashtags($j)." ";
	}
}


$id = $_GET['id'];
//$call = $_GET['call'];
$sql = "SELECT * FROM `blogs` where `blog_id`= '$id'";
$result = mysqli_query($db,$sql);
$num_query = mysqli_num_rows($result);
$i=0;
while($i<$num_query){
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
//$arr_hashtags = array();
$string = $row[4];
$arr_hashtags = getTags($string);

echo '<form action = "newblog.php" method = "POST" enctype = "multipart/form-data"> 
		<p class="fieldset">
			<label for="signup-username">Blog Title</label>

			<input class="image-replace cd-username" type = "text" name = "blogtitle" placeholder="Blog Title" value = '.$row[2].' maxlength = 30 required>
		</p>

		<p class="fieldset">
			<label for="signup-username">Details</label>
			<textarea rows="6" id="blog-detail" value = '.$row[3].'placeholder="Write your blog here. Max word limit is 5000" name="detail" maxlength="5000">
			</Textarea>
		</p>
		<p class="fieldset">
			<label for="signup-username">HashTags</label>

			<input class="image-replace cd-username" type = "text" name = "tags" value = '.printTags($arr_hashtags).'placeholder="HashTags" maxlength = 30 required>
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
';
$i++;

}

?>