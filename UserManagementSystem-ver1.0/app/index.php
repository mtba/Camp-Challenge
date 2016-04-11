<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>   <!-- 課題１ 関数を使うために追加 -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー情報管理トップ</title>

</head>
<body>
    <h1>ユーザー情報管理トップ画面</h1><br>
    <h3>ここでは、ユーザー情報管理システムとしてユーザー情報の登録や検索、
        付随して修正や削除を行うことができます</h3><br>
    <a href="<?php echo INSERT; ?>">新規登録</a><br>
    <a href="<?php echo SEARCH; ?>" >検索(修正・削除)</a><br>

    <!-- ↓この機能はよくない模様 -->
    <!-- <script type="text/javascript"> //ブラウザの戻ると進むの制御
        // ブラウザがpushStateに対応しているかチェック
        if (window.history && window.history.pushState){

            //戻らせない進ませない
            history.pushState(null, null, null);
            window.addEventListener("popstate", function() {
                history.pushState(null, null, null);
            });
        }else {     //未対応なら
            //location.hashを使う？
        }
    </script> -->
</body>
</html>
