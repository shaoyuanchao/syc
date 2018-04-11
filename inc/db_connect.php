<?php
// 数据库连接类

// WWW数据库
class DB_WWW extends Mysql {

  public $schema = 'sycsql';
  protected $server = 'localhost';
  protected $user = 'syc';
  protected $password = 'root';
  protected $database = 'sycsql';
  protected $character = 'utf8';
  
  // $host='localhost';  //主机名
  // $user='syc';        //用户名
  // $password='root';   //密码
  // $database='sycsql';  //数据库名
  // $tablename='sycsyf';  //表名
 
  
}


?>