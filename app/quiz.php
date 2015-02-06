<meta charset="utf-8" />
<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-5
 * Time: 下午11:01
 * File: quiz.php
 * Description:
 */

session_start();//start the php session
if(!isset($_GET['eid']))//No Test Specified
{
	require_once('html/quiz_form.html');            //Show find quiz dialog
	exit();
}
$_SESSION['examid']=$_GET['eid'];

