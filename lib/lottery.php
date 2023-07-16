<script>
    console.log("Lottery.php is called");
</script>

<?php

// The Session Section:
{
    if (session_status() == PHP_SESSION_NONE) { // This is needed to start session variables
        session_start();
    }
    if (!isset($_SESSION['cash_earned'])) {
        $_SESSION['cash_earned'] = 0;
    };
    if (!isset($_SESSION['win_streak'])) {
        $_SESSION['win_streak'] = 0;
    };
}; {

    $reward = 10;

    if ($_SESSION['win_streak'] > 0) {
        $reward *= $_SESSION['win_streak'];
    }
};


// lottery.php

echo "this is called";

if (isset($_POST['spin'])) { // this is used to update the cash earned since $1 is fee.
    $spin_fee = 1;

    if ($_SESSION['cash_earned'] >= 1) {
        $_SESSION['cash_earned'] -= $spin_fee;
        echo $_SESSION['cash_earned'];
    } else {
        echo "Insufficient funds";
    }
    exit();
};

if (isset($_POST['final_str'])) {

    $finalStr = $_POST['final_str'];

    // Check if the string is the same.
    $char1 = mb_substr($finalStr, 0, 1);
    $char2 = mb_substr($finalStr, 1, 1);
    $char3 = mb_substr($finalStr, 2, 1);

    if ($char1 == $char2 && $char2 == $char3) {
        echo "Bingo!";
        $_SESSION['cash_earned'] += $reward;
        $_SESSION['win_streak'] += 1;
    } else {
        echo "Not the same :(";
        $_SESSION['win_streak'] = 0;
    };

    header("Location:" . "../index.php");
};
