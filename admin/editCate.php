<?php
	require_once "../include.php";
	$id = $_REQUEST['id'];
	$sql = "select * from heber_Cate where id = {$id}";
	$row = fetchOne($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加管理员</title>
</head>
<body>
<form action="doAdminAction.php?act=editCate&id=<?php echo $id;?>" method="post">
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">分类名称</td>
		<td><input type="text" name="cName" value="<?php echo $row['cName']?>"/></td>
	</tr>
<!-- 	<tr>
		<td align="right">管理员密码</td>
		<td><input type="text" name="password" value="<?php echo $row['password']?>"/></td>
 	</tr>
	<tr>
		<td align="right">管理员邮箱</td>
		<td><input type="text" name="email" value="<?php echo $row['email']?>"/></td>
	</tr> -->
	<tr>
		<td colspan="2"><input type="submit" value="修改分类" /></td>
	</tr>
</form>	
</body>
</html>	