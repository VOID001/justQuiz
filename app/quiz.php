<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-5
 * Time: 下午11:01
 * File: quiz.php
 * Description:
 */
$pos="quiz";
require_once(dirname(__FILE__)."/config.php");
require_once(dirname(__FILE__)."/class/examclass.php");
session_start();
?>
	<html>
	<head>
		<title>JustQuiz! An app for quizzing and examing</title>
		<?php require_once(dirname(__FILE__)."/html/header.php");?>
	</head>
	<body>
	<?php require_once(dirname(__FILE__)."/html/navbar_top.php");?>

	<?php
	if($_SERVER['REQUEST_METHOD']=="GET" && empty($_SESSION['curExam']))
	{
		//Show the Exam Selection Form
		require_once(dirname(__FILE__) . '/html/quiz_form.html');            //Show find quiz dialog
	}
	else
	{
	if($_SERVER['REQUEST_METHOD']=="GET" && !empty($_SESSION['curExam']))
	{
		$msgStr = '<div class="alert alert-warning">您上次作答的试卷没有答完</div>';
	}
	?>
	<div class="container">
		<?php echo $msgStr;?>
		<?php
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
				$ok=$_SESSION['curExam']->load_exam($_SESSION['examid']);
				if($ok)
				{
					$_SESSION['curExam']->show_problem($_SESSION['curID']);
				}
				else
				{
					echo '<div class="alert alert-danger">找不到与试卷ID对应的试卷!</div>';
					require_once(dirname(__FILE__) . '/html/quiz_form.html');            //Show find quiz dialog
					unset($_SESSION['curExam']);
				}
			}
		}
		}
		?>
	</div>
	</body>
<?php
require_once(dirname(__FILE__)."/html/footer.php");
?>
	</html>

