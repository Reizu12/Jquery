<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Load the XML file
    $xml = new DOMDocument();
    $xml->load('../users.xml');

    // Find the user element based on the username
    $users = $xml->getElementsByTagName("user");
    foreach ($users as $user) {
        if ($user->getElementsByTagName("username")[0]->nodeValue == $username) {
            $score3 = $user->getElementsByTagName("score3")[0]->nodeValue;
            echo $score3;
            break;
        }
    }
} else {
    echo 'Username not found';
}
?>
