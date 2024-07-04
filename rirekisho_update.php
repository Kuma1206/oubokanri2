<?php
include('functions.php');

// 更新対象のデータの処理
if (
    isset($_POST['nyugaku']) && is_array($_POST['nyugaku']) &&
    isset($_POST['n_gakkoumei']) && is_array($_POST['n_gakkoumei']) &&
    isset($_POST['sotsugyou']) && is_array($_POST['sotsugyou']) &&
    isset($_POST['s_gakkoumei']) && is_array($_POST['s_gakkoumei']) &&
    isset($_POST['ids']) && is_array($_POST['ids'])
) {
    // データベース接続
    $pdo = connect_to_db();

    // 各配列のデータをループで処理
    foreach ($_POST['ids'] as $key => $id) {
        $nyugaku = $_POST['nyugaku'][$key];
        $n_gakkoumei = $_POST['n_gakkoumei'][$key];
        $sotsugyou = $_POST['sotsugyou'][$key];
        $s_gakkoumei = $_POST['s_gakkoumei'][$key];

        // UPDATE文を実行（例）
        $sql = "UPDATE rirekisho_form SET nyugaku=:nyugaku, n_gakkoumei=:n_gakkoumei, sotsugyou=:sotsugyou, s_gakkoumei=:s_gakkoumei WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nyugaku', $nyugaku, PDO::PARAM_STR);
        $stmt->bindValue(':n_gakkoumei', $n_gakkoumei, PDO::PARAM_STR);
        $stmt->bindValue(':sotsugyou', $sotsugyou, PDO::PARAM_STR);
        $stmt->bindValue(':s_gakkoumei', $s_gakkoumei, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }
}

// 新規追加のデータの処理
if (
    isset($_POST['nyugaku_new']) && is_array($_POST['nyugaku_new']) &&
    isset($_POST['n_gakkoumei_new']) && is_array($_POST['n_gakkoumei_new']) &&
    isset($_POST['sotsugyou_new']) && is_array($_POST['sotsugyou_new']) &&
    isset($_POST['s_gakkoumei_new']) && is_array($_POST['s_gakkoumei_new'])
) {
    // データベース接続
    $pdo = connect_to_db();

    // 各配列のデータをループで処理
    foreach ($_POST['nyugaku_new'] as $key => $nyugaku_new) {
        $n_gakkoumei_new = $_POST['n_gakkoumei_new'][$key];
        $sotsugyou_new = $_POST['sotsugyou_new'][$key];
        $s_gakkoumei_new = $_POST['s_gakkoumei_new'][$key];

        // INSERT文を実行（例）
        $sql = "INSERT INTO rirekisho_form (nyugaku, n_gakkoumei, sotsugyou, s_gakkoumei) VALUES (:nyugaku_new, :n_gakkoumei_new, :sotsugyou_new, :s_gakkoumei_new)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nyugaku_new', $nyugaku_new, PDO::PARAM_STR);
        $stmt->bindValue(':n_gakkoumei_new', $n_gakkoumei_new, PDO::PARAM_STR);
        $stmt->bindValue(':sotsugyou_new', $sotsugyou_new, PDO::PARAM_STR);
        $stmt->bindValue(':s_gakkoumei_new', $s_gakkoumei_new, PDO::PARAM_STR);

        $stmt->execute();
    }
}


// 完了後にリダイレクトなどの処理を行う
header("Location: message.php");
exit();
?>
