<?php require_once '../common/defineUtil.php'; ?>
<?php require_once '../common/scriptUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <!-- JQueryをグーグルから読み込み -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <title>ユーザー情報検索画面</title>
</head>
  <body>

    <?php session_start();//再入力時用 ?>

    <h1>検索画面</h1>

    <form action="<?php echo SEARCH_RESULT ?>" method="GET">

        名前:
        <br>
        <input type="text" name="name" value=<?php echo form_value('name'); ?>>
        <br><br>

        生年:
        <br>
        <select name="year">
            <option value="">----</option>
            <?php
            for($i=1950; $i<=2010; $i++){
                ?>
                <option value="<?php echo $i;?>" <?php if($i==form_value('year')){echo "selected";}?>><?php echo $i;?></option>
                <?php
            } ?>
        </select>年生まれ
        <br><br>

        種別:
        <br>
        <?php
        for($i = 1; $i<=3; $i++){ ?>
            <input type="radio" name="type" value="<?php echo $i; ?>" <?php if($i==form_value('type')){echo "checked";}?>><?php echo ex_typenum($i);?><br>
            <?php
        } ?>
        <br>
        <input type="submit" name="btnSubmit" value="検索">
    </form>
    <?php echo return_top(); ?>   <!--トップへ戻るリンク追加 -->
    <script>
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
