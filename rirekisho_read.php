<?php
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'SELECT * FROM rirekisho_form';
$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
    $output .= "<div class=\"area1\">";
    $output .= "<div class=\"gakureki area2\" data-id=\"{$record['id']}\">";
    $output .= "<div class=\"t-area\">
                  <p>入学年月: {$record['nyugaku']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>学校名: {$record['n_gakkoumei']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>卒業年月: {$record['sotsugyou']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>学校名: {$record['s_gakkoumei']}</p>
                </div>";
    $output .= "</div>";
    $output .= "<div class=\"area3\"></div>";
    $output .= "</div>";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rirekisyo</title>
    <link rel="stylesheet" type="text/css" href="css/rirekisho_read.css" />
</head>
<body>
    <h2>学　歴</h2>
    <?php if ($output === ""): ?>
      <p id="rireki">履歴書が登録されていません</p>
      <button id="shinki">新規登録する</button>
    <?php else: ?>
      <?= $output ?>
      <div id="syusei">
          <button id="editAll">編集</button>
      </div>    
    <?php endif; ?>

    <button id="modoru">Mainに戻る</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).on('click', '#editAll', function() {
    // 全てのareaのIDを取得して、edit.phpに渡す
    var ids = [];
    $('.gakureki').each(function() {
        var id = $(this).attr('data-id');
        ids.push(id);
    });
    var editUrl = 'rirekisho_edit.php?id=' + ids.join(',');
    window.location.href = editUrl;
});

$("#shinki").click(function() {
    window.location.href = "rirekisho.php";
});

$("#modoru").click(function() {
    window.location.href = "mypage.php";
});
</script>

</body>
</html>
