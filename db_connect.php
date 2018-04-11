<?php
// 数据库连接类

// WWW数据库
class DB_WWW extends Mysql {

  public $schema = 'bdm25986977_db';
  protected $server = 'locallhost';
  protected $user = 'syc';
  protected $password = 'root';
  protected $database = 'sycsql';
  protected $character = 'utf8';

}
?>