<?php
require_once 'inc/common.php';
require_once 'db/www_cnt_action.php';

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

/*
========================== 页面访问量 ==========================
GET参数
  referrer       来源URL
  url            访问URL
  uuid           访问用户id

返回
  不返回任何参数,仅在数据库记录

说明
  获取到的访问url和来源url进行参数分割，然后统计到数据库表中，访问ip函数获取。
*/

php_begin();

// // 参数检查
 $args = array('referrer', 'url' , 'uuid');
chk_empty_args('GET', $args);

// // 提交参数整理
 $pre_url_from = get_arg_str('GET','referrer');//解析网址参数
 $now_url_action = get_arg_str('GET','url');   //解析网址参数
 $uuid  =  get_arg_str('GET' , 'uuid');


$url_from['scheme'] = parse_url($pre_url_from , PHP_URL_SCHEME);//解析前置网址参数
$url_from['host'] = parse_url($pre_url_from , PHP_URL_HOST);
$url_from['path'] = parse_url($pre_url_from , PHP_URL_PATH);
$url_from['query'] = parse_url($pre_url_from , PHP_URL_QUERY);
$url_from['fragment'] = parse_url($pre_url_from , PHP_URL_FRAGMENT);


$url_action['scheme'] = parse_url($now_url_action , PHP_URL_SCHEME);   //解析当前网址参数
$url_action['host'] = parse_url($now_url_action , PHP_URL_HOST); 
$url_action['path'] = parse_url($now_url_action , PHP_URL_PATH); 
$url_action['query'] = parse_url($now_url_action , PHP_URL_QUERY); 
$url_action['fragment'] = parse_url($now_url_action , PHP_URL_FRAGMENT); 


$from_url =$url_from['scheme']. "://" . $url_from['host'] . $url_from['path']; //获取来源url地址
$from_prm =$url_from['query'] . $url_from['fragment'];                  //获取来源参数

$action_url = $url_action['scheme'] . "://" . $url_action['host'] . $url_action['path'];//获取当前url地址
$action_prm = $url_action['query'] . $url_action['fragment']; //获取当前网址参数


$action_ip = ip2long(get_ip());        //获取访问ip地址并将IPV4的字符串互联网协议转换成长整型数字

$action_id =get_guid();              //获取当前访问者id
$action_id = $uuid;

// 默认返回信息
$msg = '提交成功';

// 字段设定
$data = array();
$data['from_url'] = $from_url;
$data['from_prm'] = $from_prm;
$data['action_url'] = $action_url;
$data['action_prm'] = $action_prm;
$data['action_ip'] = $action_ip;
$data['action_id'] = $action_id;

$ret = ins_www_action($data);

// 正常返回
exit_ok($msg);
?>
