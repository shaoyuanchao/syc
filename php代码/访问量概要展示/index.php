<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
  <title>风赢科技数据统计平台</title>
  <link rel="stylesheet" href="css/weui.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

  <div class="page__hd">
    <h1 class="page__title">统计报表</h1>
    <p class="page__desc"><?php echo date('Y-m-d H:i:s')?></p>
  </div>

  <div class="weui-cells__title">最近24小时统计数据</div>
  <div id="count_rows" class="weui-cells">
  </div>

  <div class="weui-msg__extra-area">©2018 上海风赢网络科技有限公司</div>

  <script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
  <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
  <script src="js/common.js"></script>
  <script src="js/wx.js"></script>
  <script src="js/index.js"></script>

</body>
</html>