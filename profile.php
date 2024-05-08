<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    http_response_code(401); // Unauthorized
    exit('Error: User not authenticated');
}

// Define constants for XML file path and error messages
const XML_FILE_PATH = 'users.xml';
const ERROR_USER_NOT_FOUND = 'Error: User not found';
const ERROR_LOADING_XML = 'Error: Unable to load user data';

// Load users.xml
$xml = simplexml_load_file(XML_FILE_PATH);
if ($xml === false) {
    http_response_code(500); // Internal Server Error
    exit(ERROR_LOADING_XML);
}

$username = $_SESSION['username'];

// Retrieve user data
$userData = null;
foreach ($xml->user as $user) {
    if ((string)$user->username === $username) {
        $userData = [
            'username' => (string)$user->username,
            'full_name' => (string)$user->full_name,
        ];
        break;
    }
}

if (!$userData) {
    http_response_code(404); // Not Found
    exit(ERROR_USER_NOT_FOUND);
}

// Echo user data as JavaScript object
echo "<script> var userData = " . json_encode($userData) . ";</script>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="profile-section">
    <h1>User Profile</h1>
    <label for="username">Username:</label>
    <span id="username"><?php echo $userData['username']; ?></span><br>
    <label for="full-name">Full Name:</label>
    <span id="full-name"><?php echo $userData['full_name']; ?></span><br>
    <label for="password">Password:</label>
    <span id="password">••••••••</span><br>

    <!-- Edit profile button redirects to edit_profile.php -->
    <button id="edit-profile-btn" class="styled-button">Edit Profile</button>
</div>

<script>
    $(document).ready(function(){
        // Redirect to edit_profile.php when the edit profile button is clicked
        $('#edit-profile-btn').click(function(){
            window.location.href = 'edit_profile.php';
        });
    });
</script>
<p>Go back to <a href="home.php">Home</a>.</p>
</body>
</html>
