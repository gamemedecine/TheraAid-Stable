<?php

include "../database.php";
include "../ProfilePageAPI/functions.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["caseHandled"]) &&
        isset($_POST["barangay"]) &&
        isset($_POST["city"])
    ) {
        $caseHandled = implode(",", array_map(function ($value) {
            $characterArray = str_split($value);
            if ($characterArray[0] !== " ") {
                return $value;
            } else {
                array_shift($characterArray);
                return implode("", $characterArray);
            }
        }, explode(",", $_POST["caseHandled"])));
        
        $city = $_POST["city"];
        $barangay = $_POST["barangay"];

        $sql = "UPDATE tbl_therapists
                SET
                	case_handled = '$caseHandled',
                    city = '$city',
                    barangay = '$barangay'
                WHERE user_id = $userID";

        $result = $var_conn->query($sql);

        if ($result) {
            echo "<b>Your therapist information has been updated!</b>";
        } else {
            echo "<span class='text-danger'>Something went wrong, please try again.</span>";
        }
    }
} else {
    header("location ..");
}