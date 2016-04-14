<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>削除確認画面</title>
</head>
  <body>
    <?php
    if( ! chk_post_mode("DETAIL_TO_DELETE") ){

        echo BAD_ACCESS;

    }else{

        $result = profile_detail($_POST['id']);
        //エラーが発生しなければ表示を行う
        if(is_array($result)){
            ?>
            <h1>削除確認</h1>
            <p>以下の内容を削除します。よろしいですか？</p>
            名前:    <?php echo $result['name'];?><br>
            生年月日:<?php echo $result['birthday'];?><br>
            種別:    <?php echo ex_typenum($result['type']);?><br>
            電話番号:<?php echo $result['tell'];?><br>
            自己紹介:<?php echo $result['comment'];?><br>
            登録日時:<?php echo date('Y年n月j日　G時i分s秒', strtotime($result['newDate'])); ?><br>

            <form action="<?php echo DELETE_RESULT; ?>" method="POST">
                <input type="hidden" name="id" value= <?php echo($_POST['id']);?> >
                <input type="hidden" name="mode" value="DELETE_RESULT">
                <input type="submit" name="YES" value="はい"style="width:100px">
            </form>
            <form action="<?php echo RESULT_DETAIL; ?>" method="GET">
                <input type="hidden" name="id"  value=<?php echo $_POST['id'];?> >
                <input type="submit" name="NO" value="詳細画面に戻る"style="width:100px">
            </form>

            <?php
        }else{
            echo 'データの取得に失敗しました。次記のエラーにより処理を中断します:'.$result;
        }
    }
    echo return_top();
    ?>
   </body>
</html>
