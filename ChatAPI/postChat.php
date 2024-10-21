<?php

include "../database.php";

session_start();

function appendMessage($messageText, $senderPath, $recipientPath)
{
    $senderStream = fopen($senderPath, "a");
    $senderContent = "<div class='sender align-self-end bg-light p-3 rounded-5 shadow'>$messageText</div>";

    fwrite($senderStream, $senderContent);
    fclose($senderStream);

    $recipientStream = fopen($recipientPath, "a");
    $recipientContent = "<div class='sender align-self-start bg-light p-3 rounded-5 shadow'>$messageText</div>";

    fwrite($recipientStream, $recipientContent);
    fclose($recipientStream);
}

if (
    isset($_SESSION["sess_id"]) &&
    isset($_POST["recipientID"]) &&
    isset($_POST["messageText"])
) {
    $senderID = $_SESSION["sess_id"];
    $recipientID = $_POST["recipientID"];
    $messageText = $_POST["messageText"];

    if ($senderID === $recipientID) {
        echo "Unable to send message to yourself, please try again.";
        http_response_code(400);
        exit;
    }

    $sql = "SELECT * FROM tbl_user WHERE User_id = $recipientID";
    $result = $var_conn->query($sql)->fetch_assoc();

    if ($result) {
        $senderDir = "../Chats/$senderID/";
        $recipientDir = "../Chats/$recipientID/";

        if (!is_dir($senderDir)) {
            mkdir($senderDir);
        }

        if (!is_dir($recipientDir)) {
            mkdir($recipientDir);
        }

        $senderPath = $senderDir . "$recipientID.html";
        $recipientPath = $recipientDir . "$senderID.html";

        appendMessage($messageText, $senderPath, $recipientPath);
    } else {
        echo "Couldn't find this user, please try again.";
        http_response_code(400);
        exit;
    }
} else {
    echo "Missing varaible, please try again.";
    http_response_code(400);
    exit;
}