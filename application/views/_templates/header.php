<?php
	$user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

	<title>DASHGUM - FREE Bootstrap Admin Template</title>

	<!-- Bootstrap core CSS -->
	<link href="/public/assets/css/bootstrap.css" rel="stylesheet">

	<!--external css-->
	<link href="/public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="/public/assets/css/zabuto_calendar.css">
	<link rel="stylesheet" type="text/css" href="/public/assets/js/gritter/css/jquery.gritter.css" />
	<link rel="stylesheet" type="text/css" href="/public/assets/lineicons/style.css">

	<!-- Custom styles for this template -->
	<link href="/public/assets/css/style.css" rel="stylesheet">
<!--	<link href="../../../public/assets/css/style-responsive.css" rel="stylesheet">-->

	<link href="/public/assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />


	<!-- timeline-->
	<link href="/public/assets/css/timeline.css" rel="stylesheet">

	<!-- timeline_write-->
	<link href="/public/assets/css/timeline_write.css" rel="stylesheet">

	<script src="/public/assets/js/jquery.js"></script>
	<script type="text/javascript" src="../../../public/assets/js/jquery-1.8.3.min.js"></script>
	<!--<script type="text/javascript" src="../../public/assets/js/script.js"></script>-->


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

	<![endif]-->
	<script src="/public/assets/js/homeground.js"></script>
	<script src="/public/assets/js/detail.js"></script>
	<script src="/public/assets/js/infinite_scroll.js"></script>
	<script src="/public/assets/js/bookmark.js"></script>
	<script src="/public/assets/js/home_shot.js"></script>
	<!--<script src="/public/assets/js/timeline_reply_write.js"></script>-->



</head>

<body>

<!-- 모달 팝업 -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
				</button>

				<h4 class="modal-title" id="userModalLabel" align="center">

				</h4>
			</div>

			<div class="modal-body" align="center">

			</div>
			<script>
				$(document).ready(function(){

						if($('.modal-title').text() == <?=$_SESSION['loginID']?>) {
							$('#bookmarkU').hide();
						}
						else {
							$('#bookmarkU').show();
						}
				});
			</script>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>


				<button type="button" id="bookmarkU" class="btn btn-primary" >
					<span id="check" class="star" aria-hidden="true"></span>즐겨찾기
				</button>


				<button id="goShot" type="button" class="btn btn-primary" data-dismiss="modal">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>  home
				</button>

			</div>
		</div>
	</div>
</div>


<section id="container" >
	<!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
	<!--header start-->
	<header class="header black-bg">
		<div class="sidebar-toggle-box">
			<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
		</div>

		<!-- User_Name start-->
		<a href="http://127.0.0.1/mypage" class="logo">

			<img src="../../../public/img/member_s/<?=$myInfoList[0]->user_psimage?>">
			<b><?php echo "$user_id"; ?></b>
		</a>
		<!-- User Name end-->

		<div class="nav notify-row" id="top_menu">
			<!--  notification start -->
			<ul class="nav top-menu">
				<!-- settings start -->
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
						<!-- fa fa-envelope-o 빈 쪽지 모양-->
						<i class="glyphicon glyphicon-envelope">쪽지</i>
						<span class="badge bg-theme">4</span>
					</a>

					<ul class="dropdown-menu extended tasks-bar">
						<div class="notify-arrow notify-arrow-green"></div>
						<li>
							<p class="green">You have 4 pending tasks</p>
						</li>
						<li>
							<a href="index.html#">
								<div class="task-info">
									<div class="desc">DashGum Admin Panel</div>
									<div class="percent">40%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
										<span class="sr-only">40% Complete (success)</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<div class="task-info">
									<div class="desc">Database Update</div>
									<div class="percent">60%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
										<span class="sr-only">60% Complete (warning)</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<div class="task-info">
									<div class="desc">Product Development</div>
									<div class="percent">80%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
										<span class="sr-only">80% Complete</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<div class="task-info">
									<div class="desc">Payments Sent</div>
									<div class="percent">70%</div>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
										<span class="sr-only">70% Complete (Important)</span>
									</div>
								</div>
							</a>
						</li>
						<li class="external">
							<a href="#">See All Tasks</a>
						</li>
					</ul>
				</li>
				<!-- settings end -->

				<!-- inbox dropdown start-->
				<li id="header_inbox_bar" class="dropdown">
					<a id="nittei" href="../../calendar">
						<i class="fa fa-envelope-o">일정</i>
						<!--<span class="badge bg-theme">5</span>-->
					</a>
				</li>
				<!-- inbox dropdown end -->


				<!-- team start -->
				<li id="header_inbox_bar" class="dropdown">
					<a href="../../team">
						<i class="fa fa-envelope-o">팀</i>
						<!--<span class="badge bg-theme">5</span>-->
					</a>
				</li>
				<!-- team end -->
				<!-- information_update start -->
				<li id="header_inbox_bar" class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
						<i class="fa fa-envelope-o">정보수정</i>
						<span class="badge bg-theme">5</span>
					</a>

					<ul class="dropdown-menu extended inbox">
						<div class="notify-arrow notify-arrow-green"></div>
						<li>
							<p class="green">You have 5 new messages</p>
						</li>
						<li>
							<a href="index.html#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-divya.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">
								<span class="photo"><img alt="avatar" src="assets/img/ui-sherman.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
							</a>
						</li>
						<li>
							<a href="index.html#">See all messages</a>
						</li>
					</ul>
				</li>
				<!-- information_update end-->


			</ul>



			<!--  notification end -->
		</div>

		<div class="top-menu">
			<ul class="nav pull-right top-menu">
				<li>
					<a class="logout" href="../../member/logout">
						Logout
					</a>
				</li>
			</ul>
		</div>
	</header>
	<!--header end-->