<?php
session_start();

if (!isset($_SESSION['username'])) {
    // User not logged in
    http_response_code(401); // Unauthorized
    exit('Error: User not authenticated');
}

// Define the path to the XML file (relative to the current directory)
$xmlFilePath = 'users.xml';

// Load users.xml
$xml = simplexml_load_file($xmlFilePath);
if ($xml === false) {
    // Error loading XML file
    http_response_code(500); // Internal Server Error
    exit('Error: Unable to load user data');
}

$username = $_SESSION['username'];

// Retrieve user data
$userData = null;
foreach ($xml->user as $user) {
    if ((string)$user->username === $username) {
        $userData = [
            'username' => (string)$user->username,
            'full_name' => (string)$user->full_name,
            'password' => (string)$user->password // Include password field
        ];
        break;
    }
}

if (!$userData) {
    // User not found
    http_response_code(404); // Not Found
    exit('Error: User not found');
}

// If the request is POST, handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (!isset($_POST['new_username'], $_POST['new_full_name'], $_POST['present_password'], $_POST['new_password'])) {
        http_response_code(400); // Bad Request
        exit('Error: All form fields are required.');
    }

    // Handle form submission to update user profile
    $newUsername = $_POST['new_username'];
    $newFullName = $_POST['new_full_name'];
    $newPassword = $_POST['new_password'];
    $presentPassword = $_POST['present_password'];

    // Check if the present password matches the user's current password
    if (!empty($newPassword) && $presentPassword !== $userData['password']) {
        // Present password does not match
        http_response_code(400); // Bad Request
        exit('Error: Present password is incorrect');
    }

    // Update user profile data
    foreach ($xml->user as $user) {
        if ((string)$user->username === $username) {
            $user->full_name = $newFullName;
            // Update password only if a new password is provided
            if (!empty($newPassword)) {
                $user->password = $newPassword;
            }
            break;
        }
    }

    // Update username if it's different from the current one
    if ($newUsername !== $username) {
        $user->username = $newUsername;
        $_SESSION['username'] = $newUsername; // Update session variable
    }

    // Save changes to users.xml
    $xml->asXML($xmlFilePath);

    // Provide response
    echo 'success';
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="edit_profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="profile-section">
        <h1>Edit Profile</h1>
        <form id="edit-profile-form">
            <label for="new-username">New Username:</label>
            <input type="text" id="new-username" name="new_username" value="<?php echo $userData['username']; ?>"><br>
            <label for="new-full-name">New Full Name:</label>
            <input type="text" id="new-full-name" name="new_full_name" value="<?php echo $userData['full_name']; ?>"><br>
            <label for="present-password">Present Password:</label>
            <input type="password" id="present-password" name="present_password"><br>
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new_password"><br>
            <button type="button" id="save-changes-btn">Save Changes</button>
        </form>
    </div>
    <p>Go back to <a href="profile.php">Profile</a>.</p>

    <script>
        $(document).ready(function() {
            // Handle form submission using jQuery AJAX
            $("#save-changes-btn").click(function() {
                var formData = $("#edit-profile-form").serialize(); // Serialize form data
                $.ajax({
                    type: "POST",
                    url: "edit_profile.php", // Current page URL
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        if (response === 'success') {
                            alert("Profile updated successfully!");
                            window.location.href = "profile.php"; // Redirect to profile page
                        } else {
                            alert(response); // Show error message if any
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert("An error occurred while processing your request.");
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
