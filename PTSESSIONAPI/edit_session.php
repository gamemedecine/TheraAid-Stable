<?php

include "../database.php";

$sessionPicsDir = "../UserFiles/SessionPictures";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST["sessionID"]) &&
        isset($_POST["TxtNote"]) &&
        isset($_FILES["FilePoto"])
    )

    $sessionID = $_POST["sessionID"];
    $TxtNote = $_POST["TxtNote"];
    $FilePoto = $_FILES["FilePoto"];

    $sql = "SELECT photo FROM tbl_session WHERE session_id = $sessionID";
    $result = $var_conn->query($sql)->fetch_assoc();

    $photos = $result["photo"];
    $photosArr = explode(",", $photos);

    if ($photosArr > 0) {
        foreach ($photosArr as $photo) {
            if (file_exists("$sessionPicsDir/$photo")) {
                unlink("$sessionPicsDir/$photo");
            }
        }
    }

    $fileNamesArray = [];

    foreach ($FilePoto["name"] as $key => $name) {
        $newName = uniqid() . "." . pathinfo($name, PATHINFO_EXTENSION);
        $tmp_name = $FilePoto["tmp_name"][$key];

        $fileNamesArray[] = $newName;

        if (!move_uploaded_file($tmp_name, "$sessionPicsDir/$newName")) {
            echo "Something went wrong while upload your pictures, please try again.";
            exit;
        }
    }

    $fileNames = implode(",", $fileNamesArray);

    $currentTime = date("h:i:sa");

    $sql = "UPDATE tbl_session
        SET
        	note = '$TxtNote',
            photo = '$fileNames',
            status = 'Finished',
            end_time = '$currentTime'
        WHERE session_id = '$sessionID'";
    $result = $var_conn->query($sql);

    if ($result) {
        echo "Your session has been updated.";
    } else {
        echo "Something went wrong while updating your session, please try again.";
    }

} else {
    echo "Invalid http request for this page.";
}