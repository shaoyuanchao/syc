<?php
//======================================
// 函数: 取得符合关键字的近期网址访问记录的数量
// 参数: $url_key       URL关键字
// 返回: 符合条件的记录数量
//======================================
function get_recent_url_action_by_key($url_key)
{
  // 最近24小时
  $recent_time = time() - 24 * 60 * 60;
  $db = new DB_WWW();

  $sql = "SELECT count(log_id) as logid_count FROM cnt_url_action WHERE action_url like '%{$url_key}%' AND action_time > $recent_time";
  $logid_count = $db->getField($sql, 'logid_count');
  // if (is_null($logid_count)) $logid_count = 0;
  return $logid_count;
}

//======================================
// 函数: 创建网址访问记录
// 参数: $data          信息数组
// 返回: id             新的记录ID
// 返回: 0              创建失败
//======================================
function ins_cnt_url_action($data)
{
  // 提交时间
  $data['action_time'] = time();

  $db = new DB_WWW();

  $sql = $db->sqlInsert("cnt_url_action", $data);
  $q_id = $db->query($sql);

  if ($q_id == 0)
    return 0;
  return $db->insertID();
}
?>
