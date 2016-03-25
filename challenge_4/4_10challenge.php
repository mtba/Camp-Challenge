<?php
//課題１０
//array_shift()とarray_push()を使用

//ログファイルに開始時間を書き込み
$fp = fopen('4-10log.txt','w');
fwrite($fp, date('Y-m-d h:i:s')." 開始"."<br>");
fclose($fp);

//寿司が回るだけ
$sushi = array("マグロ","ハマチ","ヒラメ","イクラ","イカ");
var_dump($sushi);
echo "<br>";

ob_end_flush();                 // バッファリングをオフ
for ($i=0; $i <5 ; $i++) {
    flush();                    //フラッシュする
    sleep(1);                   //１秒処理を止める
    $temp = $sushi[0];          //配列の先頭の要素を一時保存
    array_shift($sushi);        //配列の先頭の要素を取り除き、空いた分詰める
    array_push($sushi,$temp);   //保存した要素を配列の末尾に追加
    var_dump($sushi);
    echo "<br>";
}

//ログファイルに終了時間を書き込み
$fp = fopen('4-10log.txt','a');
fwrite($fp, date('Y-m-d h:i:s')." 終了");
fclose($fp);

//ログファイルを読み込み、その内容を表示
$fp = fopen('4-10log.txt','r');
echo fgets($fp);
