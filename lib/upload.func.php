<?php
require_once "string.func.php";
function buildInfo(){
	$i = 0;
	foreach ($_FILES as $myfile) {
		if(is_string($myfile['name'])){
			$file[$i] = $myfile;
			$i++;
		}
		else{
			foreach ($myfile['name'] as $key => $v) {
				$file[$i]['name'] = $v;
				$file[$i]['size'] = $myfile['size'][$key];
				$file[$i]['tmp_name'] = $myfile['tmp_name'][$key];
				$file[$i]['error'] = $myfile['error'][$key];
				$file[$i]['type'] = $myfile['type'][$key];
				$i++;
			}

		}
	}
	if($file){
		return $file;
	}
}

function uploadFile($path="uploads",$allowExt = array("txt","jpeg","gif","png","jpg"),$maxSize=1512000){
	$i = 0;

	if(!file_exists($path)){
		mkdir($path,0777,true);
	}
	$fileInfos = buildInfo();
	// var_dump($fileInfos);
	foreach($fileInfos as $fileInfo){
		$ext = getExt($fileInfo['name']);
		$uniName = getUniName();
		$name = $uniName.".".$ext;
		$des = $path."/".$name;
		if($fileInfo['error']==UPLOAD_ERR_OK){
			//限制上传文件类型
			if(!in_array($ext,$allowExt)){
				exit("非法文件类型！");
			}
			//限制上传文件大小
			if($fileInfo['size']>$maxSize){
				exit("文件过大！");
			}
			//判断文件是否通过HTTP上传
			//is_uploaded_file($tmp_name);
			if(is_uploaded_file($fileInfo['tmp_name'])){
				if(move_uploaded_file($fileInfo['tmp_name'],$des)){
					$mes="文件上传成功！";
					$fileInfo['name'] = $name;
					unset($fileInfo['error'],$fileInfo['tmp_name'],$fileInfo['size'],$fileInfo['type']);
					$uploadedFiles[$i] = $fileInfo;
					$i++;
				}
				else{
					$mes="文件上传失败";
				}
			}	
			else{
				$mes="不是通过HTTP方式上传";
			}
		}
		else{
			switch($fileInfo['error']){
				case 1:
					$mes="超过了设置的上传文件大小";
					break;
				case 2:
					$mes="超过了表单设置上传文件的大小";
					break;
				case 3:
					$mes="文件部分被上传";
					break;
				case 4:
					$mes="没有文件被上传";
					break;
				case 6:
					$mes="没有找到临时目录";
					break;
				case 7:
					$mes="文件不可写";
					break;
				case 8:
					$mes="由于PHP的扩展程序中断了文件上传";
					break;
			}
			
			//file_uploads = on
			//upload_tmp_dir 更改临时文件目录
			//upload_max_filesize 表单上传文件的最大值
			//post_max_size 表单以POST方式发送数据的最大值
		}
		echo $mes;
	}
	return $uploadedFiles;
}

