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
                            <img src="./assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
                        </h5>
                        <button type="button" class="btn-close shadow" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-0 gap-0 gap-lg-4">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./TherapistsHomePage.php">
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
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Mon" id="monday">
                                <label class="form-check-label" for="monday">Monday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Tue" id="tuesday">
                                <label class="form-check-label" for="tuesday">Tuesday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Wed" id="wednesday">
                                <label class="form-check-label" for="wednesday">Wednesday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="THU" id="thursday">
                                <label class="form-check-label" for="thursday">Thursday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Fri" id="friday">
                                <label class="form-check-label" for="friday">Friday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="CheckBoxDay[]" type="checkbox" value="Sat" id="saturday">
                                <label class="form-check-label" for="saturday">Saturday</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Note" class="mb-1">Note <i>(Optional)</i></label><br>
                            <input type="text" id="Note" name="Note" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="startTime" class="mb-1">Start Time <span class="text-danger">*</span></label><br>
                                <select id="startTime" name="start_time" class="form-control" required>
                                <option value="">Select a start time.</option>
                                    <?php
                        
                                    for ($var_i = 7; $var_i <= 12; $var_i++) {
                                        echo "<option value=" . $var_i . ":00" . ">" . $var_i . ":00 AM</option>";
                                    }
        
                                    for ($var_j = 1; $var_j <= 5; $var_j++) {
                                        echo "<option value=" . ($var_j + 12) . ":00" . ">" . $var_j . ":00 PM</option>";
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
                    <button type="button" class="btn btn-secondary px-5 rounded-5" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-5 rounded-5" form="InputSched">Add</button>
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
                                <p id="AM" class="d-flex justify-content-start align-items-center flex-column shadow rounded p-3 gap-2" style="height: 250px; overflow-y: auto;"></p>
                            </div>
                        </div>
                        <div class="PM" id="PM-schedule" style="display: none;">
                            <div class="SchedButton">
                                <p id="PM" class="d-flex justify-content-start align-items-center flex-column shadow rounded p-3 gap-2" style="height: 250px; overflow-y: auto;"></p>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-5 rounded-5 w-100" data-bs-target="#add-schedule-modal" data-bs-toggle="modal">Add Schedule</button>
                    </div>

                </div>

                <div class="col-lg">

                    <h3>Near Me Patients</h3>
                    <hr>

                    <div id="patients" class="d-flex justify-content-center justify-content-lg-start align-items-start flex-wrap p-3 gap-3 rounded shadow" style="height: 740px; overflow-y: auto;">

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
                        endTimeSelect.innerHTML += `<option value="${i}:00">${displayHour}:00 ${period}</option>`;
                    }
                }
            });

            const form = document.getElementById("InputSched");

            form.addEventListener("submit", async (e) => {
                const addScheduleModal = document.querySelector("#add-schedule-modal");
                const alertPlaceholder = document.getElementById('alertPlaceHolder');

                const button = addScheduleModal.querySelector("button[type='submit']");

                const appendAlert = (message, type) => {
                    const wrapper = document.createElement('div')
                    wrapper.innerHTML = [
                        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                        `   <div>${message}</div>`,
                        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                        '</div>'
                    ].join('');

                    alertPlaceholder.append(wrapper);
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
                document.getElementById("City").innerText = data.city;
                document.getElementById("ID").innerText = TherapID;

                GetSched(TherapID);

                SessionPTID(TherapID);

                const formData = new FormData();
                formData.append("city", " Mandaue City");
                formData.append("barangay", "Banilad");
                formData.append("case", "Case 1,Case 2,Case 3,Case 4,Case 5,Case 6");

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
                                <button value="${schedule.Sched_id}" class='btn btn-outline-primary d-flex justify-content-center align-items-start flex-column gap-1'>
                                    <label><b>Day<small>(s)</small>:</b> ${schedule.Day}</label>
                                    <label><b>Time:</b> ${convertTo12HourFormat(schedule.Start_ime)} to ${convertTo12HourFormat(schedule.End_Time)}</label>
                                    <label><b>Note:</b> ${schedule.Note}</label>
                                </button>
                            `;
                        } else if (convertTo12HourFormat(schedule.Start_ime).includes("PM")) {
                            pmElement.innerHTML += `
                                <button value="${schedule.Sched_id}" class='btn btn-outline-primary d-flex justify-content-center align-items-start flex-column gap-1'>
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
    </script>

</body>
</html>