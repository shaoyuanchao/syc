<?php

require_once 'inc/common.php';
require_once 'db/www_rpt_overview.php';

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();
$ret = rpt_overview_refresh();
// print_R($ret);

exit_ok('ok');
?>
