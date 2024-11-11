<?php

include "./database.php";

session_start();

// echo $_SESSION["sess_APID"];

$sess_APID = $_SESSION["sess_APID"];

$var_conn = mysqli_connect("localhost", "root", "", "theraaid");
$var_qry = "SELECT u.User_id,
                    u.Fname, 
                    u.Lname, 
                    u.Mname, 
                    u.Bday,
                    u.ContactNum, 
                    u.Email, 
                    t.case_handled,
                    t.city,
                    t.Radius, 
                    t.license_img
                    FROM tbl_user u JOIN tbl_therapists t ON u.User_id = t.user_id
                    WHERE t.therapist_id  = $sess_APID;";

$var_chk = mysqli_query($var_conn, $var_qry);

$var_Fname = "";
$var_Lname = "";
$var_Mname = "";
$var_MI = "";
$var_Age = "";
$var_CntctNum = "";
$var_Email = "";
$var_CaseHndld = "";
$var_City = "";
$var_Radius = "";
$var_LicenseIMG = "";

if (mysqli_num_rows($var_chk) > 0) {
    $var_get = mysqli_fetch_array($var_chk);
    $var_CaseHndld = $var_get["case_handled"];
    $var_City = $var_get["city"];
    $var_Radius = $var_get["Radius"];
    $var_LicenseIMG = $var_get["license_img"];
    $var_Fname = $var_get["Fname"];
    $var_Lname = $var_get["Lname"];
    $var_Mname = $var_get["Mname"];
    $var_Date = $var_get["Bday"];
    $var_CntctNum = $var_get["ContactNum"];
    $var_Email = $var_get["Email"];
    $var_year = date("Y");
    $var_MI = substr($var_Mname, 0, 1);
    $var_byear = substr($var_Date, 0, 4);
    $var_Age = $var_year - $var_byear;
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PATAppointmentList.php">
                                    <i class="bi bi-calendar-check fs-3"></i><br>
                                    <small>Appointment</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="PatientHistory.php">
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PATnotif.php">
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

    <main class="py-0 py-lg-3">

        <section class="main-section bg-secondary-subtle py-3 py-lg-5 px-3 px-lg-5 shadow container-fluid container-lg">

            <div class="row">
                
                <div class="col-md">

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <img class="img-fluid rounded-5 shadow" style="height: 250px; width: auto;" src="./UserFiles/ProfilePictures/<?php echo $profilePicture ?>" alt="#">
                    </div>
                    <hr>

                    <h3 class="fw-semibold">User Information</h3>

                    <div>
                        <label class="mb-1">
                            <b>Full Name:</b>
                            <span><?php echo $var_Fname . " " . $var_MI . ". " . $var_Lname; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Age:</b>
                            <span><?php echo $var_Age; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Contact Number:</b>
                            <span><?php echo $var_CntctNum; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Email:</b>
                            <span><?php echo $var_Email; ?></span>
                        </label><br>
                    </div>

                    <div>
                        <label>
                            <b>Case Handled:</b>
                            <span><?php echo $var_CaseHndld ?></span>
                        </label>
                    </div>

                    <div>
                        <h3>Area of Operation:</h3>

                        <label class="mb-1">
                            <b>City:</b>
                            <span><?php echo $var_City; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Radius:</b>
                            <span><?php echo $var_Radius; ?></span>
                        </label>
                    </div>

                    <hr>
                </div>

                <div class="col-md">
                    <hr>

                    <label class="mb-2"><b>Medical License</b></label>
                    <div class="d-flex justify-content-start align-items-start">
                        <img class="img-fluid rounded-5 shadow cursor" style="height: auto; width: 100%; cursor: pointer;" src="./UserFiles/LicensePictures/<?php echo $var_LicenseIMG ?>" alt="<?php echo $var_LicenseIMG ?>">
                    </div>

                </div>

            </div>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>