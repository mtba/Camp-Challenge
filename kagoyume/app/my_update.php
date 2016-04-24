<?php
require_once("../util/defineUtil.php");
require_once(SCRIPT);

write_log(UPDATE.'に遷移');

session_start();
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>kagoyume_update</title>
        <!-- <link rel="stylesheet" type="text/css" href="../css/prototype.css"/> -->
    </head>
    <body>
        <header>
            <?php require_once(HEADER_TOP);?>
            <?php require_once(HEADER_UNDER);?>
        </header>

        <section class='main'>

            <?php
            if( ! chk_transition("from_mydata") ){

                echo BAD_ACCESS;

            }else {
                ?>
               <form action="<?php echo UPDATE_RESULT ?>" method="POST">
                   <p>ユーザー名:
                       <input type="text" name="name" value="<?php echo $_SESSION['user']['name']; ?>"></p>
                   <p>パスワード:
                       <input type="text" name="password" value="<?php echo $_SESSION['user']['password']; ?>"></p>
                   <p>メールアドレス:
                       <input type="email" name="mail" value="<?php echo $_SESSION['user']['mail']; ?>"></p>
                   <p>住所:
                       <input type="text" name="address" value="<?php echo $_SESSION['user']['address']; ?>"></p>

                   <input type="hidden" name="transition"  value="from_update">
                   <input type="submit" name="btnSubmit" value="更新">
               </form>
               <a href='<?php echo MYDATA?>'>ユーザ情報へ戻る</a>
               <?php
           } ?>
        </section>
    </body>
</html>
