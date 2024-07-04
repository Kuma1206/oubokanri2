<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rirekisyo</title>
    <link rel="stylesheet" type="text/css" href="css/rirekisho.css" />
</head>
<body>
<form action="rirekisho_create.php" method="POST">
    <h2>履歴書</h2>
    <div id="area1">
        <p id="kategori">学歴</p>
        <div id="gakureki" class="area2">
            <div class="t-area">
                <p>入学年月</p><input type="date" name="nyugaku[]">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="n_gakkoumei[]" placeholder="○○県立○○学校　○○科　入学">
            </div>
            <div class="t-area">
                <p>卒業年月</p><input type="date" name="sotsugyou[]">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="s_gakkoumei[]" placeholder="○○県立○○学校　○○科　卒業">
            </div>
            <div id="p-area">
                <div id="sakujo1" class="trash"></div>
                <h5>＋</h5>
            </div>
        </div>
        <div id="area3"></div>
    </div>


    <div id="area1"> 
        <p id="kategori">職歴</p>
        <div id="shokumu-keireki" class="area3">
            <div class="t-area">
                <p>入社年月</p><input type="date" name="nyusya[]">
            </div>
            <div class="t-area">
                <p>会社名</p><input type="text" class="textarea" name="kaisyamei[]" placeholder="○○株式会社　入社">
            </div>
            <div class="t-area">
                <p>退社年月</p><input type="date" name="taisya[]">
            </div>
            <div class="t-area">
                <p>退職理由</p><input type="text" class="textarea" name="riyuu[]" placeholder="一身上の都合により退社">
            </div>
            <div id="p-area">
                <div id="sakujo2" class="trash"></div>
                <h6>＋</h6>
            </div>
        </div>
        <div id="area4"></div>
    </div>
    <div id="hozon">
        <button>保存</button>
    </div>
</form>


        <button id="modoru">Mainに戻る</button>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

$(document).on('click', 'h5', function() {
    let newGakureki = `
        <div id="gakureki" class="new-gakureki area2">
            <div class="t-area">
                <p>入学年月</p><input type="date" name="nyugaku[]">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="n_gakkoumei[]" placeholder="○○県立○○学校　○○科　入学">
            </div>
            <div class="t-area">
                <p>卒業年月</p><input type="date" name="sotsugyou[]">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="s_gakkoumei[]" placeholder="○○県立○○学校　○○科　卒業">
            </div>
            <div id="p-area">
                <div class="trash"></div>
                <h5>＋</h5>
            </div>
        </div>
    `;
    $(newGakureki).insertAfter($(this).closest('.area2'));
});



$(document).on('click', 'h6', function() {
    let newShokumu = `
        <div id="shokumu-keireki" class="new-shokumu-keireki area3">
            <div class="t-area">
                <p>入社年月</p><input type="date" name="nyusya[]">
            </div>
            <div class="t-area">
                <p>会社名</p><input type="text" class="textarea" name="kaisyamei[]" placeholder="○○株式会社　入社">
            </div>
            <div class="t-area">
                <p>退社年月</p><input type="date" name="taisya[]">
            </div>
            <div class="t-area">
                <p>退職理由</p><input type="text" class="textarea" name="riyuu[]" placeholder="一身上の都合により退社">
            </div>
            <div id="p-area">
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

$("#modoru").click(function() {
    window.location.href = "mypage.php";
});


</script>

</body>
</html>