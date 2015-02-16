<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-6
 * Time: 下午3:29
 */
require_once(dirname(__FILE__)."/../config.php");
class PItemclass
{
	public $pid,$ptitle,$pbody,$psel,$pans,$pfile;
	public $pIsObjective,$pIsMulti;
	private $initflag=false;

	public function fetch_from_post($MY_POST)
	{
		$this->ptitle=$MY_POST['p_title'];
		$this->pbody=$MY_POST['p_body'];
		$this->pfile=$MY_POST['p_file'];
		for($icounter=1;$icounter<=4;$icounter++)
		{
			$tmpStr=$MY_POST["p_sel_$icounter"];
			if(!empty($tmpStr))
			{
				$this->psel[$icounter]=$tmpStr;
			}
			else
			{
				break;
			}
		}
		$this->pans=$MY_POST['p_ans'];
		$this->initflag=true;
	}

	public function fetch_from_ID($PID)
	{
		global $db_host;
		global $db_port;
		global $db_user;
		global $db_password;
		global $db_name;
		mysql_connect($db_host.":".$db_port,$db_user,$db_password);
		mysql_select_db($db_name);
		$SQLQUERY="SELECT * FROM testitems WHERE PID='".$PID."'";
		$resStr=mysql_query($SQLQUERY);
		$tmpData=mysql_fetch_array($resStr);
		$this->ptitle=$tmpData['title'];
		$this->pbody=$tmpData['body'];
		$this->pIsObjective=$tmpData['isObjective'];
		$this->pans=$tmpData['answer'];
		$this->pfile=$tmpData['attachment'];
		for($icounter=1;$icounter<=$tmpData['choiceNum'];$icounter++)
		{
			$this->psel[$icounter]=$tmpData["item_$icounter"];
		}
		$this->initflag=true;
	}

	/**
	 * @return bool
	 */
	public function save_to_db()
	{
		global $db_host;
		global $db_port;
		global $db_user;
		global $db_password;
		global $db_name;
		if($this->initflag)
		{
			mysql_connect($db_host.":".$db_port,$db_user,$db_password);
			mysql_select_db($db_name);
			$SQLQUERY="SELECT * FROM testitems";
			$queryRes=mysql_query($SQLQUERY);
			$this->pid=mysql_num_rows($queryRes)+1;
			$SQLQUERY="INSERT INTO testitems(PID, title, body, attachment, isObjective, isMulti, choiceNum, item_1, item_2, item_3, item_4, item_5, item_6, item_7, answer, correctNum, wrongNum)
VALUES('$this->pid','$this->ptitle','$this->pbody','$this->pfile','1','0','4','".$this->psel[1]."','".$this->psel[2]."','".$this->psel[3]."','".$this->psel[4]."',NULL,NULL,NULL,'$this->pans','0','0')";
			mysql_query($SQLQUERY);
			if(mysql_error())
			{
				echo mysql_error();
				return false;
			}
			return true;
		}
		return false;
	}
}

