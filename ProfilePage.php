<?php

include "./database.php";

session_start();

if (!isset($_SESSION["sess_id"])) {
    header("location: landingPage.php");
    exit();
}

$var_profid = intval($_SESSION["sess_id"]);
$var_qry = "SELECT u.User_id,
                    u.Fname, 
                    u.Lname, 
                    u.Mname,
                    u.E_wallet,
                    u.Bday,
                    u.ContactNum, 
                    u.Email,
                    u.profilePic,
                    p.P_case,
                    p.case_desc,
                    p.City, 
                    p.barangay,
                    p.assement_photo, 
                    p.mid_hisotry_photo 
                    FROM tbl_user u JOIN tbl_patient p ON u.User_id = p.user_id
                    WHERE 
                    p.User_id ='$var_profid';";
$var_chk = mysqli_query($var_conn, $var_qry);
$var_Fname = "";
$var_Lname = "";
$var_Mname = "";
$var_MI = "";
$var_Age = "";
$var_CntctNum = "";
$var_Email = "";
$var_Case = "";
$var_CaseDesc = "";
$var_City = "";
$var_Stret = "";
$var_Medpic = null;
$var_Assesment = null;

if (mysqli_num_rows($var_chk) > 0) {
    $var_get = mysqli_fetch_array($var_chk);

    $var_Case = implode(",", array_map(function ($value) {
        return " " . $value;
    }, explode(",", $var_get["P_case"])));

    $var_CaseDesc = $var_get["case_desc"];
    $var_City = $var_get["City"];
    $var_Medpic = explode(",", $var_get["mid_hisotry_photo"]);
    $var_Assesment = explode(",", $var_get["assement_photo"]);
    $var_Street = $var_get["barangay"];
    $var_Fname = $var_get["Fname"];
    $var_Lname = $var_get["Lname"];
    $var_Mname = $var_get["Mname"];
    $var_Date = $var_get["Bday"];
    $var_CntctNum = $var_get["ContactNum"];
    $var_Email = $var_get["Email"];
    $profilePicture = $var_get["profilePic"];
    $var_year = date("Y");
    $var_MI = substr($var_Mname, 0, 1);
    $var_byear = substr($var_Date, 0, 4);
    $var_Age = $var_year - $var_byear;
    $var_Balance = $var_get["E_wallet"];

} else {
    echo "No records found";
}

if (isset($_POST["BtnSubmit"])) {
    $var_ammnt = floatval($_POST["TxtMoney"]);
    $var_UpdE_wallet = $var_ammnt + $var_Balance;

    $var_updt = "UPDATE tbl_user SET E_wallet= $var_UpdE_wallet WHERE User_id =  $var_profid ";
    $var_upqry = mysqli_query($var_conn, $var_updt);
    header("location: ./ProfilePage.php");
}

?>
<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Patient View</title>
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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./ProfilePage.php">
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">E_wallet</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="ProfilePage.php" class="needs-validation" id="topUpForm" novalidate>
                        <h3>Balance: <span class="balance">₱<?php echo $var_Balance ?></span></h3>
                        <hr>
                        <label class="mb-1" for="TxtMoney">Top up</label>
                        <input type="number" name="TxtMoney" placeholder="₱" class="form-control" id="TxtMoney" required>
                        <div class="invalid-feedback">Please type in a balance.</div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-5 rounded-5" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="BtnSubmit" form="topUpForm" class="btn btn-primary px-5 rounded-5">Top-up</button>
                </div>
            </div>
        </div>
    </div>

    <main class="py-0 py-sm-3">

        <section class="patient-view-section bg-secondary-subtle py-3 py-sm-5 px-3 px-sm-5 shadow container-fluid container-sm">

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
                            <span class="text-capitalize"><?php echo $var_Fname . " " . $var_MI . ". " . $var_Lname; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Age:</b>
                            <span class="text-capitalize"><?php echo $var_Age; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Contact Number:</b>
                            <span class="text-capitalize"><?php echo $var_CntctNum; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Email:</b>
                            <span class="text-capitalize"><?php echo $var_Email; ?></span>
                        </label><br>
                        <div class="d-flex justify-content-start align-items-center">
                            <label>
                                <b>Balance:</b>
                                <span class="balance text-capitalize">₱<?php echo $var_Balance; ?></span>
                            </label>
                            <button type="button" class="btn btn-sm btn-outline-primary px-3 rounded-5 ms-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Top Up</button>
                        </div>
                    </div>

                    <hr>
                    <h3 class="fw-semibold">Patient Information</h3>

                    <div>
                        <label class="mb-1">
                            <b>Case:</b>
                            <span class="text-capitalize"><?php echo $var_Case; ?></span>
                        </label><br>
                        <label>
                            <b>Description:</b>
                            <span><?php echo $var_CaseDesc; ?></span>
                        </label>
                    </div>

                </div>

                <div class="col-md">
                    <hr>

                    <div class="row gap-4 gap-lg-0">

                        <div class="col-lg">

                            <label class="mb-2"><b>Medical History</b></label>
                            <div class="d-flex justify-content-center align-items-center flex-column gap-2">
                                <?php 

                                foreach ($var_Medpic as $names) {
                                    echo "<img class='img-fluid rounded-5 shadow medicalImages' style='object-fit: cover; cursor: pointer;' src='./UserFiles/PatientMedicalHistoryPictures/$names' alt='$names'>";
                                }

                                ?>
                            </div>

                        </div>

                        <div class="col-lg">

                            <label class="mb-2"><b>Medical Assesment</b></label>
                            <div class="d-flex justify-content-center align-items-center flex-column gap-2">
                                <?php
                                
                                foreach ($var_Assesment as $names) {
                                    echo "<img class='img-fluid rounded-5 shadow medicalImages' style='object-fit: cover; cursor: pointer;' src='./UserFiles/PatientAssementPictures/$names' alt='$names'>";
                                }

                                ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        (() => {
            Array.from(document.getElementsByClassName("needs-validation")).forEach((form) => {
                form.addEventListener("submit", (e) => {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    form.classList.add("was-validated");
                });

                Array.from(form.querySelectorAll('button[data-bs-dismiss="modal"]')).forEach((closeButton) => {
                    closeButton.addEventListener("click", () => {
                        if (form.classList.contains("was-validated")) {
                            form.classList.remove("was-validated");
                        }
                    });
                });
            });

            Array.from(document.getElementsByClassName("medicalImages")).forEach((element) => {
                element.addEventListener("click", () => {
                    window.open(element.src);
                });
            });
        })();

        window.onload = () => {
            Array.from(document.getElementsByClassName("balance")).forEach((balance) => {
                const newValue = formatCurrency(balance.innerHTML);
                balance.innerHTML = newValue;
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