<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>ユーザー情報詳細画面</title>
</head>
  <body>
    <?php

    $id = chk_input('id');
    $result = profile_detail($id);

    if (empty($result)) {   //検索ヒットせず

        echo BAD_ACCESS;

    }elseif(is_array($result)){  //エラーが発生しなければ

        // 生年月日データをハイフンで分割
        $birthday = explode('-', $result['birthday']);

        //詳細情報をセッションに格納し、他ページでも参照できるようにする
        session_start();
        $_SESSION['userID']  = $result['userID'];
        $_SESSION['name']    = $result['name'];
        $_SESSION['year']    = $birthday[0];
        $_SESSION['month']   = $birthday[1];
        $_SESSION['day']     = $birthday[2];
        $_SESSION['type']    = $result['type'];
        $_SESSION['tell']    = $result['tell'];
        $_SESSION['comment'] = $result['comment'];
        ?>

        <h1>詳細情報</h1>
        名前:    <?php echo $result['name'];?><br>
        生年月日:<?php echo $result['birthday'];?><br>
        種別:    <?php echo ex_typenum($result['type']);?><br>
        電話番号:<?php echo $result['tell'];?><br>
        自己紹介:<?php echo $result['comment'];?><br>
        登録日時:<?php echo date('Y年n月j日　G時i分s秒', strtotime($result['newDate'])); ?><br>

        <form action="<?php echo UPDATE; ?>" method="POST">
            <input type="hidden" name="mode" value="REINPUT">
            <input type="submit" name="update" value="変更"style="width:100px">
        </form>
        <form action="<?php echo DELETE; ?>" method="POST">
            <input type="hidden" name="id" value= <?php echo($_GET['id']);?> >
            <input type="hidden" name="mode" value="DETAIL_TO_DELETE" >
            <input type="submit" name="delete" value="削除"style="width:100px">
        </form>

        <?php
    }else{
        echo '<p>データの検索に失敗しました。次記のエラーにより処理を中断します:'.$result.'</p>';
    }
    echo return_top();
    ?>
  </body>
</html>
