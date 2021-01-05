<?php
require_once '../dbconnect.php';

class UserLogic
{
    /**
     * ユーザーを登録する
     * @param array $userData
     * @return bool $result
     */

    public static function createUser($userData)
    {
        $result = false;

        $sql = 'INSERT INTO users (name,email,password) VALUES (?,?,?)';

        $arr = [];
        $arr[] = $userData['name'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);
        try {
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);
            return $result;
        } catch (\Exception $e) {
            return $result;
        }
    }

    /**
     * ログイン処理
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email,$password)
    {
        $result = false;

        //ユーザーをE-mailから検索して取得
        $user = self::getUserByEmail($email);

        if (!$user)
        {
            $_SESSION['msg'] = 'emailが一致しません';
            return $result;
        }

        //パスワードの照会
        if (password_verify($password,$user['password']))
        {
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }

        $_SESSION['msg'] = 'パスワードが一致しません';
        return $result;
    }

    /**
     * e-mailからユーザーを取得
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email)
    {
       //SQLの準備
        //SQLの実行
        //SQLの結果を返す
        $sql = 'SELECT * FROM users WHERE email=?';

        $arr = [];
        $arr[] = $email;
        try {
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            $user = $stmt->fetch();
            return $user;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * ログインチェック
     * @param void
     * @return bool $result
     */
    public static function checkLogin()
    {
       $result = false;

       //セッションにログインユーザーが入っていなかったらfalse
       if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0)
       {
           return true;
       }
       return $result;
    }

    /**
     * ログアウト処理
     */
    public static function logOut()
    {
        $_SESSION = array();
        session_destroy();
    }
}