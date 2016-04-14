<?php
const ROOT_URL = 'http://localhost/matome/app';     //indexディレクトリへのURL
//TOPのURLを編集↓
const TOP_URL        = 'index.php';          //トップページ
const INSERT         = 'insert.php';         //登録ページ
const INSERT_CONFIRM = 'insert_confirm.php'; //登録確認ページ
const INSERT_RESULT  = 'insert_result.php';  //登録完了ページ
const SEARCH         = 'search.php';         //検索ページ
const SEARCH_RESULT  = 'search_result.php';  //検索結果ページ
const RESULT_DETAIL  = 'result_detail.php';  //検索詳細ページ
const DELETE         = 'delete.php';         //検索詳細ページ
const DELETE_RESULT  = 'delete_result.php';  //検索詳細ページ
const UPDATE         = 'update.php';         //検索詳細ページ
const UPDATE_RESULT  = 'update_result.php';  //検索詳細ページ

const DB_TYPE     = 'mysql';            //データベースの種類
const DB_HOST     = 'localhost';        //ホスト名
const DB_DBNAME   = 'challenge_db';     //データベース名
const DB_CHARSET  = 'utf8';             //文字コード
const DB_USER     = 'root';             //ユーザ
const DB_PWD      = '';                 //パスワード
const DB_TBL_USER = 'user_t';           //テーブル名

const BAD_ACCESS = '<h1>不正なアクセスです</h1><p>もう一度トップページからやり直してください</p>';
const BAD_INPUT  = '<h1>入力項目が不完全です</h1><p>再度入力を行ってください</p><h3>不完全な項目</h3>';
const NON_DATE   = '<p>その日付は存在しません</p><p>再度入力を行ってください</p>';
