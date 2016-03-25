<?php
//課題１
echo "課題１：<br>";
$stamp = mktime(0, 0, 0, 1, 1, 2015);
echo "$stamp";
echo '<br>';

//課題２
echo "課題２：<br>";
$today = date('Y-m-d h:i:s');
echo "$today";
echo '<br>';

//課題３
echo "課題３：<br>";
$stamp = mktime(10, 0, 0, 11, 4, 2016);
$today = date('Y-m-d h:i:s',$stamp);
echo "$today";
echo '<br>';

//課題４
echo "課題４：<br>";
$stamp1 = mktime(0, 0, 0, 1, 1, 2015);
$stamp2 = mktime(23, 59, 59, 12, 31, 2015);
echo ($stamp2 - $stamp1).'秒';
echo '<br>';

//課題５
echo "課題５：<br>";
$str = '青山尚澄';
echo 'バイト数：'.strlen($str).'<br>';
echo '文字数：'.mb_strlen($str).'<br>';

//課題６
echo "課題６：<br>";
$address = 'mtba9lear@gmail.com';
echo strstr($address,'@');
echo '<br>';

//課題７
echo "課題７：<br>";
$str = 'きょUはぴIえIちぴIのくみこみかんすUのがくしゅUをしてIます';
$str = str_replace('U', 'う', $str);
$str = str_replace('I', 'い', $str);
echo $str;
echo '<br>';

//課題８
$profile = ('青山尚澄です。<br>趣味は読書です。<br>好きな作家は東野圭吾です。');
$fp = fopen('kadai8.txt','w');
fwrite($fp, $profile);
fclose($fp);

//課題９
echo "課題９：<br>";
$fp = fopen('kadai8.txt','r');
$file_txt = fgets($fp);
fclose($fp);
echo $file_txt;
