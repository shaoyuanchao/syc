<?php
require_once 'inc/common.php';
require_once 'db/staff_weixin.php';
require_once 'db/staff_permit.php';

need_staff_login();
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no" />
  <meta name="description" content="">
  <meta name="author" content="">

  <title>员工管理平台-风赢科技</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-table.min.css">
  <link rel="stylesheet" href="css/bootstrap-editable.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/index.css">
</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menubar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://www.fnying.com/staff/">员工管理平台</a>
      </div>
      <div id="h-navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><?php echo $_SESSION['staff_name']?></a></li>
          <li><a href="logout.php">退出</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!--左侧导航-->
      <div class="col-sm-3 col-md-2 sidebar panel-group" id="menubar">
        <?php if (has_pm('root')) {?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#menubar" href="#admin_menu">
              <i class="glyphicon glyphicon-king"></i> 超级管理员
            </a></h4>
          </div>
          <div id="admin_menu" class="panel-collapse collapse">
            <div class="panel-body">
              <ul class="nav nav-sidebar">
                <li><a href="javascript:;" onclick="menu_click('feature','obj')">目标管理</a></li>
                <li><a href="javascript:;" onclick="menu_click('feature','kpi')">衡量指标</a></li>
                <li><a href="javascript:;" onclick="menu_click('feature','task')">任务管理</a></li>
                <li><a href="javascript:;" onclick="menu_click('feature','staff_weixin')">微信登录</a></li>
                <li><a href="javascript:;" onclick="menu_click('feature','staff_permit')">管理权限</a></li>
              </ul>
            </div>
          </div>
        </div>
        <?php }?>

        <?php if (has_pm('www')) {?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#menubar" href="#info_menu">
              <i class="glyphicon glyphicon-star"></i> 官网管理
            </a></h4>
          </div>
          <div id="info_menu" class="panel-collapse collapse">
            <div class="panel-body">
              <ul class="nav nav-sidebar">
                <li><a href="javascript:;" onclick="menu_click('feature','www_email')">邮箱列表</a></li>
                <li><a href="javascript:;" onclick="menu_click('feature','www_contact')">官网联系</a></li>
              </ul>
            </div>
          </div>
        </div>
        <?php }?>

        <?php if (has_pm('hr')) {?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#menubar" href="#news_menu">
              <i class="glyphicon glyphicon-bullhorn"></i> 人事管理
            </a></h4>
          </div>
          <div id="news_menu" class="panel-collapse collapse">
            <div class="panel-body">
              <ul class="nav nav-sidebar">
                <li><a href="javascript:;" onclick="menu_click('feature','staff_main')">员工情报</a></li>
                <li><a href="javascript:;" onclick="menu_click('feature','staff_office_sign')">员工考勤</a></li>
              </ul>
            </div>
          </div>
        </div>
        <?php }?>

      </div>

      <!--右侧内容-->
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <!--状态-->
        <div id="main_status">
        </div>

      </div>

    </div>

  </div>

  <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
  <script src="http://libs.baidu.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="http://cdn.bootcss.com/Chart.js/2.1.6/Chart.bundle.min.js"></script>
  <script src="js/layer/layer.js"></script>
  <script src="js/pc_menu.js"></script>

</body>
</html>
