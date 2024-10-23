<?php

include "./database.php";

session_start();

$_SESSION["sess_id"];

if (!isset($_SESSION["sess_id"])) {
    header("location: landingPage.php");
    exit();
}

$var_profid = intval($_SESSION["sess_id"]);
$var_qry = "SELECT u.User_id,
                    u.Fname, 
                    u.Lname, 
                    u.Mname, 
                    u.Bday,
                    u.ContactNum, 
                    u.Email, 
                    u.E_wallet,
                    u.profilePic,
                    t.case_handled,
                    t.city,
                    t.Radius,
                    t.barangay,
                    t.license_img
                    FROM tbl_user u JOIN tbl_therapists t ON u.User_id = t.user_id
                    WHERE 
                    t.User_id ='$var_profid';";
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

$profilePic = "";
$balance;

if (mysqli_num_rows($var_chk) > 0) {
    $var_get = mysqli_fetch_array($var_chk);

    $var_CaseHndld = implode(", ", explode(",", $var_get["case_handled"]));

    $var_City = $var_get["city"];
    $var_Radius = $var_get["Radius"];
    $var_LicenseIMG = $var_get["license_img"];
    $var_Fname = $var_get["Fname"];
    $var_Lname = $var_get["Lname"];
    $var_Mname = $var_get["Mname"];
    $var_Date = $var_get["Bday"];
    $var_CntctNum = $var_get["ContactNum"];
    $var_Email = $var_get["Email"];
    $profilePic = $var_get["profilePic"];
    $balance = $var_get["E_wallet"];
    $var_year = date("Y");
    $var_MI = substr($var_Mname, 0, 1);
    $var_byear = substr($var_Date, 0, 4);
    $var_Age = $var_year - $var_byear;

} else {
    echo "No records found";
}
$var_UId = $var_get['User_id'];
$var_ammnt = "";
if (isset($_POST["BtnSubmit"])) {
    $var_ammnt = floatval($_POST["TxtMoney"]);

    $var_updt = "UPDATE tbl_user SET E_wallet= $var_ammnt WHERE User_id =  $var_UId ";
    $var_upqry = mysqli_query($var_conn, $var_updt);
}

?>
<!DOCTYPE html>
<html data-bs-theme="light">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Therapist Profile</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/TherapistHomePage.css'>
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./TherapistsHomePage.php">
                                    <i class="bi bi-house fs-3"></i><br>
                                    <small>Home</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-hospital fs-3"></i><br>
                                    <small>Session</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./TherapistsAppointment.php">
                                    <i class="bi bi-calendar-check fs-3"></i><br>
                                    <small>Appointment</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="">
                                    <i class="bi bi-clock-history fs-3"></i><br>
                                    <small>History</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-card-checklist fs-3"></i><br>
                                    <small>Reminder</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-bell fs-3"></i><br>
                                    <small>Notification</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./TherapistChat.php">
                                    <i class="bi bi-chat-dots fs-3 chat-badge"></i><br>
                                    <small>Chat</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./TherapistsProfilePage.php">
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

    <form method="POST" action="TherapistsProfilePage.php" class="needs-validation" novalidate>
        <div class="modal fade" id="topUpModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">E Wallet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="fw-semibold">Balance: <span class="balance"><?php echo $balance; ?></span></h3>
                        <div class="mb-3">
                            <label class="mb-1">Top up</label>
                            <input type="text" name="TxtMoney" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="BtnSubmit" class="btn btn-primary">Top-up</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <main class="py-0 py-sm-3">

        <section class="main-section bg-secondary-subtle py-3 py-sm-5 px-3 px-sm-5 shadow container">

            <div class="row">

                <div class="col-md">
                    <h3 class="fw-semibold">User Information</h3>
                    <hr>

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <img id="ProfPic" class="img-fluid rounded-5 shadow" style="height: 250px; width: auto;" src="./UserFiles/ProfilePictures/<?php echo $profilePic; ?>" alt="<?php echo $profilePic; ?>">
                    </div>
                    <hr>

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
                            <b>Mobile Number:</b>
                            <span><?php echo $var_CntctNum; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Email:</b>
                            <span><?php echo $var_Email; ?></span>
                        </label><br>
                        <label class="mb-1 d-flex justify-content-start align-items-center flex-row gap-1">
                            <b>Balance:</b>
                            <span class="balance"><?php echo $balance; ?></span>
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#topUpModal">Top Up</button>
                        </label>
                        <label>
                            <b>User ID:</b>
                            <span><?php echo $var_get["User_id"]; ?></span>
                        </label><br>
                    </div>

                </div>

                <div class="col-md">
                    <h3 class="fw-semibold">Therapist Information</h3>
                    <hr>

                    <div class="mb-3">
                        <label class="mb-1">
                            <b>Case Handled:</b>
                            <span><?php echo $var_CaseHndld; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>City:</b>
                            <span><?php echo $var_City; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Barangay:</b>
                            <span><?php echo $var_get["barangay"]; ?></span>
                        </label><br>
                        <label>
                            <b>Radius:</b>
                            <span><?php echo $var_Radius ? $var_Radius : "<i>N/A</i>"; ?></span>
                        </label>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-center align-items-start flex-column">
                        <label class="mb-2 fw-semibold">License Image:</label>
                        <img class="img-fluid licenseImage rounded shadow" style="object-fit: cover; cursor: pointer;" src="./UserFiles/LicensePictures/<?php echo $var_LicenseIMG; ?>" alt="<?php echo $var_LicenseIMG; ?>">
                    </div>
                </div>

            </div>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        window.onload = () => {
            Array.from(document.getElementsByClassName("needs-validation")).forEach((form) => {
                form.addEventListener("submit", (e) => {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    form.classList.add("was-validated");
                });
            });

            Array.from(document.getElementsByClassName("balance")).forEach((element) => {
                element.innerHTML = formatCurrency(element.innerHTML);
            });
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