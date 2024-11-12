<?php

include "../database.php";

$JSONDATA = file_get_contents(filename: "php://input");

$DcodeJSON = json_decode($JSONDATA, true);

if (isset($DcodeJSON["PTID"])) {

    $var_PID = $DcodeJSON["PTID"];

    $var_getPatient = "SELECT
                        	*
                        FROM tbl_appointment appointment
                        JOIN tbl_therapists PT ON appointment.therapists_id = PT.therapist_id
                        JOIN tbl_user user ON user.User_id = PT.user_id
                        WHERE appointment_id = $var_PID";

    $var_qry = mysqli_query($var_conn, $var_getPatient);

    if (mysqli_num_rows($var_qry) > 0) {
        $var_rec = mysqli_fetch_array($var_qry);

        echo json_encode([
            "fname" => $var_rec["Fname"],
            "lname" => $var_rec["Lname"],
            "mname" => $var_rec["Mname"],
            "bday" => $var_rec["Bday"],
            "CntctNum" => $var_rec["ContactNum"],
            "email" => $var_rec["Email"],
            "profPic" => $var_rec["profilePic"],
            "case" => $var_rec["case_handled"],
            "city" => $var_rec["city"],
            "street" => $var_rec["barangay"],
            "PtntID" => $var_rec["patient_id"],
            "Session" => $var_rec["num_of_session"],
            "APID" => $var_rec["appointment_id"]
        ]);
    } else {
        echo "ERROR! NO DATA FOUND";
    }
}