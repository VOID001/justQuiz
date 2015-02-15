<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-6
 * Time: 下午8:24
 */
require_once(dirname(__FILE__)."/pitemclass.php");
require_once(dirname(__FILE__)."/../config.php");
class Examclass {
	public $examTitle,$examTiming,$examProblemContainer,$examUserAnswerContainer;
	public $examID;
	public $examProblemNum;
	public $examCurrentProblem;
	public function load_exam($examid)
	{
		global $db_port;
		global $db_host;
		global $db_user;
		global $db_password;
		global $db_name;
		mysql_connect($db_host.":".$db_port,$db_user,$db_password);
		mysql_select_db($db_name);
		$SQLQUERY="SELECT * FROM exams WHERE EID='".$examid."'";
		$resStr=mysql_query($SQLQUERY);
		$tmpData=mysql_fetch_array($resStr);
		$probs=split(",",$tmpData['items']);                //Which function to use?
		$icounter=0;
		foreach($probs as $key=>$value)
		{
			$this->examProblemContainer[$icounter]=new PItemclass();
			$this->examProblemContainer[$icounter]->fetch_from_ID($value);
			$icounter++;
		}
		$this->examID=$examid;
		$this->examProblemNum=$icounter;
		$this->examTitle=$tmpData['EID'];
		shuffle($this->examProblemContainer);
		//var_dump($this);
	}

	public function show_problem($seqID)
	{
		$currProb=$this->examProblemContainer[$seqID];
		?>
		<div class="well">
			<div class="page-header">
				<h1><?php print_r($currProb->ptitle);?></h1>
			</div>
			<div class="page-body">
				<h4><?php print_r($currProb->pbody); ?></h4>
			</div>
			<div class="panszone">
				<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<input type="hidden" name="seqNum" value="<?php echo $seqID;?>"/>
					<?php
					foreach($currProb->psel as $key=>$val)
					{
						$optStr="<div class='input-group'><span class='input-group-addon'><input class='radio-inline' type='radio' name='usersel' value='".$key."'/></span><span class='form-control'>".chr(ord('A')+$key-1).".".$val."</span></div>";
						//chr 这一函数可以把ASCII转为字符 而 ord这一函数可以把字符转为ASCII
						print_r($optStr);
					}
					?>
					<input class= "bottom btn btn-primary" type=submit value="下一题"/>
					<input type="hidden" name="answered" value="true"/>
				</form>
			</div>
		</div>
	<?php
	}

	public function useranswer($seqID,$userans)
	{
		$this->examUserAnswerContainer[$seqID]=$userans;
		//check_immediately();
	}

	public function show_exam_result()
	{
		//var_dump($this);
		$correctNum=0;
		$wrongNum=0;
		foreach($this->examProblemContainer as $key=>$val)
		{
			if($this->check_ans($key)) $correctNum++;
			else $wrongNum++;
		}
		?>

		<div class="well">
			<h2>测试结果</h2>
			<div class="alert alert-success">
				<strong>正确题目数量:</strong><?php print_r($correctNum); ?>
			</div>
			<div class="alert alert-danger">
				<storng>错误题目数量:</storng><?php print_r($wrongNum); ?>
			</div>
			<div>
				<a href="<?php echo $_SERVER['PHP_SELF'];?>">点击这里返回测试选择页面</a>
				<a href="<?php echo dirname($_SERVER['PHP_SELF']);?>">点击这里返回主界面</a>
			</div>
		</div>
	<?php
	}

	public function check_ans($seqID)
	{
		if($this->examProblemContainer[$seqID]->pans==$this->examUserAnswerContainer[$seqID])
			return true;
		return false;
	}
}

//$test=new Examclass();
//$test->load_exam("3a1");
//$test->show_problem(0);