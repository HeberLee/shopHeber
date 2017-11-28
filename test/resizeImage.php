<?php
require_once "../lib/string.func.php";
thumb("101.png");
function thumb($filename,$destination=null,$dst_w=null,$dst_h=null,$flag=true,$scale=0.5){

	list($src_w,$src_h,$imagetype) = getimagesize($filename);
	// $src_w = 250;
	// $src_h = 250;
	// $imagetype = 3;
	$mime = image_type_to_mime_type($imagetype);
	//echo $mime;
	//image/jpeg,image/gif
	$createFun = str_replace("/","createfrom", $mime);
	//输出时，需要用到imagejpeg()这个格式的函数，提前生成好
	$outFun = str_replace("/",null, $mime);
	$src_image = $createFun($filename);
	

	if(is_null($dst_w) || is_null($dst_h)){
		$dst_w = ceil($src_w*$scale);
		$dst_h = ceil($src_h*$scale);
	}
	
	$dst_image = imagecreatetruecolor($dst_w,$dst_h);
	imagecopyresampled($dst_image, $src_image,0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);

	if($destination&&!file_exists(dirname($destination))){
		mkdir(dirname($destination),0777,true);
	}
	$dstFilename = $destination==null?getUniName().".".getExt($filename):$destination;
	$outFun($dst_image,$dstFilename);
	imagedestroy($src_image);
	imagedestroy($dst_image);
	if(!$flag){
		unlink($filename);
	}
	return $dstFilename;
}