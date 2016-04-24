<div class='header_top'>
    <h1><a href="<?php echo TOP ;?>">かごゆめ</a></h1>
    <?php
    if ( empty($_SESSION['user']) ){ ?>
        <form action="<?php echo LOGIN;?>" method="POST">
            <input type='hidden' name='comeFrom' value=<?php echo $_SERVER["REQUEST_URI"];?>>
            <input type='submit' name='in_or_out' value='ログイン'>
        </form>
        <?php
    }else { ?>
        <p>ようこそ<a href=<?php echo MYDATA?> id="userName"><?php echo $_SESSION['user']['name']?></a>さん！</p>
        <p><a href='<?php echo CART?>'>買い物かご</a></p>
        <form action="<?php echo LOGIN;?>" method="POST">
            <input type='submit' name='in_or_out' value='ログアウト'>
        </form>
        <?php
    } ?>
</div>
