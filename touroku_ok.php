<!DOCTYPE html>
<ht lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kanryou</title>
    <link rel="stylesheet" type="text/css" href="css/touroku_ok.css" />
</head>
<body>

  <div class="login-form">
    <h2>新規登録が完了しました。</h2>
      <button type="submit" id="modoru">ログイン画面に戻る</button>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

$("#modoru").click(function() {
    window.location.href = "input.php";
});


</script>
    
</body>
</html>