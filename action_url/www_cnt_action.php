<?php
function ins_www_action($data)
{
  // 时间戳函数
  $data['action_time'] = time();

  $db = new DB_WWW();

  $sql = $db->sqlInsert("cnt_url_action", $data);
  $q_id = $db->query($sql);


  if ($q_id == 0)
  return 0;
return $db->insertID();

}
?>