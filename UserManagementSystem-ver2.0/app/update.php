<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<!-- JQueryをグーグルから読み込み -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<title>変更入力画面</title>
<link href="../common/ums.css" rel="stylesheet" media="all">
</head>
<body>
    <?php
    if( ! chk_post_mode("REINPUT") ){

        echo BAD_ACCESS;

    }else{

        session_start();

        ?>
        <h1>更新ページ</h1>
        <form action="<?php echo UPDATE_RESULT ?>" method="POST">

            名前:
            <input type="text" name="name" value="<?php echo form_value('name'); ?>">
            <br><br>

            生年月日:
            <select name="year">
                <option value="">----</option>
                <?php
                for($i=1950; $i<=2010; $i++){ ?>
                    <option value="<?php echo $i;?>"<?php if($i==form_value('year')){echo "selected";}?>><?php echo $i ;?></option>
                    <?php
                } ?>
            </select>年
            <select name="month">
                <option value="">--</option>
                <?php
                for($i = 1; $i<=12; $i++){?>
                    <option value="<?php echo $i;?>"<?php if($i==form_value('month')){echo "selected";}?>><?php echo $i;?></option>
                    <?php
                } ?>
            </select>月
            <select name="day">
                <option value="">--</option>
                <?php
                for($i = 1; $i<=31; $i++){ ?>
                    <option value="<?php echo $i; ?>"<?php if($i==form_value('day')){echo "selected";}?>><?php echo $i;?></option>
                    <?php
                } ?>
            </select>日
            <br><br>

            種別:
            <br>
            <?php
            for($i = 1; $i<=3; $i++){ ?>
                <input id="btn" type="radio" name="type" value="<?php echo $i; ?>"<?php if($i==form_value('type')){echo "checked";}?>><?php echo ex_typenum($i);?><br>
                <?php
            } ?>
            <br>

            電話番号:
            <input type="text" name="tell" value="<?php echo form_value('tell'); ?>">
            <br><br>

            自己紹介文
            <br>
            <textarea name="comment" rows=10 cols=50 style="resize:none" wrap="hard"><?php echo form_value('comment'); ?></textarea><br><br>

            <input type="hidden" name="mode"  value="RESULT">
            <input type="submit" name="btnSubmit" value="以上の内容で更新を行う">
        </form>
        <form action="<?php echo RESULT_DETAIL; ?>" method="GET">
            <input type="hidden" name="id"  value=<?php echo $_SESSION['userID'];?> >
            <input type="submit" name="NO" value="詳細画面に戻る"style="width:100px">
        </form>
        <?php
    } echo return_top();
    ?>
    <script>
        // (function(){
        //     "use strict";
        //     console.log(document.getElementsByName("type"));
        //
        //     var elem = document.getElementsByName('type');
        //     elem[0].addEventListener('click', function(){
        //         if(elem[0].checked == true) {
        //             elem[0].checked=false;
        //         }else {
        //             elem[0].checked=true;
        //         }
        //     });
        //     elem[1].addEventListener('click', function(){
        //         if(elem[1].checked == true) {
        //             elem[1].checked=false;
        //         }else {
        //             elem[1].checked=true;
        //         }
        //     });
        //     elem[2].addEventListener('click', function(){
        //         if(elem[2].checked == true) {
        //             elem[2].checked=false;
        //         }else {
        //             elem[2].checked=true;
        //         }
        //     });
        // })();
        $(function(){
            var nowchecked = $('input[name=type]:checked').val();
            $('input[name=type]').click(function(){
                if($(this).val() == nowchecked) {
                    $(this).prop('checked', false);
                    nowchecked = false;
                } else {
                    nowchecked = $(this).val();
                }
            });
        });
    </script>
</body>
</html>
