<?php
require_once '6_13-define.php';
require_once '6_13-util.php';

try {
    $pdo = create_pdo();

    $sql_select_schedules = 'SELECT * FROM ' . DB_TBL_SCHEDULE;
    $schedules = pdo_select($pdo, $sql_select_schedules);

    $pdo = null;
} catch (Exception $err) {
    $pdo = null;
    echo $err->getMessage();
    exit;
}

$day = array('月曜', '火曜', '水曜', '木曜', '金曜');
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>PDO課題13</title>
        <meta charset="UTF-8">
        <style>
            body {
                font-family:"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, sans-serif;
                fontsize:14px;
            }
            table tr th {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>○×塾　時間割表</h1>

        <p>・<a href="6_13-insert.php" target="_self">時間割登録</a></p>

        <hr>
<?php if (!empty($schedules)) { ?>
            <table border="1">
                <tr>
                    <th width="64"></th>
    <?php
    foreach ($day as $value) {
        ?>
                        <th width="160"><?= $value ?></th>
                        <?php
                    }
                    ?>
                </tr>
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                        ?>
                    <tr>
                        <td><?= $i . "限目" ?></td>
        <?php
        foreach ($day as $value) {
            ?>
                            <!-- データと一致する時間帯ならば科目と担当者を入力 -->
                            <td><?= compare($value, $i, $schedules) ?></td>
            <?php
        }
        ?>
                    </tr>
                        <?php
                    }
                    ?>
            </table>
            <?php } else { ?>
            <p>時間割は登録されていません。</p>
        <?php } ?>
    </body>
</html>
