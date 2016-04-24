<?php
require_once("../util/defineUtil.php");
require_once(SCRIPT);

write_log(ITEM.'に遷移');

session_start();

$code = !empty($_GET["code"]) ? $_GET["code"] : ""; //商品コード
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>kagoyume_item</title>
        <!-- <link rel="stylesheet" type="text/css" href="../css/prototype.css"/> -->
    </head>
    <body>
        <header>
            <?php require_once(HEADER_TOP);?>
            <?php require_once(HEADER_UNDER);?>
        </header>

        <h2>商品詳細</h2>
        <?php

        if ($code != "") {

            // 商品コードを基に検索し、その商品の詳細情報を取得
            $hit = hitBy_itemLookup($code);

            if ($hit != null) {?>
                <div class="Item">
                    <p><?php echo h($hit->Name);?></p>
                    <img src="<?php echo h($hit->Image->Medium);?>" />
                    <p>￥<?php echo h($hit->Price);?></p>
                    <p><?php echo h($hit->Headline);?></p>
                    <p><?php echo $hit->Caption;?></p>
                    <p>評価：<?php echo $hit->Store->Ratings->Rate;?></p>
                    <p>評価人数：<?php echo $hit->Store->Ratings->Count;?>人</p>
                    <?php
                    // ログインしているならカートに追加ボタン表示
                    if ( !empty($_SESSION['user']) ){ ?>
                        <form action="<?php echo ADD;?>" method="POST">
                            <input type='hidden' name='code' value=<?php echo $code;?>>
                            <input type='hidden' name='transition' value='from_item'>
                            <input type='submit' value='カートに追加する'>
                        </form>
                        <?php
                    } ?>
                </div>
                <?php
            }else {
                echo "<p>その商品コードは存在しません</p>";
            }
            ?>

            <?php
        }else{
            echo "<p>商品コードが未指定です</p>";
        } ?>
    </body>
</html>
