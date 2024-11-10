<?php

include "../database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["appointment_id"])) {
        $appointment_id = $_POST["appointment_id"];

        $sql = "INSERT INTO `tbl_session`(`session_id`, `duration`, `note`, `photo`, `status`, `Time_startted`, `appointment_id`, `Date_creadted`) 
        VALUES (NULL,'0','','','On-Going',NULL,$appointment_id,NULL)";
        $result = $var_conn->query($sql);

        if (!$result) {
            echo "Something went wrong while starting your session, please try again.";
        }
    }
} else {
    echo "Invalid http request for this page.";
}