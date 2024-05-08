<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $score = $_POST['score3'];

    $xml = new DOMDocument();
    $xml->load('../users.xml');

    $users = $xml->getElementsByTagName("user");
    foreach ($users as $user) {
        if ($user->getElementsByTagName("username")[0]->nodeValue == $username) {
            $user->getElementsByTagName("score3")->item(0)->nodeValue = $score;
            break;
        }
    }

    $xml->formatOutput = true;
    $xml->save('../users.xml');
}
?>
