<?php
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
// スーパーグローバル変数 php 9種類
// 連想配列
// クリックジャッキング対策
header('X-Frame-Options: DENY');


// CSRF 偽物のinput.php
// 合言葉を用意して偽物を判別する
// セッションを使う

session_start(

);

$pageFlag = 0;

if(!empty($_POST['btn_confirm'])){
    $pageFlag = 1;
}

if(!empty($_POST['btn_submit'])){
    $pageFlag = 2;
}

function h ($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if($pageFlag === 0) : ?>

    <form method="POST" action="input.php">
        <label for="">名前<input type="text" name="your-name"></label><br>
        <label for="baseball"><input type="checkbox" name="sports[]" value="野球" id="baseball">野球</label><br>
        <label for="soccer"><input type="checkbox" name="sports[]" value="サッカー" id="soccer">サッカー</label><br>
        <label for="basketball"><input type="checkbox" name="sports[]" value="バスケ" id="basketball">バスケ</label><br>

        <label for="">メアド<input type="email" name="email" id=""></label><br>

        <input type="submit" name="btn_confirm" value="確認する">
    </form>
    <?php endif; ?>

    <?php if($pageFlag === 1) : ?>
    <form method="POST" action="input.php">
        名前<br>
        <?php echo h($_POST['your-name']); ?>
        <br>
        メールアドレス<br>
        <?php echo h($_POST['email']); ?>

        <input type="submit" value="戻る" name="back">
        <input type="submit" name="btn_submit" value="送信する">
        <input type="hidden" name="your-name" value="<?php echo h($_POST['your-name']) ?>">
        <input type="hidden" name="email" value="<?php echo h($_POST['email']) ?>">
    </form>
    <?php endif; ?>
    完了
    <?php if($pageFlag === 2) : ?>
    <?php endif; ?>

</body>

</html>