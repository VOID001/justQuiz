<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-5
 * Time: 下午10:18
 * File: welcome.php
 * Description: The main UI for homepage
 */
$pos="home";
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
	<title>JustQuiz! An app for quizzing and examing</title>
	<?php require_once(dirname(__FILE__)."/html/header.php");?>
</head>
<body>
<?php require_once(dirname(__FILE__)."/html/navbar_top.php");?>


<div class="container-fluid jumbotron">
	<div class="jumbotron text-center">
		<h1 class>justQuiz!</h1>
		<h2 class="lead text-justify">justQuiz! 是一个分享型的竞答社区,你可以提交你的题目让他人作答,也可以去挑战其它人布下的难题哦,快点击下面的按钮先睹为快吧</h2>
	</div>
	<div class="row" align="center">
		<a href="quiz.php">
			<!--<div style="background-color:yellowgreen; width:300px;height:200px;">-->
			<div class="btn btn-primary" >
				<div style='font-size:40px;'>Take Quiz! 参加测试</div>
			</div>
		</a>
	</div>
	<div class="bottom">
		<!--	<a href="admin/index.php">Admin Access</a>-->
	</div>
</div>
<?php require_once(dirname(__FILE__)."/html/footer.php");?>
</body>
</html>