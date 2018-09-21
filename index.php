<?php
require_once 'class/connect.php';
$connect = new connect();
$sql = "SELECT
            employee.id
            ,name
            ,CASE gender WHEN 1 THEN '男' WHEN 2 THEN '女' END AS gender
            ,DATE_FORMAT(birthday, '%Y年%m月%d日') AS birthday
            ,mynumber
        FROM employee
        LEFT JOIN mynumber ON employee.id = mynumber.id
        ORDER BY birthday";
$items = $connect->select($sql);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>従業員一覧</title>
  </head>
  <body>
    <?php include(dirname(__FILE__).'/common/nav.html') ?>
    <div class="container">
      <h1 style="margin:20px 0">従業員一覧</h1>
      <table class="table table-striped">
        <tr>
          <th scope="col">社員コード</th><th scope="col">名前</th><th scope="col">性別</th><th scope="col">生年月日</th><th scope="col">マイナンバー</th>
        </tr>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><?php echo $item["id"] ?></td><td><?php echo $item["name"] ?></td><td><?php echo $item["gender"] ?></td><td><?php echo $item["birthday"] ?></td><td><?php echo $item["mynumber"] ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php include(dirname(__FILE__).'/common/script.html') ?>
  </body>
</html>
