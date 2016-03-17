<?php
  //課題１
  $num =3;
  switch ($num) {
    case 1:
      echo "one";
      break;
    case 2:
      echo "two";
      break;
    default:
      echo "想定外";
      break;
  }

  echo "<br><br>";

  //課題２
  $value ='Ａ';
  switch ($value) {
    case 'Ａ':
      echo "英語";
      break;
    case 'あ':
      echo "日本語";
  }

  echo "<br><br>";

  //課題３
  $num =8;
  for($i=0; $i<20; $i++){
    $num = $num *8;
    echo $num."<br>";
  }

  echo "<br>";

  //課題４
  $value ='';
  for($i=0; $i<30; $i++){
    $value .= "A";
  }
  echo "$value";

  echo "<br><br>";

  //課題５
  $num = 0;
  for ($i=1; $i<=100; $i++) {
    $num += $i;
  }
  echo $num;

  echo "<br><br>";

  //課題６
  $num = 1000;
  while ($num >= 100) {
    $num /= 2;
    echo $num."<br>";
  }

  echo "<br>";

  //課題７
  $arr = array(10, 100, 'soeda', 'hayashi', -20, 118, 'END');
  var_dump($arr);

  echo "<br><br>";

  //課題８
  $arr[2] = 33;
  var_dump($arr);

  echo "<br><br>";

  //課題９
  $rensou = array(
    1       => 'AAA',
    'hello' => 'world',
    'soeda' => 33,
    20      => 20,
  );
  var_dump($rensou);
