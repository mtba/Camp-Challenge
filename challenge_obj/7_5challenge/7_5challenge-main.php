<?php
    require_once '7_5challenge-class.php';
    require_once '7_5challenge-define.php';
    session_chk();

    $db = new Operate_DB;
    $sql_select_users = 'SELECT * FROM ' . DB_TBL_GOODS;
    $goods = $db->pdo_select($sql_select_users);
    $db = null;

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>課題</title>
        <meta charset="UTF-8">
        <style>
            body {
                font-family:"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, sans-serif;
                fontsize:14px;
            }
            ul li {
                display: inline;
            }
            table tr th {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>在庫管理</h1>
        <p>ユーザ名：<?=$_SESSION['user']?></p>
        <p>・<a href="<?=INSERT?>" target="_self">商品登録</a></p>

        <?php if (!empty($goods)) { ?>
        <table border="1">
            <tr>
                <th width="160">商品名</th>
                <th width="100">値段</th>
                <th width="100">個数</th>
                <th width="100">合計</th>
                <th width="120">日付</th>
            </tr>
            <?php
                foreach($goods as $value) {
            ?>
            <tr>
                <td><?=$value['name']?></td>
                <td><?=$value['price']?></td>
                <td><?=$value['number']?></td>
                <td><?=$value['price'] * $value['number']?></td>
                <td><?=$value['date']?></td>
            </tr>
            <?php
                }
            ?>
        </table>
        <?php } else { ?>
        <p>現在登録されている商品はありません。</p>
        <?php } ?>
    </body>
</html>
