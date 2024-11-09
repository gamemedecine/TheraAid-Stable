<?php

include "./database.php";

session_start();

if (
    !isset($_SESSION["sess_PTID"]) &&
    !isset($_SESSION["sess_id"])
) {
    header("Location: Login.php");
    exit();
}

$var_Tid = $_SESSION["sess_PTID"];
$var_Etime = "";


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
                            <img src="./assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64"
                                height="64">
                        </h5>
                        <button type="button" class="btn-close shadow" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-0 gap-0 gap-lg-4">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center active" aria-current="page"
                                    href="./TherapistsHomePage.php">
                                    <i class="bi bi-house fs-3"></i><br>
                                    <small>Home</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PTSession.php">
                                    <i class="bi bi-hospital fs-3"></i><br>
                                    <small>Session</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page"
                                    href="./TherapistsAppointment.php">
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
                                <a class="nav-link fw-semibold text-center" aria-current="page"
                                    href="./TherapistsReminder.php">
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
                                <a class="nav-link fw-semibold text-center" aria-current="page"
                                    href="./TherapistChat.php">
                                    <i class="bi bi-chat-dots fs-3 chat-badge"></i><br>
                                    <small>Chat</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center" aria-current="page"
                                    href="./TherapistsProfilePage.php">
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

    <div class="modal fade" id="add-schedule-modal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="InputSched" class="needs-validation" novalidate>
                        <div id="alertPlaceHolder"></div>
                        <input type="text" name="TxtID" value="<?php echo $var_Tid; ?>" hidden>
                        <div class="mb-3">
                            <label class="mb-1">Days <span class="text-danger">*</span></label><br>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Mon"
                                    id="monday">
                                <label class="form-check-label" for="monday">Monday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Tue"
                                    id="tuesday">
                                <label class="form-check-label" for="tuesday">Tuesday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Wed"
                                    id="wednesday">
                                <label class="form-check-label" for="wednesday">Wednesday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="THU"
                                    id="thursday">
                                <label class="form-check-label" for="thursday">Thursday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Fri"
                                    id="friday">
                                <label class="form-check-label" for="friday">Friday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Sat"
                                    id="saturday">
                                <label class="form-check-label" for="saturday">Saturday</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Note" class="mb-1">Note <i>(Optional)</i></label><br>
                            <input type="text" id="Note" name="Note" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="startTime" class="mb-1">Start Time <span
                                        class="text-danger">*</span></label><br>
                                <select id="startTime" name="start_time" class="form-control" required>
                                    <option value="">Select a start time.</option>
                                    <?php

                                    for ($var_i = 7; $var_i <= 12; $var_i++) {
                                        echo "<option value=" . $var_i . ":30" . ">" . $var_i . ":30 AM</option>";
                                    }

                                    for ($var_j = 1; $var_j <= 5; $var_j++) {
                                        echo "<option value=" . ($var_j + 12) . ":30" . ">" . $var_j . ":30 PM</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="endTime" class="mb-1">End Time <span class="text-danger">*</span></label>
                                <select id="endTime" name="end_time" class="form-control" required>
                                    <option value="">Please select a start time first.</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-5 rounded-5"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-5 rounded-5" form="InputSched">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!--EDIT MODAL--->

    <div class="modal fade" id="EditscheduleModal" tabindex="-1" aria-labelledby="EditscheduleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditscheduleModal">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input id="modalSchedId" name="TxtSchedID" hidden>
                    <label>Day(s):</label>
                    <input type="checkbox" name="days[]" value="Mon"><label>Mon</label>
                    <input type="checkbox" name="days[]" value="Tue"><label>Tue</label>
                    <input type="checkbox" name="days[]" value="Wed"><label>Wed</label>
                    <input type="checkbox" name="days[]" value="THU"><label>Thu</label>
                    <input type="checkbox" name="days[]" value="Fri"><label>Fri</label>
                    <input type="checkbox" name="days[]" value="Sat"><label>Sat</label>

                    <br><label>Start Time: </label>
                    <select id="modalSTime" name="SlctSTime">

                    </select>
                    <label>End Time: </label>
                    <select id="modalETime" name="SlctETime">

                    </select><br>
                    <label>Note:</label><textarea id="modalNote" name="EditNote"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary px-5 rounded-5" id="editButton">Edit</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal">
                        Delete
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteModalLabel">Warning</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this schedule?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="main-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <main class="py-0 py-sm-3">

        <section class="main-section bg-secondary-subtle py-3 py-sm-5 px-3 px-sm-5 shadow container">
            <div class="row">

                <div class="col-lg-3">

                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <img id="ProfPic" class="img-fluid rounded-5 shadow" style="height: 250px; width: auto;" src="#"
                            alt="#">
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
                            <b>Therapist ID:</b>
                            <span id="ID"></span>
                        </label>
                    </div>

                    <hr>

                    <div class="TherapistScghed">
                        <div id="TimeBTN" class="TimeBTN d-flex justify-content-center align-items-center gap-1 mb-3">
                            <button id="BtnAM" class="btn btn-primary px-5 rounded-5 w-100">AM</button>
                            <button id="BtnPM" class="btn btn-primary px-5 rounded-5 w-100">PM</button>
                        </div>
                        <div class="AM" id="AM-schedule">
                            <div class="SchedButton">
                                <p id="AM"
                                    class="d-flex justify-content-start align-items-center flex-column shadow rounded p-3 gap-2"
                                    style="height: 250px; overflow-y: auto;"></p>
                            </div>
                        </div>
                        <div class="PM" id="PM-schedule" style="display: none;">
                            <div class="SchedButton">
                                <p id="PM"
                                    class="d-flex justify-content-start align-items-center flex-column shadow rounded p-3 gap-2"
                                    style="height: 250px; overflow-y: auto;"></p>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-5 rounded-5 w-100"
                            data-bs-target="#add-schedule-modal" data-bs-toggle="modal">Add Schedule</button>
                    </div>

                </div>

                <div class="col-lg">

                    <h3>Near Me Patients</h3>
                    <hr>

                    <div id="patients"
                        class="d-flex justify-content-center justify-content-lg-start align-items-start flex-wrap p-3 gap-3 rounded shadow"
                        style="height: 740px; overflow-y: auto;">

                    </div>

                </div>
            </div>
        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        let TherapID;

        (() => {

            const btnAM = document.getElementById('BtnAM');
            const btnPM = document.getElementById('BtnPM');
            const amSchedule = document.getElementById('AM-schedule');
            const pmSchedule = document.getElementById('PM-schedule');

            if (btnAM && btnPM && amSchedule && pmSchedule) {
                btnAM.addEventListener('click', function () {
                    amSchedule.style.display = 'block';
                    pmSchedule.style.display = 'none';
                });

                btnPM.addEventListener('click', function () {
                    amSchedule.style.display = 'none';
                    pmSchedule.style.display = 'block';
                });
            }

            suway();

            // Add Schedule Function

            document.getElementById("startTime").addEventListener("change", function () {
                const startTime = parseInt(this.value);
                const endTimeSelect = document.getElementById("endTime");

                endTimeSelect.innerHTML = '';

                if (startTime >= 7 && startTime <= 16) {
                    for (let i = startTime + 1; i <= 17; i++) {
                        let period = i < 12 ? "AM" : "PM";
                        let displayHour = i <= 12 ? i : i - 12;
                        endTimeSelect.innerHTML += `<option value="${i}:30">${displayHour}:30 ${period}</option>`;
                    }
                }
            });

            const form = document.getElementById("InputSched");

            form.addEventListener("submit", async (e) => {
                const alertPlaceholder = document.getElementById("alertPlaceHolder");

                const addScheduleModal = document.querySelector("#add-schedule-modal");

                const button = addScheduleModal.querySelector("button[type='submit']");

                const appendAlert = (message, type) => {
                    const wrapper = document.createElement('div')
                    wrapper.innerHTML = [
                        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                        `   <div>${message}</div>`,
                        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                        '</div>'
                    ].join('');

                    alertPlaceholder.appendChild(wrapper);
                }

                e.preventDefault();
                e.stopPropagation();

                form.classList.add("was-validated");

                const StarTime = form.start_time.value;
                const EndTime = form.end_time.value;
                const Note = form.Note.value
                const checkboxes = form["CheckBoxDay[]"];

                var Error = "";
                var isThereChecked = false;
                var therapists_id = form["TxtID"].value;
                var days = [];
                var Status = "Available";

                days = days.map((day) => {
                    return day + ",";
                })

                for (var i = 0; i < checkboxes.length; i++) {
                    const isChecked = checkboxes[i].checked;

                    if (isChecked) {
                        isThereChecked = true;
                    }
                }

                if (isThereChecked) {
                    checkboxes.forEach((item) => {
                        if (item.checked) {
                            days.push(item.value)
                        }
                    });
                } else {
                    var Error = "Error";
                }

                if (StarTime === "" || EndTime === "") {
                    var Error = "Error";

                }
                if (Note === "") {
                    var Error = "Error";

                }

                if (Error == "") {
                    try {
                        const r = await fetch("./SchedAPI/SchedCheckerAPI.php", {
                            method: "POST",
                            body: JSON.stringify({
                                day: days,
                                start_time: StarTime,
                                therapists_id: therapists_id,
                            })
                        });

                        const rText = await r.text();

                        switch (rText) {
                            case "0":
                                try {
                                    const response = await fetch("./SchedAPI/SchedPOST.php", {
                                        method: "POST",
                                        body: JSON.stringify({
                                            therapists_id: therapists_id,
                                            day: days,
                                            start_time: StarTime,
                                            end_time: EndTime,
                                            note: Note,
                                            status: Status
                                        })
                                    });

                                    showToast("Your schedule has been created!");

                                    if (button.hasAttribute("data-bs-dismiss")) {
                                        button.click();
                                        form.reset();
                                        form.classList.remove("was-validated");
                                        alertPlaceholder.innerHTML = "";
                                    } else {
                                        button.setAttribute("data-bs-dismiss", "modal");
                                        button.click();
                                        form.reset();
                                        form.classList.remove("was-validated");
                                        alertPlaceholder.innerHTML = "";
                                    }

                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);

                                } catch (err) {
                                    console.log(err.message);
                                }
                                break;
                            case "1":
                                appendAlert("This schedule has already been taken.", "danger");
                                break;
                            case "2":
                                appendAlert("This time is in between the saved.", "danger");
                                break;
                        }
                    } catch (err) {
                        console.error(err.message);
                    }
                }
            });

        })();

        async function suway() {
            try {
                let response = await fetch("./HomePageAPI/TheraPistsAPI.php", {
                    method: "POST",
                    body: JSON.stringify({
                        'ID': "<?php echo $_SESSION["sess_id"]; ?>"
                    })
                });

                const data = await response.json();
                const fullname = `${data.fname} ${data.mname.charAt(0)}. ${data.lname}`;

                TherapID = data.therapitst_id;

                document.getElementById("fllname").innerText = fullname;
                document.getElementById("ProfPic").src = `./UserFiles/ProfilePictures/${data.ProfPic}`;
                document.getElementById("ProfPic").alt = `./UserFiles/ProfilePictures/${data.ProfPic}`;
                document.getElementById("case_handled").innerText = data.case.split(",").map((item) => {
                    return " " + item;
                }).toString();
                document.getElementById("City").innerText = `${data.city}, ${data.barangay}`;
                document.getElementById("ID").innerText = TherapID;

                GetSched(TherapID);

                SessionPTID(TherapID);

                const formData = new FormData();
                formData.append("city", data.city);
                formData.append("barangay", data.barangay);
                formData.append("case", data.case);

                response = await fetch("./TherapistHomePageAPI/NearMePatients.php", {
                    method: "POST",
                    body: formData
                });

                const results = await response.json();

                const patientsListContainer = document.getElementById("patients");

                for (result of results) {
                    const patientID = result.patientID;
                    const userID = result.userID;
                    const cases = result.cases;
                    const caseDesc = result.caseDesc;
                    const city = result.city;
                    const barangay = result.barangay;
                    const firstName = result.firstName;
                    const middleName = result.middleName;
                    const lastName = result.lastName;
                    const fullName = `${firstName} ${middleName}, ${lastName}`;
                    const profilePic = result.profilePic;

                    patientsListContainer.appendChild(createPatientCard(profilePic, fullName, cases, city, barangay, userID));
                }

            } catch (error) {
                console.error('Error:', error);
            }
        }

        async function GetSched(TherapID) {
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

                        function convertTo12HourFormat(time24) {
                            const [hours, minutes] = time24.split(':');
                            let hour12 = hours % 12 || 12;
                            const period = hours >= 12 ? 'PM' : 'AM';

                            hour12 = String(hour12).padStart(2, '0');

                            return `${hour12}:${minutes} ${period}`;
                        }

                        if (convertTo12HourFormat(schedule.Start_ime).includes("AM")) {
                            amElement.innerHTML += `
                            <button onclick="openScheduleModal('${schedule.Sched_id}', '${schedule.Day}', '${convertTo12HourFormat(schedule.Start_ime)}','${convertTo12HourFormat(schedule.End_Time)}' ,'${schedule.Note}')" 
                                    class='btn btn-outline-primary d-flex justify-content-center align-items-start flex-column gap-1'>
                                <label><b>Day<small>(s)</small>:</b> ${schedule.Day}</label>
                                <label><b>Time:</b> ${convertTo12HourFormat(schedule.Start_ime)} to ${convertTo12HourFormat(schedule.End_Time)}</label>
                                <label><b>Note:</b> ${schedule.Note}</label>
                             </button>
                            `;
                        } else if (convertTo12HourFormat(schedule.Start_ime).includes("PM")) {
                            pmElement.innerHTML += `
                                <button onclick="openScheduleModal('${schedule.Sched_id}', '${schedule.Day}', '${convertTo12HourFormat(schedule.Start_ime)}','${convertTo12HourFormat(schedule.End_Time)}' ,'${schedule.Note}')" 
                                    class='btn btn-outline-primary d-flex justify-content-center align-items-start flex-column gap-1'>
                                    <label><b>Day<small>(s)</small>:</b> ${schedule.Day}</label>
                                    <label><b>Time:</b> ${convertTo12HourFormat(schedule.Start_ime)} to ${convertTo12HourFormat(schedule.End_Time)}</label>
                                    <label><b>Note:</b> ${schedule.Note}</label>
                                </button>
                            `;
                        }
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById("AM").innerHTML = "An error occurred while fetching schedules.";
                document.getElementById("PM").innerHTML = "An error occurred while fetching schedules.";
            }
        }

        function createPatientCard(imageSrc, name, cases, city, barangay, userID) {
            const cardDiv = document.createElement('div');
            cardDiv.className = 'card shadow rounded-5';

            const img = document.createElement('img');
            img.src = `./UserFiles/ProfilePictures/${imageSrc}`;
            img.className = 'card-img-top';
            img.alt = imageSrc;
            img.style.height = '250px';
            img.style.width = 'auto';
            img.style.objectFit = 'cover';

            cardDiv.appendChild(img);

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body';

            const cardTitle = document.createElement('h6');
            cardTitle.className = 'card-title';
            cardTitle.textContent = name;

            const caseInfo = document.createElement('small');
            caseInfo.className = 'mb-1';
            caseInfo.innerHTML = `<b>Case handled: </b>${cases}`;

            const cityBarangay = document.createElement('small');
            cityBarangay.className = 'mb-1';
            cityBarangay.innerHTML = `<b>City & Barangay: </b> ${city}, ${barangay}`;

            const button = document.createElement('button');
            button.className = 'btn btn-primary btn-sm px-5 rounded-5 w-100 fw-semibold mt-2';
            button.textContent = 'View Patient';

            button.onclick = () => {
                window.location.href = `./TherapistPatientView.php?userID=${userID}`;
            }

            cardBody.appendChild(cardTitle);
            cardBody.appendChild(caseInfo);
            cardBody.appendChild(document.createElement('br'));
            cardBody.appendChild(cityBarangay);
            cardBody.appendChild(document.createElement('br'));
            cardBody.appendChild(button);

            cardDiv.appendChild(cardBody);

            return cardDiv;
        }

        function SessionPTID(id) {
            fetch("./HomePageAPI/SessionPTID.php", {
                method: "POST",
                body: JSON.stringify({
                    PTID: id,
                })
            });
        }

        function showToast(message) {
            const toastElement = document.getElementById("main-toast");
            const toast = new bootstrap.Toast(toastElement);

            toastElement.getElementsByClassName("toast-body")[0].innerHTML = message;

            toast.show();
        }
        function openScheduleModal(id, day, Stime, Etime, note) {
            // Populate modal content
            document.getElementById('modalSchedId').value = id;

            // Split the selected days
            const selectedDays = day.split(",");
            const checkboxes = document.querySelectorAll("input[name='days[]']");
            const modalTimeSelect = document.getElementById('modalSTime');
            const modalETimeSelect = document.getElementById('modalETime');

            // Clear existing options in the start time dropdown
            modalTimeSelect.innerHTML = '';

            // Set the pulled value as the first option
            modalTimeSelect.innerHTML += `<option value="${Stime}" selected>${Stime}</option>`;

            // Add additional options from 7:30 AM to 5:30 PM
            for (let i = 7; i <= 12; i++) {
                modalTimeSelect.innerHTML += `<option value="${i}:30 AM">${i}:30 AM</option>`;
            }
            for (let j = 1; j <= 5; j++) {
                modalTimeSelect.innerHTML += `<option value="${j + 12}:30 PM">${j}:30 PM</option>`;
            }

            // Initialize the end time options based on the initial start time value
            setEndTimeOptions(modalTimeSelect.value);

            // Event listener to update end time options whenever the start time changes
            modalTimeSelect.addEventListener('change', function (event) {
                const selectedValue = event.target.value;
                console.log("Selected start time:", selectedValue);

                // Update end time options based on selected start time
                setEndTimeOptions(selectedValue);
            });

            // Populate notes
            document.getElementById('modalNote').innerText = note;

            // Check the selected days for the checkboxes
            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectedDays.includes(checkbox.value);
            });

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('EditscheduleModal'));
            modal.show();
        }



        // Function to set end time options based on the selected start time
        function setEndTimeOptions(startTime) {
            const modalETimeSelect = document.getElementById('modalETime');
            modalETimeSelect.innerHTML = ''; // Clear existing options

            // Parse start time to determine hour and AM/PM suffix
            const [hourStr, suffix] = startTime.split(" ");
            let hour = parseInt(hourStr.split(":")[0]);

            // Add end times starting one hour after the selected start time
            let nextHour = hour + 1;
            let nextSuffix = suffix;

            // Check for AM to PM transition
            if (nextHour > 12) {
                nextHour = nextHour - 12;
                nextSuffix = "PM";
            }


            // Add end time options until 5:30 PM
            while ((nextSuffix === "AM" && (nextHour <= 12 || suffix === "PM")) ||
                (nextSuffix === "PM" && nextHour <= 5)) {

                // Generate option for end time dropdown
                const timeOption = `${nextHour}`;
                var SlcedEtime;
                if (timeOption < 7) {
                    SlcedEtime = parseInt(timeOption) + 12;
                }
                else {
                    SlcedEtime = timeOption;
                }

                modalETimeSelect.innerHTML += `<option value="${SlcedEtime + ":30"}">${timeOption + ":30" + nextSuffix}</option>`;

                // Increment to next hour
                nextHour++;

                // Transition from 12 PM to 1 PM or 12 AM to 1 AM
                if (nextHour > 12) {
                    nextHour = 1;
                    nextSuffix = nextSuffix === "AM" ? "PM" : "AM";
                }
            }
        }



        // EDIT SCHEDULE
        document.getElementById('editButton').addEventListener('click', async function () {
            // Gather values from the modal
            const schedId = document.getElementById('modalSchedId').value;
            const days = Array.from(document.querySelectorAll('input[name="days[]"]:checked')).map(cb => cb.value);
            const startTime = document.getElementById('modalSTime').value;
            const endTime = document.getElementById('modalETime').value;
            const note = document.getElementById('modalNote').value;

            let EditErrors = "";

            // Validation
            if (days.length === 0) {
                EditErrors += "Please select at least one day.\n";
            }
            if (startTime === "" || endTime === "") {
                EditErrors += "Please select both a start and an end time.\n";
            }
            if (note === "") {
                EditErrors += "Please enter a note.\n";
            }

            // Show error messages if any, and stop execution if there are errors
            if (EditErrors) {
                alert(EditErrors);
                return;
            }

            try {
                // Ensure `therapists_id` is defined or replace with actual value
                const therapists_ID = TherapID; // Replace with the correct value

                const Eres = await fetch("./SchedAPI/SchedCheckerAPI.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        day: days,
                        start_time: startTime,
                        therapists_id: therapists_ID
                    })
                });

                // Check for response
                const Etext = await Eres.text();

                // Handle different API responses
                if (Etext === "1") {
                    alert("Schedule already exists.");
                } else if (Etext === "2") {
                    alert("This time overlaps with an existing schedule.");
                } else {
                    try {
                        const updte = await fetch("./SchedAPI/SchedUPDATE.php", {
                            method: "POST",
                            body: JSON.stringify({
                                day: days,
                                start_time: startTime,
                                end_time: endTime,
                                note: note,
                                SchedID: schedId
                            })
                        });
                        const updtres = await updte.text();
                        if (updtres == "1") {
                            alert("Update successfull");
                            window.location.href = "TherapistsHomePage.php"
                        } if (updtres == "0") {
                            alert("Update failed");

                        }
                    } catch (err) {
                        console.error("Fetch error:", err.message);
                    }
                }

            } catch (err) {
                console.error("Fetch error:", err.message);
            }
        });
        //DELETE
        document.getElementById("confirmDeleteButton").addEventListener("click", async function () {
            // Get the value of the hidden input field
            const schedId = document.getElementById("modalSchedId").value;

            try {
                const schedID = schedId;

                const delt = await fetch("./SchedAPI/SchedDELETE.php", {
                    method: "POST",
                    body: JSON.stringify({
                        DeleteID: schedID
                    })
                });
                const delres = await delt.text();
                if (delres === "1") {
                    alert("Schedule was deleted successfully");
                }
                else {
                    alert("Warning schedule was not deleted");
                }

            } catch (err) {
                console.error("Fetch error:", err.message);
            }

        });



    </script>

</body>

</html>