<?php
function ins_www_upuserInfo($data)
{
  // 提交时间
  $data['ctime'] = date('Y-m-d H:i:s');

  $db = new DB_WWW();
  $sql = "SELECT * FROM $tablename WHERE name = '{$data['user_name']}'";
  $db->query($sql);
  $row = $db->fetchRow();
  if($row ==0)
    {
      return 1;
    }else{
      $sql = $db->sqlUpdate($tablename, $data,$data['user_name']);
      $q_id = $db->query($sql);
      if ($q_id == 0)
        return 2;
      return 3;

    }
 

}

?>