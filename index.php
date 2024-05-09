<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Load XML file
    $xml = new DOMDocument();
    $xml->load('users.xml');

    // Check if username and password match
    $users = $xml->getElementsByTagName("user");
    $valid = false;
    foreach ($users as $user) {
        if ($user->getElementsByTagName("username")[0]->nodeValue == $username && 
            $user->getElementsByTagName("password")[0]->nodeValue == $password) {
            $valid = true;
            break;
        }
    }

    if ($valid) {
        $_SESSION['username'] = $username;
        echo "success";
    } else {
        echo "Invalid username or password. Please try again.";
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="login_ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'index.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === "success") {
                            window.location.href = "home.php";
                        } else {
                            $('#error-message').text(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <form>
            <h2>PINYIN <br>CHALLENGE</br> </h2>
            <h3>Login </h3>
            <p id="error-message" style="color: red;"></p>
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Login">
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </form>
    </div>
</body>
</html>