<?php

require_once 'inc/common.php';
require_once 'db/rpt_overview.php';
require_once  'db/cnt_url_action.php';

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();

$rows = get_rpt_overview_all();

foreach($rows as $row){                                      //循环开始
     $url =  $row['url_key'];                               //取url值
     $rpt_title =  $row['rpt_title'];
     $rpt_count = get_recent_url_action_by_key($url);
     upd_rpt_overview($rpt_title , $rpt_count);                    
}
$dis =  get_rpt_overview_all();
print_r($dis);
exit_ok('ok');
?>
