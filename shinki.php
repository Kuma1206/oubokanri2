<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="css/shinki.css" />
</head>
<body>

  <div class="login-form">
    <h2>新規登録</h2>
    <form action="shinki_create.php" method="POST">
      <!-- <fieldset> -->
        <div class="koumoku">
        <p>名前</p>
        <input type="text" id="namae" class="b-login" name="namae" placeholder="山田　タロウ">
        </div>

        <div class="koumoku">
        <p>フリガナ</p>
        <input type="text" id="furigana" class="b-login" name="furigana" placeholder="ヤマダ　タロウ">
        </div>

        <div class="koumoku">
        <p>メールアドレス</p>
        <input type="email" id="email" class="b-login" name="email" placeholder="メールアドレス" required>
        </div>

        <div class="koumoku">
        <p>パスワード</p>
        <input type="password" id="password" class="b-login" name="password" placeholder="パスワード" required>
        </div>

        <span class="password-toggle" id="togglePassword">👁️</span>

        <button type="submit">新規登録</button>
      <!-- </fieldset> -->
    </form>
    <p id="shinki"><a href="input.php">ログインっしょ！</a></p>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#togglePassword').click(function() {
    const passwordInput = $('#password');
    const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
    passwordInput.attr('type', type);
    $(this).text(type === 'password' ? '👁️' : '👁️');
    });
});
</script>
</body>
</html>