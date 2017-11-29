<?php
	function addCate(){
		$arr = $_POST;
		if(insert('heber_cate',$arr)){
			return $mes = "添加成功!</br><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看列表</a>";
		}
		else{
			return $mes = "添加失败!</br><a href='addCate.php'>重新添加</a>";
		}
	}

	function editCate($id){
		$arr = $_POST;
		if(update('heber_Cate',$arr,"id = {$id}")){
			return $mes = "修改成功!</br><a href='listCate.php'>查看列表</a>";
		}
		else{
			return $mes = "修改失败!</br><a href='listCate.php'>查看列表</a>";
		}

	}

	function delCate($id){
		if(delete("heber_Cate","id = {$id}")){
			return $mes = "删除成功!</br><a href='listCate.php'>查看列表</a>";
		}
		else{
			return $mes = "删除失败!</br><a href='listCate.php'>查看列表</a>";
		}

	}

	function getAllCate() {
		$sql = "select id,cName from heber_cate order by id asc";
		return fetchAll($sql);
	}