<?php
session_start();

// データベース接続情報
$dbUserName = 'root';
$dbPassword = 'password';

try {
    // データベースへの接続を確立
    $pdo = new PDO("mysql:host=mysql;dbname=blog;charset=utf8", $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームから送信されたデータを取得
    $articleId = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? '';
    $contents = $_POST['contents'] ?? '';

    // 入力値の検証
    if (empty($title) || empty($contents)) {
        $_SESSION['error'] = 'タイトルか内容の入力がありません';
        header("Location: ../edit.php?id=$articleId");
        exit;
    }

    // 記事を更新するクエリを準備
    $stmt = $pdo->prepare("UPDATE blogs SET title = :title, contents = :contents WHERE id = :id");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':contents', $contents, PDO::PARAM_STR);
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    $stmt->execute();

    // エラーメッセージをセッションから削除
    unset($_SESSION['error']);

    // myarticledetail.phpにリダイレクト
    header("Location: ../myarticledetail.php?id=". $articleId); 
              // ../myarticledetail.php ../user/index.php
    exit;
} catch (PDOException $e) {
    die("データベースへの接続に失敗しました: " . $e->getMessage());
}
?>
