<?php
function parsehash($string){
	preg_match_all ("/(#(.*)\s)|(#(.*)$)/U", $string, $tagarray);
	return $tagarray;
}

function checkforimage(){
	$allowed = array('gif','png' ,'jpg');
	$filename = $_FILES['file']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed)) 
		echo "<script>alert('".$ext." file format is not allowed. Upload jpg, png or gif format only.')</script>";
	else{
		$file=addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
		return $file;
	}
}

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

?>