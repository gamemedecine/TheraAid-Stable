<?php

session_start();

if (isset($_GET["target"])) {
    $target = $_GET["target"];
    $userID = $_SESSION["sess_id"];

    $filepath = "../Chats/$userID/$target.html";

    if (file_exists($filepath) && (filesize($filepath) > 0)) {
        $file = fopen($filepath, "r");
        $contents = fread($file, filesize($filepath));

        echo $contents;

        fclose($file);
    }
}