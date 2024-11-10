<?php

include "../database.php";

session_start();

$sess_PTID = $_GET["record"];


$var_GettherapistId = "SELECT therapist_id FROM tbl_therapists WHERE user_id =$sess_PTID";
$var_qry = mysqli_query($var_conn, $var_GettherapistId);

$var_PTRec = mysqli_fetch_array($var_qry);
$var_PTID = $var_PTRec["therapist_id"];
$var_success="Yes";



if(isset($_POST["BtnDisable"])){
    
    $var_Disable="UPDATE tbl_therapists SET validate = 0 where therapist_id = $var_PTID";
    $var_Disableqry = mysqli_query($var_conn,$var_Disable);

    if($var_Disableqry){
        echo "Account Disabled";
    }
}

?>

<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Admin View</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/PatientHomePage.css'>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary-subtle">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./AdminHomePage.php">
                                    <i class="bi bi-house fs-3"></i><br>
                                    <small>Home</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./AdminManageUsers.php">
                                    <i class="bi bi-hospital fs-3"></i><br>
                                    <small>Manage users</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./Reports.php">
                                    <i class="bi bi-calendar-check fs-3"></i><br>
                                    <small>Reports</small>
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

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <main class="py-0 py-sm-3">

        <section class="patient-view-section bg-secondary-subtle py-3 py-sm-5 px-3 px-sm-5 shadow container-fluid container-sm">

            <div class="row">

                <div class="col-lg-3">

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <img id="ProfPic" class="img-fluid rounded-5 shadow" style="height: 250px; width: auto;" src="#" alt="#">
                    </div>

                    <hr>

                    <div class="mb-1">
                        <label class="mb-1">
                            <b>Full Name:</b>
                            <span id="fllname" class="text-capitalize"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Case Handled:</b>
                            <span id="case_handled" class="text-capitalize"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>City:</b>
                            <span id="City" class="text-capitalize"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Barangay:</b>
                            <span id="barangay" class="text-capitalize"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Therapist ID:</b>
                            <span id="ID"></span>
                        </label>
                    </div>

                    <button type="button" id="sendMessageButton" class="btn btn-primary rounded-5 w-100 mb-3 mb-lg-0">Send Message</button>
                    <button type="button" id="DA" data-bs-toggle="modal" data-bs-target="#Disableaccount" class="btn btn-danger rounded-5 w-100 mb-3 mb-lg-0">Disable Account</button>


                </div>

                <div class="col-lg">

                    <div id="TimeBTN" class="TimeBTN mb-3">
                        <button id="BtnAM" class="btn btn-primary px-5 rounded-5">AM</button>
                        <button id="BtnPM" class="btn btn-primary px-5 rounded-5">PM</button>
                    </div>

                    <div class="AM shadow p-3 rounded" id="AM-schedule">
                        <div class="SchedButton">
                            <div id="AM" class="d-flex justify-content-center justify-content-sm-start align-items-start gap-2 flex-wrap">

                            </div>
                        </div>
                    </div>
                    <div class="PM shadow p-3 rounded" id="PM-schedule" style="display: none;">
                        <div class="SchedButton" id="PM" class="d-flex justify-content-center justify-content-sm-start align-items-start gap-2 flex-wrap">

                        </div>
                    </div>

                </div>

            </div>

        </section>
    </main>
    <form method="POST" action>
        <!-- Modal -->
        <div class="modal fade" id="Disableaccount" tabindex="-1" aria-labelledby="Disableaccount" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="Disableaccount">Disable Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Disable account
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="BtnDisable" class="btn btn-danger">Disable</button>
                    </div>
                </div>
            </div>
        </div>

    </form>





    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        var TherapID;
        
       
       
       
        


        (() => {
           
            const btnAM = document.getElementById('BtnAM');
            const btnPM = document.getElementById('BtnPM');
            const amSchedule = document.getElementById('AM-schedule');
            const pmSchedule = document.getElementById('PM-schedule');

            if (btnAM && btnPM && amSchedule && pmSchedule) {
                btnAM.addEventListener('click', function() {
                    amSchedule.style.display = 'block';
                    pmSchedule.style.display = 'none';
                });

                btnPM.addEventListener('click', function() {
                    amSchedule.style.display = 'none';
                    pmSchedule.style.display = 'block';
                });
            }

            PTProf();
        })();

        async function PTProf() {
            try {
                const response = await fetch("../PatientViewAPI/TherapistsProfAPI.php", {
                    method: "POST",
                    body: JSON.stringify({
                        'ID': "<?php echo $var_PTID; ?>"
                    })
                });

                const data = await response.json();
                const fullname = `${data.fname} ${data.mname.charAt(0)}. ${data.lname}`;

                document.getElementById("fllname").innerText = fullname;
                document.getElementById("ProfPic").src = `../UserFiles/ProfilePictures/${data.ProfPic}`;
                document.getElementById("case_handled").innerText = data.case.split(",").map((word) => {
                    return " " + word;
                }).toString();
                document.getElementById("City").innerText = data.city;
                document.getElementById("barangay").innerText = data.barangay;
                document.getElementById("ID").innerText = data.therapitst_id;

                document.getElementById("sendMessageButton").addEventListener("click", () => {
                    window.location.href = `./PatientChat.php?newChat=${data.userID}`;
                });

                TherapID = data.therapitst_id;
                GetSched(TherapID);
            } catch (error) {
                console.error('Error:', error);
            }
        }

        async function GetSched(TherapID) {
            function convertTo12HourFormat(time24) {
                const [hours, minutes] = time24.split(':');
                let hour12 = hours % 12 || 12;
                const period = hours >= 12 ? 'PM' : 'AM';

                hour12 = String(hour12).padStart(2, '0');

                return `${hour12}:${minutes} ${period}`;
            }


            try {
                const SchedRes = await fetch("../HomePageAPI/TherapistsSchedAPI.php", {
                    method: "POST",
                    body: JSON.stringify({
                        "TID": TherapID
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const scheddata = await SchedRes.json();
                const amElement = document.getElementById("AM");
                const pmElement = document.getElementById("PM");

                amElement.innerHTML = "";
                pmElement.innerHTML = "";

                if (scheddata.message) {

                    amElement.innerHTML = scheddata.message;
                    pmElement.innerHTML = scheddata.message;

                } else {
                    scheddata.forEach(schedule => {
                        const SchedID = schedule.Sched_id;

                        const SchedDay = schedule.Day.split(",").map((item) => {
                            return " " + item;
                        }).toString();

                        const Stime = schedule.Start_ime;
                        const Etime = schedule.End_Time;
                        const Note = schedule.Note;

                        if (convertTo12HourFormat(schedule.Start_ime).includes("AM")) {
                            const scheduleHTML = `
                                <button value="${SchedID}" class='schedule-btn btn btn-outline-primary d-flex justify-content-center align-items-start flex-column gap-1'>
                                    <label><b>Day<small>(s)</small>:</b> ${SchedDay}</label>
                                    <label><b>Time:</b> ${convertTo12HourFormat(Stime)} to ${convertTo12HourFormat(Etime)}</label>
                                    <label><b>Note:</b> ${Note}</label>
                                </button>`;

                            amElement.innerHTML += scheduleHTML;

                        } else if (convertTo12HourFormat(schedule.Start_ime).includes("PM")) {
                            const scheduleHTML = `
                            <button value="${SchedID}" class='schedule-btn btn btn-outline-primary d-flex justify-content-center align-items-start flex-column gap-1'>
                                <label><b>Day<small>(s)</small>:</b> ${SchedDay}</label>
                                <label><b>Time:</b> ${convertTo12HourFormat(Stime)} to ${convertTo12HourFormat(Etime)}</label>
                                <label><b>Note:</b> ${Note}</label>
                            </button>`;

                            pmElement.innerHTML += scheduleHTML;
                        }
                    });




                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById("AM").innerHTML = "An error occurred while fetching schedules.";
                document.getElementById("PM").innerHTML = "An error occurred while fetching schedules.";
            }
        }
        
    </script> 

</body>

</html>