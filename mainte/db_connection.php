<?php
const DB_HOST = 'mysql:dbname=udemy_php;host=127.0.0.1';
const DB_USER = 'php_user';
const DB_PASSWORD = 'P@ssWord123';
// PDOクラスのインスタンス化
// インスタンス化したあとに、PDOの中のプロパティやメソッドにアクセスできる
$pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD);
?>