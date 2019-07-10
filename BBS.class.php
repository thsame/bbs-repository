<?php
  class BBSClass{
    private $rows;

    public static function h($str) {
      return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    public static function fileOpen(){
      $name = (string)filter_input(INPUT_POST, 'name'); // $_POST['name']
      $text = (string)filter_input(INPUT_POST, 'text'); // $_POST['text']
      $token = (string)filter_input(INPUT_POST,'token');

      $fp = fopen('data.csv','a+b');
      if($_SERVER['REQUEST_METHOD'] === 'POST' ){
        flock($fp, LOCK_EX); // 排他ロックを行う
        fputcsv($fp,[$name,$text]);
        rewind($fp);
      }
      while($row = fgetcsv($fp)){
        $rows[] = $row;
      }
      flock($fp, LOCK_UN); // ロック解除
      fclose($fp);
      return $rows;
    }
  }
 ?>
