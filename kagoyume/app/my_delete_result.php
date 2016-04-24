<?php
require_once("../util/defineUtil.php");
require_once(SCRIPT);
require_once(DBACCESS);

write_log(DELETE_RESULT.'に遷移');

session_start();
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>kagoyume_delete_result</title>
        <!-- <link rel="stylesheet" type="text/css" href="../css/prototype.css"/> -->
    </head>
    <body>
        <header>
            <h1><a href="<?php echo TOP ;?>">かごゆめ</a></h1>
            <?php require_once(HEADER_UNDER);?>
        </header>

        <section class='main'>
            <?php
            if( ! chk_transition("from_delete") || empty($_SESSION['user']) ){

                echo BAD_ACCESS;

            }else {

                $result_delete = delete_profile($_SESSION['user']['userID']);

                if(!isset($result_delete)){ //エラーが発生しなければ
                    echo '<h2>データの削除が完了しました</h2>';
                    logout();
                }else{
                    echo '<p>データの削除に失敗しました。次記のエラーにより処理を中断します:'.$result_delete.'</p>';
                }
            }
            ?>
        </section>
    </body>
</html>
