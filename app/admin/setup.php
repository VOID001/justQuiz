<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-6
 * Time: 上午9:10
 * File: setup.php
 * Description: Running only once and remove itself when finish setup
 */
if(!isset($_GET['action']) || $_GET['action']!="install")
{
	require_once(dirname(__FILE__)."/../html/setup_ui.html");
	require_once(dirname(__FILE__)."/../html/setup_btn.html");
	exit();
}
else
{
	require_once(dirname(__FILE__)."/../html/setup_ui.html");
	echo "<h3>安装中，请稍后...</h3>";
	require_once(dirname(__FILE__)."/../config.php");
	//sqlConnection
	$sqlconn=mysql_connect($db_host.":".$db_port,$db_user,$db_password);
	if(!mysql_error()) echo"<h4>数据服务器连接完成</h4>";
	mysql_select_db($db_name);
	if(!mysql_error()) echo"<h4>数据库连接完成</h4>";
	//Start to Create Tables
	$SQLQUERY="CREATE TABLE testitems(PID INTEGER ,title MEDIUMTEXT,body MEDIUMTEXT,
		attachment MEDIUMTEXT,isObjective BOOL,isMulti BOOL,choiceNum INTEGER,
		item_1 VARCHAR(225),item_2 VARCHAR(225),item_3 VARCHAR(225),item_4 VARCHAR(225),item_5 VARCHAR(225),
		item_6 VARCHAR(225),item_7 VARCHAR(225),answer MEDIUMTEXT,correctNum MEDIUMINT,wrongNum
		MEDIUMINT)";
	mysql_query($SQLQUERY);               //暂时不执行
	if(!mysql_error())
	{
		echo"<h4>试题库testitems建立完成!</h4>";
		$ok=true;
	}
	else
	{
		echo"<h4><i>试题库testitems建立失败!</i></h4>";
		echo "<br/>".mysql_error();
		$ok=false;
	}
	$SQLQUERY="CREATE TABLE exams(EID VARCHAR(32) ,items MEDIUMTEXT,rankAnum MEDIUMINT,
		rankBnum MEDIUMINT,rankCnum MEDIUMINT,rankDNum MEDIUMINT,timinginfo MEDIUMTEXT)";
	mysql_query($SQLQUERY);               //暂时不执行
	if(!mysql_error())
	{
		echo"<h4>试卷库exams建立完成!</h4>";
		$ok=true;
	}
	else
	{
		echo"<h4><i>试卷库exams建立失败!</i></h4>";
		echo "<br/>".mysql_error();
		$ok=false;
	}

	if($ok)                         //建立成功
	{
		//Rename the File and create load_conf then goback to index.php
		mysql_close($sqlconn);
		$confFile="load_conf";
		if(!is_readable($confFile))
		{
			touch($confFile);
			if (is_writeable($confFile) == false)
			{
				echo "请检查你的admin目录是否有可写入的权限，没有的话请赋予写入权限";
			}
			else
			{
				srand(time());
				$seed = rand(100000, 9999999);
				$data = hash("md5", time() . $seed);
				echo $data;
				file_put_contents($confFile, $data);
				require_once(dirname(__FILE__)."/../html/setup_finish.html");
			}
		}
	}
	else
	{
		echo"<h4>安装失败，请修改配置文件中的用户名和密码以保证数据库的正常连接，并检查其它问题之后刷新本页面重新安装</h4>";
	}
}


