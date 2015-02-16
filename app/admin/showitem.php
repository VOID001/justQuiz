<meta charset="utf-8"/>
<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-14
 * Time: 下午10:40
 */
$pos="admin";
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
	<?php require_once(dirname(__FILE__)."/../html/header.php");?>
</head>
<body>
<?php require_once(dirname(__FILE__)."/../html/navbar_top.php");?>
<div class="container well">
	<div class="row page-header"">
	<h1><?php echo $prob['title'];?></h1>
</div>
<div class="row page-body lead">
	<?php
	echo $prob['body'];
	?>
</div>
<div class="row">
	<?php
		if(!empty($prob['attachment']))
		{
			$suffix=explode(".",$prob['attachment']);
			$suffix=$suffix[count($suffix)-1];
			$imgType=array("jpg","jpeg","png","gif","bmp");
			$isImg=false;
			foreach($imgType as $key=>$val)
			{
				if($suffix==$val)
				{
					?>
					<img class=" col-md-4 img-responsive img-thumbnail" src="<?php echo $ABSPATH."/".FILE_UPLOAD_DIR.$prob['attachment']?>"/>
					<?php
					$isImg=true;
					break;
				}
			}
			if(!$isImg)
			{
				?>
				<a class=" col-md-4" href="<?php echo $ABSPATH."/".FILE_UPLOAD_DIR.$prob['attachment']?>">点此下载附件</a>
				<?php
			}
		}
	?>
</div>
<div class="row">
	<h3>答案及选项</h3>
	<?
	$alphabets=array("A","B","C","D","E","F");
	for($count=1;$count<=$prob['choiceNum'];$count++)
	{
		$echoStr="";
		$echoStr.=$alphabets[$count-1].".".$prob['item_'.$count];
		if($prob['answer']==$count) $echoStr='<div class=bg-success><strong>'.$echoStr.'[答案]</strong></div>';
		?>
		<ul class="form-control">
			<?php echo $echoStr; ?>
		</ul>
	<?php
	}
	$rate=$prob['correctNum']/($prob['wrongNum']+$prob['correctNum']);
	?>
</div>
<div class="alert alert-warning">
	<h1>试题信息</h1>
	<div>正确数:&nbsp;&nbsp;&nbsp;<?php echo$prob['correctNum'];?></div>
	<div>错误数:&nbsp;&nbsp;&nbsp;<?php echo$prob['wrongNum'];?></div>
	<div>正确率:&nbsp;&nbsp;&nbsp;<?php echo$prob['wrongNum'];?></div>
</div>
<?php
$hrefAdd = $_SERVER['PHP_SELF'] . "/../addexam.php?addItem=true&id=" . $prob['PID'] . "&token=" . hash("md5", $prob['PID'] . $salt."add");
$hrefDel = $_SERVER['PHP_SELF'] . "/../addexam.php?delItem=true&id=" . $prob['PID'] . "&token=" . hash("md5", $prob['PID'] . $salt."del");
?>
<div class="btn-group">
	<a class='btn btn-success' href=<?php echo $hrefAdd;?>>添加此试题并返回</a>&nbsp;&nbsp;&nbsp;
	<a class='btn btn-info' href=<?php echo $hrefDel;?>>从试卷中移出此试题并返回</a>&nbsp;&nbsp;&nbsp;
	<a class='btn btn-primary' href="./addexam.php">返回题目选择页面</a>
</div>
<?php require_once(dirname(__FILE__)."/../html/footer.php");?>
</body>
</html>
