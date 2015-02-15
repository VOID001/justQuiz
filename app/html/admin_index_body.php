<!DOCTYPE html>
<html>
<head lang="en">
	<?php require_once(dirname(__FILE__)."/../html/header.php");?>
    <title>管理入口</title>
</head>
<body style="width: 100%;height: 768px">
<?php require_once(dirname(__FILE__)."/navbar_top.php");?>
<div style="top:50%;margin:auto;text-align:center">
    <div>
        <h2><a href="../admin/additem.php">试题添加</a></h2>
    </div>
    <div>
        <h2><a href="../admin/addexam.php">试卷添加</a></h2>
    </div>
</div>
</body>
<?php require_once(dirname(__FILE__)."/../html/footer.php");?>
</html>