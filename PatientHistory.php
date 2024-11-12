<?php

include "./database.php";

session_start();
$var_patientID = $_SESSION["Patient_id"];
$var_TransactionHistory = "SELECT PM.payment_id,
                            PM.amount, 
                            PM.status, 
                            PM.date_paid,
                            SC.day,
                            SC.start_time,
                            SC.end_time,
                            PT.case_handled,
                            AP.Date_creadted,
                            PAT.P_case,
                            AP.appointment_id,
                            CONCAT(U.Fname,' ', U.Mname,' ',U.Lname) AS fullname
                        FROM tbl_payment PM
                        JOIN tbl_appointment  AP ON PM.appointment_id = ap.appointment_id
                        JOIN tbl_sched SC ON AP.schedle_id = SC.shed_id
                        JOIN tbl_therapists PT ON AP.therapists_id = PT.therapist_id
                        JOIN tbl_user U ON PT.user_id = U.User_id
                        JOIN tbl_patient PAT ON AP.patient_id = PAT.patient_id
                        WHERE AP.patient_id = $var_patientID";
$var_Historyqry = mysqli_query($var_conn, $var_TransactionHistory);

?>

<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Patient Home Page</title>
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PatientHomePage.php">
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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="PatientHistory.php">
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./Logout.php">
                                    <i class="bi bi-box-arrow-right fs-3"></i><br>
                                    <small>Logout</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-0 py-lg-3">
        <section class="main-section bg-secondary-subtle py-3 py-lg-5 px-3 px-lg-5 shadow container-fluid container-lg">

            <h1 class="mb-3">History</h1>

            <table class="table table-striped">

                <tr>
                    <th>Date Created</th>
                    <th>Therapists</th>
                    <th>Schedule</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date Paid</th>
                    <th>Action</th>
                </tr>

                <?php

                if (mysqli_num_rows($var_Historyqry) > 0) {
                    while ($var_HstryRec = mysqli_fetch_array($var_Historyqry)) {

                ?>
                    <tr>
                        <td><?php echo $var_HstryRec["Date_creadted"]; ?></td>
                        <td><?php echo $var_HstryRec["fullname"] . "<br>" . "<br>" . "Case:" . $var_HstryRec["P_case"]; ?>
                        </td>
                        <td><?php echo $var_HstryRec["day"] . "<br>" . $var_HstryRec["start_time"] . "-" . $var_HstryRec["end_time"]; ?>
                        </td>
                        <td><?php echo "₱" . $var_HstryRec["amount"] . "<br>"; ?></td>
                        <td><?php echo $var_HstryRec["status"] . "<br>"; ?></td>
                        <td><?php echo $var_HstryRec["date_paid"] . "<br>"; ?></td>
                        <td>
                            <a href="./PatientSessionView.php?record=<?php echo $var_HstryRec["appointment_id"] ?>">Check Session</a>
                            </td>
                    </tr>
                <?php

                    }
                } else {
                    echo "<tr>
                        <td class='opacity-50'>No Data</td>
                        <td class='opacity-50'>No Data</td>
                        <td class='opacity-50'>No Data</td>
                        <td class='opacity-50'>No Data</td>
                        <td class='opacity-50'>No Data</td>
                        <td class='opacity-50'>No Data</td>
                        <td class='opacity-50'>No Data</td>
                    </tr>";
                }

                ?>
            </table>

        </section>
    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>