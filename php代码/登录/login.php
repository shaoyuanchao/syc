<?php

require_once 'inc/common.php';
require_once 'db/wwwlogin.php';

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();
$args = array('user_name', 'user_pass');
chk_empty_args('GET', $args);

// 提交参数整理
$user_name = get_arg_str('GET', 'user_name');
$user_pass = get_arg_str('GET', 'user_pass');


// 字段设定
$data = array();
$data['user_name'] = $user_name;
$data['user_pass'] = $user_pass;

$ret = sel_www_user_check($data);

//用户信息查询返回值
if ($rec == 1) {
    $msg = $email . '用户名不正确';}
if ($rec == 2) {
    $msg = $email . '用户密码不正确';}
if ($rec == 3) {
    $msg = $email . '登录成功';}

  exit_ok($msg);
  

// 正常返回
?>