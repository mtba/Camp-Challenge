<?php
    require_once '7_5challenge-class.php';
    require_once '7_5challenge-define.php';

    $db = new Operate_DB;
    $sql_select_users = 'SELECT * FROM ' . DB_TBL_USER;
    $users = $db->pdo_select($sql_select_users);
    $db = null;

    $chkpass = isset($_POST['pass']) ? $_POST['pass'] : "";
    $chkID = isset($_POST['ID']) ? $_POST['ID'] : "";

    //passとIDをデータベースのものと照合する関数
    //一致すればユーザ名を返す
    function compare($pass,$id,$data){
        foreach ($data as $value) {
            if ( ($value['password']==$pass) && ($value['userID']==$id) ) {
                return $value['name'];
            }
        }
        return FALSE;
    }

    $match = compare($chkpass,$chkID,$users);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title><?php echo LOGIN ?></title>
</head>
<body>
    <h1>ログイン画面</h1>

    <?php
    if(!$match){
        if($chkpass!='' || $chkID!=''){
            echo '<p>IDまたはパスワードが異なります。もう一度入力してください</p>';
        }else{
            echo '<p>ID、パスワードを入力してください</p>';
        }
        ?>
        <form action="<?php echo LOGIN ?>" method="POST">
            <table>
                <tr>
                    <th>ユーザーID：</th><td><input type="text" name="ID"></td>
                </tr>
                <tr>
                    <th>パスワード：</th><td><input type="text" name="pass"></td>
                </tr>
                <tr colspan="2">
                    <td><input type="submit" value="ログイン"></td>
                </tr>
        </form>
    <?php
    }else{
        echo 'ログインに成功しました。三秒後にサービストップに移動します';
        echo '<meta http-equiv="refresh" content="3;URL='.MAIN.'">';

         session_start();
         $_SESSION['last_access']=mktime();
         $_SESSION['user']=$match;
    }
    ?>
</body>
</html>
