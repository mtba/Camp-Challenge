<?php
require_once '6_13-define.php';
require_once '6_13-util.php';

$errflg = false;
$isSubmit = false;
$alreadyin = false;

if (isset($_POST[INSERT_PAGE_SUBMIT])) {
    $isSubmit = true;

    if (!empty($_POST['day']) && !empty($_POST['time']) && !empty($_POST['subject']) && !empty($_POST['teacher'])) {

        $day = $_POST['day'];
        $time = $_POST['time'];
        $subject = $_POST['subject'];
        $teacher = $_POST['teacher'];

        try {
            $sql_select_schedules = 'SELECT * FROM ' . DB_TBL_SCHEDULE;

            $pdo = create_pdo();

            $schedules = pdo_select($pdo, $sql_select_schedules);

            if (empty(compare($day, $time, $schedules))) {
                $sql = 'INSERT INTO ' . DB_TBL_SCHEDULE . '(day, time, subject, teacher) ';
                $sql .= 'Values (:day, :time, :subject, :teacher)';

                $reg_param = array();
                $reg_param[':day'] = $day;
                $reg_param[':time'] = $time;
                $reg_param[':subject'] = $subject;
                $reg_param[':teacher'] = $teacher;

                pdo_insert($pdo, $sql, $reg_param);
            } else {
                $alreadyin = true;
            }
            $pdo = null;
        } catch (Exception $ex) {
            $pdo = null;
            echo $ex->getMessage();
            exit;
        }
    } else {
        $errflg = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>PDO課題13 - INSERT</title>
        <meta charset="UTF-8">
        <style>
            body {
                font-family:"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, sans-serif;
                fontsize:14px;
            }
        </style>
    </head>
    <body>
        <h2>○×塾　時間割登録</h2>
        <?php
        if ($isSubmit == true && $errflg == false && $alreadyin == false) {
            ?>
            <p><?= MSG_REGIST_OK ?></p>
            <?php
        } else {
            if ($errflg == true) {
                echo '<p>' . MSG_INPUT_ERR . '</p>';
            } elseif ($alreadyin == true) {
                echo '<p>' . MSG_ALREADY_INPUT . '</p>';
            } else {
                echo '<p>全て必須項目です。</p>';
            }
            ?>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                            科目：
                        </td>
                        <td>
                            <input type="text" name="subject" value="<?php
                            if ($isSubmit == true && !empty($_POST['subject'])) {
                                echo $_POST['subject'];
                            }
                            ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            担当：
                        </td>
                        <td>
                            <input type="text" name="teacher" value="<?php
                            if ($isSubmit == true && !empty($_POST['teacher'])) {
                                echo $_POST['teacher'];
                            }
                            ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            曜日：
                        </td>
                        <td>
                            <select name="day">
                                <option value =""selected>選択してください</option>
                                <option value ="月曜">月曜</option>
                                <option value ="火曜">火曜</option>
                                <option value ="水曜">水曜</option>
                                <option value ="木曜">木曜</option>
                                <option value ="金曜">金曜</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            時限：
                        </td>
                        <td>
                            <select name="time">
                                <option value =""selected>選択してください</option>
                                <option value ="1">1</option>
                                <option value ="2">2</option>
                                <option value ="3">3</option>
                                <option value ="4">4</option>
                                <option value ="5">5</option>
                                <option value ="6">6</option>
                            </select>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="<?= INSERT_PAGE_SUBMIT ?>" value="登録">
                        </td>
                    </tr>
                </table>
            </form>
    <?php
}
?>
        <a href="6_13-main.php">トップへ戻る</a>
    </body>
</html>
