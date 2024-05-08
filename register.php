<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation: Ensure all fields are filled
    if (empty($full_name) || empty($username) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
    } elseif ($password !== $confirm_password) { // Validation: Confirm password match
        echo "Password and Confirm Password do not match.";
    } else {
        // Load XML file
        $xmlFilePath = 'users.xml';
        $xml = new DOMDocument();
        if (file_exists($xmlFilePath) && filesize($xmlFilePath) > 0) {
            $xml->load($xmlFilePath);
        } else {
            // Create a new XML structure if file doesn't exist or empty
            $xml->appendChild($xml->createElement('users'));
        }

        // Check if username already exists
        $users = $xml->getElementsByTagName("user");
        $userExists = false;
        foreach ($users as $user) {
            if ($user->getElementsByTagName("username")[0]->nodeValue == $username) {
                $userExists = true;
                break;
            }
        }

        if ($userExists) {
            echo "Username already exists. Please choose a different one.";
        } else {
            // Create a new user element
            $user = $xml->createElement("user");
            $user->appendChild($xml->createElement("full_name", $full_name));
            $user->appendChild($xml->createElement("username", $username));
            $user->appendChild($xml->createElement("password", $password));

            // Create scores element and child elements with default value 0
            $user->appendChild($xml->createElement("level"));
            $scores = $xml->createElement("scores");
            $scores->appendChild($xml->createElement("score1", "0"));
            $scores->appendChild($xml->createElement("score2", "0"));
            $scores->appendChild($xml->createElement("score3", "0"));
            $scores->appendChild($xml->createElement("score4", "0"));
            $scores->appendChild($xml->createElement("score5", "0"));
            $user->appendChild($scores);

            // Append the new user to the XML structure
            $xml->documentElement->appendChild($user);
            // Save XML file
            $xml->formatOutput = true;
            $xml->save($xmlFilePath);

            echo "success";
        }
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="register_ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'register.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === "success") {
                            window.location.href = "login.php";
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
        <h4>PINYIN <br>CHALLENGE</br> </h4>
        <h5>Register</h5>
        <p id="error-message" style="color: red;"></p>
        <form>
            <input type="text" name="full_name" placeholder="Full Name" required><br><br>
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br><br>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>