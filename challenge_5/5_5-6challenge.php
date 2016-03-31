<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset ="utf-8">
        <title>課題５、６</title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="" method="post">
            ファイル選択（テキストファイル限定）：<input name="userfile" type="file" />
            <br><br>
            <input type="submit" value="送信">
        </form>
        <br>
        <?php
            $file_name = 'sample.txt';

            echo '↓にファイルを表示<br>';

            if (isset($_FILES['userfile']['tmp_name'])){    //ファイルが送られているかを判別
                //送られたファイルの名前に.txtが含まれるならば、ファイルを移動し、読み込んで表示
                if (preg_match("/\.txt/", $_FILES['userfile']['name'])){

                    move_uploaded_file( $_FILES['userfile']['tmp_name'], $file_name);

                    $file_txt = file_get_contents($file_name);
                    echo $file_txt;
                }else {
                    echo 'テキストファイルを選択してから送信して下さい';
                }
            }
        ?>
    </body>
</html>
