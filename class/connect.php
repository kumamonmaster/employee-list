<?php
class connect {
  const DB_NAME='sample';
  const HOST='localhost';
  const UTF='utf8';
  const USER='root';
  const PASS='';

  function pdo() {
    $dbh = "mysql:dbname=".self::DB_NAME."; host=".self::HOST."; charset=".self::UTF;
    $user = self::USER;
    $pass = self::PASS;
    try {
      $pdo = new PDO($dbh, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.SELF::UTF));
    }catch(Exception $e) {
      echo 'error' .$e->getMesseage;
      die();
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    return $pdo;
  }
  //SELECT文のときに使用する関数
  function select($sql) {
    $pdo = $this->pdo();
    $stmt = $pdo->query($sql);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
  }
  //SELECT,INSERT,UPDATE,DELETE文の時に使用する関数
  function plural($sql, $item) {
    $pdo = $this->pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id'=>$item));//sql文のVALUES等の値が?の場合は$itemでもいい。
    return $stmt;
  }
}
