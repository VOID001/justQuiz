<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-5
 * Time: 下午9:33
 * File: config.php
 * Description: configuration file
 */






/**
 * $db_host 变量用于保存数据库服务器的地址 默认为localhost,
 * 如果使用的是远程数据库,则根据情况进行修改
 */
$db_host="localhost";
/**
 * $db_port 变量用于保存数据库的端口号 默认端口为3307
 * 根据情况请自行修改
 */
$db_port="2333";
/**
 * $db_user 变量用于保存数据库用户名 建议不要使用root+空密码
 */
$db_user="justQuiz";
/**
 * $db_password 变量用于保存数据库用户访问密码 建议不要使用root+空密码
 */
$db_password="quizByNEUP-NET";
/**
 * $db_name 变量用于保存本网站所使用的数据库名 在使用本网站之前
 * 请先在数据库服务器内新建一个空数据库 $db_name的名字要与你新建
 * 的数据库名字一致
 */
$db_name="justQuiz";
/**
 * $salt 变量为安全变量,这个变量会检测提交是否合法,等一系列操作 ,
 * 请务必对初始的值进行修改!
 */
$salt="justQuizSaltToken";
/**
 * $jquery_version 变量存储的信息为当前使用的jquery版本
 * 只有在更新jquery的时候才对其进行改动,其他情况下改动可能
 * 导致网页显示出错
 */

$jquery_version="1.11.2";                       //JQuery的版本

/**
 * 开发者信息
 */
$developer="VOID001";

error_reporting(0);                             //调试时注释掉本句

/**
 *以下请不要修改
 */

/** @var  $ABSPATH */
$ABSPATH=substr(dirname(__FILE__),strlen($_SERVER['DOCUMENT_ROOT']));

