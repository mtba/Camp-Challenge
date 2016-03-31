<?php
session_start();

if (isset($_SESSION["LastLoginDate"])){
    $lastDate = $_SESSION['LastLoginDate'];
    echo '前回のログイン日時は、' . $lastDate . 'です！';
}else {
    echo "前回のログインはありません";
}
$access_time = date('Y年m月d日 H時i分s秒');
$_SESSION['LastLoginDate'] = $access_time;
