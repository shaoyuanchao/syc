<?php
require_once 'inc/common.php';
require_once 'db/rpt_overview.php';


header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();
$args = array('url_key');
chk_empty_args('GET', $args);
$count_num = array();
$data = array();
$pout = array();
// 提交参数整理
$url_key = get_arg_str('GET', 'url_key');
//取得当天零点的时间戳
$today = strtotime(date('Y-m-d', time()));

$begin_time = $today - 7*24*60*60;
while($today){
  $rows = get_rpt_overview_detail($url_key, $today);
  if(count($rows)){
    foreach($rows as $row){
      $count_num['rpt_title'] =substr($row['rpt_title'],5,10);
      $count_num['action_count'] = $row['action_count'];
      $pout[] = $count_num;
    }
  }
  else{
    $count = serch_rpt_detail($url_key, $today);
    $unio = count($count);
    $data['action_url'] = $url_key;
    $data['rpt_title'] =date("Y-m-d",$today);
    $data['from_time_stamp'] = $today;
    $data['to_time_stamp']  = $today + 24*60*60;
    $data['action_count'] = $unio;
    $creat = creat_rpt_detail($data);
    array_splice($data, 0, count($data));;
    continue;
  }
  $today =$today - 24*60*60;
  if($today == $begin_time){
    $today = 0;
  }
  $pout["action_url"] = $row['action_url'];
}

//返回数据做成
$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['rows'] = $pout;
$rtn_str = json_encode($rtn_ary);
php_end($rtn_str);


?>
