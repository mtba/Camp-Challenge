<?php
require_once '../common/defineUtil.php';

//DBへの接続を行う。成功ならPDOオブジェクトを生成
//失敗なら中断し、メッセージの表示を行う
function connect2MySQL(){
    try{
        $pdo = new PDO( DB_TYPE.':host='.DB_HOST.';dbname='.DB_DBNAME.
            ';charset=utf8',DB_USER,DB_PWD ); //ユーザとパスを変更
        //課題７ エラーモードをEXCEPTIONに設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //エミュレートをオフ
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

        return $pdo;

    } catch (PDOException $err) {
        die('接続に失敗しました。次記のエラーにより処理を中断します:'.$err->getMessage());
    }
}
//課題８ DBアクセス処理を関数にまとめる
function pdo_insert($sql, $params=array()) {
    //db接続を確立
    $pdo = connect2MySQL();

    try {
        //クエリとして用意
        $query = $pdo->prepare($sql);
        //SQL文にセッションから受け取った値＆現在時をバインド
        foreach($params as $key=>$val) {
            $query->bindValue($key, $val);
        }
        //SQLを実行
        $query->execute();

        //接続オブジェクトを初期化することでDB接続を切断
        $pdo = null;
    } catch (Exception $err) {
        $pdo = null;
        echo 'データの挿入に失敗しました:'.$err->getMessage();
        //exit;     課題７ エラーが出ても処理を止めないようexit文を消去
    }
}
