<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-16
 * Time: 上午10:46
 * justQuiz文件类 支持功能为文件验证 文件上传至指定目录,
 * 文件名加密 文件读取等功能
 */
require_once(dirname(__FILE__)."/../config.php");
class Fileclass {
	//定义初始常数
	private $MAX_FILE_SIZE=1024000;
	private $dir;
	public $currFile;

	function load($FILE)
	{
		if(empty($FILE)) return false;
		$this->currFile=$FILE;
		$this->dir=dirname(__FILE__)."/../".FILE_UPLOAD_DIR;
		return true;
	}

	function verify()
	{
		$acceptDataType=array("audio","image","pdf","text");                 //支持上传的文件类型
		foreach($acceptDataType as $key=>$val)
		{
			if(strstr($this->currFile['type'],$val))                                //文件类型检查
			{
				if($this->currFile['size']<=$this->MAX_FILE_SIZE)           //文件大小校验
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		return false;
	}

	function upload()
	{
		//Get File suffix
		$tmparr=explode(".",$this->currFile['name']);
		$suffix=".".$tmparr[count($tmparr)-1];

		$encStr=$this->encrypt();
		$encStr.=$suffix;
		move_uploaded_file($this->currFile['tmp_name'],$this->dir.$encStr);
		var_dump($this->dir.$encStr);
		return $encStr;
	}

	private function encrypt()
	{
		global $salt;
			return hash("md5", $this->currFile['name'] . time() . $salt);
	}
}