<?php
const DB_HOST = 'mysql:dbname=udemy_php;host=localhost';
const DB_USER = 'php_user';
const DB_PASSWORD = 'P@ssWord123';
// PDOクラスのインスタンス化
// インスタンス化したあとに、PDOの中のプロパティやメソッドにアクセスできる

// 例外処理 exception
// 接続確認に使う
try{
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD);
    echo '接続成功';
}
catch(PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
}

?>