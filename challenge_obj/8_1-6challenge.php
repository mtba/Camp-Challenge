<?php

try{
    $pdo_object= new PDO(
        'mysql:host=localhost;dbname=challenge_db;charset=utf8',
        'mtba',
        'blue0192',
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        )
    );

    //テーブルの存在を確認する関数
    function table_check($tb_name,$pdo){
        $result =$pdo->query("SHOW TABLES");
        $table = $result->fetchAll(PDO::FETCH_COLUMN);
        if(in_array($tb_name,$table)){
            return true;
		}
        return false;
    }

    //課題１
    if(!table_check('human',$pdo_object)){   //humanテーブルが存在しなければ作成
        $sql = "CREATE TABLE human(
            profileID int,
            name varchar(255),
            tell varchar(255),
            age int,
            birthday date
        )";
        $pdo_object->exec($sql);
        $sql = "INSERT INTO human values
            (1,'田中 実','012-345-6789',30,'1994-02-01'),
            (2,'鈴木 茂','090-1122-3344',37,'1987-08-01'),
            (3,'鈴木 実','080-5566-7788',24,'2000-12-24'),
            (4,'佐藤 清','012-0987-6543',19,'2005-08-01'),
            (5,'高橋 清','090-9900-1234',24,'2000-12-24')";
        $pdo_object->exec($sql);
        echo "humanテーブルを作成しました<br>";
    }else {
        echo "humanテーブルは既に存在します<br>";
    }

    //課題２
    if(!table_check('station',$pdo_object)){   //stationテーブルが存在しなければ作成
        $sql = "CREATE TABLE station(
            stationID int,
            stationName varchar(255)
        )";
        $pdo_object->exec($sql);
        $sql = "INSERT into station values
            (1,'九段下'),
            (2,'永田町'),
            (3,'渋谷'),
            (4,'神保町'),
            (5,'上井草')";
        $pdo_object->exec($sql);
        echo "stationテーブルを作成しました<br>";
    }else {
        echo "stationテーブルは既に存在します<br>";
    }

    //課題３～６
    abstract class base{
        protected $table ='';
        protected $result =array();
        abstract protected function load();
        public function show(){
            if ($this->result) {
                foreach ($this->result as $value) {
                    foreach ($value as $key => $value2) {
                        echo $key.':'.$value2.' ';
                    }
                    echo "<br>";
                }
            }else {
                echo "テーブルのデータをロードしていません<br>";
            }
        }
    }

    class Human extends base{
        function __construct(){
            $this->table ='human';
        }
        //テーブルの全データを$resultに格納する関数
        function load(){
            global $pdo_object;
            $sql = "SELECT * from `{$this->table}`";
            $query = $pdo_object->query($sql);
            $this->result = $query->fetchall(PDO::FETCH_ASSOC);
        }
    }

    class Station extends base{
        function __construct(){
            $this->table ='station';
        }
        function load(){
            global $pdo_object;
            $sql = "SELECT * from `{$this->table}`";
            $query = $pdo_object->query($sql);
            $this->result = $query->fetchall(PDO::FETCH_ASSOC);
        }
    }


    $human = new Human;
    $station = new Station;
    $human->load();
    $station->load();
    $human->show();
    $station->show();

}catch(PDOException $Exception){
 	die('接続に失敗しました<br>'.$Exception->getMessage());
}

$pdo_object = null;
