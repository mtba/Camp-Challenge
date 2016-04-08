<?php require_once '../common/scriptUtil.php'; ?>
<?php require_once '../common/dbaccesUtil.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録結果画面</title>
</head>
<body>
    <?php
    if (isset($_POST["route"])) {   //課題５ 確認ページからhidden情報を送ってページ遷移しているなら、以下の処理を実行

        session_start();
        $name     = $_SESSION['name'];
        $birthday = $_SESSION['birthday'];
        $type     = $_SESSION['type'];
        $tell     = $_SESSION['tell'];
        $comment  = $_SESSION['comment'];

        //DBに全項目のある1レコードを登録するSQL
        $insert_sql = "INSERT INTO ".DB_TBL_USER."(name,birthday,tell,type,comment,newDate)"
        ."VALUES(:name,:birthday,:tell,:type,:comment,:newDate)";

        //種別を数値化
        switch ($type) {
            case 'エンジニア':
                $type_to_number = 1;
                break;

            case '営業':
                $type_to_number = 2;
                break;

            case 'その他':
                $type_to_number = 3;
        }

        //課題８ バインド用の連想配列を作成する
        //Key名にプレースホルダ、バリューに入れる値を設定する
        $key_bind = array(
            ':name'     => $name,
            ':birthday' => $birthday,
            ':tell'     => $tell,
            ':type'     => $type_to_number,
            ':comment'  => $comment,
            ':newDate'  => date('y-m-d H-i-s') //課題６ dateで日付文字列に変更
        );

        pdo_insert($insert_sql,$key_bind);  //課題８ データベース操作する関数
        ?>

        <h1>登録結果画面</h1>
        <table>
            <tr>
                <th>名前:</th><td><?=$name?></td>
            </tr>
            <tr>
                <th>生年月日:</th><td><?=$birthday?></td>
            </tr>
            <tr>
                <th>種別:</th><td><?=$type?></td>
            </tr>
            <tr>
                <th>電話番号:</th><td><?=$tell?></td>
            </tr>
            <tr>
                <th>自己紹介:</th><td><?=$comment?></td>
            </tr>
        </table>
        <p>以上の内容で登録しました。</p>

        <?php
    }else { //課題５ 確認ページからhidden情報が送られていないならエラー文表示
        echo "<p>不正なアクセスです<p>";
    }

    echo return_top();
    ?>
</body>
</html>
