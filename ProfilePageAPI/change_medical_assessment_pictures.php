<?php

include "../database.php";
include "./functions.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["assesmentImage"])) {
        $assesmentImage = $_FILES["assesmentImage"];

        $assesmentImageName = $assesmentImage["name"];
        $assesmentImageTmpName = $assesmentImage["tmp_name"];
        $assesmentImageSize = $assesmentImage["size"];
        $newAssesmentImageNames = uploadFiles($assesmentImageName, $assesmentImageTmpName, $assesmentImageSize, "../UserFiles/PatientAssementPictures/");

        $newAssesmentImageNameErr = null;
        
        foreach ($newAssesmentImageNames as $name) {
            if (!$name) {
                $newAssesmentImageNameErr = $name;
                break;
            }
        }
    
        if (!$newAssesmentImageNameErr) {
            $assesmentImageNamesArray = array();

            foreach ($newAssesmentImageNames as $names) {
                array_push($assesmentImageNamesArray, $names);
            }

            $assesmentImageNames = implode(",", $assesmentImageNamesArray);

            $sql = "UPDATE tbl_patient SET assement_photo='$assesmentImageNames' WHERE user_id = $userID";
            $result = $var_conn->query($sql);

            if ($result) {
                echo "<b>Your medical asessment pictures has been changed!</b>";
            } else {
                echo "<span class='text-danger'>Something went wrong, please try again.</span>";
            }
        } else {
            echo "<span class='text-danger'>Something went wrong while uploading your medical asessment pictures, please try again.</span>";
        }
    } else {
        echo "Missing variable, please try again.";
    }
} else {
    header("location ..");
}