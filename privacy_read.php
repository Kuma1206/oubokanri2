<?php

include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'SELECT * FROM privacy';
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

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
  $output .= "<tr>";
  $output .= "<div class=\"t-area\">
                <p>名前: {$record['namae']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>フリガナ: {$record['furigana']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>性別: {$record['gender']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>生年月日: {$record['umare']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>年齢: {$record['nenrei']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>郵便番号: {$record['zipcode']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>現住所: {$record['zyusho']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>電話番号: {$record['phone']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>E-mail: {$record['email']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>資格: {$record['shikaku']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>扶養家族（配偶者を除く）: {$record['fuyou']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>配偶者: {$record['kazoku']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>配偶者の扶養義務: {$record['haifu']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>本人希望記入欄: {$record['kibou']}</p>
              </div>";
  // $output .= "<div class=\"t-area\">
  //               <p><a href='delete.php?id={$record['id']}'>delete</a></p>
  //             </div>";
  $output .= "</tr>";
  $output .= "<div class=\"t-area1\">
                <a href='privacy_edit.php?id={$record['id']}' id=\"syuuseiLink\"><button id=\"syuusei\" onclick=\"redirectToEdit()\">修正</button></a>
            </div>";
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
  <link rel="stylesheet" type="text/css" href="css/privacy_read.css" />
</head>
<body>
  <h2>個人情報の修正</h2>
  <div id="t-box">
    <?php if ($output === ""): ?>
      <p id="kojin">個人情報が登録されていません</p>
      <button id="shinki">新規登録する</button>
    <?php else: ?>
      <?= $output ?>
    <?php endif; ?>
  </div>
  <!-- <button id="syuusei">修正</button> -->
  <button id="modoru">Mainに戻る</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    

  $("#modoru").click(function() {
    window.location.href = "mypage.php";
  });

  $("#shinki").click(function() {
    window.location.href = "privacy.php";
  });

  // $(".syuusei").click(function() {
  //   window.location.href = "privacy_edit.php";
  // });

</script>
</body>
</html>
