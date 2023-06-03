<?php
session_start();

// データベース接続情報
$dbUserName = 'root';
$dbPassword = 'password';

try {
    // データベースへの接続を確立
    $pdo = new PDO("mysql:host=mysql;dbname=blog;charset=utf8", $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 記事IDを取得
    $articleId = $_GET['id'] ?? null;

    if (!$articleId) {
        die("記事IDが指定されていません");
    }

    // 記事の詳細を取得するクエリを準備
    $stmt = $pdo->prepare("SELECT title, created_at, contents FROM blogs WHERE id = :id");
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    $stmt->execute();

    // 記事のデータを取得
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        die("指定された記事が存在しません");
    }
} catch (PDOException $e) {
    die("データベースへの接続に失敗しました: " . $e->getMessage());
}

// 編集ボタンが押されたときの処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $editUrl = "edit.php?id=" . $articleId;
    header("Location: $editUrl");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../user/style.css" rel="stylesheet" type="text/css">
  <title>記事詳細</title>
  <base href="http://localhost:8080/">
</head>
<body>
  <header>
    <h2>こんにちは！nameさん!</h2>
    <nav class="nav-top">
      <ul>
        <li><a href="user/index.php">ホーム</a></li>
        <li><a href="../user/mypage.php">マイページ</a></li>
        <li><a href="../logout.php">ログアウト</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <h2>記事詳細</h2>
    <h3><?php echo $article['title']; ?></h3>
    <p>作成日: <?php echo $article['created_at']; ?></p>
    <p><?php echo $article['contents']; ?></p>
  <form method="post" action="">
      <button type="submit" name="edit">編集</button>
  </form>
  <form method="post" action="post/delete.php">
    <input type="hidden" name="id" value="<?php echo $articleId; ?>">
    <button type="submit" name="delete">削除</button>
  </form>
    <a href="user/mypage.php"><button type="button">マイページへ</button></a>
  </main>
  
</body>
</html>




