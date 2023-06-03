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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../user/style.css" rel="stylesheet" type="text/css">
  <title>記事編集</title>
  <base href="http://localhost:8080/">
</head>
<body>
  <header>
    <h2>こんにちは！nameさん!</h2>
    <nav class="nav-top">
      <ul>
        <li><a href="user/index.php">ホーム</a></li>
        <li><a href="user/mypage.php">マイページ</a></li>
        <li><a href="#">ログアウト</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <h2>記事編集</h2>

<form method="post" action="../post/update.php">
  <input type="hidden" name="id" value="<?php echo $articleId; ?>">
  <div>
    <label for="title">タイトル:</label>
    <input type="text" id="title" name="title" value="<?php echo $article['title']; ?>">
  </div>
  <div>
    <label for="contents">内容:</label>
    <textarea id="contents" name="contents"><?php echo $article['contents']; ?></textarea>
  </div>
  <button type="submit">編集</button>
</form>

  </main>
  
</body>
</html>
