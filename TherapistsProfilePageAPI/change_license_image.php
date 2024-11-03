<?php

include "../database.php";
include "../ProfilePageAPI/functions.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_FILES["licenseImage"])
    ) {
        $licenseImage = $_FILES["licenseImage"];
    
        $licenseImageName = $licenseImage["name"];
        $licenseImageTmpName = $licenseImage["tmp_name"];
        $licenseImageSize = $licenseImage["size"];
        $newLicenseImageName = uploadFiles($licenseImageName, $licenseImageTmpName, $licenseImageSize, "../UserFiles/LicensePictures/");
    
        if ($newLicenseImageName[0]) {
            $sql = "UPDATE tbl_therapists SET license_img = '$newLicenseImageName[0]' WHERE user_id = $userID";
            $result = $var_conn->query($sql);
    
            if ($result) {
                echo "<b>Your license image has been updated!</b>";
            } else {
                echo "<span class='text-danger'>Something went wrong, please try again.</span>";
            }
        } else {
            echo "<span class='text-danger'>Something went wrong while uploading your license image, please try again.</span>";
        }
    }
} else {
    header("location ..");
}