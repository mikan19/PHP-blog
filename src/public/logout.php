<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location:user/signup.php"); // リダイレクト先のURLを指定
exit; // リダイレクト後にスクリプトの実行を終了

?>


