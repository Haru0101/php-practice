<?php
function validation($data){
    $error = [];

    if(empty($data['your-name'])){
        $error[] = '氏名が必須';

    }

    return $error;
}
?>