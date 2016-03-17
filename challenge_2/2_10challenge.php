<?php
  $num = $_GET['param'];    //クエリストリングで値を取得

  echo '元の値：'.$num.'<br>';

  $sosuu = array(); //素数を格納する配列
  $i = 0;           //$sosuuの配列番号
  if ($num != 0){
    while (($num%2) == 0) {
        $num/=2;
        $sosuu[$i] = 2;
        $i++;
    }
    while (($num%3) == 0) {
        $num/=3;
        $sosuu[$i] = 3;
        $i++;
    }
    while (($num%5) == 0) {
        $num/=5;
        $sosuu[$i] = 5;
        $i++;
    }
    while (($num%7) == 0) {
        $num/=7;
        $sosuu[$i] = 7;
        $i++;
    }
  }

  echo "1ケタの素因数：";
  foreach ($sosuu as $value) {
    echo $value." ";
  }
  if (($num != 1) && ($num != 0)) {
    echo "<br>";
    echo "その他：".$num;
  }
