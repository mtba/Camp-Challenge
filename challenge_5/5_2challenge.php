<?php
$namae = isset($_POST['namae']) ? $_POST['namae'] : "";
$seibetu = isset($_POST['seibetu']) ? $_POST['seibetu'] : "";
$syumi = isset($_POST['syumi']) ? $_POST['syumi'] : "";

echo '名前：'.$namae."<br/>";
echo '性別：'.$seibetu."<br/>";
echo '趣味：'.$syumi."<br/>";
?>
