<?php

include "../database.php";
include "./functions.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["medicalHistoryImage"])) {
        $medicalHistoryImage = $_FILES["medicalHistoryImage"];

        $medicalHistoryImageName = $medicalHistoryImage["name"];
        $medicalHistoryImageTmpName = $medicalHistoryImage["tmp_name"];
        $medicalHistoryImageSize = $medicalHistoryImage["size"];
        $newMedicalHistoryImageNames = uploadFiles($medicalHistoryImageName, $medicalHistoryImageTmpName, $medicalHistoryImageSize, "../UserFiles/PatientMedicalHistoryPictures/");
        
        $newMedicalHistoryImageNameErr = null;
        
        foreach ($newMedicalHistoryImageNames as $name) {
            if (!$name) {
                $newMedicalHistoryImageNameErr = $name;
                break;
            }
        }
    
        if (!$newMedicalHistoryImageNameErr) {
            $medicalHistoryImageArray = array();
            
            foreach ($newMedicalHistoryImageNames as $names) {
                array_push($medicalHistoryImageArray, $names);
            }
        
            $medicalHistoryImageNames = implode(",", $medicalHistoryImageArray);
        
            $sql = "UPDATE tbl_patient SET mid_hisotry_photo='$medicalHistoryImageNames' WHERE user_id = $userID";
            $result = $var_conn->query($sql);
        
            if ($result) {
                echo "<b>Your medical history pictures has been changed!</b>";
            } else {
                echo "<span class='text-danger'>Something went wrong, please try again.</span>";
            }
        } else {
            echo "<span class='text-danger'>Something went wrong while uploading your medical history pictures, please try again.</span>";
        }
    } else {
        echo "Missing variable, please try again.";
    }
} else {
    header("location ..");
}