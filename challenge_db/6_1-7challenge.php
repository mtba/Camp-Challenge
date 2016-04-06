<?php
//テーブルの配列データを全表示する関数
function print_table($result){
    foreach ($result as $value) {
        foreach ($value as $key => $value2) {
            echo $key.':'.$value2.' ';
        }
        echo "<br>";
    }
    echo "<br>";
}

//課題1
echo "課題１<br>";
try{
    $pdo_object= new PDO('mysql:host=localhost;dbname=challenge_db;charset=utf8','mtba','blue0192');
    $pdo_object->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo_object->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    print '接続しました'.'<br><br>';

    //課題2
    $sql = "INSERT INTO profiles VALUES (:ID,:name,:tell,:age,:birth)";
    $query = $pdo_object->prepare($sql);
    $query -> bindValue(':ID',20);
    $query -> bindValue(':name','山田 茂');
    $query -> bindValue(':tell','090-1111-1111');
    $query -> bindValue(':age',25);
    $query -> bindValue(':birth','1998-04-01');
    $query -> execute();

    //課題3
    echo "課題３<br>";
    $sql_s_all = "select * from profiles";
    $query = $pdo_object->query($sql_s_all);
    $result = $query->fetchall(PDO::FETCH_ASSOC);
    print_table($result);

    //課題４
    echo "課題４<br>";
    $sql = "select * from profiles where profilesID=1";
    $query = $pdo_object->query($sql);
    $result = $query->fetchall(PDO::FETCH_ASSOC);
    print_table($result);

    //課題５
    echo "課題５<br>";
    $sql = "select * from profiles where name like '%茂%'";
    $query = $pdo_object->query($sql);
    $result = $query->fetchall(PDO::FETCH_ASSOC);
    print_table($result);

    //課題６
    echo "課題６<br>";
    $sql = "delete from profiles where profilesID=20";
    $pdo_object->exec($sql);

    $query = $pdo_object->query($sql_s_all);
    $result = $query->fetchall(PDO::FETCH_ASSOC);
    print_table($result);

    //課題７
    echo "課題７<br>";
    $sql = "update profiles set name='松岡 修造', age=48, birthday='1967-11-06' where profilesID=1";
    $query = $pdo_object->exec($sql);

    $query = $pdo_object->query($sql_s_all);
    $result = $query->fetchall(PDO::FETCH_ASSOC);
    print_table($result);

}catch(PDOException $Exception){
 	die('接続に失敗しました<br>'.$Exception->getMessage());
}
?>
