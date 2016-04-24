<?php
require_once("../util/defineUtil.php");
require_once(SCRIPT);

write_log(DELETE.'に遷移');

session_start();
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>kagoyume_delete</title>
        <!-- <link rel="stylesheet" type="text/css" href="../css/prototype.css"/> -->
    </head>
    <body>
        <header>
            <?php require_once(HEADER_TOP);?>
            <?php require_once(HEADER_UNDER);?>
        </header>

        <section class='main'>

            <?php
            if( ! chk_transition("from_mydata") ){

                echo BAD_ACCESS;

            }else {

                $user = $_SESSION['user'];

                ?>
                <h2>ユーザー情報削除の確認</h2>
                <p>ユーザー名：<?php echo $user['name'];?></p>
                <p>パスワード：<?php echo $user['password'];?></p>
                <p>メールアドレス：<?php echo $user['mail'];?></p>
                <p>住所：<?php echo $user['address'];?></p>
                <p>総購入金額：￥<?php echo $user['total'];?></p>
                <p>登録日時：<?php echo date('Y年n月j日　G時i分s秒', strtotime($user['newDate']));?></p>
                <h3>このユーザーをマジで削除しますか？</h3>
                <form action="<?php echo DELETE_RESULT ;?>" method="POST">
                    <input type='hidden' name='transition' value='from_delete'>
                    <input type="submit" name='yes' value="はい">
                </form>
                <form action="<?php echo MYDATA ;?>" method="POST">
                    <input type="submit" name='no' value="いいえ">
                </form>
                <?php
           } ?>
        </section>
    </body>
</html>
