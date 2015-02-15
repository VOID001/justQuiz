<!DOCTYPE html>
<html>
<head lang="zh-CN">
	<?php require_once(dirname(__FILE__)."/../html/header.php");?>
    <title>管理入口</title>
</head>
<body style="width: 100%;height: 768px">
<?php require_once(dirname(__FILE__)."/navbar_top.php");?>
<div class="container text-center">
    <div>
        <a class='btn' href="../admin/additem.php"><h2>试题添加</h2></a>
    </div>
    <div>
        <a class='btn' href="../admin/addexam.php"><h2>试卷添加</h2></a>
    </div>
</div>
</body>
<?php require_once(dirname(__FILE__)."/../html/footer.php");?>
</html>