<?php
include('functions.php');

// id受け取り
$idString = $_GET['id'];
$idArray = explode(',', $idString); // カンマで分割して配列化

// DB接続
$pdo = connect_to_db();

// 学歴データを全て取得
$output = "";
foreach ($idArray as $id) {
    // SQL実行
    $sql = 'SELECT * FROM rirekisho_form WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    try {
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }

    // 学歴データの表示
    $output .= "<div class=\"area1\" data-id=\"{$record['id']}\">";
    $output .= "<div class=\"gakureki area2\">";
    $output .= "<div class=\"t-area\">";
    $output .= "<p>入学年月</p> <input type=\"date\" name=\"nyugaku[]\" value=\"{$record['nyugaku']}\">";
    $output .= "</div>";
    $output .= "<div class=\"t-area\">";
    $output .= "<p>学校名</p> <input type=\"text\" class=\"textarea\" name=\"n_gakkoumei[]\" value=\"{$record['n_gakkoumei']}\" placeholder=\"○○県立○○学校　○○科　入学\">";
    $output .= "</div>";
    $output .= "<div class=\"t-area\">";
    $output .= "<p>卒業年月</p> <input type=\"date\" name=\"sotsugyou[]\" value=\"{$record['sotsugyou']}\">";
    $output .= "</div>";
    $output .= "<div class=\"t-area\">";
    $output .= "<p>学校名</p> <input type=\"text\" class=\"textarea\" name=\"s_gakkoumei[]\" value=\"{$record['s_gakkoumei']}\" placeholder=\"○○県立○○学校　○○科　卒業\">";
    $output .= "</div>";
    $output .= "<div class=\"p-area\">";
    $output .= "<a href='rirekisho_delete.php?id={$record["id"]}' class='trash'></a>";
    $output .= "<h5>＋</h5>";
    $output .= "</div>";
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
    <link rel="stylesheet" type="text/css" href="css/rirekisho_edit.css" />
</head>
<body>

<h2>学　歴</h2>
<form action="rirekisho_update.php" method="POST">
    <?= $output ?> <!-- 学歴データを表示 -->
    <div id="area3"></div>

    <div id="hozon">
        <button type="submit">保存</button> <!-- 保存ボタン -->
    </div>
    <?php foreach ($idArray as $id): ?>
        <input type="hidden" name="ids[]" value="<?= $id ?>"> <!-- idをhiddenで送信 -->
    <?php endforeach; ?>
</form>

<button id="modoru">Mainに戻る</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // IDの最大値を取得
    let maxId = Math.max(...$('.area1').map(function() {
        return parseInt($(this).data('id'));
    }).get(), 0); // 初期値を0に設定

    $(document).on('click', 'h5', function() {
        maxId++; // 新しいIDを生成

        let newGakureki = `
        <div class="area1" data-id="new">
            <div class="gakureki area2">
                <div class="t-area">
                    <p>入学年月</p><input type="date" name="nyugaku_new[]" value="">
                </div>
                <div class="t-area">
                    <p>学校名</p><input type="text" class="textarea" name="n_gakkoumei_new[]" value="" placeholder="○○県立○○学校　○○科　入学">
                </div>
                <div class="t-area">
                    <p>卒業年月</p><input type="date" name="sotsugyou_new[]" value="">
                </div>
                <div class="t-area">
                    <p>学校名</p><input type="text" class="textarea" name="s_gakkoumei_new[]" value="" placeholder="○○県立○○学校　○○科　卒業">
                </div>
                <div class="p-area">
                    <a href='rirekisho_delete.php?id={$record["id"]}' class='trash'></a>
                    <h5>＋</h5>
                </div>
            </div>
            <div class="area3"></div>
        </div>
        `;
        $(newGakureki).insertAfter($(this).closest('.area2'));
    });

    $(document).on('click', '.trash', function(e) {
        e.preventDefault();
        let idToDelete = $(this).closest('.area1').data('id'); // 削除する学歴データのIDを取得

        if (confirm('削除しますか？')) {
            // 「はい」を選択した場合の処理
            if (idToDelete !== 'new') {
                // IDがnewでない場合は削除リンクがクリックされたと判断
                // 削除処理を実行するためのリダイレクト
                window.location.href = `rirekisho_delete.php?id=${idToDelete}`;
            } else {
                // 新しい項目の削除処理
                $(this).closest('.area1').remove();
            }
        } else {
            // 「いいえ」を選択した場合の処理
            return false;
        }
    });

    $("#modoru").click(function() {
        window.location.href = "mypage.php";
    });
</script>

</body>
</html>
