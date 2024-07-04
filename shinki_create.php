<?php

if (
    !isset($_POST['namae']) || $_POST['namae'] === '' ||
    !isset($_POST['furigana']) || $_POST['furigana'] === '' ||
    !isset($_POST['email']) || $_POST['email'] === '' ||
    !isset($_POST['password']) || $_POST['password'] === ''
) {
  exit('データが足りません');
}
  

// POSTデータ確認
$namae = $_POST['namae'];
$furigana = $_POST['furigana'];
$email = $_POST['email']; 
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // パスワードをハッシュ化

// DB接続
$dbn ='mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost';
$user = 'root';
$pwd = '';

// ユーザーIDの初期化
$user_id = null;

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．
// todo_create.php

// SQL作成&実行
$sql = 'INSERT INTO shinki_touroku (id, namae, furigana, email, password, created_at, updated_at) VALUES (NULL, :namae, :furigana, :email, :password,  now(), now())';
$stmt = $pdo->prepare($sql);
// バインド変数を設定
$stmt->bindValue(':namae', $namae, PDO::PARAM_STR);
$stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);   
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:touroku_ok.php");
exit();


?>
