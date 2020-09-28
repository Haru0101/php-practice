<?php

// DB接続
function insertContact ($data) {

require 'db_connection.php';
// 入力 DB保存 prepare bind execute(配列(すべて文字列))
$params = [
    'id' => null,
    'your_name' => $data['your_name'],
    'email' => $data['email'],
    'url' => $data['url'],
    'gender' => $data['gender'],
    'age' => $data['age'],
    'contact' => $data['contact'],
    'created_at' => null
];
// $params = [
//     'id' => null,
//     'your_name' => '名前22',
//     'email' => 'test@test.com',
//     'url' => 'http://test.com',
//     'gender' => '1',
//     'age' => '2',
//     'contact' => 'aaaaa',
//     'created_at' => null
// ];

$count = 0;
$columns = '';
$values = '';

foreach(array_keys($params) as $key){
    if($count ++>0){
        $columns .= ',';
        $values .= ',';
    }
    $columns .= $key;
    $values .= ':'.$key;
}

$sql = 'insert into contacts (' . $columns . ')values('. $values .')'; // 名前付きプレースホルダ ここがユーザー入力によって変わる箇所
var_dump ($sql);
$stmt = $pdo->prepare($sql); // プリペアードステートメント
$stmt->execute($params); // 実行

}


?>
