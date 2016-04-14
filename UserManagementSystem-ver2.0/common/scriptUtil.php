<?php
require_once '../common/defineUtil.php';

/**
 * 使用した場所にトップページへのリンクを挿入する
 * @return トップページへのリンクのaタグ
 */
function return_top(){
    //トップページへのリンクを渡すように修正
    return "<a href='".TOP_URL."'>トップへ戻る</a>";
}

/**
 * 種別番号から実際の種別名を返却する
 * @param type $type 種別と対応した数字
 * @return string 種別名
 */
function ex_typenum($type){
    switch ($type){
        case 1;
            return "エンジニア";
        case 2;
            return "営業";
        case 3;
            return "その他";
    }
}

/**
 * フォームの再入力時に、すでにセッションに対応した値があるときはその値を返却する
 * @param type $name formのname属性
 * @return type セッションに入力されていた値
 */
function form_value($name){
    if(chk_post_mode('REINPUT')){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
}

/**
 * ポストからセッションに存在チェックしてから値を渡す。
 * 二回目以降のアクセス用に、ポストから値の上書きがされない該当セッションは初期化する
 * @param type $name
 * @return type
 */
function bind_pg2s($name){
    if(!empty($_POST[$name])){
        $_SESSION[$name] = $_POST[$name];
        return $_POST[$name];
    }elseif (!empty($_GET[$name])) {
        $_SESSION[$name] = $_GET[$name];
        return $_GET[$name];
    }else{
        $_SESSION[$name] = null;
        return null;
    }
}

/**
 * 前の画面からボタンを押して遷移してきたかどうかを判定
 * 不正アクセス処理用
 * @param type $value 前ページから送られるhiddenデータ
 * @return type
 */
function chk_post_mode($value){
    if (isset($_POST['mode']) && $_POST['mode']==$value) {
        return TRUE;
    }
    return FALSE;
}

/**
 * POSTとGETの存在判定
 * @param type $name キー名
 * @return type
 */
function chk_input($name){
    if(!empty($_GET[$name])){
        return $_GET[$name];
    }elseif (!empty($_POST[$name])) {
        return $_POST[$name];
    }else{
        return null;
    }
}

/**
 * 現在時をdatetime型で取得し返す
 * @param type
 * @return type datetime型の現在時
 */
function now(){
    $datetime =new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');
    return $date;
}
