<?php
function sel_www_user_check($data)
{
  // 提交时间
  $data['ctime'] = date('Y-m-d H:i:s');

  $db = new DB_WWW();

  $sql = $db->sqlSelect($tablename, $data['name']);//查询数据
  $q_id = $db->query($sql);
  while($row=mysql_fetch_array($q_id)){
    $dbusername=$row["username"]; 
    $dbpassword=$row["password"]; 
  }
  if (is_null($dbusername)) {
     return 1;
      } 
      else { 
        if ($dbpassword!=$password){
         return 2;
        } 
        else { 
          $_SESSION["username"]=$username; 
          $_SESSION["code"]=mt_rand(0, 100000);
          return 3;
        } 
      }
      }


?>