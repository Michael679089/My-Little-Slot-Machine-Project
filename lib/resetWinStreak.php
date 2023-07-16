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

$_SESSION['win_streak'] = 0;
