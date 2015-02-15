<head>
	<meta charset="utf-8"/>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-5
 * Time: 下午11:34
 * File: additem.php
 */
$pos="admin";
require_once(dirname(__FILE__)."/../class/pitemclass.php");

if(isset($_POST['addItem']))
{
	//if(check_post()) exit();
	$prob=new PItemclass();
	$prob->fetch_from_post($_POST);
	if($prob->save_to_db())
	{
		$msgStr = "<div class='alert alert-success'>添加试题成功</div>";
	}
	else
	{
		$msgStr="<div class='alert alert-danger'>添加试题失败,请刷新本页面重新尝试或者联系管理员解决问题</div>";
	}


}
require_once(dirname(__FILE__)."/../html/additem_form.php");

require_once(dirname(__FILE__)."/../html/footer.php");

