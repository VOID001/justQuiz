<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-5
 * Time: 下午10:18
 * File: welcome.php
 * Description: The main UI for homepage
 */

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 	<head>
		<title>JustQuiz! An app for quizzing and examing</title>
	</head>
	<body>
		<div style='margin: auto;font-family:KaiTi, "楷体", sans-serif;text-align: center;font-size:40px'>
			justQuiz!测评考试系统
		</div>
		<table style="margin:auto;">
			<th></th>
			<tr><br/></tr>
			<tr>
				<td>
					<a href="quiz.php">
						<div style="background-color:yellowgreen; width:300px;height:200px;">
							<div style='margin:auto;font-family:"Courier New","Arial","sans-serif","monospace";font-size:40px;'>Take Quiz! 参加测试</div>
						</div>
					</a>
				</td>
				<!--
				<td>
					<div style="background-color:red; width:300px;height:200px;">
						<a href="admin/admin.php">
							<div style='margin:auto;font-family:"Courier New","Arial","sans-serif","monospace";font-size:40px;'>Add A Quiz!</div>
						</a>
					</div>
				</td>
				!-->
			</tr>
		</table>
		<div style="">
			<a href="admin/index.php">Admin Access</a>
		</div>
	</body>
</html>