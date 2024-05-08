<?php
// Start the session (if not already started)
session_start();

// Check if username is set in the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page or handle the case where username is not set
    // For now, let's set it to an empty string
    $username = '';
}

// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Game Home</title>
    <link rel="stylesheet" type="text/css" href="home_ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>

</head>
<body>
<div class="navigation-bar">
    <div class="left-buttons">
        <form action="how-to-play.html">
            <button type="submit">How to Play</button>
        </form>
        <form action="about.html">
            <button type="submit">About</button>
        </form>
    </div>
    <div class="right-buttons">
        <form action="profile.php" method="get">
            <input type="hidden" name="user_id" value="<?php echo $username; ?>">
            <button type="submit" class="profile-button"></button>
        </form>
        <!-- Logout form -->
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</div>
<h6>PINYIN <br>CHALLENGE</br></h6>

<div>
    <script>
            $.ajax({
                url: 'levels/getLevel.php',
                method: 'GET',
                success: function(response) {
                    let level = parseInt(response);
                    if (level === 5) {
                        $(".continue-button").hide();
                    }else{
                        $(".continue-button").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching level:', error);
                    window.location.href = 'levels/level1/questions1.php';
                }
            });
    </script>

    <form action="levels/level1/questions1.php" class="play-game-button">
        <button type="submit">Play Game</button>
    </form>
    
    <form class="continue-button">
    <button type="button" >Continue</button>
        <script>
            $(document).ready(function() {
                $('.continue-button').click(function(e) {
                    e.preventDefault();
                    
                    $.ajax({
                        url: 'levels/getLevel.php',
                        method: 'GET',
                        success: function(response) {
                            let level = parseInt(response);
                            if (level >= 1 && level <= 4) {
                                window.location.href = 'levels/level' + level + '/questions' + level + '.php';
                            } else {
                                window.location.href = 'levels/level1/questions1.php';
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching level:', error);

                            window.location.href = 'levels/level1/questions1.php';
                        }
                    });
                });
            });
        </script>
    </form>
</div>

<div class="container">
    <div class="statistics">
        <p>Hello, <?php echo $username !== '' ? $username : 'Guest'; ?>!</p>
        <p>Statistics:</p>
        <ul>
            <li id="score1">Level 1: <span>Loading...</span></li>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'levels/getScore.php',
                            method: 'GET',
                            success: function(response) {
                                $('#score1 span').text(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching score1:', error);
                            }
                        });
                    });
                </script>
            <li id="score2">Level 2: <span>Loading...</span></li>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'levels/getScore2.php',
                            method: 'GET',
                            success: function(response) {
                                $('#score2 span').text(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching score2:', error);
                            }
                        });
                    });
                </script>
            <li id="score3">Level 3: <span>Loading...</span></li>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'levels/getScore3.php',
                            method: 'GET',
                            success: function(response) {
                                $('#score3 span').text(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching score3:', error);
                            }
                        });
                    });
                </script>
            <li id="score4">Level 4: <span>Loading...</span></li>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'levels/getScore4.php',
                            method: 'GET',
                            success: function(response) {
                                $('#score4 span').text(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching score4:', error);
                            }
                        });
                    });
                </script>
            <li id="score5">Level 5: <span>Loading...</span></li>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'levels/getScore5.php',
                            method: 'GET',
                            success: function(response) {
                                $('#score5 span').text(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching score5:', error);
                            }
                        });
                    });
                </script>
        </ul>
    </div>
</div>

<!-- Modal for How to Play -->
<div id="how-to-play-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>How to Play</h2>
        <p>Welcome to the Guess the Picture game!</p>
        <p>In this game, you will be presented with a picture, and below it, there will be a set of random letters. Your task is to guess the correct word that matches the picture by arranging the letters in the correct order.</p>
        <p>To play the game:</p>
        <ol>
            <li>Drag the letters to the boxes below the picture to form a word that describes the picture.</li>
            <li>If you place the correct letters in the correct order, they will stay in the boxes.</li>
            <li>If you place an incorrect letter or arrange the letters incorrectly, they will revert back to their original position.</li>
            <li>Complete the word to proceed to the next picture.</li>
            <li>You win the game by correctly guessing all the words.</li>
        </ol>
        <p>Enjoy playing and have fun!</p>
    </div>
</div>

<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JavaScript for modal functionality -->
<script>
    $(document).ready(function() {
        // Get the modal
        var modal = document.getElementById("how-to-play-modal");

        // Get the button that opens the modal
        var btn = document.getElementById("how-to-play-button");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>
</body>
</html>
