<?php

require_once 'inc/common.php';
require_once 'db/www_userInfo.php';

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();

// 参数检查
$args = array('user_name', 'user_email', 'user_tel');
chk_empty_args('GET', $args);

// 提交参数整理
$user_name = get_arg_str('GET', 'user_name');
$user_email = get_arg_str('GET', 'user_email');
$user_tel = get_arg_str('GET', 'user_tel');

// 默认返回信息
$msg = '提交成功';
// 字段设定
$data = array();
$data['user_name'] = $user_name;
$data['user_email'] = $user_email;
$data['user_tel'] = $user_tel;

$ret = ins_www_userinfo($data);
if ($rec == 1) {
    $msg = $email . '用户已存在';}
if ($rec == 2) {
    $msg = $email . '数据错误请重试';}
if ($rec == 3) {
    $msg = $email . '注册成功';}
// 正常返回
exit_ok($msg);
?>
