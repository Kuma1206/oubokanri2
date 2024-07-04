<?php

// DB接続
$dbn ='mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
function connectDB($dbn, $user, $pwd) {
    try {
        $pdo = new PDO($dbn, $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}


// DBに接続する
$pdo = connectDB('mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost', 'root', '');
// SQLを準備する
$sql = 'SELECT created_at FROM rirekisho';
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
  $output .= "<tr>";
  $output .= "<td>{$record["rirekisho"]}</td>";
  $output .= "</tr>";
}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rirelisho</title>
    <link rel="stylesheet" type="text/css" href="css/rirekisho_data_read.css" />
</head>
<body>

<div id="area1"> 
    <p>履歴書File</p>
    <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
    </tbody>
    <div id="text-area">
        <button id="modoru" class="button">Mainに戻る</button>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.6/xlsx.full.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    $('#excelFile').change(function(e) {
        var files = e.target.files;
        var f = files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, {type: 'array'});

            var firstSheet = workbook.SheetNames[0];
            var worksheet = workbook.Sheets[firstSheet];

            var html = XLSX.utils.sheet_to_html(worksheet, { editable: true });

            $('#excelData').html(html).find('table').css({
                'border-collapse': 'collapse',
                'width': '100%'
            }).find('th, td').css({
                'border': '1px solid #000',
                'padding': '8px',
                'text-align': 'left'
            });
        };
        reader.readAsArrayBuffer(f);
    });

    $("#modoru").click(function() {
        window.location.href = "mypage.php";
    });

</script>

</body>
</html>