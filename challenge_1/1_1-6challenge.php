<?php
  echo 'Hello world !!'; //課題１
  echo '<br><br>';

  echo 'groove'.'-'.'gear'; //課題２
  echo '<br><br>';

?>
<!-- 課題３ -->
青山尚澄と申します。<br>趣味は読書、好きな食べ物はかつ丼です。<br>よろしくお願いします。
<br><br>
<?php
  //課題４
  const CON = 5;
  $var = 3;
  $sum = $var + CON;
  $dif = $var - CON;
  $pro = $var * CON;
  $quo = $var / CON;

  //課題５
  echo "$var + ".CON." = $sum<br>";
  echo "$var - ".CON." = $dif<br>";
  echo "$var * ".CON." = $pro<br>";
  echo "$var / ".CON." = $quo<br><br>";

  //課題６
  $num = 'b';
  if ($num == 1) {
    echo '１です！';
  }else if ($num == 2) {
    echo 'プログラミングキャンプ！';
  }else if ($num == 'a') {
    echo '文字です！';
  }else {
    echo 'その他です！';
  }
?>
