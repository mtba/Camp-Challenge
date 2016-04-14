<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>検索結果画面</title>
</head>
    <body>
        <h1>検索結果</h1>
        <table border=1>

            <?php

            session_start();

            //ポストの存在チェックとセッションに値を格納しつつ、連想配列にポストされた値を格納
            $search_values = array(
                'name'    => bind_pg2s('name'),
                'year'    => bind_pg2s('year'),
                'type'    => bind_pg2s('type'),
            );
            // //GETデータの存在をチェックし、代入。存在しなければnullが入る
            // $name = chk_input('name');
            // $year = chk_input('year');
            // $type = chk_input('type');

            $result = null;
            if( empty($search_values) ){
                $result = serch_all_profiles();
            }else{
                $result = serch_profiles(
                    $search_values['name'],
                    $search_values['year'],
                    $search_values['type']
                );
            }

            //DBでエラーが発生したらエラー文を表示
            //発生しなければ検索結果を表示
            if( ! is_array($result) ){
                echo "<p>データの検索に失敗しました:".$result."</p>";
            }elseif (empty($result)) {
                echo "<p>検索結果はありません</p>";
            }else{
                ?>
                <tr>
                    <th>名前</th>
                    <th>生年</th>
                    <th>種別</th>
                    <th>登録日時</th>
                </tr>
                <?php
                foreach($result as $value){
                    ?>
                    <tr>
                        <td><a href="<?php echo RESULT_DETAIL ?>?id=<?php echo $value['userID']?>"><?php echo $value['name']; ?></a></td>
                        <td><?php echo $value['birthday']; ?></td>
                        <td><?php echo ex_typenum($value['type']); ?></td>
                        <td><?php echo date('Y年n月j日　G時i分s秒', strtotime($value['newDate']));; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <form action="<?php echo SEARCH; ?>" method="POST">
            <input type="hidden" name="mode"  value="REINPUT" >
            <input type="submit" name="NO" value="検索画面に戻る"style="width:100px">
        </form>
        <?php
        echo return_top(); ?> <!--トップへ戻るリンク追加 -->
    </body>
</html>
