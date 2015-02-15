<?php
/**
 * Created by PhpStorm.
 * User: void-admin
 * Date: 15-2-15
 * Time: 上午11:26
 */
?>
<nav class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $ABSPATH;?>">justQuiz!</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li <?php if($pos=="home")echo 'class="active"';?>><a href="<?php echo $ABSPATH;?>">主页</a></li>
				<li <?php if($pos=="quiz")echo 'class="active"';?>><a href="<?php echo $ABSPATH."/quiz.php";?>">测试入口</a></li>
				<li <?php if($pos=="admin")echo 'class="active"';?>><a href="<?php echo $ABSPATH."/admin/";?>">管理入口</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>