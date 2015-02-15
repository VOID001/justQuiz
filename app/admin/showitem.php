<meta charset="utf-8"/>
<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-14
 * Time: 下午10:40
 */
require_once(dirname(__FILE__)."/../config.php");
$sqlconn=mysql_connect($db_host.":".$db_port,$db_user,$db_password);
mysql_select_db($db_name);
$SQLQUERY="SELECT * FROM testitems WHERE PID='".$_GET['id']."'";
$resStr=mysql_query($SQLQUERY);
$prob=mysql_fetch_array($resStr);
mysql_close();
//var_dump($prob);
?>
<html>
<head>
	<title><?php echo "试题显示--".$prob['title'];?></title>
</head>
<body>
	<div>
		<div style="font-size:30px">
			&nbsp;&nbsp;&nbsp;<?php echo $prob['title'];?>
		</div>
		<div style='font-size: 20px;font-family: Courier, "Courier New", monospace'>
			<?php
				echo $prob['body'];
			?>
		</div>
		<div>
			<h3>答案及选项</h3>
			<?
				$alphabets=array("A","B","C","D","E","F");
				for($count=1;$count<=$prob['choiceNum'];$count++)
				{
					$echoStr="";
					$echoStr.=$alphabets[$count-1].".".$prob['item_'.$count];
					if($prob['answer']==$count) $echoStr.="[答案]";
					?>
				<div>
					<?php echo $echoStr; ?>
				</div>
			<?php
				}
				$rate=$prob['correctNum']/($prob['wrongNum']+$prob['correctNum']);
			?>
		</div>
		<div>
			<h3>试卷信息</h3>
			<div>正确数:&nbsp;&nbsp;&nbsp;<?php echo$prob['correctNum'];?></div>
			<div>错误数:&nbsp;&nbsp;&nbsp;<?php echo$prob['wrongNum'];?></div>
			<div>正确率:&nbsp;&nbsp;&nbsp;<?php echo$prob['wrongNum'];?></div>
		</div>
		<?php
		$hrefAdd = $_SERVER['PHP_SELF'] . "/../addexam.php?addItem=true&id=" . $prob['PID'] . "&token=" . hash("md5", $prob['PID'] . $salt."add");
		$hrefDel = $_SERVER['PHP_SELF'] . "/../addexam.php?delItem=true&id=" . $prob['PID'] . "&token=" . hash("md5", $prob['PID'] . $salt."del");
		?>
		<a href=<?php echo $hrefAdd;?>>添加此试题并返回</a>&nbsp;&nbsp;&nbsp;
		<a href=<?php echo $hrefDel;?>>从试卷中移出此试题并返回</a>&nbsp;&nbsp;&nbsp;
		<a href="./addexam.php">返回题目选择页面</a>
	</div>
	<?php require_once(dirname(__FILE__)."/../html/footer.php");?>
</body>
</html>
