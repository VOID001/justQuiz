<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-5
 * Time: 下午11:34
 * File: additem.php
 */
require_once("../config.php");
if(is_readable("load_conf")==false)
{
	require_once("setup.php");          //First Time to Run
	exit();
}

