<?php

session_start();

// セッションの有効性を確認する
if (!isset($_SESSION['user_id'])) {
    exit('セッションが有効ではありません。ログインしてください。');
}

// 必要なパラメータがセットされていることを確認する
if (!isset($_FILES['rirekisho']) || $_FILES['rirekisho']['error'] !== UPLOAD_ERR_OK) {
    exit('ファイルがアップロードされていませんまたはエラーが発生しました');
}

// ユーザーIDをセッションから取得する
$user_id = $_SESSION['user_id'];

// ファイル情報を取得する
$rirekisho = $_FILES['rirekisho'];
$file_path = $rirekisho['tmp_name'];

// DB接続関数
function connectDB($dbn, $user, $pwd) {
    try {
        $pdo = new PDO($dbn, $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．
// DBに接続する
$pdo = connectDB('mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost', 'root', '');
// SQLを準備する
$sql = 'INSERT INTO rirekisho (id, user_id, file_path, created_at, updated_at) VALUES (NULL, :user_id, :file_path, now(), now())';
$stmt = $pdo->prepare($sql);
// バインド変数を設定する
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':file_path', $file_path, PDO::PARAM_STR);
 
try {
    // SQLを実行する
    $status = $stmt->execute();

    // 成功時の処理
    if ($status) {
        header('Location: rirekisho_data.php');
        exit();
    } else {
        exit('ファイルのアップロードに失敗しました');
    }
} catch (PDOException $e) {
    // エラー時の処理
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// SQL実行の処理
header('Location: rirekisho_data.php');
exit();


?>
