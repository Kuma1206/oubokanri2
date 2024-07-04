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
    $output .= "<p id=\"kategori\">学歴</p>";
    $output .= "<div class=\"gakureki area2\">";
    $output .= "<div class=\"t-area\">
                  <p>入学年月: {$record['nyugaku']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>入学学校名: {$record['n_gakkoumei']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>卒業年月: {$record['sotsugyou']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>卒業学校名: {$record['s_gakkoumei']}</p>
                </div>";
    $output .= "</div>";
    $output .= "<div class=\"area3\"></div>";
    $output .= "</div>";

    $output .= "<div class=\"area1\">"; 
    $output .= "<p id=\"kategori2\">職歴</p>";
    $output .= "<div class=\"shokumu-keireki area3\">";
    $output .= "<div class=\"t-area\">
                  <p>入社年月: {$record['nyusya']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>会社名: {$record['kaisyamei']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>退社年月: {$record['taisya']}</p>
                </div>";
    $output .= "<div class=\"t-area\">
                  <p>退職理由: {$record['riyuu']}</p>
                </div>";
    $output .= "</div>";
    $output .= "<div class=\"area4\"></div>";
    $output .= "</div>";

    $output .= "<div class=\"t-area1\">
                  <a href='rirekisho_edit.php?id={$record['id']}' class=\"syuuseiLink\"><button class=\"syuusei\">修正</button></a>
                </div>";
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
    <?php if ($output === ""): ?>
      <p id="rireki">履歴書が登録されていません</p>
      <button id="shinki">新規登録する</button>
    <?php else: ?>
      <?= $output ?>
    <?php endif; ?>

<button id="modoru">Mainに戻る</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).on('click', 'h5', function() {
    let newGakureki = `
        <div class="gakureki new-gakureki area2">
            <div class="t-area">
                <p>入学年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　入学">
            </div>
            <div class="t-area">
                <p>卒業年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業">
            </div>
            <div class="p-area">
                <div class="trash"></div>
                <h5>＋</h5>
            </div>
        </div>
    `;
    $(newGakureki).insertAfter($(this).closest('.area2'));
});

$(document).on('click', 'h6', function() {
    let newShokumu = `
        <div class="shokumu-keireki new-shokumu-keireki area3">
            <div class="t-area">
                <p>入社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>会社名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○株式会社　入社">
            </div>
            <div class="t-area">
                <p>退社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>退職理由</p><input type="text" class="textarea" name="kaisyamei" placeholder="一身上の都合により退社">
            </div>
            <div class="p-area">
                <div class="trash"></div>
                <h6>＋</h6>
            </div>
        </div>
    `;
    $(newShokumu).insertAfter($(this).closest('.area3'));
});

$(document).on('click', '.trash', function() {
    $(this).closest('.area2').remove();
});

$(document).on('click', '.trash', function() {
    $(this).closest('.area3').remove();
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
