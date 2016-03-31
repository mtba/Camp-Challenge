<?php
$namae = isset($_POST['namae']) ? $_POST['namae'] : "";
$seibetu = isset($_POST['seibetu']) ? $_POST['seibetu'] : "";
$syumi = isset($_POST['syumi']) ? $_POST['syumi'] : "";

//空でなければクッキーを保存
if ($namae != "") {
    setcookie('namae', $namae);
}
if ($namae != "") {
    setcookie('seibetu', $seibetu);
}
if ($namae != "") {
    setcookie('syumi', $syumi);
}

echo '↓入力情報<br>';
echo '名前：'.$namae."<br/>";
echo '性別：'.$seibetu."<br/>";
echo '趣味：'.$syumi."<br/>";
?>
<p><a href="5_7form.php">入力画面へ戻る</a></p>
