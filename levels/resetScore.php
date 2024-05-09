<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $score = 0;

    //Load XML file
    $xml = new DOMDocument();
    $xml->load('../users.xml');

    //Finduser based on the username
    $users = $xml->getElementsByTagName("user");
    foreach ($users as $user) {
        if ($user->getElementsByTagName("username")[0]->nodeValue == $username) {
            $user->getElementsByTagName("score1")->item(0)->nodeValue = $score;
            $user->getElementsByTagName("score2")->item(0)->nodeValue = $score;
            $user->getElementsByTagName("score3")->item(0)->nodeValue = $score;
            $user->getElementsByTagName("score4")->item(0)->nodeValue = $score;
            $user->getElementsByTagName("score5")->item(0)->nodeValue = $score;
            break;
        }
    }

    // Save the updated XML file
    $xml->formatOutput = true;
    $xml->save('../users.xml');
}
?>

