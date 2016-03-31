<?php
$access_time = date('Y年m月d日 H時i分s秒');
setcookie('LastLoginDate', $access_time);
if (isset($_COOKIE["LastLoginDate"])){
    $lastDate = $_COOKIE['LastLoginDate'];
    echo '前回のログイン日時は、' . $lastDate . 'です！';
}else {
    echo "前回のログインはありません";
}
