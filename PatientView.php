<?php

include"./database.php";

session_start();

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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-bell fs-3"></i><br>
                                    <small>Notification</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-chat-dots fs-3 chat-badge"></i><br>
                                    <small>Chat</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="#">
                                    <i class="bi bi-person fs-3"></i><br>
                                    <small>Profile</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PatientHomePage.php">
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

        <section class="patient-view-section bg-secondary-subtle py-3 py-sm-5 px-3 px-sm-5 shadow container-fluid container-sm">

            <div class="row">

                <div class="col-lg-3">

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <img id="ProfPic" class="img-fluid rounded-5 shadow" style="height: 250px; width: auto;" src="#" alt="#">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="mb-1">
                            <b>Full Name:</b>
                            <span id="fllname"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Case Handled:</b>
                            <span id="case_handled"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>City:</b>
                            <span id="City"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Barangay:</b>
                            <span id="barangay"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Therapist ID:</b>
                            <span id="ID"></span>
                        </label>
                    </div>

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

    <!-- <div class="container-fluid full-height">
        <div class="white-box">
            <div class="flex-container">
                <div class="box">
                    <div class="Details-box  rounded">
                        <div class="TherapistInfo rounded">
                            <img id="ProfPic" class="border rounded-circle" src="" alt="Profile Picture">
                            <p id="fllname"></p>
                            <p id="case_handled"></p>
                            <p id="City"></p>
                            <p id="Radius"></p>
                            <p id="ID"></p>

                            <p>Rating: </p>
                        </div>
                        <div class="TherapistScghed">
                            <div id="TimeBTN" class="TimeBTN">
                                <button id="BtnAM">AM</button>
                                <button id="BtnPM">PM</button>
                            </div>
                            <div class="AM" id="AM-schedule">
                                <div class="SchedButton">
                                    <div id="AM"></div>
                                </div>
                            </div>
                            <div class="PM" id="PM-schedule" style="display: none;">
                                <div class="SchedButton">
                                    PM Schedule content goes here
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> -->

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        let TherapID;

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
                const response = await fetch("./PatientViewAPI/TherapistsProfAPI.php", {
                    method: "POST",
                    body: JSON.stringify({
                        'ID': "<?php echo $_SESSION["sess_PTID"]; ?>"
                    })
                });

                const data = await response.json();
                const fullname = `${data.fname} ${data.mname.charAt(0)}. ${data.lname}`;

                document.getElementById("fllname").innerText = fullname;
                document.getElementById("ProfPic").src = `./UserFiles/ProfilePictures/${data.ProfPic}`;
                document.getElementById("case_handled").innerText = data.case;
                document.getElementById("City").innerText = data.city;
                document.getElementById("barangay").innerText = data.barangay;
                document.getElementById("ID").innerText = data.therapitst_id;

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

            function createScheduleButton(SchedID, SchedDay, Stime, Etime, Note) {
                const button = document.createElement('button');
                button.className = 'schedule-btn btn btn-outline-primary d-flex justify-content-center align-items-start flex-column gap-1';
                button.value = SchedID;

                const dayLabel = document.createElement('label');
                dayLabel.innerHTML = `<b>Day<small>(s)</small>:</b> ${SchedDay}`

                const timeLabel = document.createElement('label');
                timeLabel.innerHTML = `<b>Time:</b> ${convertTo12HourFormat(Stime)} to ${convertTo12HourFormat(Etime)}`

                const noteLabel = document.createElement('label');
                noteLabel.innerHTML = `<b>Note:</b> ${Note}`

                button.appendChild(dayLabel);
                button.appendChild(timeLabel);
                button.appendChild(noteLabel);
                button.addEventListener("click", () => {
                    SessionSched(SchedID);
                })

                return button;
            }

            try {
                const SchedRes = await fetch("./HomePageAPI/TherapistsSchedAPI.php", {
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
                        var SchedID = schedule.Sched_id;
                        var SchedDay = schedule.Day;
                        var Stime = schedule.Start_ime;
                        var Etime = schedule.End_Time;
                        var Note = schedule.Note;

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

                    Array.from(amElement.querySelectorAll(".schedule-btn")).forEach((button) => {
                        button.addEventListener("click", () => {
                            const SlctedID = button.getAttribute("value");
                            SessionSched(SlctedID);
                        });
                    });

                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById("AM").innerHTML = "An error occurred while fetching schedules.";
                document.getElementById("PM").innerHTML = "An error occurred while fetching schedules.";
            }
        }

        function SessionSched(SlctedID){
            fetch("./PatientViewAPI/SelectedDateAPI.php",{
                method: "POST",
                body: JSON.stringify({
                    SchedID:SlctedID
                })
            });
            window.location.href = "PatAppointment.php";
        }
    </script>

</body>

</html>