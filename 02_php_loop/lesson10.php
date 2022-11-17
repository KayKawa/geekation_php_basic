﻿<?php
// 以下はランダムな数字を格納した配列を表示するプログラムです。
// 配列内の隣合う数字を比較して左側から小さい順に表示されるよう配列の中身を並び替えてください。
// 並び替えはfor文を使用すること

$arr = [99, 3, 12, 45, 60, 100, 31, 7, 28];

// 例）
// 4, 3, 1, 2
// ↓
// 3, 4, 1, 2
// ↓
// 3, 1, 4, 2
// ↓
// 3, 1, 2, 4
// ↓
// 1, 3, 2, 4
// ↓
// 1, 2, 3, 4　←これが画面に表示される

$arr = [99, 3, 12, 45, 60, 100, 31, 7, 28];

// ここで並び替え処理
//配列の要素の数の定義
$count_arr=count($arr);

// 10回のループ
// →0,1,2,3,4,5,6,7,8,9
for ($a=0; $a<$count_arr; $a++) {
    // 配列の要素の数 - 現在のループ回数=9回のループ
    // →9,8,7,6,5,4,3,2,1
    $asc=$count_arr-$a;
    // 一つ前の要素と比較のループ
    // 9回ループ〜１回ずつ減る
    for ($b=1; $b<$asc; $b++) {
        // 右隣の値と比較
        // 右のほうが小さければ値を入れ替える
        if ($arr[$b]<$arr[$b-1]) {
            $swap=$arr[$b];
            $arr[$b] = $arr[$b-1];
            $arr[$b-1] = $swap;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>数字並び替えプログラム</title>
</head>
<body>
<!-- ここに並び替え後を表示 -->
<?php
foreach ($arr as $num) {
    echo $num.",";
}
?>
</body>
</html>
