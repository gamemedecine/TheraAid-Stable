<?php

include "../database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["message"]) &&
        isset($_POST["targetID"]) &&
        isset($_SESSION["sess_id"])
    ) {
        $message = $_POST["message"];
        $targetID = $_POST["targetID"];
        $userID = $_SESSION["sess_id"];

        $sql = "SELECT patient_id FROM tbl_patient WHERE user_id = $userID";
        $result = $var_conn->query($sql);

        if ($result->num_rows > 0 && $rows = $result->fetch_assoc()) {
            $recipientID = $rows["patient_id"];

            $sql = "INSERT INTO `feedback`(`feedback_id`, `recipient_id`, `receiver_id`, `message`, `date_created`) VALUES ('[value-1]','$recipientID','$targetID','$message',NULL);";
            $result = $var_conn->query($sql);

            if ($result) {
                echo "Your feedback has been posted!";
            } else {
                echo "Something went wrong while posting your feedback, please try again.";
            }
        } else {
            echo "Unable to find your target, please try again.";
        }
    } else {
        echo "Missing variable, please try again.";
    }
} else {
    header("location ..");
}