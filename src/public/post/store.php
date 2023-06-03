<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"] ?? '';
    $contents = $_POST["contents"] ?? '';

    if (empty($title) || empty($contents)) {
        $_SESSION["error_message"] = "タイトルか内容の入力がありません";
        header("Location: ../create.php");
        exit;
    } else {
        $dbUserName = 'root';
        $dbPassword = 'password';

        try {
            $pdo = new PDO("mysql:host=mysql;dbname=blog;charset=utf8", $dbUserName, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            // ユーザーIDを取得する（ログイン時に既に生成されているものとする）
            $stmt_user = $pdo->prepare("SELECT id FROM user WHERE id = :id");
            $stmt_user->bindParam(':id', $_SESSION["user_id"], PDO::PARAM_INT);
            $stmt_user->execute();
            $user = $stmt_user->fetch(PDO::FETCH_ASSOC);


            if ($user && $user["id"] === $_SESSION["user_id"]) {
                // "blogs"テーブルに記事を挿入し、"id"には自動生成された値を、"user_id"にはユーザーIDを保存する
                $stmt_blogs = $pdo->prepare("INSERT INTO blogs (user_id, title, contents) VALUES (:user_id, :title, :contents)");
                $stmt_blogs->bindParam(':user_id', $_SESSION["user_id"]);
                $stmt_blogs->bindParam(':title', $title);
                $stmt_blogs->bindParam(':contents', $contents);
                $stmt_blogs->execute();

                // データベースへの保存が成功した場合
                header("Location: ../user/mypage.php");
                exit;
            } else {
              header("Location: ../create.php");  // ユーザーIDが無効な場合は、記事作成ページにリダイレクトする
              exit;
            }
        } catch (PDOException $e) {
            die("データベースへの接続に失敗しました: " . $e->getMessage());
        }
    }
}
?>
