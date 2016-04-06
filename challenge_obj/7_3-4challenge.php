<?php

//課題３
class Color{
    public $red='0';
    public $green='0';
    public function yellow(){
        $this->red ='f';
        $this->green ='f';
    }
    public function parcentage(){
        echo '赤：緑 = '.$this->red.'：'.$this->green.'<br>';
    }
}

//課題４
class Color2 extends Color {
    public function clear(){
        $this->red ='';
        $this->green ='';
    }
}


$color = new Color2();
$color->parcentage();
$color->yellow();
$color->parcentage();
$color->clear();
$color->parcentage();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset ="utf-8">
    <title>課題３、４</title>
  </head>
  <body style="background-color:#<?php echo $color->red.$color->green;?>0;">
    
  </body>
</html>
