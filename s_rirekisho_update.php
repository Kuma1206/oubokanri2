<?php
include('functions.php');

// 必要なパラメータがセットされていることを確認する
if (
    !isset($_POST['nyugaku']) || $_POST['nyugaku'] === '' ||
    !isset($_POST['n_gakkoumei']) || $_POST['n_gakkoumei'] === '' ||
    !isset($_POST['sotsugyou']) || $_POST['sotsugyou'] === '' ||
    !isset($_POST['s_gakkoumei']) || $_POST['s_gakkoumei'] === '' ||
    !isset($_POST['nyusya']) || $_POST['nyusya'] === '' ||
    !isset($_POST['kaisyamei']) || $_POST['kaisyamei'] === '' ||
    !isset($_POST['taisya']) || $_POST['taisya'] === '' ||
    !isset($_POST['riyuu']) || $_POST['riyuu'] === '' ||
    !isset($_POST['id']) || $_POST['id'] === ''
) {
    // フォームページにリダイレクト
    exit('paramError');
}

// var_dump($_POST);
// exit();

// POSTデータを取得する
$nyugaku = $_POST['nyugaku'];
$n_gakkoumei = $_POST['n_gakkoumei'];
$sotsugyou = $_POST['sotsugyou'];
$s_gakkoumei = $_POST['s_gakkoumei'];
$nyusya = $_POST['nyusya'];
$kaisyamei = $_POST['kaisyamei'];
$taisya = $_POST['taisya'];
$riyuu = $_POST['riyuu'];
$id = $_POST['id'];

// DBに接続する
$pdo = connect_to_db();

// SQLを準備する
$sql = 'UPDATE rirekisho_form SET 
            nyugaku = :nyugaku,
            n_gakkoumei = :n_gakkoumei,
            sotsugyou = :sotsugyou,
            s_gakkoumei = :s_gakkoumei,
            nyusya = :nyusya,
            kaisyamei = :kaisyamei,
            taisya = :taisya,
            riyuu = :riyuu,
            updated_at = now()
        WHERE id = :id';
$stmt = $pdo->prepare($sql);

// バインド変数を設定する
$stmt->bindValue(':nyugaku', $nyugaku, PDO::PARAM_STR);
$stmt->bindValue(':n_gakkoumei', $n_gakkoumei, PDO::PARAM_STR);
$stmt->bindValue(':sotsugyou', $sotsugyou, PDO::PARAM_STR);
$stmt->bindValue(':s_gakkoumei', $s_gakkoumei, PDO::PARAM_STR);
$stmt->bindValue(':nyusya', $nyusya, PDO::PARAM_STR);
$stmt->bindValue(':kaisyamei', $kaisyamei, PDO::PARAM_STR);
$stmt->bindValue(':taisya', $taisya, PDO::PARAM_STR);
$stmt->bindValue(':riyuu', $riyuu, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:rirekisho_read.php");
exit();

?>
