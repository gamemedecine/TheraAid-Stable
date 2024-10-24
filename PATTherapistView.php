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

include "./database.php";

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

if (isset($_POST["BTNsubmit"])) {
    $var_Rate = intval($_POST["TxtRate"]);
    $var_status = "Responded";

    $var_update = "UPDATE tbl_appointment SET
                        rate=$var_Rate,
                        status='$var_status' 
                        WHERE appointment_id=" . $var_AppID;
    $var_upqry = mysqli_query($var_conn, $var_update);

    if ($var_upqry) {
        $var_type = "Therapists Have Responded to your request";
        $var_notif = "INSERT INTO tbl_notifications(user_id,appointment_id,type)
        VALUES($var_UID,$var_APID,'$var_type')";
        mysqli_query($var_conn, $var_notif);
        header("location: ./TherapistsAppointment.php");
    } else {
        "error";
    }
}

//Decline Code
if (isset($_POST["BTNDecline"])) {
    $var_status = "declined"; // Set status to "declined"

    // Update the status in the database
    $var_update = "UPDATE tbl_appointment SET
                         status='$var_status' 
                         WHERE appointment_id=" . $var_AppID;
    $var_upqry = mysqli_query($var_conn, $var_update);

    if ($var_upqry) {
        $var_type = "Therapists Have Declined to your request";
        $var_notif = "INSERT INTO tbl_notifications(user_id,appointment_id,type)
        VALUES($var_UID,$var_APID,'$var_type')";
        mysqli_query($var_conn, $var_notif);
        header("location: TherapistsAppointment.php");
    } else {
        echo "Error: Could not decline the appointment.";
    }
}

$var_ammnt = "";
$statusCode = 0;

if (isset($_POST["BtnSubmit"])) {
    $var_ammnt = floatval($_POST["TxtAmount"]);

    if ($var_ammnt != $var_get["rate"]) {
        $statusCode = 1;
        // echo "Please enter the proper amount";
    } else if ($var_get["rate"] > $var_PtntE_wallet) {
        $statusCode = 2;
        // echo "Insufficient balance Please Top-up";
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
                header("location: ./PATAppointmentList.php");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html data-bs-theme="light">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Patient Therapist View</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/PatientHomePage.css'>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary-subtle">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="./assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
                </a>
                <button class="navbar-toggler rounded-pill shadow" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start bg-primary-subtle" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <img src="./assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
                        </h5>
                        <button type="button" class="btn-close shadow" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-0 gap-0 gap-lg-4">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./PatientHomePage.php">
                                    <i class="bi bi-house fs-3"></i><br>
                                    <small>Home</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PATAppointmentList.php">
                                    <i class="bi bi-calendar-check fs-3"></i><br>
                                    <small>Appointment</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-clock-history fs-3"></i><br>
                                    <small>History</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PATnotif.php">
                                    <i class="bi bi-bell fs-3"></i><br>
                                    <small>Notification</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PatientChat.php">
                                    <i class="bi bi-chat-dots fs-3 chat-badge"></i><br>
                                    <small>Chat</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./ProfilePage.php">
                                    <i class="bi bi-person fs-3"></i><br>
                                    <small>Profile</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PATAppointmentList.php">
                                    <i class="bi bi-box-arrow-right fs-3"></i><br>
                                    <small>Go Back</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <form method="POST" action="PATTherapistView.php" class="needs-validation" novalidate>
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Payment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <b>Rate: </b>
                            <?php echo $var_get["rate"]; ?>
                        </p>

                        <div>
                            <label for="TxtAmount" class="mb-1">Amount</label>
                            <input type="text" id="TxtAmount" name="TxtAmount" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-5 px-5" data-bs-dismiss="modal">Close</button>
                        <button type="submit " name="BtnSubmit" class="btn btn-primary rounded-5 px-5">Confirm Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <main class="py-0 py-lg-3">

        <section class="main-section bg-secondary-subtle py-3 py-lg-5 px-3 px-lg-5 shadow container-fluid container-lg">

            <div class="row">

                <div class="col-lg">

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <img id="ProfPic" class="img-fluid rounded-5 shadow" style="height: 250px; width: auto;" src="./UserFiles/ProfilePictures/<?php echo $profilePic; ?>" alt="<?php echo $proiflePic; ?>">
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="mb-1">
                            <b>Full Name:</b>
                            <span class="text-capitalize"><?php echo $var_get["PT_fllname"]; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Age:</b>
                            <span class="text-capitalize"><?php echo $var_PTAge; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Mobile Number:</b>
                            <span class="text-capitalize"><?php echo $var_get["PT_CntctNum"]; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Email:</b>
                            <span><?php echo $var_get["PT_Email"]; ?></span>
                        </label>
                    </div>

                </div>

                <div class="col-lg">

                    <hr>

                    <h3 class="text-center"><?php echo $formattedData; ?></h3>
                    <h3 class="text-center"><?php echo "$startTime - $endTime"; ?></h3>

                    <hr>

                    <div class="mb-3">
                        <label class="mb-1">
                            <b>Case:</b>
                            <span class="text-capitalize"><?php echo implode(", ", explode(",", $var_get["P_case"])); ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Balance:</b>
                            <span class="text-capitalize" id="balance"><?php echo $var_PtntE_wallet; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Description:</b>
                            <span class="text-capitalize"><?php echo $var_get["case_desc"]; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Payment Type:</b>
                            <span class="text-capitalize"><?php echo $var_get["payment_type"]; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Start Date:</b>
                            <span class="text-capitalize"><?php echo $var_Sdate; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Rate:</b>
                            <span class="text-capitalize"><?php echo $var_get["rate"]; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Patient Address:</b>
                            <span class="text-capitalize"><?php echo $var_get["patient_address"]; ?></span>
                        </label>
                    </div>

                    <button type="button" class="btn btn-primary px-5 rounded-5 mb-3" data-bs-toggle="modal" data-bs-target="#paymentModal">Pay</button>
                    <p class="text-danger">If payment is not recieved within 24 hours The appointment will be cancelled</p>
                    
                </div>

            </div>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        <?php

        if ($statusCode === 1) {
            echo "showToast(`<span class='text-danger'>Please enter the proper amount</span>`)";
        }
        if ($statusCode === 2) {
            echo "showToast(`<span class='text-danger'>Insufficient balance Please Top-up</span>`)";
        }

        ?>

        function showToast(message) {
            const toastElement = document.getElementById("toast");
            const toast = new bootstrap.Toast(toastElement);

            toastElement.getElementsByClassName("toast-body")[0].innerHTML = message;

            toast.show();
        }

        function formatCurrency(value) {
            value = value.replace(/[^\d.-]/g, '');
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'PHP',
            }).format(value || 0);
        }
    </script>
</body>
</html>