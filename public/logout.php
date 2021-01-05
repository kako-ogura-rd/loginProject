<?php
session_start();
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();

if (!$result)
{
    $_SESSION['login_err'] = 'ユーザーを登録してログインしてください';
    header('Location:signup.php');
    return;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>ログアウト</title>
</head>
<body>
<h2>ログアウト</h2>
<p>ログアウト完了しました</p>
</body>
</html>