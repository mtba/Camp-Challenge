<?php
    require_once '7_5challenge-class.php';
    require_once '7_5challenge-define.php';
    session_chk();


    $errflg = false;
    $isSubmit = false;

    if (isset($_POST[INSERT_PAGE_SUBMIT])) {
        $isSubmit = true;

        if (
            !empty($_POST['name']) &&
            !empty($_POST['price']) &&
            !empty($_POST['number'])
        ) {

            $name = $_POST['name'];
            $price = (int)$_POST['price'];
            $date = date('Y-m-d');
            $number = (int)$_POST['number'];

            $db = new Operate_DB;
            $sql = 'INSERT INTO ' . DB_TBL_GOODS ;
            $sql .= ' Values (:name ,:price, :number, :date)';
            $reg_param = array(
                ':name' => $name,
                ':price' => $price,
                ':number' => $number,
                ':date' => $date
            );
            $addedrecord = $db->pdo_insert($sql,$reg_param);
            $db = null;
        } else {
            $errflg = true;
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>PDO課題0 - SUBJECT</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family:"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, sans-serif;
            fontsize:14px;
        }
        ul li {
            display: inline;
        }
    </style>
</head>
<body>
    <h2>商品登録</h2>
    <?php
        if ($isSubmit == true && $errflg == false ) {
    ?>
    <p><?=MSG_REGIST_OK?></p>
    <?php
        } else {
            if ($errflg == true) {
                echo '<p>'.MSG_INPUT_ERR.'</p>';
            }
    ?>
    <form action=<?=INSERT?> method="post">
        <table>
            <tr>
                <td>
                    名前：
                </td>
                <td>
                    <input type="text" name="name" value="<?php if ($isSubmit == true && !empty($_POST['name'])) { echo $_POST['name']; } ?>">
                </td>
            </tr>
            <tr>
                <td>
                    値段：
                </td>
                <td>
                    <input type="number" name="price" value="<?php if ($isSubmit == true && !empty($_POST['price'])) { echo $_POST['price']; } ?>">
                </td>
            </tr>
            <tr>
                <td>
                    個数：
                </td>
                <td>
                    <input type="number" name="number" value="<?php if ($isSubmit == true && !empty($_POST['number'])) { echo $_POST['number']; } ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">    <!--横方向セル結合-->
                    <input type="submit" name="<?=INSERT_PAGE_SUBMIT?>" value="登録">
                </td>
            </tr>
        </table>
    </form>
    <?php
        }
    ?>
    <p><a href=<?=MAIN?>>戻る</a></p>
</body>
</html>
