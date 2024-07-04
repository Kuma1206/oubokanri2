<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/oubo.css" />
</head>
<body>

<div class="tabs">
    <input id="all" type="radio" name="tab_item" checked>
    <label class="tab_item" for="all">全体進捗</label>
    <input id="syorui" type="radio" name="tab_item">
    <label class="tab_item" for="syorui">書類選考</label>  
    <input id="itiji" type="radio" name="tab_item">
    <label class="tab_item" for="itiji">一次面接</label>  
    <input id="niji" type="radio" name="tab_item">
    <label class="tab_item" for="niji">二次面接</label>  
    <input id="saiyou" type="radio" name="tab_item">
    <label class="tab_item" for="saiyou">採用確定</label>   
    <input id="fusaiyou" type="radio" name="tab_item">
    <label class="tab_item" for="fusaiyou">不採用</label>

    <div class="tab_content" id="all_content">
        総合の内容がここに入ります
    </div>
    <div class="tab_content" id="syorui_content">
        aa
    </div>
    <div class="tab_content" id="itiji_content">
        c
    </div>
    <div class="tab_content" id="niji_content">
        c
    </div>
    <div class="tab_content" id="saiyou_content">
        d
    </div>
    <div class="tab_content" id="fusaiyou_content">
        e
    </div>
</div>
<footer>
    <div id="area1"> 
        <button id="modoru">Mainに戻る</button>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

$("#modoru").click(function() {
    window.location.href = "mypage.php";
});


</script>
</body>
</html>