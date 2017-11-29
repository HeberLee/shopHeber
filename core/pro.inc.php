<?php
function addPro(){
	$arr = $_POST;
	$arr['pubTime'] = time();
	$uploadFiles = uploadFile("../image_800");
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach ($uploadFiles as $key => $uploadFile) {
			thumb("../image_800".$uploadFile['name'],"../image_50".$uploadFile['name'],50,50);
			thumb("../image_800".$uploadFile['name'],"../image_220".$uploadFile['name'],220,220);
			thumb("../image_800".$uploadFile['name'],"../image_350".$uploadFile['name'],350,350);
		}
	}
}