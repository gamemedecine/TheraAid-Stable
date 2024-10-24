<?php

include "./database.php";

function calculateAge($birthdate) {
    $birthdateYear = explode("-", $birthdate)[0];
    $currentYear = explode("-", date("Y-m-d"))[0];

    return $currentYear - $birthdateYear;
}

if (isset($_GET["userID"])) {

    $targetUserID = $_GET["userID"];

    $sql = "SELECT
            user.User_id,
            CONCAT(user.Fname, ' ', user.Mname, ' ', user.Lname) as fullName,
            user.Bday,
            user.ContactNum,
            user.Email,
            user.profilePic,

            patient.patient_id,
            patient.P_case,
            patient.case_desc,
            patient.City,
            patient.barangay,
            CONCAT(patient.barangay, ', ', patient.City) as fullAddress
        FROM tbl_user user
        JOIN tbl_patient patient
        ON patient.user_id = user.User_id
        WHERE user.User_id = $targetUserID";
    $result = $var_conn->query($sql)->fetch_assoc();

    $userID = $result["User_id"];
    $fullName = $result["fullName"];
    $age = calculateAge($result["Bday"]);
    $contactNum = $result["ContactNum"];
    $email = $result["Email"];
    $profilePic = $result["profilePic"];
    
    $patientID = $result["patient_id"];
    $case = implode(", ", explode(",", $result["P_case"]));
    $caseDesc = $result["case_desc"];
    $city = $result["City"];
    $barangay = $result["barangay"];
    $fullAddress = $result["fullAddress"];
} else {
    echo "Missing variable, please try again.";
    exit;
}

?>
<!DOCTYPE html>
<html data-bs-theme="light">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Therapist Home Page</title>
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./TherapistsProfilePage.php">
                                    <i class="bi bi-person fs-3"></i><br>
                                    <small>Profile</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./TherapistHomePage.php">
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

    <main class="py-0 py-sm-3">

        <section class="main-section bg-secondary-subtle py-3 py-sm-5 px-3 px-sm-5 shadow container">

            <div class="row">

                <div class="col-lg">
                    <h3 class="fw-semibold">User Information</h3>

                    <hr>

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <img id="ProfPic" class="img-fluid rounded-5 shadow" style="height: 250px; width: auto;" src="./UserFiles/ProfilePictures/<?php echo $profilePic; ?>" alt="<?php echo $profilePic; ?>">
                    </div>
                    <hr>

                    <div>
                        <label class="mb-1">
                            <b>Full Name:</b>
                            <span><?php echo $fullName; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Age:</b>
                            <span><?php echo $age; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Mobile Number:</b>
                            <span><?php echo $contactNum; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Email:</b>
                            <span><?php echo $email; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>User ID:</b>
                            <span><?php echo $userID; ?></span>
                        </label><br>
                    </div>
                </div>
                
                <div class="col-lg">
                    
                    <h3 class="fw-semibold">Patient Information</h3>

                    <hr>

                    <div class="mb-3">
                        <label class="mb-1">
                            <b>Patient Case:</b>
                            <span><?php echo $case; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Case Description:</b>
                            <span><?php echo $caseDesc; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Full Address:</b>
                            <span><?php echo $fullAddress; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Barangay:</b>
                            <span><?php echo $barangay; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>City:</b>
                            <span><?php echo $city; ?></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Patient ID:</b>
                            <span><?php echo $patientID; ?></span>
                        </label><br>
                    </div>

                    <button class="btn btn-primary px-5 rounded-5" id="sendMessageButton">Send Message</button>
                
                </div>

            </div>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        (() => {

            const sendMessageButton = document.getElementById("sendMessageButton");

            sendMessageButton.onclick = () => {
                const urlParams = new URLSearchParams(window.location.search);
                window.location.href = `./TherapistChat.php?newChat=${urlParams.get('userID')}`;
            }

        })();
    </script>
</body>
</html>