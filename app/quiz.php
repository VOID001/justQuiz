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
require_once(dirname(__FILE__)."/class/examclass.php");
session_start();
if($_SERVER['REQUEST_METHOD']=="GET")
{
	//Show the Exam Selection Form
	require_once(dirname(__FILE__) . '/html/quiz_form.html');            //Show find quiz dialog
}
else
{
	if(!empty($_SESSION['curExam']))               //User has already in exam
	{
		if(!empty($_POST['answered']))
		{
			if($_SESSION['curExam']->examProblemNum==$_SESSION['curID']+1)
			{
				$_SESSION['curExam']->useranswer($_SESSION['curID'],$_POST['usersel']);
				$_SESSION['curExam']->show_exam_result();
				unset($_SESSION['curExam']);
			}
			else
			{
				$_SESSION['curExam']->useranswer($_SESSION['curID'],$_POST['usersel']);
				$_SESSION['curID']++;
				$_SESSION['curExam']->show_problem($_SESSION['curID']);
			}
		}
		else
		{
			$_SESSION['curExam']->show_problem($_SESSION['curID']);
		}
	}
	else                                            //User should select paper
	{
		if(empty($_POST['eid']))
		{
			require_once(dirname(__FILE__) . '/html/quiz_form.html');            //Show find quiz dialog
		}
		else                                        //User has already choose an exam
		{
			$_SESSION['examid']=$_POST['eid'];

			$_SESSION['curExam']=new Examclass();
			$_SESSION['curID']=0;
			$_SESSION['curExam']->load_exam($_SESSION['examid']);
			$_SESSION['curExam']->show_problem($_SESSION['curID']);
		}
	}
}
//require_once("html/quiz_header.php");
//require_once("html/quiz_body.php");
//require_once("html/quiz_footer.php");

