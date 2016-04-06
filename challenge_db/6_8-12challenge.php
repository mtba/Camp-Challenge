<?php

//テーブルの配列データを全表示する関数
function print_table($result){
    foreach ($result as $value) {
        foreach ($value as $key => $value2) {
            echo $key.':'.$value2.' ';
        }
        echo "<br>";
    }
    echo "<br>";
}

//ＰＤＯ作成とエラーハンドリング
try{
    $pdo_object= new PDO('mysql:host=localhost;dbname=challenge_db;charset=utf8','mtba','blue0192');
    $pdo_object->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo_object->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    //print '接続しました'.'<br><br>';
    ?>

    <html lang="ja">
      <head>
        <meta charset ="utf-8">
        <title>課題8~12</title>
        <style>
            #kadai8-10{
                float: left;
                margin-right: 20px;
            }
            #kadai11-12{
                float: left;
                margin-right: 20px;
            }
        </style>
      </head>
      <body>
          <header>
              <h1>データベース操作課題８～１２</h1>
          </header>

          <!-- 課題８ -->
          <div id="kadai8-10">
              <h2>課題８</h2>
              <form action="" method="post">
                  <input type="text" name="keyword">
                  <input type="submit" value="検索">
              </form>
              <p>検索結果↓</p>
              <?php
              $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";
              if ($keyword != "") {
                  $sql = "select * from profiles where name like ?";
                  $prepare = $pdo_object->prepare($sql);
                  $prepare -> bindValue(1,"%$keyword%");
                  $prepare -> execute();
                  $result = $prepare->fetchall(PDO::FETCH_ASSOC);
                  print_table($result);
              }else {
                  echo "なし";
              }
              ?>

              <!-- 課題９ -->
              <h2>課題９</h2>
              <form action="" method="post">
                  <table border="1">
                      <tr>
                          <th>ＩＤ：</th>
                          <td><input type="text" name="id"></td>
                      </tr>
                      <tr>
                          <th>名前：</th>
                          <td><input type="text" name="name"></td>
                      </tr>
                      <tr>
                          <th>電話番号：</th>
                          <td><input type="text" name="tell"></td>
                      </tr>
                      <tr>
                          <th>年齢：</th>
                          <td><input type="text" name="age"></td>
                      </tr>
                      <tr>
                          <th>誕生日：</th>
                          <td><input type="text" name="birth"></td>
                      </tr>
                  </table>
                  <input type="submit" value="データ追加" name="insert">
              </form>
              <?php
              if (isset($_POST['insert'])) {
                  $id = isset($_POST['id']) ? $_POST['id'] : "";
                  $name = isset($_POST['name']) ? $_POST['name'] : "";
                  $tell = isset($_POST['tell']) ? $_POST['tell'] : "";
                  $age = isset($_POST['age']) ? $_POST['age'] : "";
                  $birth = isset($_POST['birth']) ? $_POST['birth'] : "";

                  $sql = "insert into profiles( profilesID, name, tell, age,birthday) values( :id, :name, :tell, :age,:birth)";
                  $prepare = $pdo_object->prepare($sql);
                  $prepare -> bindValue(':id',$id);
                  $prepare -> bindValue(':name',$name);
                  $prepare -> bindValue(':tell',$tell);
                  $prepare -> bindValue(':age',$age);
                  $prepare -> bindValue(':birth',$birth);
                  $prepare -> execute();
              }
              ?>

              <!-- 課題１０ -->
              <h2>課題１０</h2>
              <form action="" method="post">
                  ID:<input type="text" name="del_id">
                  <input type="submit" value="削除">
              </form>
              <?php
              $del_id = isset($_POST['del_id']) ? $_POST['del_id'] : "";
              if ($del_id != "") {
                  $sql = "delete from profiles where profilesID= ?";
                  $prepare = $pdo_object->prepare($sql);
                  $prepare -> bindValue(1,$del_id);
                  $prepare -> execute();
              }
              ?>
          </div>

          <!-- 課題１１ -->
          <div id="kadai11-12">
              <h2>課題１１</h2>
              <form action="" method="post">
                  ID指定:<input type="text" name="update_id">
                  <table border="1">
                      <tr>
                          <th>名前：</th>
                          <td><input type="text" name="update_name"></td>
                      </tr>
                      <tr>
                          <th>電話番号：</th>
                          <td><input type="text" name="update_tell"></td>
                      </tr>
                      <tr>
                          <th>年齢：</th>
                          <td><input type="text" name="update_age"></td>
                      </tr>
                      <tr>
                          <th>誕生日：</th>
                          <td><input type="text" name="update_birth"></td>
                      </tr>
                  </table>
                  <input type="submit" value="データ更新" name="update">
              </form>
              <?php
              if (isset($_POST['update'])) {
                  $update_id = isset($_POST['update_id']) ? $_POST['update_id'] : "";
                  $update_name = isset($_POST['update_name']) ? $_POST['update_name'] : "";
                  $update_tell = isset($_POST['update_tell']) ? $_POST['update_tell'] : "";
                  $update_age = isset($_POST['update_age']) ? $_POST['update_age'] : "";
                  $update_birth = isset($_POST['update_birth']) ? $_POST['update_birth'] : "";

                  if ($update_id != '') {
                      $update_array = array(
                          'name' => $update_name,
                          'tell' => $update_tell,
                          'age' => $update_age,
                          'birthday' => $update_birth
                      );
                      foreach ($update_array as $key => $value) {
                          if (!empty($value)) {
                              $sql = "update profiles set $key = ? where profilesID = ?";
                              $prepare = $pdo_object->prepare($sql);
                              $prepare -> bindValue(1,$value);
                              $prepare -> bindValue(2,$update_id);
                              $prepare -> execute();
                          }
                      }
                  }else {
                      echo "IDを指定してください";
                  }
              }
              ?>

              <!-- 課題１２ -->
              <h2>課題１２</h2>
              <form action="" method="post">
                  <table border="1">
                      <tr>
                          <th>名前：</th>
                          <td><input type="text" name="select_name"></td>
                      </tr>
                      <tr>
                          <th>年齢：</th>
                          <td><input type="text" name="select_age"></td>
                      </tr>
                      <tr>
                          <th>誕生日：</th>
                          <td><input type="text" name="select_birth"></td>
                      </tr>
                  </table>
                  <input type="submit" value="検索" name="select">
              </form>
              <p>検索結果↓</p>
              <?php
              if (isset($_POST['select'])) {
                  $select_name = isset($_POST['select_name']) ? $_POST['select_name'] : "";
                  $select_age = isset($_POST['select_age']) ? $_POST['select_age'] : "";
                  $select_birth = isset($_POST['select_birth']) ? $_POST['select_birth'] : "";

                  $sql = "select * from profiles where (name like ?) and (age like ?) and (birthday like ?)";
                  $prepare = $pdo_object->prepare($sql);
                  $prepare -> bindValue(1,"%$select_name%");
                  $prepare -> bindValue(2,"%$select_age%");
                  $prepare -> bindValue(3,"%$select_birthday%");
                  $prepare -> execute();
                  $result = $prepare->fetchall(PDO::FETCH_ASSOC);
                  if (!empty($result)) {
                      print_table($result);
                  }else {
                      echo "なし";
                  }
              }else {
                  echo "なし";
              }
              ?>
          </div>

          <div id="alldata">
              <?php
              //全データを検索して表示
              echo "テーブル内の全データ↓<br>";
              $sql = "select * from profiles";
              $query = $pdo_object->query($sql);
              $result = $query->fetchall(PDO::FETCH_ASSOC);
              print_table($result)
              ?>
          </div>
      </body>
    </html>
<?php
}catch(PDOException $Exception){
 	die('接続に失敗しました<br>'.$Exception->getMessage());
}
?>
