<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>タスク4-0-1</title>
</head>
<body>
    <?php
    /*
     * 問1.この初期化は何を表しているか答えなさい
     * 答.初期状態は2015年1月1日0時0分0秒であるということ
     */
    $hour=0;
    $min=0;
    $sec=0;
    $month=1;
    $day=1;
    $year=2015;


    /*
     * 問2.このループにおける繰り返し条件を答えなさい
     * 答.変数$dayの値が365以下である
     *
     * 問3.このループの目的を答えなさい
     * 答.2015年の365日それぞれの日に対して処理を施すこと
     */
    while($day<=365){

        /*
         * 問4.下行の処理の動作を答えなさい
         * 答.mktimeのそれぞれのパラメータに変数を渡し、結果を$timestampに格納している
         *
         * 問5.なぜ下行のような処理を行っているのかを答えなさい
         * 答.ある日のタイムスタンプを取得し、保管するため
         */
        $timestamp = mktime($hour, $min, $sec, $month, $day, $year);


        /*
         * 問6.下行の処理の動作を答えなさい
         * 答.dateに$timestampを渡し、'm'を$now_monthに格納している
         *
         * 問7.なぜ下行のような処理を行っているのかを答えなさい
         * 答.ある日が何月に属するのかを取得し、保管するため
         */
        $now_month=date('m', $timestamp);

        /*
         * 問8.この条件分岐はどのような条件で行われているのか答えなさい
         * 答.$befor_monthの値と$now_monthの値が同じでない
         *
         * 問9.条件分岐の目的を答えなさい
         * 答.日付をプラスしていった結果、月をまたいだかどうかを判別すること
         */
        if($befor_month!=$now_month){

            /*
            * 問10.なぜ下行のような処理を行っているのかを答えなさい
            * 答.次に月をまたぐ際にも判別できるように、$befor_monthの値を現在の月に更新している
            */
            $befor_month=$now_month;

            /*
            * 問11.下行の処理の動作を答えなさい
            * 答.改行し、何月になったのかを表示し、また改行している
            */
            echo '<br>'.$now_month.'月<br>';
        }

        /*
         * 問12.下行の処理の動作を答えなさい
         * 答.$timestampの値を年月日で表示し、$timestampの値も表示。その後改行している
         *
         * 問13.なぜ下行のような処理を行っているのか答えなさい
         * 答.ある日の日付とタイムスタンプを表示するため
         */
        echo date('Y年m月d日', $timestamp).'タイムスタンプ:'.$timestamp.'<br>';

        /*
         * 問14.なぜ下行のような処理を行っているのか答えなさい
         * 答.日付を１日プラスするため
         */
        $day++;
    }

    /*
     * 問15.このプログラムは、何を目的とした処理なのかを要約して答えなさい
     * 答.2015年のすべての日において、0時0分0秒のタイムスタンプを表示すること
     *
     * 問16.このままでは本来この処理が望んでいる結果になっていない。何が問題で、どこをどう修正すべきか答えなさい
     * 答.変数$befor_monthが初期化されていないことが問題なので、whileループに入る前に$befor_month=12;と記述すればよい。
     *
     */

    ?>
</body>
</html>