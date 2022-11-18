<?php
namespace Player;

namespace Me;

namespace Enemy;

namespace Battle;

// デバック練習問題
// あらかじめ壊れているプログラムを用意してあります。
// コードを読みデバックしつつジャンケンゲームを完成させてください。
// 判定が勝った時のみ勝利回数を表示させてください。
// 例)
// 山田太郎はグーを出しました。
// 相手はチョキを出しました。
// 勝敗は勝ちです。
// 3回目の勝利です。

// 勝敗の結果
// $_SESSIONはスーパーグローバル変数
if (! isset($_SESSION['result'])) {
    $_SESSION['result'] = 0;
}
// じゃんけんの手
// jankenConverter関数の定義
class Player
{
    // jankenConverter関数の引数を整数型で宣言(1,2,3)
    // 返り値はstringのみ許可
    public function jankenConverter(int $choice): string
    {
        $janken = '';
        switch ($choice) {
            case 1:
                $janken = 'グー';
                break;
            case 2:
                $janken = 'チョキ';
                break;
            case 3:
                $janken = 'パー';
                break;
            default:
                break;
        }
        return $janken;
    }
}
// 自分クラス
// インスタンス→名前・手
class Me extends Player
{
    private $name;
    private $choice;

    // Meがnewされたら自動的に処理を実行__construct
    // Meがnewされたら、引数で渡された値がnameとchoiceに必ず代入される
    // $this→スコープ外で定義された変数も使える
    // ここから↓
    public function __construct(string $lastName, string $firstName, int $choice)
    {
        $this->name   = $lastName.$firstName;
        $this->choice = $choice;
    }
    // ここまで↑

    public function getName(): string
    {
        return $this->name;
    }

    public function getChoice(): string
    {
        return $this->jankenConverter($this->choice);
    }
}
// 相手CPUプレイヤー
// インスタンス→手(ランダム)
class Enemy extends Player
{
    private $choice;
    // Enemyがnewされたら自動的に処理を実行__construct
    // ここから↓
    public function __construct()
    {
        // グーチョキパーをランダムにだす
        $this->choice = random_int(1, 3);
    }
    //ここまで↑
    public function getChoice(): string
    {
        return $this->jankenConverter($this->choice);
    }
}

// バトルクラス
// インスタンス→自分の出した手、相手の出した手
class Battle
{
    private $first;
    private $second;

    // Battleがnewされたら自動的に処理を実行__construct
    // ここから↓
    public function __construct(Me $me, Enemy $enemy)
    {
        $this->first  = $me->getChoice();
        $this->second = $enemy->getChoice();
    }
    // ここまで↑
    // 返り値stringのみを許可
    private function judge(): string
    {
        if ($this->first === $this->second) {
            return '引き分け';
        }

        if ($this->first === 'グー' && $this->second === 'チョキ') {
            return '勝ち';
        }

        if ($this->first === 'グー' && $this->second === 'パー') {
            return '負け';
        }

        if ($this->first === 'チョキ' && $this->second === 'グー') {
            return '負け';
        }

        if ($this->first === 'チョキ' && $this->second === 'パー') {
            return '勝ち';
        }

        if ($this->first === 'パー' && $this->second === 'グー') {
            return '勝ち';
        }

        if ($this->first === 'パー' && $this->second === 'チョキ') {
            return '負け';
        }
        return "";
    }

    public function countVictories()
    {
        if ($this->judge() === '勝ち') {
            $_SESSION['result'] += 1;
        }
    }

    public function getVictories()
    {
        return $_SESSION['result'];
    }

    public function showResult()
    {
        return $this->judge();
    }
}

if (!empty($_POST) && !empty($_POST['choice'])) {
    $me    = new Me($_POST['last_name'], $_POST['first_name'], $_POST['choice'], $_POST['choice']);
    $enemy = new Enemy();
    echo $me->getName().'は'.$me->getChoice().'を出しました。';
    echo '<br>';
    echo '相手は'.$enemy->getChoice().'を出しました。';
    echo '<br>';
    $battle = new Battle($me, $enemy);
    echo '勝敗は'.$battle->showResult().'です。';
    if ($battle->showResult() === '勝ち') {
        session_start();
        $battle->countVictories();
        echo '<br>';
        echo $battle->getVictories().'回目の勝利です。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>デバック練習</title>
</head>
<body>
    <section>
    <form action='debug03.php' method="post">
        <label>姓</label>
        <input type="text" name="last_name" value="<?php echo '山田' ?>" />
        <label>名</label>
        <input type="text" name="first_name" value="<?php echo '太郎' ?>" />
        <select name='choice'>
            <option value=0 >--</option>
            <option value=1 >グー</option>
            <option value=2 >チョキ</option>
            <option value=3 >パー</option>
        </select>
        <input type="submit" value="送信する"/>
    </form>
    </section>
</body>
</html>
