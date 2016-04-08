<?php

require_once '7_5challenge-define.php';

class Operate_DB{
    private $pdo = null;

    public function __construct(){
        try {
            $dsn = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_DBNAME . ';charset=utf8';
            $this->pdo = new PDO($dsn, DB_USER, DB_PWD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $err) {
            echo $err->getMessage();
            exit;
        }
    }

    public function pdo_select($sql, $params=array()) {
        try{
            $stmt = $this->pdo->prepare($sql);
            foreach($params as $key=>$val) {
                $stmt->bindValue($key, $val);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $err) {
            echo $err->getMessage();
            exit;
        }

    }

    public function pdo_insert($sql, $params=array()) {
        try{
            $stmt = $this->pdo->prepare($sql);
            foreach($params as $key=>$val) {
                $stmt->bindValue($key, $val);
            }
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $err) {
            echo $err->getMessage();
            exit;
        }
    }

    public function __destruct(){
        $this->pdo = null;
    }
}

function session_chk(){
    $period_time = 300;
    session_start();
    if(!empty($_SESSION['last_access'])){
        if((mktime() - $_SESSION['last_access']) > $period_time){
            echo '<meta http-equiv="refresh" content="0;URL='.REDIRECT.'?mode=timeout">';
            logout_s();
            exit;
        }else{
            $_SESSION['last_access']=mktime();
        }
    }else{
        echo '<meta http-equiv="refresh" content="0;URL='.REDIRECT.'">';
        exit;
    }
}

function logout_s(){
    session_unset();
    if (isset($_COOKIE['PHPSESSID'])) {
        setcookie('PHPSESSID', '', time() - 1800, '/');
    }
    session_destroy();
}
