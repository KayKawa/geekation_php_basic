﻿<?php
// 以下をfor文を使用して表示してください。

// 6
// 54
// 321
$c=6;
for ($a=1; $a<=3; $a++) {
    for ($b=1; $b<=$a; $b++) {
        echo $c;
        $c--;
    }
    echo "\n";
}
