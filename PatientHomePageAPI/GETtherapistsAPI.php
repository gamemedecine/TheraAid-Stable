<?php

include "../database.php";

$JSNDATA = file_get_contents(filename: "php://input");

$DcodeJSON = json_decode($JSNDATA, true);

if (
    isset($DcodeJSON["city"])
    && isset($DcodeJSON["barangay"])
    && isset($DcodeJSON["case"])
) {

    $var_city = $DcodeJSON["city"];
    
    $barangay = $DcodeJSON["barangay"];

    $var_case = array_map(function ($value) {
        $characterArray = str_split($value);
        if ($characterArray[0] !== " ") {
            return $value;
        } else {
            array_shift($characterArray);
            return implode($characterArray);
        }
    }, explode(",", $DcodeJSON["case"]));

    $var_slctTherapists = "SELECT   U.Fname,
                                    U.Mname,
                                    U.Lname,
                                    U.profilePic,
                                    T.case_handled,
                                    T.city,
                                    T.barangay,
                                    T.therapist_id
                                    FROM tbl_therapists T
                                    JOIN tbl_user U
                                    ON U.User_id = T.user_id
                                    WHERE T.city= '$var_city'";

    $var_qry = mysqli_query($var_conn, $var_slctTherapists);

    $therapists = array();

    foreach ($var_qry as $result) {
        $var_strdcase = explode(",", $result["case_handled"]);
        $therapistCity = $result["city"];
        $therapistBarangay = $result["barangay"];

        $isExists = false;

        foreach ($var_case as $case) {
            if (in_array($case, $var_strdcase)) {
                $isExists = true;
                break;
            }
        }

        if ($isExists) {
            if ($var_city === $therapistCity || $barangay === $therapistBarangay) {
                array_push($therapists, array(
                    "fname" => $result["Fname"],
                    "lname" => $result["Lname"],
                    "mname" => $result["Mname"],
                    "profilePic" => $result["profilePic"],
                    "case" => $result["case_handled"],
                    "city" => $result["city"],
                    "barangay" => $result["barangay"],
                    "TID" => $result["therapist_id"]
                ));
            }
        }
    }

    echo json_encode($therapists);
}