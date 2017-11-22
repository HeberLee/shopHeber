<?php
	function checkAdmin($sql){
		return fetchOne($sql);
	}

	function checkLogined(){
		if($_SESSION['adminId']==''){
			mesAlert('请先登录','login.php');
		}
	}

	function logout(){
		$_SESSION = array();
		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(),"",time()-1);
		}
		session_destroy();
		mesAlert('退出成功','login.php');
	}