<?php
  const LINE_BREAK = '<br>';

  $sougaku = $_GET['sougaku'];
  $kosuu = $_GET['kosuu'];
  $syubetu = $_GET['syubetu'];

  //①
  echo '商品種別：';
  if ($syubetu == 1) {
    echo '雑貨';
  }else if ($syubetu == 2) {
    echo '生鮮食品';
  }else if ($syubetu == 3) {
    echo 'その他';
  }
  echo '<br>';

  //②
  $price = $sougaku / $kosuu;
  echo "総額：$sougaku".'円<br>';
  echo "一個当たりの値段：$price".'円<br>';

  //③
  $point = 0;
  if ($sougaku >= 5000) {
    $point = $sougaku * 0.05;
  }else if ($sougaku >= 3000) {
    $point = $sougaku * 0.04;
  }
  echo $point.'ポイント';
?>
