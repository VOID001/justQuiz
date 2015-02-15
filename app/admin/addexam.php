<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-14
 * Time: 下午1:41
 */
require_once(dirname(__FILE__)."/../class/examclass.php");
require_once(dirname(__FILE__)."/../class/pitemclass.php");
session_start();

//Show current select problems
if(empty($_SESSION['selProb']))
{
	$_SESSION['selProb']=array();
}
if(!empty($_GET['addItem']) || !empty($_GET['delItem']))           //Add a problem to current exam
{
	if(!empty($_GET['addItem']))
	{
		if(!validate($_GET['id'],$_GET['token'],"add"))
		{
			exit("请不要直接修改URL<br/><a href=".$_SERVER['PHP_SELF'].">返回试卷添加</a>"); //这里可以修改为任意的一个错误页面
		}
		array_push($_SESSION['selProb'],$_GET['id']);
		sort($_SESSION['selProb']);
		$_SESSION['selProb']=array_unique($_SESSION['selProb']);
	}
	else if(!empty($_GET['delItem']))
	{
		//remove_arr_element($_SESSION['selProb'],"3dm");
		if(!validate($_GET['id'],$_GET['token'],"del"))
		{
			exit("请不要直接修改URL<br/><a href=".$_SERVER['PHP_SELF'].">返回试卷添加</a>"); //这里可以修改为任意的一个错误页面
		}
		remove_arr_element($_SESSION['selProb'],$_GET['id']);
	}
}
else if(isset($_POST) && $_POST['create']=="true")               //Create a Paper
{
	if(empty($_POST['examid']))
	{
		$msgStr = "<div style='background-color: red'>试卷名字不能为空!</div>";
	}
	else
	{
		if (empty($_SESSION['selProb']))
		{
			$msgStr = "<div style='background-color: red'>你没有选择试题,请选择试题之后再次进行组卷</div>";
		}
		else
		{
			$sqlconn = mysql_connect($db_host . ":" . $db_port, $db_user, $db_password);
			mysql_select_db($db_name);
			$SQLQUERY = "SELECT * FROM exams WHERE EID='" . $_POST['examid'] . "'";
			$resStr = mysql_query($SQLQUERY);
			$resStr = mysql_fetch_array($resStr);
			if ($resStr != false)
			{
				$msgStr = "<div style='background-color: red'>试卷ID重复,请重新输入</div>";
			}
			else
			{
				$tmpStr = "";
				$cnt = count($_SESSION['selProb']);
				$curr = 1;
				foreach ($_SESSION['selProb'] as $key => $val)
				{
					$tmpStr = $tmpStr . $val;
					if ($curr != $cnt) $tmpStr = $tmpStr . ",";
					$curr++;
				}
				$SQLQUERY = "INSERT INTO exams(EID,items) VALUE('" . $_POST['examid'] . "','" . $tmpStr . "')";
				mysql_query($SQLQUERY);
				$msgStr = "<div style='background-color: lightgreen'>试卷添加成功</div>";
				mysql_close($sqlconn);
				unset($_SESSION['selProb']);
			}
		}
	}
}

?>
	<html>
	<head lang="en">
		<title>添加试卷</title>
		<meta charset="utf-8"/>
	</head>
	<body>
	<div style="background-color: greenyellow">
		<div style="background-color: hotpink">Warning: 测试版每套试卷仅支持50道题目的添加,请注意</div>
		<div>已选择试题,点击试题删除已选择试题</div>
		<div style='font-family:"Courier New", Courier, Monospace;font-size: 30px'>
			<?php
			$maxCol=8;                  //设置每行最多显示题目数量
			$curCol=0;
			if(!empty($_SESSION['selProb']))
			{
				foreach($_SESSION['selProb'] as $key=>$val)
				{
					$href = $_SERVER['PHP_SELF'] . "?delItem=true&id=" . $val . "&token=" . hash("md5", $val . $salt."del");
					echo "<a style='text-decoration: none;'href=$href>$val</a>&nbsp;&nbsp;&nbsp;";                  //CSS Goes
					$curCol++;
					if ($curCol == $maxCol) echo "<br/>";
				}
			}
			?>
		</div>
		<div>
			<div>
				选好试题后 请为试卷命名
				<form method="post" action=<?php echo$_SERVER['PHP_SELF']; ?>>
					<input type="text" id="examid" name="examid"/>
					<input type="submit" value="生成试卷"/>
					<input type="hidden" id="create" name="create" value="true"/>
				</form>
				<?php echo $msgStr;?>
			</div>
		</div>
	</div>
	<div style="background-color: lightblue;margin:auto; width:100%">
		<div style="margin:auto; width:80%">
			<div style="font-size: 30px;">全部试题</div>
			<table border="1"  align="center" width="80%" height="80%">
				<tr>
					<td width="25%">试题编号(点击可查看试题)</td>
					<td>摘要内容</td>
					<td>添加试题</td>
				</tr>
				<?php
				$sqlconn=mysql_connect($db_host.":".$db_port,$db_user,$db_password);
				mysql_select_db($db_name);
				$SQLQUERY="SELECT * FROM testitems";
				$queryStr=mysql_query($SQLQUERY,$sqlconn);

				while($tmpRes=mysql_fetch_array($queryStr))
				{
					//var_dump($tmpRes);
					$hrefID="<a href=\"".$_SERVER['PHP_SELF']."/../showitem.php?id=".$tmpRes['PID']."\">".$tmpRes['PID']."</a>";
					$contentStr=mb_substr($tmpRes['body'],0,5,"utf-8")."...";                 //不可以直接使用substr 用mb_substr代替 这样在截取中文的时候才不会出现乱码
					//$contentStr=$tmpRes['body'];
					$hrefAdd = $_SERVER['PHP_SELF'] . "?addItem=true&id=" . $tmpRes['PID'] . "&token=" . hash("md5", $tmpRes['PID'] . $salt."add");
					$echoStr="<tr><td align='center' style='font-size: 20px;'>".$hrefID."</td><td>$contentStr</td><td><a href=$hrefAdd>Add</a></td></tr>";
					echo $echoStr;
				}
				mysql_close($sqlconn);
				?>
			</table>
		</div>
	</div>
	<?php require_once(dirname(__FILE__)."/../html/footer.php");?>
	</body>
	</html>

<?php

function remove_arr_element(&$arr,$data)        //用引用才能真正实现删除掉数组内元素
{
	$offset=array_search($data,$arr);
	if(!is_bool($offset))
		array_splice($arr,$offset,1);
}

function validate($id,$token,$mode)
{
	global $salt;
	$str=hash("md5",$id.$salt.$mode);
	if($token==$str) return true;
	return false;
}
