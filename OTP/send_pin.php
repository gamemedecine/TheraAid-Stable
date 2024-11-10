<?php

include "./functions.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"])) {
        $target = $_POST["email"];

        $pin = sendPin($target, "charliezkiecharlzk@gmail.com", "Charles Henry Tinoy", "oaqp zfcb jalg fuyy");

        if ($pin === "error") {
            http_response_code(400);
            echo "An error occurred. The email you entered may be invalid or does not exist. Please try again.";
            exit;
        } else {
            http_response_code(200);
            echo "Your one-time pin has been sent to your email. Please check your inbox.";
            $_SESSION["oneTimePin"] = $pin;
            exit;
        }
    } else {
        http_response_code(400);
        echo "Missing variable, please try again.";
        exit;
    }
} else {
    header("location ..");
}