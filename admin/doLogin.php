<?php
	require_once "../include.php";
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$verify = $_POST['verify'];
	$verify_1 = $_SESSION['verify'];
	$autoFlag = $_POST['autoFlag'];

	if($verify==$verify_1){
		$sql = "select * from heber_admin where username='{$username}' and password='{$password}'";
		$row = checkAdmin($sql);
		if($row){
			if($autoFlag){
				setcookie("adminId",$row['id'],time()+7*24*3600);
				setcookie("adminName",$row['username'],time()+7*24*3600);
			}
			$_SESSION['adminName'] = $row['username'];
			$_SESSION['adminId'] = $row['id'];
			mesAlert('欢迎管理员','index.php');
		}
		else{
			mesAlert('用户名或密码错误','login.php');
		}
	}
	else{
		mesAlert('验证码错误','login.php');
	}
	