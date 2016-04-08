<?php
require_once '../common/defineUtil.php';

function return_top(){
  //課題１ トップページへのリンクを渡すように修正
  return "<a href='".TOP_URL."'>トップページへ戻る</a>";
}

//session破棄関数を追加
function delete_session(){
    session_unset();
    if (isset($_COOKIE['PHPSESSID'])) {
        setcookie('PHPSESSID', '', time() - 1800, '/');
    }
    session_destroy();
}
