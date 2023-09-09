<?php
session_start();

// データベース接続情報
$dbUserName = 'root';
$dbPassword = 'password';

try {
    // データベースへの接続を確立
    $pdo = new PDO("mysql:host=mysql;dbname=blog;charset=utf8", $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ログインしているユーザーのIDを取得
    $userId = $_SESSION["user"]["id"];

    // ユーザー名を取得するクエリを準備
    $stmt = $pdo->prepare("SELECT name FROM user WHERE id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // ユーザー名を取得
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $row['name'];

    

    // ユーザーの記事を取得するクエリを準備
    $stmt = $pdo->prepare("SELECT id, title, created_at, contents FROM blogs WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // 記事のデータを取得
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("データベースへの接続に失敗しました: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet" type="text/css">
  <title>Document</title>
  <base href="http://localhost:8080/">
</head>
<body>
  <header>
    <h2>こんにちは！<?php echo $name; ?>さん!</h2>
    <nav class="nav-top">
      <ul>
        <li><a href="user/index.php">ホーム</a></li>
        <li><a href="user/mypage.php">マイページ</a></li>
        <li><a href="../logout.php">ログアウト</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <h1 class="mypage">マイページ</h1>
    <a href="../create.php"><button type="button">新規作成</button></a>

    <h3>記事一覧</h3>
    <table>
      <thead>
        <tr>
          <th>タイトル</th>
          <th>作成日</th>
          <th>内容</th>
      
        </tr>
      </thead>
      <tbody>
        <?php foreach ($blogs as $blog): ?>
          <tr>
            <td><?php echo $blog['title']; ?></td>
            <td><?php echo $blog['created_at']; ?></td>
            <td><?php echo substr($blog['contents'], 0, 15); ?></td>
            <td><a href="myarticledetail.php?id=<?php echo $blog['id']; ?>"><button type="button">記事詳細へ</button></a></td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
  
</body>
</html>
