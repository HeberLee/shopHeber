<?php
	// require_once "./mysql.func.php";
	// $sql = "select * from heber_admin";
	// $totalRows = getNum($sql);
	// var_dump($totalRows);
	// $pageSize = 2;
	// $totalPage = ceil($totalRows/$pageSize);
	// if(isset($_REQUEST['page'])){
	// 	$page = (int)$_REQUEST['page'];
	// }
	// else{
	// 	$page = 1;
	// }
	// if($page<1 || $page==null || !is_numeric($page)){
	// 	$page = 1;
	// }
	// if($page>=$totalPage){
	// 	$page = $totalPage;
	// }
	// $offset = ($page-1)*$pageSize;

	// $sql = "select * from heber_admin limit {$offset},{$pageSize}";
	// $rows = fetchAll($sql);
	// foreach ($rows as $key => $value) {
	// 	print_r($value);
	// 	echo "<hr>";
	// }
	// $test = divide_page($page,$totalPage,$pageSize,$where="cid=6");
	// echo $test;
	function divide_page($page,$totalPage,$pageSize,$where=null){
		$where = ($where==null)?null:"&".$where;
		$url = $_SERVER['PHP_SELF'];
		$index = ($page == 1)?"首页":"<a href='{$url}?page=1{$where}'>首页</a>";
		$last = ($page == $totalPage)?"尾页":"<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
		$prev = ($page == 1)?"上一页":"<a href='{$url}?page=".($page-1)."{$where}'>上一页</a>";
		$next = ($page == $totalPage)?"下一页":"<a href='{$url}?page=".($page+1)."{$where}'>下一页</a>";
		$str = "当前是第{$page}页/总共{$totalPage}页";
		$p = null;
		for($i=1;$i<=$totalPage;$i++){
			if($page == $i){
				$p .= "[{$i}]";
			}
			else{
				$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
			}
		}
		$sep = "  ";
		return $pageStr =  $str.$sep.$index.$sep.$prev.$sep.$p.$sep.$next.$sep.$last;
	}
?>