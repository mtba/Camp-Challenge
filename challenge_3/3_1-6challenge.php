<?php
    //課題１と課題４
    function my_profile(){
        echo "名前：青山尚澄<br>";
        echo "生年月日：1991年1月12日<br>";
        echo "自己紹介：趣味は読書、好きな動物は猫です<br>";
        return true;
    }
    for ($i=0; $i <10 ; $i++) {
        my_profile();
    }
    echo "<br>";
    if (my_profile() == true) {
        echo "この処理は正しく実行できました";
    }else {
        echo "正しく実行できませんでした";
    }

    echo "<br><br>";

    //課題２
    function hannbetu($num){
        if ($num%2 == 1) {
            echo "奇数です";
        }elseif ($num%2 == 0) {
            echo "偶数です";
        }
    }
    hannbetu(11);

    echo "<br><br>";

    //課題３
    function product($num1, $num2 =5, $type =false){
        $result = $num1 * $num2;
        if ($type == false) {
            echo $result;
        }else {
            $result = $result * $result;
            echo $result;
        }
    }
    product(3);

    echo "<br><br>";

    //課題５
    function profile_satou(){
        $satou =array(
            'id' => 20,
            '名前' => '佐藤ノブオ',
            '生年月日' => '1995/01/25',
            '住所' => 'Ｚ県Ａ市○○町'
        );
        return $satou;
    }
    foreach(profile_satou() as $key => $value) {
        echo $key.'：'.$value.'<br>';
    }

    echo "<br><br>";

    //課題６
    $satou =array(
        'id' => 20,
        '名前' => '佐藤ノブオ',
        '生年月日' => '1995/01/25',
        '住所' => 'Ｚ県Ａ市○○町'
    );
    $suzuki =array(
        'id' => 25,
        '名前' => '鈴木ノブユキ',
        '生年月日' => '2002/11/03',
        '住所' => 'Ａ県Ｄ市□□町'
    );
    $tanaka =array(
        'id' => 30,
        '名前' => '田中ヒロユキ',
        '生年月日' => '1903/02/29',
        '住所' => 'Ｂ県Ｑ市△△町'
    );
    $profile = array($satou, $suzuki, $tanaka);

    function kennsaku($pro, $str){
        foreach ($pro as $value) {
            if (preg_match("/$str/", $value['名前'])) {   //引き数の文字が名前に含まれるならば
                return $value;
            }
        }
        return 0;                                  //一致しなければ0をreturn
    }

    $after_search = kennsaku($profile, 'ユキ');    //関数を実行し、結果を保持

    if ($after_search == 0) {
        echo "一致無し";
    }else {
        foreach($after_search as $key => $value) {
            echo $key.'：'.$value.'<br>';
        }
    }
