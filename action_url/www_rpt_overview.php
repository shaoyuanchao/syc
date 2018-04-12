<?php

function  rpt_overview_refresh()
{
  $db = new DB_WWW();                                      //数据库连接
  $url_key = "SELECT url_key FROM rpt_overview WHERE 1";  //sql查询语句
  
  $url_sql = $db ->query($url_key);                      //执行查询
  $row = $db->fetchAll($url_sql);                        //返回所有数据

  $count = $db->affectedRows($url_sql);                  //返回影响的行数       
  $i=0;
  while($i<$count){                                      //循环开始
       $url =  $row[$i]['url_key'];                       //取url值
       $sql = "SELECT * FROM cnt_url_action WHERE action_url   IN(SELECT url_key FROM rpt_overview WHERE url_key = '{$url}')";  //sql查询语句
       $query = $db->query($sql);                          //执行sql语句
       $rpt_count = $db->affectedRows($query);                   //返回影响的行数
       $rpt_time  = date('Y-m-d H:i:s');                   //获取当前时间    
       $upd = "UPDATE rpt_overview SET rpt_count = '{$rpt_count}' , rpt_time = '{$rpt_time}' WHERE url_key = '{$url}'"; //sql更新语句
       $upd_query = $db->query($upd);                        //执行更新
       $i++;                                                 //参数自增1
    }

      $dis_tab = "SELECT * FROM  rpt_overview WHERE 1 ";         //查询语句
      $dis_count =$db->query($dis_tab);
      $dis_row = $db->fetchAll($dis_count);
    //   return $dis_row ;
  }
  
?>
