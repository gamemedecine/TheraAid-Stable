<?php

include "../database.php";
include "./functions.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_FILES["assesmentImage"]) &&
        isset($_FILES["medicalHistoryImage"])
    ) {
        $assesmentImage = $_FILES["assesmentImage"];
        $medicalHistoryImage = $_FILES["medicalHistoryImage"];

        $assesmentImageName = $assesmentImage["name"];
        $assesmentImageTmpName = $assesmentImage["tmp_name"];
        $assesmentImageSize = $assesmentImage["size"];
        $newAssesmentImageNames = uploadFiles($assesmentImageName, $assesmentImageTmpName, $assesmentImageSize, "../UserFiles/PatientAssementPictures/");

        $medicalHistoryImageName = $medicalHistoryImage["name"];
        $medicalHistoryImageTmpName = $medicalHistoryImage["tmp_name"];
        $medicalHistoryImageSize = $medicalHistoryImage["size"];
        $newMedicalHistoryImageNames = uploadFiles($medicalHistoryImageName, $medicalHistoryImageTmpName, $medicalHistoryImageSize, "../UserFiles/PatientMedicalHistoryPictures/");

        $newAssesmentImageNameErr = null;
        $newMedicalHistoryImageNameErr = null;
        
        foreach ($newAssesmentImageNames as $name) {
            if (!$name) {
                $newAssesmentImageNameErr = $name;
                break;
            }
        }

        foreach ($newMedicalHistoryImageNames as $name) {
            if (!$name) {
                $newMedicalHistoryImageNameErr = $name;
                break;
            }
        }
    
        if (!$newAssesmentImageNameErr && !$newMedicalHistoryImageNameErr) {
            $assesmentImageNamesArray = array();

            foreach ($newAssesmentImageNames as $names) {
                array_push($assesmentImageNamesArray, $names);
            }

            $assesmentImageNames = implode(",", $assesmentImageNamesArray);

            $medicalHistoryImageArray = array();
            
            foreach ($newMedicalHistoryImageNames as $names) {
                array_push($medicalHistoryImageArray, $names);
            }

            $medicalHistoryImageNames = implode(",", $medicalHistoryImageArray);

            $sql = "UPDATE tbl_patient SET assement_photo='$assesmentImageNames', mid_hisotry_photo='$medicalHistoryImageNames' WHERE user_id = $userID";
            $result = $var_conn->query($sql);

            if ($result) {
                echo "<b>Your medical pictures has been changed!</b>";
            } else {
                echo "<span class='text-danger'>Something went wrong, please try again.</span>";
            }
        } else {
            echo "<span class='text-danger'>Something went wrong while uploading your medical pictures, please try again.</span>";
        }
    }
} else {
    header("location ..");
}