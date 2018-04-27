<?php
//======================================
// 函数: 取得概要统计报告所有记录
// 参数: 无
// 返回: 记录数组
//======================================
function get_rpt_overview_all()
{
  $db = new DB_WWW();
  $sql = "SELECT * FROM rpt_overview ORDER BY rpt_sort";

  $db->query($sql);
  $rows = $db->fetchAll();
  return $rows;
}

//======================================
// 函数: 更新概要统计报告中指定报告标题的记录
// 参数: $rpt_title     报告标题
// 参数: $rpt_count     报告数据
// 返回: true           更新成功
// 返回: false          更新失败
//======================================
function upd_rpt_overview($rpt_title, $rpt_count)
{
  $db = new DB_WWW();
  $data['rpt_count'] = $rpt_count;
  $data['rpt_time'] = date('Y-m-d H:i:s');
  
  $where = "rpt_title = '{$rpt_title}'";
  $sql = $db->sqlUpdate("rpt_overview", $data, $where);
  $q_id = $db->query($sql);
  
  if ($q_id == 0)
    return false;
  return true;
}
?>
