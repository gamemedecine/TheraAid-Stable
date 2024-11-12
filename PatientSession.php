<?php

include "./database.php";

session_start();

// echo  $_SESSION["Patient_id"]."<br>";

$var_appid = $_SESSION["Patient_id"];

date_default_timezone_set('Asia/Manila'); // Change to your timezone

$var_crrntTime = date("h:i:sa");
//$var_currntDate = date("Y-m-d");
$var_currntDate = "2024-10-18";

// echo $var_currntDate . "<br>";
// echo $var_crrntTime;

$var_filter = "";
$var_days= array();
$var_sessionList = "SELECT *    
                        FROM tbl_session SS JOIN tbl_appointment AP ON AP.appointment_id = SS.appointment_id
                        JOIN tbl_therapists PT ON PT.therapist_id = AP.therapists_id 
                        JOIN tbl_patient PAT ON AP.patient_id =  PAT.patient_id 
                        JOIN tbl_user U ON PT.user_id = U.User_id 
                        JOIN tbl_sched SC ON SC.shed_id = AP.schedle_id
                    WHERE AP.patient_id =$var_appid  AND AP.status LIKE '%On-Going%'";
$var_Slist = mysqli_query($var_conn, $var_sessionList);

if(isset($_POST["BtnFilter"]) && isset($_POST["RadDay"])){
    $var_filter = $_POST["RadDay"];
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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="PatientSession.php">
                                    <i class="bi bi-hospital fs-3"></i><br>
                                    <small>Session</small>
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

    <main class="py-0 py-sm-3">

        <section class="main-section bg-secondary-subtle py-3 py-sm-5 px-3 px-sm-5 shadow container">

            <form method="POST" action="PatientSession.php" class="overflow-x-auto">

                <div class="d-flex justify-content-start align-items-center flex-row gap-2 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RadDay" id="All">
                        <label class="form-check-label" for="All">
                            All
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RadDay" id="Mon">
                        <label class="form-check-label" for="Mon">
                            Monday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RadDay" id="Tue">
                        <label class="form-check-label" for="Tue">
                            Tuesday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RadDay" id="Wed">
                        <label class="form-check-label" for="Wed">
                            Wednesday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RadDay" id="Thu">
                        <label class="form-check-label" for="Thu">
                            Thursday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RadDay" id="Fri">
                        <label class="form-check-label" for="Fri">
                            Friday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RadDay" id="Sat">
                        <label class="form-check-label" for="Sat">
                            Saturday
                        </label>
                    </div>
                    <button type="submit" name="BtnFilter" class="btn btn-primary px-5 rounded-5 shadow btn-sm">Filter</button>
                </div>

                <table class="table table-striped shadow">
                    <tr>
                        <th style="text-align:center;">Sessions</th>
                    </tr>
                    
                    <tr>
                        <?php

                        if(mysqli_num_rows($var_Slist)>0){
                            while($var_SSRec=mysqli_fetch_array($var_Slist)){
                                $var_days= explode(",", $var_SSRec["day"]);
                                    if(in_array($var_filter,$var_days)){
                                        $session_id = $var_SSRec["session_id"];
                                        $firstName = $var_SSRec["Fname"];
                                        $middleName = $var_SSRec["Mname"];
                                        $lastName = $var_SSRec["Lname"];
                                        $start_time = $var_SSRec["start_time"];
                                        $end_time = $var_SSRec["end_time"];

                                        $fullName = "$firstName $middleName $lastName";
                                        $info = "$fullName<br>$start_time-$end_time";

                        ?>
                                        <td>
                                            <button style="width: 1100px; height: 100px; border-radius: 25px;" type="submit" name="BtnsessID" value="<?php echo $session_id ?>">
                                                <?php echo $info; ?>
                                            </button>
                                        </td>
                                    </tr>
                        <?php

                        }else if($var_filter == "All"){

                        ?>
                            <tr>
                                <td>
                                    <button style="btn btn-primary rounded-5 shadow w-100" type="submit" name="BtnsessID" value="">Yes</button>
                                </td>
                            </tr>
                        <?php

                        }else{
                           echo "<td>
                                <button class='btn btn-outline-secondary rounded-5 shadow w-100' disabled>No Data</button>
                            </td>";
                           break;
                        } } }else{

                        ?>
                        <td>
                            <button class="btn btn-outline-secondary rounded-5 shadow w-100" disabled>No Data</button>
                        </td>
                        <?php

                        }

                        ?>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="Session" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Session</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <button type="button" id="StartSession" class="btn btn-primary">Start Session</button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Session-->
                <div class="modal fade" id="Editsess" tabindex="-1"aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Edit Session</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Note:</label><br>
                                <textarea style="height:100px;" name="TxtDuration" class="form-control"></textarea>
                                <input type="file" name="SessPhotos" class="form-control" multiple required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="StartSession" class="btn btn-primary px-5 rounded-5 shadow">Save</button>
                                <button type="button" class="btn btn-secondary px-5 rounded-5 shadow" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>