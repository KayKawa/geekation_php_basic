<?php
// 以下配列の中身をfor文を使用して表示してください。
// 表示はHTMLの<table>タグを使用すること

/**
 * 表示イメージ
 *  _________________________
 *  |_____|_c1|_c2|_c3|横合計|
 *  |___r1|_10|__5|_20|___35|
 *  |___r2|__7|__8|_12|___27|
 *  |___r3|_25|__9|130|__164|
 *  |縦合計|_42|_22|162|__226|
 *  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
 */

$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>テーブル表示</title>
<style>
table {
    border:1px solid #000;
    border-collapse: collapse;
}
th, td {
    border:1px solid #000;
}
</style>
</head>
<body>
    <?php
// 行の合計
    $x_total = [
    'r1' => array_sum($arr['r1']),
    'r2' => array_sum($arr['r2']),
    'r3' => array_sum($arr['r3']),
    ];
// 列の合計
    $y_total = [
    'c1' => array_sum(array_column($arr, 'c1')),
    'c2' => array_sum(array_column($arr, 'c2')),
    'c3' => array_sum(array_column($arr, 'c3')),
    ];
// 合計
    // 繰り返し処理の外側でtotalを足していく
    $total = 0;
    foreach ($y_total as $y_num) {
        $total = $total + $y_num;
    }
    ?>
<!------ ここからテーブル表示 ------>
    <table>
    <?php
// １行目
    echo "<tr><td></td>";
    for ($c_num=1; $c_num<=3; $c_num++) {
        $c = 'c'. $c_num;
        echo "<td>".$c."</td>";
    }
    echo "<td>横合計</td></tr>";

// r1からr3を表示
    for ($r_num=1; $r_num<=3; $r_num++) {
        $r = "r".$r_num;
        echo "<tr><td>".$r."</td>";
// １行ずつcの値を表示
        for ($c_num=1; $c_num<=3; $c_num++) {
            $c='c'.$c_num;
            echo "<td>{$arr[$r][$c]}</td>";
        }
// 横合計を表示
        echo "<td>{$x_total[$r]}</td></tr>";
    }

// 縦の値の合計を３回繰り返して縦合計を表示
    echo "<tr><td>縦合計</td>";
    for ($num=1; $num<=3; $num++) {
        $c = "c".$num;
        echo "<td>{$y_total[$c]}</td>";
    }

// 合計を表示
    echo "<td>{$total}</td></tr>";
    ?>
</table>
</body>
</html>
