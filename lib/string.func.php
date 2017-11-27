<?php
	function buildRandomString($type=1,$length=4){
		if($type == 1){
			$chars = join("",range(0,9));
		}
		else if($type == 2){
			$chars = join("",array_merge(range("a","z"),range("A","Z")));
		}
		else if($type == 3){
			$chars = join("",array_merge(range("a","z"),range("A","Z"),range(0,9)));
		}
		if($length > strlen($chars)){
			exit("验证码长度过长！");
		}
		$chars = str_shuffle($chars);
		return substr($chars,0,$length);
	}

	function getUniName(){
		return md5(uniqid(microtime(true),true));
	}
		//得到文件扩展名
	function getExt($filename){
		// return strtolower(end(explode(".",$filename)));
		$array=explode(".", $filename);
		$str=end($array);
		$extstr=strtolower($str);
		return $extstr;
	}