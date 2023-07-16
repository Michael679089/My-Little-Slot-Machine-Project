<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Scripts -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="lib/script.js" defer></script>

    <title>Lottery Machine</title>
</head>


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



?>

<body>

    <header class="p-10 bg-blue-100 bg-opacity-60">
        <div class="flex flex-col md:grid md:grid-cols-2 grid-flow-col gap-4 justify-items-center">
            <div class="justify-self-start text-center font-medium text-2xl">
                Michael's Web App Toys
            </div>
        </div>
    </header>

    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-20 items-center justify-center gap-y-5 flex-col">



            <div class="grid grid-cols-3 p-10 bg-gray-50 rounded border border-black">
                <div class="col-span-3 p-5 text-center bg-white">
                    <p>Three same emojis = $<?php echo $reward ?></p>
                    <?php
                    if ($_SESSION['win_streak'] > 1) {
                        echo "<p>Win streak multiplier = reward = $10 * " . $_SESSION['win_streak'] . "  </p>";
                    };
                    ?>
                </div>
                <div id="first" class="m-5 p-10 text-lg md:text-3xl text-center rounded-md border border-black bg-white"></div>
                <div id="second" class="m-5 p-10 text-lg md:text-3xl text-center rounded-md border border-black bg-white"></div>
                <div id="third" class="m-5 p-10 text-lg md:text-3xl text-center rounded-md border border-black bg-white"></div>
            </div>

            <button id="spin" class='p-5 rounded-lg bg-green-100'>Spin the machine</button>


            <div class="text-center lg:w-2/3 w-full">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">A simple slot machine simulation</h1>
                <p class="mb-8 leading-relaxed">A slot machine where each symbol randomly iterates in a emoji.json file. (From left to right) The first symbol is the quickest to stop, while the last symbol will be the last to stop. Added gamification to make it interesting such as money earned (#) and win streak multiplier. </p>
                <div class="flex justify-center">
                </div>
            </div>

            <!-- Info about how much money earned and win streak -->
            <div class="grid grid-cols-4">
                <div class="col-span-3 p-5 rounded bg-gray-100 text-center">
                    <div class="text-xl font-bold">You earned this much money during this session</div>
                    <div class="py-10 text-3xl font-bold">$<?php echo $_SESSION['cash_earned']; ?></div>
                </div>
                <div class="col-span-1 justify-self-center p-5 rounded bg-gray-100 text-center">
                    <div class="text-xl font-bold">
                        Win Streak
                    </div>
                    <div id='win_streak' class="py-10 text-3xl font-bold">
                        <?php echo $_SESSION['win_streak']; ?>
                    </div>
                </div>
            </div>

            <p class="text-center font-bold"> Scroll down for more info. </p>

        </div>
    </section>

    <section class="m-10 p-5">
        <div id="hidden-div">

            <?php
            echo "<p class='font-bold text-xl'> From the README.md </p>";
            require("lib/parsedown/vendor/autoload.php");
            $parsedown = new Parsedown();

            $file = fopen('README.md', 'r');
            echo $parsedown->text(fread($file, filesize('README.md')));
            ?>

        </div>
    </section>



</body>

</html>