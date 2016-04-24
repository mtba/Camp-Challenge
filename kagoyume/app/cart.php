<?php
require_once("../util/defineUtil.php");
require_once(SCRIPT);

write_log(CART.'に遷移');

session_start();
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>kagoyume_cart</title>
        <!-- <link rel="stylesheet" type="text/css" href="../css/prototype.css"/> -->
    </head>
    <body>

        <header>
            <?php require_once(HEADER_TOP);?>
            <?php require_once(HEADER_UNDER);?>
        </header>

        <?php
        if ( empty($_SESSION['user']) ) {

            echo BAD_ACCESS;

        }else {
            ?>
            <h2>カート内商品</h2>
            <?php
            if ( isset($_COOKIE[$_SESSION['user']['userID']]) ) {

                $numPrice = 0;   //カート内商品の合計金額を格納する変数
                $codes_array = explode(" ", $_COOKIE[$_SESSION['user']['userID']]); // クッキー内の商品コード群を分割し、配列に格納

                // 削除ボタンが押された商品のコードを配列から削除し、再びクッキーに格納する
                if (isset($_POST['delete']) && $_POST['delete']=='削除') {
                    array_splice($codes_array, $_POST['item_num'], 1);
                    $codes_string = implode(" ", $codes_array);
                    setcookie($_SESSION['user']['userID'],$codes_string);
                }

                // セットクッキーはすぐには反映されないため、配列でカートが空かどうか判定
                if ( empty($codes_array) ) {

                    echo "<p>カートは空です</p>";

                }else {
                    // 商品情報(リンク付き)と削除ボタンを表示
                    foreach ($codes_array as $key => $value) {
                        $hit = hitBy_itemLookup($value);
                        ?>
                        <a href="<?php echo ITEM.'?code='.$value; ?>"><img src="<?php echo $hit->Image->Medium;?>" ></a>
                        <a href="<?php echo ITEM.'?code='.$value; ?>"><p><?php echo $hit->Name;?></p></a>
                        <p>￥<?php echo $hit->Price;?></p>

                        <form action="<?php echo CART?>" method="post">
                            <input type="hidden" name="item_num" value=<?php echo $key;?>>
                            <input type="submit" name="delete" value="削除">
                        </form>
                        <?php
                        $numPrice += $hit->Price;   //商品の値段を合計金額にプラス
                    }

                    // 合計金額と購入ボタン表示
                    //合計金額は別のページからも参照できるようセッションに保存
                    echo "<p>合計金額：￥".$numPrice;
                    $_SESSION['numPrice'] = $numPrice;
                    ?>
                    <form action="<?php echo BUY_CONFIRM?>" method="post">
                        <input type="hidden" name="transition" value='from_cart'>
                        <input type="submit" name="buy" value="購入">
                    </form>
                    <?php
                }
            }else {
                echo "<p>カートは空です</p>";
            }
        }
        ?>
    </body>
</html>
