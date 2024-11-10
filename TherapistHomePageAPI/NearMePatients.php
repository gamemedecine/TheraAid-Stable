<?php

include "../database.php";

if (
    isset($_POST["city"]) &&
    isset($_POST["barangay"]) &&
    isset($_POST["case"])
) {
    $city = $_POST["city"];
    $barangay = $_POST["barangay"];
    $cases = explode(",", $_POST["case"]);

    $sql = "SELECT 
            patient.patient_id, 
            patient.user_id, 
            patient.P_case,
            patient.City, 
            patient.barangay,
            patient.case_desc,
            user.Fname,
            user.Mname,
            user.Lname,
            user.profilePic
        FROM 
            tbl_patient AS patient
        JOIN 
            tbl_user AS user ON patient.user_id = user.user_id
        LEFT JOIN 
            tbl_appointment AS APT ON APT.patient_id = patient.patient_id 
        WHERE 
            APT.appointment_id IS  NULL;";

    $results = $var_conn->query($sql);

    if ($results) {
        $patients = array();

        foreach ($results as $result) {

            $patientID = $result["patient_id"];
            $userID = $result["user_id"];
            $patientCases = explode(",", $result["P_case"]);
            $caseDesc = $result["case_desc"];
            $patientCity = $result["City"];
            $patientBarangay = $result["barangay"];
            $firstName = $result["Fname"];
            $middleName = $result["Mname"];
            $lastName = $result["Lname"];
            $profilePic = $result["profilePic"];

            $isExists = false;

            foreach ($cases as $case) {
                if (in_array($case, $patientCases)) {
                    $isExists = true;
                }
            }

            if ($isExists) {
                if ($city === $patientCity || $barangay === $patientBarangay) {
                    array_push($patients, array(
                        "patientID" => $patientID,
                        "userID" => $userID,
                        "cases" => implode(", ", $patientCases),
                        "caseDesc" => $caseDesc,
                        "city" => $patientCity,
                        "barangay" => $patientBarangay,
                        "firstName" => $firstName,
                        "middleName" => $middleName,
                        "lastName" => $lastName,
                        "profilePic" => $profilePic,
                    ));
                }
            }
        }

        echo json_encode($patients);
    } else {
        echo "Something went wrong, please try again.";
        http_response_code(500);
    }
} else {
    echo "Missing variable, please try again.";
    http_response_code(400);
}
