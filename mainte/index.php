<?php

require 'db_connection.php';

// ユーザー入力がない query
// 気をつけることが少ない

// SQL文を変数に入れて
// $sql = 'select * from contacts where id = 2';

// // インスタンス化済みのPDOに問い合わせる
// $stmt = $pdo->query($sql);

// // fetchallでSQLの結果が表示される
// $result = $stmt->fetchall();
// echo '<pre>';
// var_dump($result);
// echo '</pre>';

// ユーザー入力がある prepare bind execute
// 気をつけることが多いので、使う関数も多い
// 特にdeleteなどのSQLを入力されないようにSQLインジェクション対策をする必要がある

$sql = 'select * from contacts where id = :id'; // 名前付きプレースホルダ ここがユーザー入力によって変わる箇所
$stmt = $pdo->prepare($sql); // プリペアードステートメント
$stmt->bindValue('id', 1, PDO::PARAM_INT); // 紐付け IDの1は本来はユーザーが入力したものを使用するので、変数が入る
$stmt->execute(); // 実行

$result = $stmt->fetchall();
echo '<pre>';
var_dump($result);
echo '</pre>';

// トランザクション
// まとまった処理を行う時に使用する
// ex)銀行 残高確認 -> Aさんから引き落とし -> Bさんに振り込み
// 途中でシステム不具合が起きれば、引き落とされたけど、振り込まれてない、残高が減っているという現象が起きる
// なのでまとめて処理をする できなければ一定の地点に戻る

// beginTransaction, commit, rollback

try{

    $stmt = $pdo->prepare($sql); // プリペアードステートメント
    $stmt->bindValue('id', 1, PDO::PARAM_INT); // 紐付け IDの1は本来はユーザーが入力したものを使用するので、変数が入る
    $stmt->execute(); // 実行


    // SQL処理

    $pdo->commit();
}
catch(PDOException $e)
{
    $pdo->rollback();
}

?>