<?php
session_start();
$err = $_SESSION;

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
<h2>ログインフォーム</h2>
<form action="top.php" method="post">
    <p>
        <label for="email">メールアドレス：</label>
        <input type="email" name="email">
        <?php if (isset($err['email'])) :?>
            <p><?php echo $err['email']?></p>
        <?php endif;?>
    </p>
    <p>
        <label for="password">パスワード：</label>
        <input type="password" name="password">
        <?php if (isset($err['password'])) :?>
            <p><?php echo $err['password']?></p>
        <?php endif;?>
    </p>
    <p>
        <input type="submit" value="ログイン">
    </p>
</form>
    <a href="signup.php">新規登録はこちら</a>
</body>
</html>