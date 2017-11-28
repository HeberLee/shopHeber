<?php
require_once "string.func.php";
function verifyImage($type=1,$length=4,$pixel=0,$line=0){
	//创建画布
	$sess_name = "verify";
	$width = 80;
	$height = 20;
	$image = imagecreatetruecolor($width, $height);
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image,0,0,0);
	//填充画布
	imagefilledrectangle($image, 1, 1,$width-2,$height-2, $white);
	$chars = buildRandomString();
	
	$_SESSION[$sess_name] = $chars;
	$fontfiles = array("msyh.ttf","msyhbd.ttf","ygyxsziti2.0.ttf");
	for($i=0;$i<$length;$i++){
		$size = mt_rand(14,18);
		$angle = mt_rand(-15,15);
		$x = 5+$i*$size;
		$y = mt_rand(16,20);
		$text = substr($chars,$i,1);
		$fontfile = "../fonts/".$fontfiles[mt_rand(0,count($fontfiles)-1)];
		$color = imagecolorallocate($image,mt_rand(0,33),mt_rand(33,66), mt_rand(66,99));
		imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);

	}
			for($i=0;$i<$pixel;$i++){
			imagesetpixel($image,mt_rand(0,$width-1),mt_rand(0,$height-1), $black);
		}

		$color = imagecolorallocate($image,mt_rand(0,33),mt_rand(33,66), mt_rand(66,99));
		for($i=0;$i<$line;$i++){
			imageline($image,mt_rand(0,$width-1),mt_rand(0,$height-1),mt_rand(0,$width-1),mt_rand(0,$height-1), $color);
		}
	ob_clean(); 
	header("content-type:image/gif");
	imagegif($image);
	imagedestroy($image);
}

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
