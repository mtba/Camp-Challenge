<?php
require_once("../util/defineUtil.php");
require_once(SCRIPT);

write_log(BUY_CONFIRM.'に遷移');

session_start();
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>kagoyume_buy_confirm</title>
        <!-- <link rel="stylesheet" type="text/css" href="../css/prototype.css"/> -->
    </head>
    <body>

        <header>
            <?php require_once(HEADER_TOP);?>
            <?php require_once(HEADER_UNDER);?>
        </header>

        <?php
        if( ! chk_transition("from_cart") ){

            echo BAD_ACCESS;

        }else {
            $codes_array = explode(" ", $_COOKIE[$_SESSION['user']['userID']]); // クッキー内の商品コード群を分割し、配列に格納
            ?>
            <h2>確認</h2>
            <?php
            foreach ($codes_array as $key => $value) {
                $hit = hitBy_itemLookup($value);
                ?>
                <p><?php echo $hit->Name;?></p>
                <p>￥<?php echo $hit->Price;?></p>

                <?php
            }
            echo "<p>合計金額：￥".$_SESSION['numPrice']."<p>";
            ?>

            <form action="<?php echo BUY_COMPLETE;?>" method="post">
                <p>
                    <input type="radio" name="type" value=1 checked >通常
                    <input type="radio" name="type" value=2 >お急ぎ便
                    <input type="radio" name="type" value=3 >なんか
                </p>

                <input type="hidden" name="transition" value='from_confirm'>
                <input type="submit" name="btnSubmit" value="上記の内容で購入する">
            </form>
            <a href='<?php echo CART?>'>カートへ戻る</a>
            <?php
        }
         ?>
    </body>
</html>
