<?php

// コールバック関数の一例
$params = ['   空白あり','配列  ','空白あり  '];

echo '<pre>';
var_dump($params);
echo '</pre>';

$trimParams = array_map('trim',$params );

echo '<pre>';
var_dump($trimParams);
echo '</pre>';

?>