<?php
require_once '../inc/common.php';
require_once('../db/staff_weixin.php');

// 需要员工登录
need_staff_login();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
  <title>员工个人情报-风赢科技</title>
  <link rel="stylesheet" href="css/weui.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/personalHomepage.css">
  <link rel="stylesheet" href="css/swiper-4.2.2.min.css">
  
</head>
<body>
  <div class="info"></div>
 
  <div class="page__hd" style="display:none">
    <h1 class="page__title" id="name"><?php echo $_SESSION['staff_name'] ?></h1>
   
  </div>



  <div class="weui-msg__extra-area">©2018 上海风赢网络科技有限公司</div>

  <script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
  <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
  <script src="js/common.js"></script>
  <script src="js/main.js"></script>
  <script src="js/wx.js"></script>
  <script src="js/swiper-4.2.2.min.js"></script>

</body>
</html>

