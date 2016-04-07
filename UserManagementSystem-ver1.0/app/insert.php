<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>   <!-- 課題１ 関数を使うために追加 -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録画面</title>
</head>
<body>
    <?php session_start();

    // 課題５ noを受け取っていないならsessionを破棄
    // つまり確認ページから戻るボタンでページ遷移してきた場合のみセッションを維持
    if (!isset($_POST["no"])) {
        delete_session();
    }
    ?>

    <!-- 課題４ セッションが空でなければ各フォームに初期値を入力 -->
    <form action="<?=INSERT_CONFIRM?>" method="POST">
    名前:
    <input type="text" name="name" value=<?=isset($_SESSION['name']) ? $_SESSION['name'] : ""?>>
    <br><br>

    生年月日:
    <select name="year">
        <option value="">----</option>  <!-- 課題２ valueを空に -->
        <?php
        for($i=1950; $i<=2010; $i++){ ?>
            <option value="<?=$i?>" <?=isset($_SESSION['year']) && $_SESSION['year']==$i ? "selected" : ""?>><?=$i?></option>
            <?php
        } ?>
    </select>年
    <select name="month">
        <option value="">--</option>    <!-- 課題２ valueを空に -->
        <?php
        for($i = 1; $i<=12; $i++){ ?>
            <option value="<?=$i?>" <?=isset($_SESSION['month']) && $_SESSION['month']==$i ? "selected" : ""?>><?=$i?></option>
            <?php
        } ?>
    </select>月
    <select name="day">
        <option value="">--</option>    <!-- 課題２ valueを空に -->
        <?php
        for($i = 1; $i<=31; $i++){ ?>
            <option value="<?=$i?>" <?=isset($_SESSION['day']) && $_SESSION['day']==$i ? "selected" : ""?>><?=$i?></option>
            <?php
        } ?>
    </select>日
    <br><br>

    種別:
    <br>
    <input type="radio" name="type" value="エンジニア" <?=isset($_SESSION['type']) && $_SESSION['type']=="エンジニア" ? "checked" : ""?>>エンジニア<br>
    <input type="radio" name="type" value="営業"<?=isset($_SESSION['type']) && $_SESSION['type']=="営業" ? "checked" : ""?>>営業<br>
    <input type="radio" name="type" value="その他"<?=isset($_SESSION['type']) && $_SESSION['type']=="その他" ? "checked" : ""?>>その他<br>
    <br>

    電話番号:
    <input type="text" name="tell" value=<?=isset($_SESSION['tell']) ? $_SESSION['tell'] : ""?>>
    <br><br>

    自己紹介文
    <br>
    <textarea name="comment" rows=10 cols=50 style="resize:none" wrap="hard"><?=isset($_SESSION['comment']) ? $_SESSION['comment'] : ""?></textarea><br><br>

    <input type="submit" name="btnSubmit" value="確認画面へ">
    </form>
    <?=return_top();?>  <!-- 課題１ トップへ戻るリンク -->
</body>
</html>
