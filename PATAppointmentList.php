<?php

include "./database.php";

session_start();

$var_filter = "P"; // Default filter is Pending

// Handle form submission for filtering
if (isset($_POST["BtnFilter"])) {
    $var_filter = $_POST["response"];
}

// SQL query based on the selected filter
$var_slct = "SELECT 
                    S.day,
                    S.start_time,
                    S.end_time,
                    S.note,
                    A.num_of_session,
                    A.payment_type,
                    A.start_date,
                    A.date_accepted,
                    A.therapists_id,
                    A.patient_id,
                    A.rate,
                    A.status,
                    A.Date_creadted,
                    A.appointment_id 
                FROM tbl_appointment A
                JOIN tbl_sched S 
                ON S.shed_id = A.schedle_id 
                WHERE A.patient_id = " . $_SESSION["sess_PtntID"] . " 
                AND A.status LIKE '" . $var_filter . "%'";

$var_qry = mysqli_query($var_conn, $var_slct);

if (isset($_POST["BTNAPInfo"])) {
    $_SESSION["sess_APID"] = $_POST["BTNAPInfo"];
    header("location: PATTherapistView.php");
}

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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./PATAppointmentList.php">
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
            
            <div class="overflow-x-auto">

                <form method="POST" action="PATAppointmentList.php" class="mb-3">
                    <div class="d-flex justify-content-start align-items-center gap-3 mb-2 flex-wrap">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="P" name="response" id="pending" <?php if ($var_filter == "P")
                                echo "checked"; ?>>
                            <label class="form-check-label" for="pending">
                                Pending
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="R" name="response" id="responded" <?php if ($var_filter == "R")
                                echo "checked"; ?>>
                            <label class="form-check-label" for="responded">
                                Responded
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="O" name="response" id="ongoing" <?php if ($var_filter == "O")
                                echo "checked"; ?>>
                            <label class="form-check-label" for="ongoing">
                                Ongoing
                            </label>
                        </div>
                        <input type="submit" name="BtnFilter" value="Filter"
                            class="btn btn-primary px-5 rounded-5 btn-sm">
                    </div>
                </form>

                <table class="table table-primary table-striped rounded-5">
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Number Of Session</th>
                        <th>Payment Type</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Rate</th>
                        <?php if ($var_filter != "O"): ?>
                            <th>Action</th>
                        <?php else: ?>
                            <th></th> <!-- Keep header blank for ongoing appointments -->
                        <?php endif; ?>
                    </tr>
                    <?php if ($var_qry && mysqli_num_rows($var_qry) > 0): ?>
                        <?php while ($var_rec = mysqli_fetch_array($var_qry)): ?>
                            <tr>
                                <td><?php echo $var_rec["day"]; ?></td>
                                <td><?php echo $var_rec["start_time"]; ?></td>
                                <td><?php echo $var_rec["end_time"]; ?></td>
                                <td><?php echo $var_rec["num_of_session"]; ?></td>
                                <td><?php echo $var_rec["payment_type"]; ?></td>
                                <td><?php echo $var_rec["start_date"]; ?></td>
                                <td><?php echo $var_rec["status"]; ?></td>
                                <td><?php echo $var_rec["Date_creadted"]; ?></td>
                                <td><?php echo $var_rec["rate"]; ?></td>
                                <?php

                                $appointment_id = $var_rec["appointment_id"];

                                if ($var_filter === "P") {
                                    echo "<td>
                                            <button type='submit' value='$appointment_id' name='BTNAPInfo' class='btn btn-primary btn-sm px-5 rounded-5 w-100'>Cancel</button>
                                        </td>";
                                }
                                if ($var_filter === "R") {
                                    echo "<td>
                                            <form method='POST' action='PATAppointmentList.php'>
                                                <button type='submit' value='$appointment_id' name='BTNAPInfo'
                                                    class='btn btn-primary btn-sm px-5 rounded-5 w-100'>Check Appointment Info</button>
                                            </form>
                                        </td>";
                                }
                                ?>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </table>

            </div>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>