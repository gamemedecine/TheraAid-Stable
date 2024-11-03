<?php

include "../database.php";
include "./functions.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_FILES["profilePicture"])
    ) {
        $profilePic = $_FILES["profilePicture"];
    
        $profilePictureName = $profilePic["name"];
        $profilePictureTmpName = $profilePic["tmp_name"];
        $profilePictureSize = $profilePic["size"];
        $newProfilePictureName = uploadFiles($profilePictureName, $profilePictureTmpName, $profilePictureSize, "../UserFiles/ProfilePictures/");
    
        if ($newProfilePictureName[0]) {
            $sql = "UPDATE tbl_user SET profilePic='$newProfilePictureName[0]' WHERE User_id = $userID";
            $result = $var_conn->query($sql);
    
            if ($result) {
                echo "<b>Your profile picture has been changed!</b>";
            } else {
                echo "<span class='text-danger'>Something went wrong, please try again.</span>";
            }
        } else {
            echo "<span class='text-danger'>Something went wrong while uploading your profile picture, please try again.</span>";
        }
    }
} else {
    header("location ..");
}