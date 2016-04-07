<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>   <!-- 課題１ 関数を使うために追加 -->
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>登録確認画面</title>
</head>
  <body>
    <?php

    //課題２ $_POST['year']と$_POST['month']と$_POST['day']が空かどうかの判定を追加
    if(!empty($_POST['name']) &&
        !empty($_POST['year']) && !empty($_POST['month']) && !empty($_POST['day']) &&
        !empty($_POST['type']) && !empty($_POST['tell']) && !empty($_POST['comment'])
    ){
        $post_name     = $_POST['name'];
        //date型にするために1桁の月日を2桁にフォーマットしてから格納
        $post_birthday = $_POST['year'].'-'.sprintf('%02d',$_POST['month']).'-'.sprintf('%02d',$_POST['day']);
        $post_type     = $_POST['type'];
        $post_tell     = $_POST['tell'];
        $post_comment  = $_POST['comment'];

        //セッション情報に格納
        session_start();
        $_SESSION['name']     = $post_name;
        //課題４ 年月日の情報もセッションに格納
        $_SESSION['year']     = $_POST['year'];
        $_SESSION['month']    = $_POST['month'];
        $_SESSION['day']      = $_POST['day'];
        $_SESSION['birthday'] = $post_birthday;
        $_SESSION['type']     = $post_type;
        $_SESSION['tell']     = $post_tell;
        $_SESSION['comment']  = $post_comment;
        ?>

        <h1>登録確認画面</h1>

        <table>
            <tr>
                <th>名前:</th><td><?=$post_name?></td>
            </tr>
            <tr>
                <th>生年月日:</th><td><?=$post_birthday?></td>
            </tr>
            <tr>
                <th>種別:</th><td><?=$post_type?></td>
            </tr>
            <tr>
                <th>電話番号:</th><td><?=$post_tell?></td>
            </tr>
            <tr>
                <th>自己紹介:</th><td><?=$post_comment?></td>
            </tr>
        </table>
        <p>上記の内容で登録します。よろしいですか？</p>

        <form action ="<?=INSERT_RESULT?>" method ="POST">
            <input type ="hidden" name ="route" value ="from_confirm">  <!-- 課題５ hiddenフォーム追加 -->
            <input type ="submit" name ="yes" value ="はい">
        </form>

        <form action ="<?=INSERT?>" method ="POST">
            <input type= "submit" name ="no" value ="登録画面に戻る">
        </form>
        <?php
    }else{
        ?>
        <h1>入力項目が不完全です</h1><br>
        <?php
        //課題３ 未入力項目を表示
        //課題４ 入力されているフォームは値をセッションに保持
        //入力されていなければセッション変数を削除
        session_start();
        if(empty($_POST['name'])){
            echo "名前が未入力です<br>";
            unset($_SESSION[("name")]);
        }else {
            $_SESSION['name'] = $_POST['name'];
        }
        if(empty($_POST['year'])){
            echo "年が未入力です<br>";
            unset($_SESSION[("year")]);
        }else {
            $_SESSION['year'] = $_POST['year'];
        }
        if(empty($_POST['month'])){
            echo "月が未入力です<br>";
            unset($_SESSION[("month")]);
        }else {
            $_SESSION['month'] = $_POST['month'];
        }
        if(empty($_POST['day'])){
            echo "日が未入力です<br>";
            unset($_SESSION[("day")]);
        }else {
            $_SESSION['day'] = $_POST['day'];
        }
        if(empty($_POST['type'])){
            echo "種別が未入力です<br>";
            unset($_SESSION[("type")]);
        }else {
            $_SESSION['type'] = $_POST['type'];
        }
        if(empty($_POST['tell'])){
            echo "電話番号が未入力です<br>";
            unset($_SESSION[("tell")]);
        }else {
            $_SESSION['tell'] = $_POST['tell'];
        }
        if(empty($_POST['comment'])){
            echo "自己紹介文が未入力です<br>";
            unset($_SESSION[("comment")]);
        }else {
            $_SESSION['comment'] = $_POST['comment'];
        }
    ?>
        <p>再度入力を行ってください</p>
        <form action="<?=INSERT?>" method="POST">
            <input type="submit" name="no" value="登録画面に戻る">
        </form>
        <?php
    }
    echo return_top();  //課題１ トップへ戻るリンク
    ?>
</body>
</html>
