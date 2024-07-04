<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>plofile</title>
    <link rel="stylesheet" type="text/css" href="css/plofile.css" />
</head>
<body>

    <div id="area1"> 
        <p>自己PR</p>
            <div class="" id="text-area">
                <div class="b-text">
                    <textarea type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業"></textarea>
                </div>
            </div>
        <button>保存</button>
        <button id="modoru">Mainに戻る</button>

    </div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>


$("#modoru").click(function() {
    window.location.href = "mypage.php";
});

</script>

</body>
</html>