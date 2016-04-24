<?php
require_once("../util/defineUtil.php");
require_once(SCRIPT);

write_log(ADD.'に遷移');

session_start();
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>kagoyume_add</title>
        <!-- <link rel="stylesheet" type="text/css" href="../css/prototype.css"/> -->
    </head>
    <body>

        <header>
            <?php require_once(HEADER_TOP);?>
            <?php require_once(HEADER_UNDER);?>
        </header>

        <?php
        if( ! chk_transition("from_item") ){

            echo BAD_ACCESS;

        }else{
            // 追加する商品のコードをクッキーに保管する
            // キー名にはユーザーIDを指定(別ユーザーでログインしたときクッキーを保持させないため)
            // ２回目以降は空欄で区切って、文字列として保管
            if ( !isset($_COOKIE[$_SESSION['user']['userID']]) ) {
                setcookie($_SESSION['user']['userID'],$_POST["code"]);
            }else {
                $codes_array = explode(" ", $_COOKIE[$_SESSION['user']['userID']]);
                $codes_array[] = $_POST["code"];
                $codes_string = implode(" ", $codes_array);
                setcookie($_SESSION['user']['userID'],$codes_string);
            }

            $hit = hitBy_itemLookup($_POST["code"]); ?>
            <h2>「<?php echo h($hit->Name);?>」をカートに追加しました</h2>
            <?php
        } ?>
    </body>
</html>
