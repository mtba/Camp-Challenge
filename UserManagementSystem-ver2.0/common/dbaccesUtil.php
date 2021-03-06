<?php

//DBへの接続を行う。成功ならPDOオブジェクトを、失敗なら中断、メッセージの表示を行う
function connect2MySQL(){
    try{
        //ユーザとパスを変更
        $pdo = new PDO( DB_TYPE.':host='.DB_HOST.';dbname='.DB_DBNAME.
            ';charset='.DB_CHARSET,DB_USER,DB_PWD );
        //SQL実行時のエラーをtry-catchで取得できるように設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //とりあえずエミュレートはオフ
        //$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        return $pdo;
    } catch (PDOException $e) {
        die('DB接続に失敗しました。次記のエラーにより処理を中断します:'.$e->getMessage());
    }
}

//レコードの挿入を行う。失敗した場合はエラー文を返却する
function insert_profiles($name, $birthday, $type, $tell, $comment){
    //db接続を確立
    $insert_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $insert_sql = "INSERT INTO user_t(name,birthday,tell,type,comment,newDate)"
            . "VALUES(:name,:birthday,:tell,:type,:comment,:newDate)";

    //現在時をdatetime型で取得
    $date = now();

    //クエリとして用意
    $insert_query = $insert_db->prepare($insert_sql);

    //SQL文にセッションから受け取った値＆現在時をバインド
    $insert_query->bindValue(':name',$name);
    $insert_query->bindValue(':birthday',$birthday);
    $insert_query->bindValue(':tell',$tell);
    $insert_query->bindValue(':type',$type);
    $insert_query->bindValue(':comment',$comment);
    $insert_query->bindValue(':newDate',$date);

    //SQLを実行
    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

function serch_all_profiles(){
    //db接続を確立
    $search_db = connect2MySQL();

    $search_sql = "SELECT * FROM user_t";

    //クエリとして用意
    $seatch_query = $search_db->prepare($search_sql);

    //SQLを実行
    try{
        $seatch_query->execute();
    } catch (PDOException $e) {
        $seatch_db=null;
        return $e->getMessage();
    }

    //全レコードを連想配列として返却
    return $seatch_query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * 複合条件検索を行う
 * @param type $name
 * @param type $year
 * @param type $type
 * @return type
 */
function serch_profiles($name=null,$year=null,$type=null){
    //db接続を確立
    $search_db = connect2MySQL();

    $search_sql = "SELECT * FROM user_t";
    $flag = false;
    if(!empty($name)){
        $search_sql .= " WHERE name like :name";
        $flag = true;
    }
    if(!empty($year) && $flag == false){ //代入演算子を比較演算子に修正
        $search_sql .= " WHERE birthday like :year";
        $flag = true;
    }else if(!empty($year)){
        $search_sql .= " AND birthday like :year";
    }
    if(!empty($type) && $flag == false){ //代入演算子を比較演算子に修正
        $search_sql .= " WHERE type = :type";
    }else if(!empty($type)){
        $search_sql .= " AND type = :type";
    }

    //クエリとして用意
    $seatch_query = $search_db->prepare($search_sql);

    if(!empty($name)){
        $seatch_query->bindValue(':name','%'.$name.'%');
    }
    if(!empty($year)){
        $seatch_query->bindValue(':year',$year.'%');
    }
    if(!empty($type)){
        $seatch_query->bindValue(':type',$type);
    }

    //SQLを実行
    try{
        $seatch_query->execute();
    } catch (PDOException $e) {
        $seatch_db=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $seatch_query->fetchAll(PDO::FETCH_ASSOC);
}

function profile_detail($id){
    //db接続を確立
    $detail_db = connect2MySQL();

    $detail_sql = "SELECT * FROM user_t WHERE userID=:id";

    //クエリとして用意
    $detail_query = $detail_db->prepare($detail_sql);

    $detail_query->bindValue(':id',$id);

    //SQLを実行
    try{
        $detail_query->execute();
    } catch (PDOException $e) {
        $detail_db=null;
        return $e->getMessage();
    }

    //レコードを連想配列として返却
    $result = $detail_query->fetchAll(PDO::FETCH_ASSOC);
    //１次元配列にしておく
    if (!empty($result)) {
        $result = $result[0];
    }
    return $result;
}

function delete_profile($id){
    //db接続を確立
    $delete_db = connect2MySQL();

    $delete_sql = "DELEtE FROM user_t WHERE userID=:id";

    //クエリとして用意
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':id',$id);

    //SQLを実行
    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_db=null;
        return $e->getMessage();
    }
    return null;
}

function update_profile($update_data,$userID){
    //db接続を確立
    $update_db = connect2MySQL();

    //現在時をdatetime型で取得
    $date = now();

    //SQL文作成
    $update_sql = "update user_t set";
    foreach ($update_data as $key => $value) {
        $update_sql .= " $key = ?,";
    }
    $update_sql .= " newDate = \"$date\" where userID = $userID";

    //クエリとして用意
    $update_query = $update_db->prepare($update_sql);
    $i =1;
    foreach ($update_data as $value) {
        $update_query -> bindValue($i,$value);
        $i++;
    }

    //SQLを実行
    try{
        $update_query->execute();
    } catch (PDOException $e) {
        $update_db=null;
        return $e->getMessage();
    }
    return null;
}
