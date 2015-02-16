<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-6
 * Time: 上午11:42
 */
require_once(dirname(__FILE__)."/../config.php");
?>
<head>
	<?php require_once(dirname(__FILE__)."/../html/header.php");?>
</head>
<body>
<?php require_once(dirname(__FILE__)."/../html/navbar_top.php");?>
	<div class="container col-md-8 col-md-offset-2 well">
		<?php echo $msgStr;?>
		<form class="form-group" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<table class="table">
				<th colspan="2">
						<h1>添加题目</h1>
				</th>
				<tr>
					<th>
							题目标题
					</th>
					<td>
						<div style="width:500px">
							<input class="form-control" type="text" name="p_title" style="width:500px"/>
						</div>
					</td>
				</tr>
				<tr>
					<th>
							题目描述
					</th>
				</tr>
				<tr>
					<td colspan="2" style="height:300px">
						<textarea class="form-control" rows=15 name="p_body"></textarea>
					</td>
				</tr>
				<?php
					$choiceArr=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N");
					for($icounter=1;$icounter<=4;$icounter++)
					{
						$optionStr="<tr><th>选项".$choiceArr[$icounter-1]."</th><td><input class='form-control' placeholder='在此输入选项内容' type='text' name='p_sel_".$icounter."' style='width:400px'/></td></tr>";
						echo $optionStr;
					}
				?>
				<tr class="">
					<th>点击此处添加附件</th>
					<td><label><input type="file" name="p_file" id="p_file"/><p class="help-block">(仅支持图片格式和音频格式以及文档格式 大小不超过1MB)</p></label></td>
				</tr>
				<tr>
					<th>
							答案
					</th>
					<td>
						<?php
						//$choiceArr=array("A","B","C","D","E");
						for($icounter=1;$icounter<=4;$icounter++)
						{
							$optionStr="<label class='col-md-1'><input class='radio-inline' type='radio' name='p_ans' value=".$icounter.">";
							echo $optionStr."".$choiceArr[$icounter-1]."</label>";
						}
						?>
					</td>
				</tr>
				<tr align="center">
					<td align="center">
						<input class="btn btn-primary" type="submit" value="添加试题"/>
					</td>
					<td align="center">
						<input class="btn btn-danger"type="reset" value="清空表单"/>
					</td>
				</tr>
			</table>
			<input type="hidden" name="addItem" value="<?php echo hash("md5",$salt.time());?>"/>
		</form>
	</div>
<?php require_once(dirname(__FILE__)."/../html/header.php");?>
</body>
