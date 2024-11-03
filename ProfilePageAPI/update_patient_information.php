<?php

include "../database.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST["patientCase"]) &&
        isset($_POST["patientCaseDescription"]) &&
        isset($_POST["city"]) &&
        isset($_POST["barangay"])
    ) {
        $patientCase = $_POST["patientCase"];
        $patientCaseDescription = $_POST["patientCaseDescription"];
        $city = $_POST["city"];
        $barangay = $_POST["barangay"];

        if (
            strlen($patientCase) >= 50 ||
            strlen($patientCaseDescription) >= 200 ||
            strlen($city) >= 100 ||
            strlen($barangay) >= 200
        ) {
            echo "<span class='text-danger'>Please follow the given max length of each inputs.</span>";
            exit;
        }

        $sql = "UPDATE tbl_patient
                SET
                	P_case = '$patientCase',
                    case_desc = '$patientCaseDescription',
                    City = '$city',
                    barangay = '$barangay'
                WHERE user_id = $userID";

        $result = $var_conn->query($sql);

        if ($result) {
            echo "Your patient information has been updated!";
        } else {
            echo "<span class='text-danger'>Something went wrong, please try again.</span>";
        }
    } else {
        echo "Missing variable, please try again.";
    }

} else {
    header("location ..");
}