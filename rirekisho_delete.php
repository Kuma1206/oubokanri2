<?php
include("functions.php");
// var_dump($GET);
// exit();

// データ受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();

// SQL実行
// $sql = 'DELETE FROM todo_table WHERE id=:id';
$sql = 'DELETE FROM rirekisho_form WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:rirekisho_read.php');
exit();

?>
