<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>privacy</title>
    <link rel="stylesheet" type="text/css" href="css/privacy.css" />
</head>
<body>
    <h2>個人情報の修正</h2>
    <form action="privacy_create.php" method="POST">
        <div id="area1">
            <div class="t-area">
                <p>名前</p><input type="text" name="namae" placeholder="山田　太郎">
            </div>
            <div class="t-area">
                <p>フリガナ</p><input type="text" name="furigana" placeholder="ヤマダ　タロウ">
            </div>
            <div class="t-area">
                <p>性別</p>
                <select id="sei" name="gender">
                    <option value="男">男性</option>
                    <option value="女">女性</option>
                    <option value="その他">その他</option>
                </select>
            </div>
            <div class="t-area">
                <p>生年月日</p><input type="date" id="umare" name="umare">
            </div>
            <div class="t-area">
                <p>年齢</p><input type="number" id="nenrei" name="nenrei" min="0">
            </div>
            <div class="t-area">
                <p>郵便番号</p><input type="text" name="zipcode" placeholder="123-4567"><p id="kensaku">🔎</p>
            </div>
            <div class="t-area">
                <p>現住所</p><input type="text" id="zyusho" name="zyusho" placeholder="福岡県福岡市中央区0-0-0 パーク福岡 101号室">
            </div>
            <div class="t-area">
                <p>電話番号</p><input type="tel" id="phone" name="phone" placeholder="000-1234-5678">
            </div>
            <div class="t-area">
                <p>E-mail</p><input type="email" id="email" name="email" placeholder="〇〇〇〇〇〇@gmail.com">
            </div>
            <div class="t-area">
                <p>資格</p><input type="text" id="shikaku" name="shikaku" placeholder="○○免許取得">
            </div>
            <div class="t-area">
                <p>扶養家族（配偶者を除く）</p><input type="text" id="fuyou" name="fuyou" placeholder="〇人">
            </div>
            <div class="t-area">
                <p>配偶者</p>
                <select id="kazoku" name="kazoku">
                    <option value="有">有</option>
                    <option value="無">無</option>
                </select>
            </div>
            <div class="t-area">
                <p>配偶者の扶養義務</p>
                <select id="haifu" name="haifu">
                    <option value="有">有</option>
                    <option value="無">無</option>
                </select>
            </div>
            <div class="t-area">
                <p>本人希望記入欄</p><input type="text" id="kibou" name="kibou" placeholder="ヤマダ　タロウ">
            </div>
            <button>保存</button>
        </div>
    </form>   
    <button id="modoru">Mainに戻る</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $("#modoru").click(function() {
        window.location.href = "mypage.php";
    });
</script>
</body> 
</html>
