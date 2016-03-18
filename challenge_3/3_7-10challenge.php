<?php
//課題７
$glo =3;
function kadai7(){
    global $glo;
    static $count =0;
    $glo *= 2;
    $count +=1;
    echo '実行回数：'.$count.'<br>';
}
for ($i=0; $i <20 ; $i++) {
    echo 'global値：'.$glo.'　';
    kadai7();
}

echo "<br><br>";

//課題８
require "util.php";
echo my_profile();
echo "<br>";
echo hannbetu(2);

echo "<br><br>";

//課題９
$satou =array(
    'id' => 20,
    '名前' => '佐藤ノブオ',
    '生年月日' => '1995/01/25',
    '住所' => 'Ｚ県Ａ市○○町'
);
$suzuki =array(
    'id' => 25,
    '名前' => '鈴木ノブユキ',
    '生年月日' => '2002/11/03',
    '住所' => 'Ａ県Ｄ市□□町'
);
$tanaka =array(
    'id' => 30,
    '名前' => '田中ヒロユキ',
    '生年月日' => '1903/02/29',
    '住所' => 'Ｂ県Ｑ市△△町'
);
$profile = array($satou, $suzuki, $tanaka);

foreach($profile as $value1) {
    foreach ($value1 as $key => $value2) {
        if ($key=='id' || $key=='住所') {
            continue;
        }
        echo $key.'：'.$value2.'<br>';
    }
    echo '<br>';
}

echo "<br><br>";

//課題１０
foreach($profile as $key1 => $value1) {
    foreach ($value1 as $key2 => $value2) {
        if ($key2=='id' || $key2=='住所') {
            continue;
        }
        echo $key2.'：'.$value2.'<br>';
    }
    if ($key1>=1) {                         //２人目以降なら
        break;                              //ループ脱出
    }
    echo '<br>';
}
