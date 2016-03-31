<?php
    require_once '5_9_4.php';
    require_once '5_9_6.php';

    session_chk();

    if(!isset($_COOKIE['login_count']) && !isset($_COOKIE['last_login'])){  //初回
        $lcount = 1;
        $llogin = mktime();
        setcookie('login_count',$lcount);
        setcookie('last_login',$llogin);
        setcookie('SAVEDPHPSESSID',$_COOKIE['PHPSESSID']);
    }else if($_COOKIE['PHPSESSID']!=$_COOKIE['SAVEDPHPSESSID']){    //ログアウト後
        setcookie('login_count',$_COOKIE['login_count']+1);
        $lcount = $_COOKIE['login_count']+1;
        $llogin = mktime();
        setcookie('last_login',$llogin);
        setcookie('SAVEDPHPSESSID',$_COOKIE['PHPSESSID']);
    }else{
        $lcount = $_COOKIE['login_count'];
        $llogin = $_COOKIE['last_login'];
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo MAIN ?></title>
    <style>
        ul{
            list-style:none;
            border-top: 1px solid #ddd;
            padding: 15px;
        }
        li.name{
            font-size: 80%;
            color: #05c;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <h1>掲示板</h1>
    <p>今回で<?php echo $lcount ?>回目のアクセスです！　最終ログイン日時 <?php echo date('Y年m月d日 H時i分s秒',$llogin)?></p>
    <section>
        <h2>投稿一覧</h2>
        <?php
        if(!empty($_POST['name']) && !empty($_POST['contents'])){
            $get_name = $_POST['name'];
            $get_text = $_POST['contents'];

            //データを変数に格納(改行コードは<br>に変換)
            $data = ('<ul><li class="name">お名前：'.$get_name.'</li><li>'.nl2br($get_text).'</li></ul>');

            //データをテキストファイルに追記
            $fp = fopen('data.txt','a');
            fwrite($fp, $data);
            fclose($fp);
        }
        if (file_exists('data.txt')){       //現在のフォルダにdata.txtがあるならば
            $file_txt = file_get_contents('data.txt');  //読み込んで
            echo $file_txt;                             //表示
        }else {
            echo "<p>まだ投稿はありません</p>";
        }
        ?>
    </section>
    <section>
        <h2>投稿フォーム</h2>
        <form action="" method="POST">
            名前:
            <input type="text" name="name" value="">
            <br><br>
            <textarea name="contents" cols="60" rows="5"></textarea>
            <br><br>
            <input type="submit" name="btnSubmit" value="投稿">
        </form>
    </section>
</body>
</html>
