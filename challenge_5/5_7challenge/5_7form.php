<?PHP
    $namae_cookie  = isset($_COOKIE['namae']) ? $_COOKIE['namae'] : "";
    $seibetu_cookie  = isset($_COOKIE['seibetu']) ? $_COOKIE['seibetu'] : "";
    $syumi_cookie  = isset($_COOKIE['syumi']) ? $_COOKIE['syumi'] : "";

    //性別の入力データが'男'なら変数$checked_manに'checked'を入れる
    //そうでなければ空文字を入れる
    if ($seibetu_cookie == '男') {
        $checked_man = 'checked';
    }else {
        $checked_man = '';
    }
    //性別の入力データが'女'なら変数$checked_womanに'checked'を入れる
    //そうでなければ空文字を入れる
    if ($seibetu_cookie == '女') {
        $checked_woman = 'checked';
    }else {
        $checked_woman = '';
    }

?>
<html>
  <head>
    <meta charset ="utf-8">
    <title>課題７の入力フォーム</title>
  </head>
  <body>
    <form action="5_7data.php" method="post">
        <table border="1">
            <tr>
                <th>名前：</th>
                <td><input type="text" name="namae" value = <?php echo $namae_cookie;?> ></td>
            </tr>
            <tr>
                <th>性別：</th>
                <td><input type="radio" name="seibetu" value="男" <?php echo $checked_man;?>>男
                    <input type="radio" name="seibetu" value="女" <?php echo $checked_woman;?>>女</td>
            </tr>
            <tr>
                <th>趣味：</th>
                <td><textarea name="syumi" rows="4" cols="40"><?php echo $syumi_cookie;?></textarea></td>
            </tr>
        </table>
        <input type="submit" value="送信">
    </form>
  </body>
</html>
