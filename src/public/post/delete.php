<?php
session_start();

// データベース接続情報
$dbUserName = 'root';
$dbPassword = 'password';

try {
    // データベースへの接続を確立
    $pdo = new PDO("mysql:host=mysql;dbname=blog;charset=utf8", $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベースへの接続に失敗しました: " . $e->getMessage());
}

// 削除ボタンが押されたときの処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // 記事IDを取得
    $articleId = $_POST['id'] ?? null;

    if (!$articleId) {
        die("記事IDが指定されていません");
    }

    // 記事を削除するクエリを準備
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = :id");
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    $stmt->execute();

    // 削除が成功した場合の処理
    if ($stmt->rowCount() > 0) {
        // 削除成功時のリダイレクト
        header("Location: ../user/mypage.php");
        exit;
    } else {
        // 削除失敗時の処理
        // 例: エラーメッセージを表示するなど
        echo "記事の削除に失敗しました";
    }
}
