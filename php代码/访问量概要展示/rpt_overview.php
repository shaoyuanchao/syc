<?php
require_once 'inc/common.php';
require_once 'db/rpt_overview.php';
/*
========================== 网页访问概要统计 ==========================
参数
  无
返回
  获取网页访问概要统计数据
说明
*/
php_begin();
// 取得概要统计报告所有记录
$rows = get_rpt_overview_all();
// 返回数据做成
$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['total'] = count($rows);
$rtn_ary['rows'] = $rows;
// 正常返回
$rtn_str = json_encode($rtn_ary);
// 输出内容
php_end($rtn_str);
?>