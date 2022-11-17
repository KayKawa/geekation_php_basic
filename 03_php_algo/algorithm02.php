<?php
// ＜アルゴリズムの注意点＞
// アルゴリズムではこれまでのように調べる力ではなく物事を論理的に考える力が必要です。
// 検索して答えを探して解いても考える力には繋がりません。
// まずは検索に頼らずに自分で処理手順を考えてみましょう。


// 以下は自動販売機のお釣りを計算するプログラムです。
// 150円のお茶を購入した際のお釣りを計算して表示してください。
// 計算内容は関数に記述し、関数を呼び出して結果表示すること
// $yen と $product の金額を変更して計算が合っているか検証を行うこと

// 表示例1）
// 10000円札で購入した場合、
// 10000円札x0枚、5000円札x1枚、1000円札x4枚、500円玉x1枚、100円玉x3枚、50円玉x1枚、10円玉x0枚、5円玉x0枚、1円玉x0枚

// 表示例2）
// 100円玉で購入した場合、
// 50円足りません。

$yen = 9999;   // 購入金額
$product = 1; // 商品金額

function calc($yen, $product)
{
    // 貨幣の配列
    $money = [10000, 5000, 1000, 500, 100, 50, 10, 5, 1];
    // お釣り 支払金額 - 商品の金額
    $change = $yen - $product;
    // もし、お釣りが発生したら処理実行
    if ($change > 0) {
        // お釣りを貨幣別に代入する為の空の配列
        $change_list = [];
        // 貨幣の種類(9種)の数分ループする
        foreach ($money as $value) {
            // 貨幣の種類をキーとして、値を代入
            // intdivでお釣りを貨幣の金額で割る
            // 戻り値がint型の為、小数点以下は切り捨て
            $change_list[$value] = intdiv($change, $value);
            // 残りのお釣りを更新
            $change = $change % $value;
        }
        // お釣りの貨幣別リストをreturn
        return $change_list;
    }
    return $change;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>お釣り</title>
</head>
<body>
    <section>
        <!-- ここに結果表示 -->
    <?php
    $result = calc($yen, $product);
    // もし、お釣りがあれば change_list
    if (is_array($result)) {
        echo "お釣り";
    // 配列$change_listからforeachで金額と枚数を順番に出力
        foreach ($result as $key => $value) {
            echo $key.'円 x '.$value.'<br>';
        }
    // お釣りがない場合
    } elseif ($result == 0) {
        echo 'お釣りは0円です';
    // お釣り$changeがマイナスの場合(支払金額が足りない場合)
    } elseif ($result < 0) {
    // absで負の整数を正の整数へ変換
        echo  abs($result) . '円足りません。';
    }
    ?>
    </section>
</body>
</html>
