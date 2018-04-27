<?php
require_once 'inc/common.php';
require_once 'db/staff_weixin.php';
require_once 'db/staff_permit.php';

need_staff_login();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
  <title>风赢科技员工管理平台</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="wx/css/weui.css">
  <link rel="stylesheet" href="wx/css/index.css">
</head>
<body>

  <div class="page__hd">
      <h1 class="page__title"><?php echo $_SESSION['staff_name']?></h1>
      <p class="page__desc">风赢科技</p>
  </div>
  <div class="weui-grids">
      <a href="../report/index.php" class="weui-grid">
          <div class="weui-grid__icon">
              <i class="glyphicon glyphicon-stats"></i>
          </div>
          <p class="weui-grid__label">统计报表</p>
      </a>
      <a href="wx/office_sign_log.php" class="weui-grid">
          <div class="weui-grid__icon">
              <i class="glyphicon glyphicon-time"></i>
          </div>
          <p class="weui-grid__label">签到记录</p>
      </a>
      <a href="javascript:;" class="weui-grid">
          <div class="weui-grid__icon">
              <i class="glyphicon glyphicon-user"></i>
          </div>
          <p class="weui-grid__label">个人情报</p>
      </a>
      <a href="javascript:;" class="weui-grid">
          <div class="weui-grid__icon">
              <i class="glyphicon glyphicon-plus"></i>
          </div>
          <p class="weui-grid__label">更多...</p>
      </a>
  </div>


  <div class="weui-msg__extra-area">©2018 上海风赢网络科技有限公司</div>
  <script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
  <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
  <script src="wx/js/common.js"></script>
  <script src="wx/js/wx.js"></script>
  <script src="js/h5_menu.js"></script>
  
</body>
</html>

