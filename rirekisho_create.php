<?php
include('functions.php');

// 必要なパラメータがセットされていることを確認する
if (
    !isset($_POST['nyugaku']) || !is_array($_POST['nyugaku']) || empty($_POST['nyugaku']) ||
    !isset($_POST['n_gakkoumei']) || !is_array($_POST['n_gakkoumei']) || empty($_POST['n_gakkoumei']) ||
    !isset($_POST['sotsugyou']) || !is_array($_POST['sotsugyou']) || empty($_POST['sotsugyou']) ||
    !isset($_POST['s_gakkoumei']) || !is_array($_POST['s_gakkoumei']) || empty($_POST['s_gakkoumei'])
) {
    // フォームページにリダイレクト
    exit('paramError');
}

// DBに接続する
$pdo = connect_to_db();

$nyugaku = $_POST['nyugaku'];
$n_gakkoumei = $_POST['n_gakkoumei'];
$sotsugyou = $_POST['sotsugyou'];
$s_gakkoumei = $_POST['s_gakkoumei'];

// SQLを準備する
$sql = 'INSERT INTO rirekisho_form (id, nyugaku, n_gakkoumei, sotsugyou, s_gakkoumei, created_at, updated_at) 
        VALUES (NULL, :nyugaku, :n_gakkoumei, :sotsugyou, :s_gakkoumei, now(), now())';

$stmt = $pdo->prepare($sql);

try {
    // 各データをループして挿入する
    foreach ($nyugaku as $index => $value) {
        $stmt->bindValue(':nyugaku', $nyugaku[$index], PDO::PARAM_STR);
        $stmt->bindValue(':n_gakkoumei', $n_gakkoumei[$index], PDO::PARAM_STR);
        $stmt->bindValue(':sotsugyou', $sotsugyou[$index], PDO::PARAM_STR);
        $stmt->bindValue(':s_gakkoumei', $s_gakkoumei[$index], PDO::PARAM_STR);
        
        $stmt->execute();
    }
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:rirekisho_read.php");
exit();

?>
