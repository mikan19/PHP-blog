<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$userName = $_SESSION['user']['name'] ?? '';
$email = $_SESSION['user']['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="post/store.php" method="post">
            <h3>新規記事</h3>
            <table>
                <tr>
                    <td>
                      <p>タイトル</p>
                      <textarea name="title"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                      <p>内容</p>
                      <textarea name="contents"></textarea>
                      </td>
                </tr>
            </table>    
            <input type="submit" value="新規作成" />
  </form>
</body>
</html>




