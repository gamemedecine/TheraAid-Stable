<?php

include "../database.php";
session_start();

$_SESSION["Patient_id"] = "";
$JSONDATA = file_get_contents(filename: "php://input");

$DcodeJSON = json_decode($JSONDATA, true);

if (isset($DcodeJSON["PID"])) {

    $var_PID = $DcodeJSON["PID"];

    $var_getPatient = "SELECT P.patient_id, 
    P.P_case, P.case_desc, 
    P.City, P.barangay,
    P.assement_photo, 
    P.mid_hisotry_photo,
    U.Fname, U.Lname, 
    U.Mname, U.Bday,
    U.ContactNum, U.Email,
    U.profilePic 
    FROM tbl_patient P 
    JOIN tbl_user U ON
    U.User_id = P.user_id WHERE P.user_id =" . $var_PID;

    $var_qry = mysqli_query($var_conn, $var_getPatient);
    
    if (mysqli_num_rows($var_qry) > 0) {
        $var_rec = mysqli_fetch_array($var_qry);
        $_SESSION["Patient_id"] =   $var_rec["patient_id"];
        echo json_encode([
            "fname" => $var_rec["Fname"],
            "lname" => $var_rec["Lname"],
            "mname" => $var_rec["Mname"],
            "bday" => $var_rec["Bday"],
            "CntctNum" => $var_rec["ContactNum"],
            "email" => $var_rec["Email"],
            "profPic" => $var_rec["profilePic"],
            "case" => $var_rec["P_case"],
            "case_desc" => $var_rec["case_desc"],
            "city" => $var_rec["City"],
            "barangay" => $var_rec["barangay"],
            "asstment" => $var_rec["assement_photo"],
            "medHstry" => $var_rec["mid_hisotry_photo"],
            "PtntID" => $var_rec["patient_id"],

        ]);
    } else {
        echo "ERROR! NO DATA FOUND";
    }
}