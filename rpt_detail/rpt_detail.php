<?php
require_once 'inc/common.php';
require_once 'db/cnt_url_action.php';


header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();
$args = array('url_key');
chk_empty_args('GET', $args);
$i = 0;
$j = 0;
$k = 0;
$l = 0;
$f = 0;
$m = 0;
$n = 0;
$count_num = array();
// 提交参数整理
$url_key = get_arg_str('GET', 'url_key');
//取得当天零点的时间戳
$today = strtotime(date('Y-m-d', time()));
//取得当天结束的时间戳
// $end = $today + 24 * 60 * 60;
// echo $end;
// 取得概要统计报告一周内的所有记录
$rows = get_rpt_detail($url_key);
foreach($rows as $row){
  $action_time = $row['action_time'];
  if($action_time >$today){
    $i++;
    $count_num['today'] = $i;
  }else if($action_time > ($today - 7*24*60*60) && $action_time < ($today - 6*24*60*60)){
    $j++;
    $count_num['first'] = $j;
  }else if($action_time > ($today - 6*24*60*60) && $action_time < ($today - 5*24*60*60)){
    $k++;
    $count_num['sec'] = $k;
  }else if($action_time > ($today - 5*24*60*60) && $action_time < ($today - 4*24*60*60)){
    $l++;
    $count_num['third'] = $l;
  }else if($action_time > ($today - 4*24*60*60) && $action_time < ($today - 3*24*60*60)){
    $f++;
    $count_num['thru'] = $f;
  }else if($action_time > ($today - 3*24*60*60) && $action_time < ($today - 2*24*60*60)){
    $m++;
    $count_num['fri'] = $m;
  }else if($action_time > ($today - 2*24*60*60) && $action_time < ($today - 1*24*60*60)){
    $n++;
    $count_num['sta'] = $n;
  }

}
//返回数据做成
$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['rows'] = $count_num;
$rtn_str = json_encode($rtn_ary);
php_end($rtn_str);


?>
