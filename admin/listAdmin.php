<?php
	require_once "../include.php";
    $sql = "select * from heber_admin";
    $totalRows = getNum($sql);
    $pageSize = 2;
    $totalPage = ceil($totalRows/$pageSize);
    if(isset($_REQUEST['page'])){
     $page = (int)$_REQUEST['page'];
    }
    else{
     $page = 1;
    }
    if($page<1 || $page==null || !is_numeric($page)){
     $page = 1;
    }
    if($page>=$totalPage){
     $page = $totalPage;
    }
    $offset = ($page-1)*$pageSize;
    $sql = "select * from heber_admin limit {$offset},{$pageSize}";
    $allAdmin = fetchAll($sql);

    $divide_page = divide_page($page,$totalPage,$pageSize,$where="cid=6");
	// $allAdmin = getAllAdmin();
	if(!$allAdmin){
		mesAlert("没有管理员，请先添加","addAdmin.php");
		exit();
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">编号</th>
                                <th width="25%">管理员名称</th>
                            	<th width="30%">管理员邮箱</th>
                                <th width="20%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;foreach ($allAdmin as $value):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $i?></label></td>
                                <td><?php echo $value['username']?></td>
                                <td><?php echo $value['email']?></td>
                                <td align="center"><input type="button" value="修改" class="btn" onclick="editAdmin(<? echo $value['id'];?>)"><input type="button" value="删除" class="btn" onclick="delAdmin(<? echo $value['id'];?>)"></td>
                            </tr>
                         <?php $i++;endforeach;?>

                        </tbody>
                    </table>
                    <?php echo $divide_page;?>
                </div>

</body>
<script type="text/javascript">
	function editAdmin(id){
		window.location = "editAdmin.php?id="+id;
	}
    function delAdmin(id){
        if(window.confirm("您确定要删除吗？")){
             window.location = "doAdminAction.php?act=delAdmin&id="+id;
        }
    }
    function addAdmin(){
        window.location = "addAdmin.php";
    }
</script>
</html>	