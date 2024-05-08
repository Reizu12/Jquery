<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zhīshì!</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
        <script src="question1.js"></script>
        <link rel ="stylesheet" href="style1.css">
    </head>

    <body>
        <div class="main-container">
            <div class="left-container">
                <div id="pause">Pause</div>
                <div id="timer">Time Left: 60</div>
                <div id="score">Score: 0</div>
            </div>

            <div class="container">
                <h2>Translate the missing word in Mandarin</h2>
                <div class="contentContainer">
                    <div id="image"></div>
                    <div id="questionContainer">
                        <div id="englishText"><p>How are you?</p></div>
                        <div class="questionbox"><p id="questionText">Nǐ hǎo </p>
                            <div id="emptyBox"></div>
                            <p id="questionText">?</p>
                        </div>
                    </div>
                </div>

                <div id="choicesContainer">
                    <div class="choice" id="choice1">Ma</div>
                    <div class="choice" id="choice2">Me</div>
                    <div class="choice" id="choice3">Mi</div>
                    <div class="choice" id="choice4">Mo</div>
                    <div class="choice" id="choice5">Mu</div>
                    <div class="choice" id="choice6">Muh</div>
                </div>

                <a id="next-button"> Next ⟶ </a>
            </div>
        </div>

        <div class="controls-container">
            <p id="result"></p>
            <button id="start">Start Game</button>
        </div>

        <div class="menu-container">
            <p>Game Paused</p>
            <div id="pauseImage"></div>
            <button id="resume">Resume</button>
            <button id="restart">Restart</button>
            <button id="home">Quit</button>
        </div>
    </body>
</html>