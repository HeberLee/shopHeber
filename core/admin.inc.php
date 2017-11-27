<?php
	function checkAdmin($sql){
		return fetchOne($sql);
	}

	function checkLogined(){
		if(!isset($_SESSION['adminId']) && !isset($_COOKIE['adminId'])){
			mesAlert('请先登录','login.php');
		}
	}

	function logout(){
		$_SESSION = array();
		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(),"",time()-1);
		}
		if(isset($_COOKIE['adminId'])){
			setcookie("adminId","",time()-1);
		}
		if(isset($_COOKIE['adminName'])){
			setcookie("adminName","",time()-1);
		}
		session_destroy();
		mesAlert('退出成功','login.php');
	}

	function addAdmin(){
		$arr = $_POST;
		$arr['password'] = md5($_POST['password']);
		if(insert('heber_admin',$arr)){
			return $mes = "添加成功!</br><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看列表</a>";
		}
		else{
			return $mes = "添加失败!</br><a href='addAdmin.php'>重新添加</a>";
		}
	}

	function getAllAdmin(){
		$sql = "select id,username,email from heber_admin";
		if($rows = fetchAll($sql)){
			return $rows;
		}
		else{
			echo "error!could not get info";
		}
	}

	function editAdmin($id){
		$arr = $_POST;
		if(update('heber_admin',$arr,"id = {$id}")){
			return $mes = "修改成功!</br><a href='listAdmin.php'>查看列表</a>";
		}
		else{
			return $mes = "修改失败!</br><a href='listAdmin.php'>查看列表</a>";
		}

	}

	function delAdmin($id){
		if(delete("heber_admin","id = {$id}")){
			return $mes = "删除成功!</br><a href='listAdmin.php'>查看列表</a>";
		}
		else{
			return $mes = "删除失败!</br><a href='listAdmin.php'>查看列表</a>";
		}

	}