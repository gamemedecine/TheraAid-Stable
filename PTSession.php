<?php

include "./database.php";

session_start();

echo $_SESSION["sess_PATID"];

$var_appid = $_SESSION["sess_PATID"];

date_default_timezone_set('Asia/Manila'); // Change to your timezone

$var_crrntTime = date("h:i:sa");
//$var_currntDate = date("Y-m-d");
$var_currntDate = "2024-10-18";

// echo $var_currntDate . "<br>";
// echo $var_crrntTime;

$var_sessionList = "SELECT * FROM tbl_session  WHERE appointment_id =" . $var_appid;
$var_Slist = mysqli_query($var_conn, $var_sessionList);

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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./PTSession.php">
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-clock-history fs-3"></i><br>
                                    <small>History</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./TherapistsReminder.php">
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

            <form method="POST" action="PTSession.php">
                <div class="container-fluid full-height">
                    <div class="white-box">
                        <div class="flex-container">
                            <div class="box">
                                <div class="Details-box  rounded">
                                    <div class="TherapistInfo">
                                        <img id="ProfPic" class="border rounded-circle" style="width: 200px; height: 180px;"
                                            src="" alt="profile Picture">
                                        <br><br>
                                        <p id="fllname"></p>
                                        <p id="case"></p>
                                        <p id="City"></p>
                                        <p id="sess"></p>
        
                                    </div>
                                </div>
                                <div class="hi">
                                    <div id="Therapists" style="padding-left: 20px; padding-top: 50px;">
                                        <div class="SessionList">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#Session">
                                                +
                                            </button>
        
                                        </div>
                                        <div id="sessions">
                                            <p id="check"></p>
        
                                        </div>
        
                                    </div>
                                </div>
                            </div>
        
                        </div>
        
                    </div>
        
        
                </div>
        
        
                <!-- Modal -->
                <div class="modal fade" id="Session" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Session</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <button type="button" id="StartSession" class="btn btn-primary">Start Session</button>
                                <!-- <label>Note:</label><br>
                                <textarea  style="height:100px; width: 100%;" name="TxtDuration" ></textarea> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit Session-->
                <div class="modal fade" id="Editsess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Session</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Note:</label><br>
                                <textarea style="height:100px; width: 100%;" name="TxtDuration"></textarea>
                                <input type="file" name="SessPhotos" multiple>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="StartSession" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let city;
            let caseDesc;
            let PtntID;
            let AppntmntId;
            async function GETPatient() {
                try {
                    const response = await fetch("./PTSESSIONAPI/PTsessionAPI.php", {
                        method: "POST",
                        body: JSON.stringify({
                            "PTID": "<?php echo $_SESSION["sess_PATID"]; ?>"
                        })
                    });
                    const data = await response.json();
                    const fullname = `${data.fname} ${data.mname.charAt(0)}. ${data.lname}`;
                    document.getElementById("fllname").innerText = "Name :" + fullname;
                    document.getElementById("ProfPic").src = `ProfilePic/${data.profPic}`;
                    document.getElementById("case").innerText = "Case :" + data.case;
                    document.getElementById("City").innerText = "City :" + data.city;
                    document.getElementById("sess").innerText = "Session:" + data.Session;
                    AppntmntId = data.APID;
                    city = data.city;
                    caseDesc = data.case;
                    PtntID = data.PtntID;


                } catch (error) {
                    console.error('Error:', error);
                }
            }



            GETPatient();
            document.getElementById("StartSession").addEventListener("click", () => {
                checkSession(AppntmntId);
            });

            async function checkSession(AppntmntId) {
                try {
                    const response = await fetch("./PTSESSIONAPI/PTcheckSession.php", {
                        method: "POST",
                        body: JSON.stringify({
                            "appId": AppntmntId
                        })
                    })
                    const res = await response.text();
                    if (res == "1") {
                        alert(AppntmntId + "  " + "You have already started a session!");
                    }
                    else if (res == "2") {
                        alert(AppntmntId + "  " + "You dont Have a session today!");
                    }
                    else if (res == "0") {
                        alert(AppntmntId + "  " + "New session have been added!");
                    }

                }

                catch (err) {
                    console.error(err.message);

                }
            }


        });

    </script>
</body>

</html>