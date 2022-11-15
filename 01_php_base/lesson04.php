<?php
// 連想配列の要素name, age, genderに
// 山田,20,女性
// という値を格納し、

// 山田
// 20歳・女性

// という形で出力してください。
$people = ['name' => '山田', 'age' => 20, 'gender' => '女性'];
echo $people['name']."\n";
echo $people['age']."歳 ".$people['gender'];
