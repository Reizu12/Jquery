<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username from the session
    $username = $_POST['username'];
    $level = $_POST['level'];

    // Load XML file
    $xml = new DOMDocument();
    $xml->load('../users.xml');

    // Find user based on the username
    $users = $xml->getElementsByTagName("user");
    foreach ($users as $user) {
        if ($user->getElementsByTagName("username")[0]->nodeValue == $username) {
            $user->getElementsByTagName("level")->item(0)->nodeValue = $level;
            break;
        }
    }

    $xml->formatOutput = true;
    $xml->save('../users.xml');
}
?>
