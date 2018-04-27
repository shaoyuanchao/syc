<?php
require_once 'inc/common.php';
require_once 'db/cnt_url_action.php';
/*
//跨域访问的时候才会存在此字段  
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
$origin_parse = parse_url($origin);
// 跨域调用源站点
$origin_host = isset($origin_parse['host']) ? $origin_parse['host'] : '';
// 跨域调用源站点符合条件
if (substr($origin_host, -10) == 'fnying.com' || substr($origin_host, -13) == 'hivebanks.com')
    header("Access-Control-Allow-Origin:".$origin);
*/
header("Access-Control-Allow-Origin:*");
header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");
/*
========================== 网页访问统计 ==========================
GET参数
  referrer       来源URL
  url            访问URL
  uuid           访问用户id
返回
  不返回任何参数,仅在数据库记录
说明
  获取到的访问url和来源url进行参数分割，然后统计到数据库表中，访问ip函数获取。
*/
// 参数检查
$args = array('url');
chk_empty_args('GET', $args);
// 提交参数整理
$referrer = get_arg_str('GET','referrer', 512);       // 来源URL
$url = get_arg_str('GET','url', 512);                 // 访问URL
$uuid = get_arg_str('GET' , 'uuid');                  // 访问ID
// 解析网址
$referrer_parse = parse_url($referrer);
$url_parse = parse_url($url);
// 来源URL
$from_url = isset($referrer_parse['host']) ? $referrer_parse['host'] : '';
$from_url .= isset($referrer_parse['path']) ? $referrer_parse['path'] : '';
// 来源URL参数
$from_prm = isset($referrer_parse['query']) ? $referrer_parse['query'] : '';
// 访问URL
$action_url = isset($url_parse['host']) ? $url_parse['host'] : '';
$action_url .= isset($url_parse['path']) ? $url_parse['path'] : '';
// 访问URL参数
$action_prm = isset($url_parse['query']) ? $url_parse['query'] : '';
// 访问IP
$action_ip = get_int_ip();
// 本地文件判断
if (substr($action_url, 1, 1) == ':' || substr($action_url, 0, 5) == 'local' || substr($action_url, 0, 3) == '127')
  exit();
// 字段设定
$data = array();
$data['from_url'] = $from_url;
$data['from_prm'] = $from_prm;
$data['action_url'] = $action_url;
$data['action_prm'] = $action_prm;
$data['action_ip'] = $action_ip;
$data['action_id'] = $uuid;
// 创建网址访问记录
$ret = ins_cnt_url_action($data);
// 返回
exit('ok');
?>