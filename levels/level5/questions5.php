<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zhīshì!</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
        <script src="question5.js"></script>
        <link rel ="stylesheet" href="style5.css">
    </head>

    <body>
        <div class="main-container">
            <div class="left-container">
                <div id="pause">Pause</div>
                <div id="timer">Time Left: 60</div>
                <div id="score">Score: 0</div>
            </div>

            <div class="container">
                <h2>Match the images with the word.</h2>
                <div class="contentContainer">
                    <div id="image"></div>
                    <div id="questionContainer">
                        <div class="questionbox">
                            <div class="box" id="emptyBox1"><span>Yǎnjīng</span></div>
                            <div class="box" id="emptyBox2"><span>Bízi</span></div>
                            <div class="box" id="emptyBox3"><span>Liǎn</span></div>      
                            <div class="box" id="emptyBox4"><span>Shǒu</span></div>
                            <div class="box" id="emptyBox5"><span>Xīgài</span></div>                    
                        </div>
                    </div>
                </div>
                
                <div id="choicesContainer">
                    <div class="choice" id="choice1"></div>
                    <div class="choice" id="choice2"></div>
                    <div class="choice" id="choice3"></div>
                    <div class="choice" id="choice4"></div>
                    <div class="choice" id="choice5"></div>
                    <div class="choice" id="choice6"></div>
                </div>

                <a id="next-button" href="../../home.php"> Submit ⟶ </a>
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