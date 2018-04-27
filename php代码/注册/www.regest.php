<?php
function ins_www_userInfo($data)
{
  // 提交时间
  $data['ctime'] = date('Y-m-d H:i:s');

  $db = new DB_WWW();
  $sql = "SELECT * FROM $tablename WHERE name = '{$data['user_name']}'";
  $db->query($sql);
  $row = $db->fetchRow();
  if($row !=0)
    {
      return 1;
    }else{
      $sql = $db->sqlInsert("$tablename", $data);
      $q_id = $db->query($sql);
    
      if ($q_id == 0)
        return 2;
      return 3;

    }
 

}


  //  $sele = "SELECT name FROM $tablename WHERE name=$data['name']";
  //  $res = mysql_query($sele);
  //      if(mysql_num_rows($res)){
  //        echo "用户已存在";
  //    }else
  //      {
  //   $sql = $db->sqlInsert($tablename, $data);
  // $q_id = $db->query($sql);

  // if ($q_id == 0)
  //   return 0;
  // return $db->insertID();
  //     }
// }

?>