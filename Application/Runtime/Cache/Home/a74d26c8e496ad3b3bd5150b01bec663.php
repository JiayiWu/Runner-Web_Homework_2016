<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>

<html>
	<head>
		<title>好友列表</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->

		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="icon" href="images/logo.ico">



		<!-- 新 Bootstrap 核心 CSS 文件 -->

		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/init.css">
		<link rel="stylesheet" href="assets/css/friends.css">
		<link rel="stylesheet" href="assets/css/search.css">
	</head>
	<body>
		<!--<div id="page-wrapper">-->

			<!-- Header -->
		<header id="header">
			<h1><a href="#">Runner</a></h1>
			<nav id="nav">
				<ul>
					<li><a href="home.html">首页</a></li>
					<li>
						<a href="dataRun.html" >数据</a>
					</li>
					<li><a href="competitionAll.html">竞赛</a></li>
					<li><a href="moments.html">圈子</a></li>
					<li>
						<a href="#" class="icon fa-angle-down">个人中心</a>
						<ul>
							<li style="white-space: nowrap"><a href="userInfo.html">修改信息</a></li>
							<li style="white-space: nowrap"><a href="index.html">登出</a></li>

						</ul>
					</li>
				</ul>
			</nav>
		</header>





		<div class="container" >
			<div class="row">
				<div class=" col-xs-10 col-sm-10  col-md-6  col-lg-6 col-md-offset-3  col-lg-offset-3 col-xs-offset-1  " >

					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation"><a href="moments.html">朋友圈</a></li>
						<li role="presentation" ><a href="friends.html">好友</a></li>
						<li role="presentation" class="active"><a href="fans.html">粉丝</a></li>
						<li role="presentation"><a href="search.html">查找</a></li>
					</ul>


					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-5  col-lg-5 list-friend media-list-base" >
							<ul >
								<li class="media">
									<a class="media-left media-middle" href="#">
										<img src="./others/dp/baidulyh.png" class="img-base" alt="dp">
									</a>
									<div class="media-body">
										<h4 class="media-heading">李彦宏</h4>
										简介:<p>做最好的中文搜索引擎</p>

										<button type="button" class="btn btn-success button-base" >关注</button><br/>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-5  col-lg-5 list-friend media-list-base" >
							<ul >
								<li class="media">
									<a class="media-left media-middle" href="#">
										<img src="./others/dp/mht.png" class="img-base" alt="dp">
									</a>
									<div class="media-body">
										<h4 class="media-heading">马化腾</h4>
										简介:<p>我们坚持做原创</p>

										<button type="button" class="btn btn-primary button-base" >≡互相关注</button><br/>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-5  col-lg-5 list-friend media-list-base" >
							<ul >
								<li class="media">
									<a class="media-left media-middle" href="#">
										<img src="./others/dp/jackma.png" class="img-base" alt="dp">
									</a>
									<div class="media-body">
										<h4 class="media-heading">马云</h4>
										简介:<p>实现个小目标</p>

										<button type="button" class="btn btn-primary button-base" >≡互相关注</button><br/>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-xs-12 col-sm-12  col-md-5  col-lg-5 list-friend media-list-base" >
							<ul >
								<li class="media">
									<a class="media-left media-middle" href="#">
										<img src="./others/dp/lj.png" class="img-base" alt="dp">
									</a>
									<div class="media-body">
										<h4 class="media-heading">雷军</h4>
										简介:<p>让你们买手机抢抢抢</p>

										<button type="button" class="btn btn-success button-base" >关注</button><br/>
									</div>
								</li>
							</ul>
						</div>



						<div class="col-xs-12 col-sm-12  col-md-5  col-lg-5 list-friend media-list-base" >
							<ul >
								<li class="media">
									<a class="media-left media-middle" href="#">
										<img src="./others/dp/lyh.png" class="img-base" alt="dp">
									</a>
									<div class="media-body">
										<h4 class="media-heading">罗永浩</h4>
										简介:<p>我们做东半球最好的手机</p>

										<button type="button" class="btn btn-primary button-base" >≡互相关注</button><br/>
									</div>
								</li>
							</ul>
						</div>



						<div class="col-xs-12 col-sm-12  col-md-5  col-lg-5 list-friend media-list-base" >
							<ul >
								<li class="media">
									<a class="media-left media-middle" href="#">
										<img src="./others/dp/jyt.png" class="img-base" alt="dp">
									</a>
									<div class="media-body">
										<h4 class="media-heading">贾跃亭</h4>
										简介:<p>你们不懂生态的力量</p>

										<button type="button" class="btn btn-primary button-base" >≡互相关注</button><br/>
									</div>
								</li>
							</ul>
						</div>
					</div>


						<nav id="paging">
							<ul class="pagination">
								<li><a href="#">&laquo;</a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">&raquo;</a></li>
							</ul>
						</nav>

				</div>
			</div>




		</div>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; JiayiWu. All rights reserved.</li><li> <a href="http://218.94.159.99/">南京大学软件学院2016[面向Web计算]课程项目</a></li>
					</ul>
				</footer>

		<!--</div>-->

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/echarts.common.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>


	</body>
</html>