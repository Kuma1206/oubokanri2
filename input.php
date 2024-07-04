<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['email']) || $_POST['email'] === '' ||
        !isset($_POST['password']) || $_POST['password'] === ''
    ) {
        $message = 'メールアドレスとパスワードを入力してください';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // DB接続
        $dbn ='mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost';
        $user = 'root';
        $pwd = '';

        try {
            $pdo = new PDO($dbn, $user, $pwd);
        } catch (PDOException $e) {
            echo json_encode(["db error" => "{$e->getMessage()}"]);
            exit();
        }

        // ユーザー情報を取得
        $sql = 'SELECT * FROM shinki_touroku WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // ログイン成功
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['namae'] = $user['namae'];
                header('Location: mypage.php');
                exit();
            } else {
                // ログイン失敗
                $message = 'メールアドレスまたはパスワードが間違っています';
            }
        } catch (PDOException $e) {
            echo json_encode(["sql error" => "{$e->getMessage()}"]);
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>
<body>
  <div class="login-form">
    <h2>ログイン</h2>
    <?php if (isset($message)): ?>
        <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form action="" method="POST">
      <input type="email" id="email" class="b-login" name="email" placeholder="メールアドレス" required>

      <div>
        <input type="password" id="password" class="b-login" name="password" placeholder="パスワード" required>
      </div>

    <span class="password-toggle" id="togglePassword">👁️</span>

      <button type="submit">ログイン</button>
    </form>
    <p id="shinki"><a href="shinki.php">新規登録しちぃなよ</a></p>
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
