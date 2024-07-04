<?php
include('functions.php');

// 必要なパラメータがセットされていることを確認する
if (
    !isset($_POST['namae']) || $_POST['namae'] === '' ||
    !isset($_POST['furigana']) || $_POST['furigana'] === '' ||
    !isset($_POST['gender']) || $_POST['gender'] === '' ||
    !isset($_POST['umare']) || $_POST['umare'] === '' ||
    !isset($_POST['nenrei']) || $_POST['nenrei'] === '' ||
    !isset($_POST['zipcode']) || $_POST['zipcode'] === '' ||
    !isset($_POST['zyusho']) || $_POST['zyusho'] === '' ||
    !isset($_POST['phone']) || $_POST['phone'] === '' ||
    !isset($_POST['email']) || $_POST['email'] === '' ||
    !isset($_POST['shikaku']) || $_POST['shikaku'] === '' ||
    !isset($_POST['fuyou']) || $_POST['fuyou'] === '' ||
    !isset($_POST['kazoku']) || $_POST['kazoku'] === '' ||
    !isset($_POST['haifu']) || $_POST['haifu'] === '' ||
    !isset($_POST['kibou']) || $_POST['kibou'] === ''
) {
    // フォームページにリダイレクト
    exit('paramError');
}

// var_dump($_POST);
// exit();

// POSTデータを取得する
$namae = $_POST['namae'];
$furigana = $_POST['furigana'];
$gender = $_POST['gender'];
$umare = $_POST['umare'];
$nenrei = $_POST['nenrei'];
$zipcode = $_POST['zipcode'];
$zyusho = $_POST['zyusho'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$shikaku = $_POST['shikaku'];
$fuyou = $_POST['fuyou'];
$kazoku = $_POST['kazoku'];
$haifu = $_POST['haifu'];
$kibou = $_POST['kibou'];


// DBに接続する
$pdo = connect_to_db();

// SQLを準備する
$sql = 'INSERT INTO privacy (id, namae, furigana, gender, umare, nenrei, zipcode, zyusho, phone, email, shikaku, fuyou, kazoku, haifu, kibou, created_at, updated_at) VALUES (NULL, :namae, :furigana, :gender, :umare, :nenrei, :zipcode, :zyusho, :phone, :email, :shikaku, :fuyou, :kazoku, :haifu, :kibou, now(), now())';
$stmt = $pdo->prepare($sql);

// バインド変数を設定する
$stmt->bindValue(':namae', $namae, PDO::PARAM_STR);
$stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);  
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);  
$stmt->bindValue(':umare', $umare, PDO::PARAM_STR);  
$stmt->bindValue(':nenrei', $nenrei, PDO::PARAM_INT);  
$stmt->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);  
$stmt->bindValue(':zyusho', $zyusho, PDO::PARAM_STR);  
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);  
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':shikaku', $shikaku, PDO::PARAM_STR);  
$stmt->bindValue(':fuyou', $fuyou, PDO::PARAM_STR);  
$stmt->bindValue(':kazoku', $kazoku, PDO::PARAM_STR);  
$stmt->bindValue(':haifu', $haifu, PDO::PARAM_STR);  
$stmt->bindValue(':kibou', $kibou, PDO::PARAM_STR);  

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:privacy_read.php");
exit();

?>
