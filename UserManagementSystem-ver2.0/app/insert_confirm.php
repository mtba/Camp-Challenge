<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>登録確認画面</title>
</head>
<body>
    <?php

    //入力画面から「確認画面へ」ボタンを押した場合のみ処理を行う
    //chk_post_mode関数を通すことで、ポストの存在もチェックするよう修正
    if( ! chk_post_mode("CONFIRM") ){

        echo BAD_ACCESS;

    }else{

        session_start();

        //ポストの存在チェックとセッションに値を格納しつつ、連想配列にポストされた値を格納
        $confirm_values = array(
                                'name'    => bind_pg2s('name'),
                                'year'    => bind_pg2s('year'),
                                'month'   => bind_pg2s('month'),
                                'day'     => bind_pg2s('day'),
                                'type'    => bind_pg2s('type'),
                                'tell'    => bind_pg2s('tell'),
                                'comment' => bind_pg2s('comment'));

        //1つでも未入力項目があったら表示しない
        if(!in_array(null,$confirm_values, true)){

            if( ! checkdate($_POST['month'], $_POST['day'], $_POST['year']) ){  //日付存在判定

                echo NON_DATE;

            }else {
                ?>
                <h1>登録確認画面</h1><br>
                名前:    <?php echo $confirm_values['name'];?><br>
                生年月日:<?php echo $confirm_values['year'].'年'.$confirm_values['month'].'月'.$confirm_values['day'].'日';?><br>
                種別:    <?php echo ex_typenum($confirm_values['type']);?><br>
                電話番号:<?php echo $confirm_values['tell'];?><br>
                自己紹介:<?php echo $confirm_values['comment'];?><br><br>

                上記の内容で登録します。よろしいですか？

                <form action="<?php echo INSERT_RESULT ?>" method="POST">
                    <input type="hidden" name="mode" value="RESULT" >
                    <input type="submit" name="yes" value="はい">
                </form>
                <?php
            }
        }else {

            echo BAD_INPUT;

            //連想配列内の未入力項目を検出して表示
            foreach ($confirm_values as $key => $value){
                if($value == null){
                    if($key == 'name'){
                        echo '名前';
                    }
                    if($key == 'year'){
                        echo '年';
                    }
                    if($key == 'month'){
                        echo '月';
                    }
                    if($key == 'day'){
                        echo '日';
                    }
                    if($key == 'type'){
                        echo '種別';
                    }
                    if($key == 'tell'){
                        echo '電話番号';
                    }
                    if($key == 'comment'){
                        echo '自己紹介';
                    }
                    echo 'が未記入です<br>';
                }
            }
        }
        ?>
        <form action="<?php echo INSERT ?>" method="POST">
            <input type="hidden" name="mode" value="REINPUT" >
            <input type="submit" name="no" value="登録画面に戻る">
        </form>
        <?php
    }
    echo return_top();
    ?>
</body>
</html>
