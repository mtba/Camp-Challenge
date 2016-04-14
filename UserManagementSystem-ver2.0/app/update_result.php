<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>更新結果画面</title>
</head>
<body>
    <?php
    if( ! chk_post_mode("RESULT") ){

        echo BAD_ACCESS;

    }else{

        session_start();

        // ポストの存在チェックとセッションに値を格納しつつ、連想配列にポストされた値を格納
        $update_data = array(
            'name'    => bind_pg2s('name'),
            'year'    => bind_pg2s('year'),
            'month'   => bind_pg2s('month'),
            'day'     => bind_pg2s('day'),
            'tell'    => bind_pg2s('tell'),
            'type'    => bind_pg2s('type'),
            'comment' => bind_pg2s('comment')
        );

        //1つでも未入力項目があったら表示しない
        if( ! in_array(null,$update_data, true) ){

            if( ! checkdate($_POST['month'], $_POST['day'], $_POST['year']) ){  //日付存在判定

                echo NON_DATE;

                ?>
                <form action="<?php echo UPDATE ?>" method="POST">
                    <input type="hidden" name="mode" value="REINPUT" >
                    <input type="submit" name="no" value='更新画面に戻る'>
                </form>
                <?php
            }else {
                //年月日情報を結合し、配列に追加
                $update_data['birthday'] = $update_data['year'].'-'.
                            sprintf('%02d',$update_data['month']).'-'.
                            sprintf('%02d',$update_data['day']);
                array_splice($update_data, 1, 3);   //配列から年月日を削除

                $result_update = update_profile($update_data,$_SESSION['userID']);

                //エラーが発生しなければ更新情報の確認を表示
                if(!isset($result_update)){
                    ?>
                    <h1>更新確認</h1>
                    <?php
                    $result_detail = profile_detail($_SESSION['userID']);

                    //エラーが発生しなければ詳細データを表示
                    if(is_array($result_detail)){
                    ?>
                        名前:    <?php echo $result_detail['name'];?><br>
                        生年月日:<?php echo $result_detail['birthday'];?><br>
                        種別:    <?php echo ex_typenum($result_detail['type']);?><br>
                        電話番号:<?php echo $result_detail['tell'];?><br>
                        自己紹介:<?php echo $result_detail['comment'];?><br>
                        登録日時:<?php echo date('Y年n月j日　G時i分s秒', strtotime($result_detail['newDate'])); ?><br>
                    <?php
                    }else{
                        echo '<p>データの検索に失敗しました。次記のエラーにより処理を中断します:'.$result_detail.'</p>';
                    }
                    ?>
                    <p>以上の内容で更新しました。</p>
                    <form action="<?php echo RESULT_DETAIL ?>" method="GET">
                        <input type="hidden" name="id" value=<?php echo $_SESSION['userID'];?> >
                        <input type="submit" name="no" value="詳細画面に戻る">
                    </form>
                    <?php
                }else{
                    echo '<p>データの更新に失敗しました。次記のエラーにより処理を中断します:'.$result_update.'</p>';
                }
            }
        }else {

            echo BAD_INPUT;

            //連想配列内の未入力項目を検出して表示
            foreach ($update_data as $key => $value){
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
            ?>
            <form action="<?php echo UPDATE ?>" method="POST">
                <input type="hidden" name="mode" value="REINPUT" >
                <input type="submit" name="no" value="更新画面に戻る">
            </form>
            <?php
        }
    } echo return_top();
    ?>
</body>
</html>
