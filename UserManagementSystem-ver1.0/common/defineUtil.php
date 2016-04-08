<?php
const ROOT_URL       = 'http://localhost/matome/app'; //indexディレクトリへのURL
//課題１ TOP_URLを編集↓
const TOP_URL        = 'index.php';             //トップページ
const INSERT         = 'insert.php';            //登録ページ
const INSERT_CONFIRM = 'insert_confirm.php';    //登録確認ページ
const INSERT_RESULT  = 'insert_result.php';     //登録完了ページ
const SEARCH         = 'search.php';            //検索ページ

//DB系の定数化
const DB_TYPE     = 'mysql';            //データベースの種類
const DB_HOST     = 'localhost';        //ホスト名
const DB_DBNAME   = 'challenge_db';     //データベース名
const DB_CHARSET  = 'utf8';             //文字コード
const DB_USER     = 'root';             //ユーザ
const DB_PWD      = '';                 //パスワード
const DB_TBL_USER = 'user_t';           //テーブル名
