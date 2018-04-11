<?php
//======================================
// 函数: get_test_arg($arg)
// 功能: 取得自动测试数据
// 参数: $arg           字段名
// 返回: 测试数据
// 说明: config.php AUTO_TEST_FLAG = true 时有效
//======================================
function get_test_arg($arg)
{
  
  $args = array(
    'referrer'=>'http://localhost/phpmyadmin/sql.php?server=1&db=sycsql&table=cnt_url_action&pos=0&token=0bbc2d80d9c98e704f55c2e41dec1b06',
    'url'=>'https://github.com/YHArthur/www/blob/master/report/sql/cnt_url_action.sql',
    'uuid'=>'08B8B2A5-8931-2D79-BF8C-8027DC0AE6B7'
  );
    
  if (array_key_exists($arg, $args))
    return $args[$arg];
  
  return 'test_' . $arg;
  
}
?>