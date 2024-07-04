<?php
session_start();
session_destroy(); // セッションを破棄

// ログアウト後にリダイレクト
header('Location: input.php'); // ログインページにリダイレクト
exit();
?>
