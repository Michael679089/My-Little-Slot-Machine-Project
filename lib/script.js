console.log("script.js was called.");

// Get the HTML elements with the ids "first", "second", and "third"
let firstID = document.querySelector("#first");
let secondID = document.querySelector("#second");
let thirdID = document.querySelector("#third");

// Note: fetch is an asynchronous operation.
// This will activate at the start of the program.
fetch('lib/emoji.json')
    .then(response => response.json())
    .then(data => {
        var emojis = data.symbols;

        // Randomly select an emoji from the array
        let randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];
        firstID.innerText = randomEmoji;
        randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];
        secondID.innerText = randomEmoji;
        randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];
        thirdID.innerText = randomEmoji;
    });

document.getElementById("spin").addEventListener("click", function () {
    console.log("The spin button has been clicked.");

    // Get the emoji's in the json file
    let emojis;
    fetch('lib/emoji.json')
        .then(response => response.json())
        .then(data => {
            emojis = data.symbols;
        });

    function randomEmoji() {
        if (!emojis) {
            throw new Error("Emojis not loaded yet");
        }
        return emojis[Math.floor(Math.random() * emojis.length)];
    };

    function startUpdating(id, stopTime) {
        let element = document.getElementById(id);
        let intervalId = setInterval(() => {
            element.innerText = randomEmoji();
        }, 50);

        document.getElementById("spin").classList.add("hidden");

        setTimeout(() => {
            clearInterval(intervalId);
        }, stopTime);
    };

    function startTimers(callback, totalTime) {
        let IDs = ["first", "second", "third"];
        let increment = totalTime / (IDs.length + 1);

        for (let i = 0; i < IDs.length; i++) {
            let stopTime = increment * (i + 1);
            console.log(stopTime);
            startUpdating(IDs[i], stopTime);
        };

        // Call the callback function after totalTime
        setTimeout(callback, totalTime);
    };


    startTimers(() => {
        // This is your callback function. Put the code you want to run after 30 seconds here.

        document.getElementById("spin").classList.remove("hidden");

        var finalStr = "";

        finalStr += firstID.innerText;
        finalStr += secondID.innerText;
        finalStr += thirdID.innerText;

        console.log(finalStr);

        if (firstID.innerText === secondID.innerText && secondID.innerText === thirdID.innerText) { // Check if the text of the firstID, secondID, and thirdID elements are equal


            // Create a form element for the finalStr to be passed to:
            let form = document.createElement('form');
            form.method = 'post';
            form.action = 'lib/lottery.php';

            let input = document.createElement('input'); // Create a hidden input element
            input.type = 'hidden';
            input.name = 'final_str';
            input.value = finalStr;

            form.appendChild(input); // Append the input element to the form

            document.body.appendChild(form); // Append the form to the body

            form.submit(); // Submit the form
        } else {
            console.log("The text of the first, second, and third emoji aren't the same.");

            let formData = new FormData();
            formData.append('final_str', finalStr);

            fetch('lib/lottery.php', {
                method: 'POST',
                body: formData
            })
                .then(() => {
                    document.getElementById('win_streak').innerText = 0;
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

        };
    }, 1000);
});

window.addEventListener("scroll", function () {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        document.getElementById('hidden-div').classList.remove('hidden');
    } else if (window.scrollY <= 0.1 * window.innerHeight) {
        document.getElementById('hidden-div').classList.add('hidden');
    }
});
