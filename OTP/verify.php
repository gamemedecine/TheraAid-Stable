<?php

include "./functions.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["pin"]) &&
        isset($_SESSION["oneTimePin"])
    ) {
        $pin = $_POST["pin"];
        $oneTimePin = $_SESSION["oneTimePin"];

        if ($pin === $oneTimePin) {
            http_response_code(200);
            echo "Your PIN was successfully verified!";
            exit;
        } else {
            http_response_code(400);
            echo "Invalid PIN. Please try again.";
            exit;
        }
    } else {
        http_response_code(400);
        echo "Invalid code, please try again.";
        exit;
    }
} else {
    header("location ..");
}