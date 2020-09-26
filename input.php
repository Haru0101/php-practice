<?php
// CSRF 偽物のinput.php
// 合言葉を用意して偽物を判別する
// セッションを使う
session_start();
echo '<pre>';
var_dump($_POST);
echo '</pre>';
// スーパーグローバル変数 php 9種類
// 連想配列
// クリックジャッキング対策
header('X-Frame-Options: DENY');




$pageFlag = 0;
$error = validation($_POST);


if(!empty($_POST['btn_confirm']) && empty($error)){
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
    <!-- CSRF対策の合言葉 -->
    <?php
    // セッションにcsrfのトークンがなければ、ランダムな値をトークンに登録する
    // ソースを表示で丸見えなので、パスワードなどは使えない
    if(!isset($_SESSION['csrfToken'])){
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION['csrfToken'] = $csrfToken;
    }
    $token = $_SESSION['csrfToken'];
    ?>
    <?php if(!empty($_POST['btn_confirm'] && !empty($error))): ?>
    <ul>
        <?php foreach ($error as $value): ?>
        <li><?php echo $value; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <!-- 見ての通り、ユーザーが任意で入力できるインプット欄のみ、h関数でエスケープしている -->
    <form method="POST" action="input.php">
        <label for="">名前<input type="text" name="your-name"></label><br>
        <label for="">メアド<input type="email" name="email" id=""></label><br>
        ホームページ
        <input type="url" name="url" value="<?php echo h($_POST['url']); ?>">
        <br>
        性別
        <label for=""><input type="radio" name="gender" value="0">男性</label>
        <br>
        <label for=""><input type="radio" name="gender" value="1">女性</label>
        <br>
        年齢
        <select name="age" id="">
            <option value="">選択してください</option>
            <option value="1">20代</option>
            <option value="2">30代</option>
            <option value="3">40代</option>
            <option value="4">50代</option>
            <option value="5">60代</option>
        </select>
        <br>
        お問い合わせ内容
        <textarea name="contact" id="" cols="30" rows="10" value="<?php echo h($_POST['contact']); ?>"></textarea>
        <br>
        <input type="checkbox" name="caution" value="1">注意事項にチェックする

        <input type="submit" name="btn_confirm" value="確認する">
        <!-- CSRFをhiddenで受け渡す -->
        <input type="hidden" name="csrf" value="<?php echo $token ?>">
    </form>
    <?php endif; ?>

    <?php if($pageFlag === 1 && $_POST['csrf'] === $_SESSION['csrfToken']) : ?>

    <form method="POST" action="input.php">
        名前<br>
        <?php echo h($_POST['your-name']); ?>
        <br>
        メールアドレス<br>
        <?php echo h($_POST['email']); ?>
        <br>
        ホームページ
        <?php echo h($_POST['url']); ?>
        <br>
        性別
        <?php echo h($_POST['gender']); ?>
        <br>
        年齢
        <?php echo h($_POST['age']); ?>
        <br>
        お問い合わせ内容
        <?php echo h($_POST['contact']); ?>
        <br>


        <input type="submit" value="戻る" name="back">
        <input type="submit" name="btn_submit" value="送信する">
        <input type="hidden" name="your-name" value="<?php echo h($_POST['your-name']) ?>">
        <input type="hidden" name="email" value="<?php echo h($_POST['email']) ?>">
        <input type="hidden" name="url" value="<?php echo h($_POST['url']) ?>">
        <input type="hidden" name="gender" value="<?php echo h($_POST['gender']) ?>">
        <input type="hidden" name="age" value="<?php echo h($_POST['age']) ?>">
        <input type="hidden" name="contact" value="<?php echo h($_POST['contact']) ?>">
        <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']) ?>">
    </form>
    <?php endif; ?>
    完了
    <!-- 完了画面でもCSRFが合っているか確認する -->
    <?php if($pageFlag === 2 && $_POST['csrf'] === $_SESSION['csrfToken']) : ?>

    送信が完了しました。

    <!-- CSRFトークンは最後に削除する -->
    <?php unset($_SESSION['csrfToken']); ?>
    <?php endif; ?>

</body>

</html>