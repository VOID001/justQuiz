<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-6
 * Time: 上午11:42
 */
?>
<head>
</head>
<body>
	<div>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<table>
				<th colspan="2">
					<div style="text-align: center">
						添加题目
					</div>
				</th>
				<tr>
					<td>
						<div>
							题目标题
						</div>
					</td>
					<td>
						<div style="width:500px">
							<input type="text" name="p_title" style="width:500px"/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div>
							题目描述
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="height:300px">
						<textarea name="p_body" style="margin:auto;width: 100%;height:100%;font-size:30px"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<div style="height:25px">
						</div>
					</td>
				</tr>
				<?php
					$choiceArr=array("A","B","C","D","E");
					for($icounter=1;$icounter<=4;$icounter++)
					{
						$optionStr="<tr><td>选项".$choiceArr[$icounter-1]."</td><td><input type='text' name='p_sel_".$icounter."' style='width:400px'/></td></tr>";
						echo $optionStr;
					}
				?>
				<tr>
					<td>
						<div>
							答案
						</div>
					</td>
					<td>
						<?php
						//$choiceArr=array("A","B","C","D","E");
						for($icounter=1;$icounter<=4;$icounter++)
						{
							$optionStr="<input type='radio' name='p_ans' value=".$icounter.">";
							echo $optionStr.$choiceArr[$icounter-1];
						}
						?>
					</td>
				</tr>
				<tr align="center">
					<td align="center">
						<input type="submit" value="添加试题"/>
					</td>
					<td align="center">
						<input type="reset" value="清空表单"/>
					</td>
				</tr>
			</table>
			<input type="hidden" name="addItem" value="<?php $data="VOID001"; echo hash("md5",$data.time());?>"/>
		</form>
	</div>
</body>
