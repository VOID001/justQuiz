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
require_once(dirname(__FILE__)."/../class/pitemclass.php");

if(isset($_POST['addItem']))
{
	//if(check_post()) exit();
	$prob=new PItemclass();
	$prob->fetch_from_post($_POST);
	var_dump($prob);
	if($prob->save_to_db())
		echo "添加试题成功";


}
require_once(dirname(__FILE__)."/../html/additem_form.php");

require_once(dirname(__FILE__)."/../html/footer.php");

