<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-15
 * Time: 上午12:08
 */
require_once(dirname(__FILE__)."/../config.php");
?>
<!--<div style="position:relative ;bottom: 100;">-->
<div class="navbar-fixed-bottom panel-footer">
	<!--<a href==history.go(-1) onclick="history.go(-1)">返回上一页</a>          <!-- 这里如何返回上一级问题还没解决-->
	<a class="btn btn-primary col-md-1" href="<?php echo $ABSPATH;?>">返回主页</a>
	<span class=" text-right copyright col-md-11"> By <a href="http://voidword.sinaapp.com">@VOID001</a> <a href="http://github.com/VOID001/justQuiz">OpenSource Project on Github</a></span>
</div>
<script src="<?php echo $ABSPATH."/bootstrap/js/jquery-".$jquery_version.".min.js";?>" ></script>
<script src="<?php echo $ABSPATH."/bootstrap/js/bootstrap.js";?>" ></script>
