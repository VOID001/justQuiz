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


<div class="container">
	<div class="text-center">
		<h1>justQuiz!测评考试系统</h1>
		<table style="margin:auto;">
			<th></th>
			<tr><br/></tr>
			<tr>
				<td>
					<a href="quiz.php">
						<!--<div style="background-color:yellowgreen; width:300px;height:200px;">-->
						<div class="btn btn-large btn-primary" >
							<div style='margin:auto;font-family: Monaco, "Courier New", Courier, monospace ;font-size:40px;'>Take Quiz! 参加测试</div>
						</div>
					</a>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="bottom">
<!--	<a href="admin/index.php">Admin Access</a>-->
</div>
<?php require_once(dirname(__FILE__)."/html/footer.php");?>
</body>
</html>