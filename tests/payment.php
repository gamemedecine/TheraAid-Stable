<?php

function SetReminder($var_APid, $var_Sdate, $data_day, $var_NumofSession, $var_conn)
{
    $future_dates = [];

    $selectedDays = explode(',', $data_day);

    $startDate = new DateTime($var_Sdate);

    while (count($future_dates) < $var_NumofSession) {
        $currentDay = $startDate->format('D');

        if (in_array($currentDay, $selectedDays)) {
            $future_dates[] = $startDate->format('Y-m-d');
        }

        $startDate->modify('+1 day');
    }

    $dates_string = implode(',', $future_dates);
    $var_RMessage = "You Have An appointment Today";
    $var_Isread = "unread";
    $var_setReminder = "INSERT INTO tbl_reminder (appointment_id, reminder_date, reminder_messsage, reminder_status) VALUES ('$var_APid', '$dates_string', '$var_RMessage', '$var_Isread')";
    $var_setqry = mysqli_query($var_conn, $var_setReminder);
}

include "../database.php";

session_start();

$var_APid = $_SESSION["sess_APID"];

$var_qry = "SELECT  
        A.num_of_session,
        A.payment_type,
        A.start_date,
        A.date_accepted,
        A.status, 
        A.rate, 
        A.Date_creadted,
        S.day,
        S.shed_id,
        S.start_time, 
        S.end_time, 
        P.P_case,
        P.case_desc,
        CONCAT(U.Fname, ' ', U.Mname, ' ', U.Lname) AS patient_fllname, 
        CONCAT(P.barangay,', ', P.City) AS patient_address,
        U.ContactNum,
        U.Bday,
        U.ContactNum,
        U.E_wallet AS PtntE_wallet,
        U.Email,
        U.profilePic,
        U.User_id AS PtntID,
        CONCAT( UT.Fname,' ',UT.Mname,' ',UT.Lname) AS PT_fllname,
        UT.Bday AS PT_Bday,
        UT.Email AS PT_Email,
        UT.ContactNum AS PT_CntctNum,
        UT.User_id AS PTID,
        UT.E_wallet AS PTE_wallet,
        T.case_handled,
        T.city
    FROM tbl_appointment A 
    JOIN tbl_sched S ON S.shed_id  = A.schedle_id 
    JOIN tbl_patient P ON P.patient_id = A.patient_id 
    JOIN tbl_user U ON P.user_id = U.User_id 
    JOIN tbl_therapists T ON T.therapist_id = A.therapists_id
    JOIN tbl_user UT ON T.user_id = UT.User_id
    WHERE A.appointment_id = $var_APid";

$var_chk = mysqli_query($var_conn, $var_qry);
$var_get = mysqli_fetch_array($var_chk);
$var_PTAge = "";
$var_rate = $var_get["rate"];
$var_PtntE_wallet = floatval($var_get["PtntE_wallet"]);
$VAR_PTNTID = $var_get["PtntID"];

$var_PTID = $var_get["PTID"];
$var_PTE_wallet = floatval($var_get["PTE_wallet"]);
$var_BY = date('Y', strtotime($var_get["PT_Bday"]));
$var_currDate = date("Y");
$var_PTAge = $var_currDate - $var_BY;
$var_Rate = "";
$var_Sdate = $var_get["start_date"];
$var_NumofSession = $var_get["num_of_session"];
$data_day = $var_get["day"];
$formattedData = str_replace(",", "-", $data_day);

$startTime = $var_get["start_time"];
$endTime = $var_get["end_time"];
$profilePic = $var_get["profilePic"];

$var_ammnt = floatval($_GET["TxtAmount"]);

if ($var_ammnt != $var_get["rate"]) {
    echo "Please enter the proper amount<br>";
}
if ($var_get["rate"] <= $var_ammnt) {
    echo "Insufficient balance Please Top-up<br>";
} else {
    $var_Payment = "INSERT INTO tbl_payment (appointment_id,amount,status)
        VALUES ('$var_APid','$var_ammnt','Paid')";
    $var_Pqry = mysqli_query($var_conn, $var_Payment);

    if ($var_Pqry) {
        //update therapists E-wallet Account PtntID
        $var_UpdtE_wallet = $var_ammnt + $var_PTE_wallet;
        //echo $var_UpdtE_wallet;
        $var_Tupdate = "UPDATE tbl_user SET E_wallet=   $var_UpdtE_wallet WHERE User_id = $var_PTID";
        $var_TupdatePT = mysqli_query($var_conn, $var_Tupdate);

        //UPDATE THE E WALLET OF THE PATIENT "DEDUCT"
        $var_deductE_wallet = $var_PtntE_wallet - $var_ammnt;
        //echo  $var_deductE_wallet;
        $var_TupdatePaatient = "UPDATE tbl_user SET E_wallet= $var_deductE_wallet WHERE User_id =$VAR_PTNTID";
        $var_TupdatePTNT = mysqli_query($var_conn, $var_TupdatePaatient);

        //UPDATE SCHED STATUS TO ONGOING/IN USED
        $var_SchedUpdate = "UPDATE tbl_sched SET status = 'On-Going' WHERE shed_id =" . $var_get["shed_id"];
        $var_SchedUpdtQRY = mysqli_query($var_conn, $var_SchedUpdate);

        //UPDATE APPOINTMENT STATUS TO ONGOING/IN USED
        $var_AppntmntUpdate = "UPDATE tbl_appointment SET status = 'On-Going' WHERE appointment_id =" . $var_APid;
        $var_AppntmntUpdtQRY = mysqli_query($var_conn, $var_AppntmntUpdate);

        if ($var_SchedUpdtQRY) {
            //CREATE A REMINDER
            SetReminder($var_APid, $var_Sdate, $data_day, $var_NumofSession, $var_conn);
        }
    }
}