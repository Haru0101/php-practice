<?php
function validation($data){
    $error = [];

    if(empty($data['your_name'])){
        $error[] = '氏名が必須';

    }

    return $error;
}
?>