<?php

session_start();

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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./PatientHomePage.php">
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

    <main class="py-0 py-lg-3">

        <section class="main-section bg-secondary-subtle py-3 py-lg-5 px-3 px-lg-5 shadow container-fluid container-lg">

            <div class="row">

                <div class="col-lg-4">

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
                            <b>Case:</b>
                            <span id="case"></span>
                        </label><br>
                        <label class="mb-1">
                            <b>Address</b>
                            <span id="City"></span>
                        </label>
                    </div>
                    <hr>
                    <h3 class="text-lg-center">Reminder</h3>
                    <div class="reminder d-flex justify-content-start align-items-center flex-column shadow rounded p-3 gap-2" style="height: 250px; overflow-y: auto;">
    
                    </div>
    
                </div>

                <div class="col-lg mt-3 mt-lg-0">
                    <div id="Therapists">

                        <h3>Near me Therapist</h3>
                        <hr>

                        <div id="PT" class="d-flex justify-content-center justify-content-lg-start align-items-start flex-wrap p-3 gap-3 rounded shadow" style="height: 625px; overflow-y: auto;">

                            <!-- <div class="card shadow rounded" style="width: 16rem;">
                                <img src="./UserFiles/ProfilePictures/670026d923b2c.jfif" class="card-img-top" style="height: 250px; width: auto; object-fit: cover;" alt="#">
                                <div class="card-body">
                                    <h6 class="card-title">Charles Henry Tinoy</h6>
                                    <label class="mb-1"><b>Case handled: </b></label><br>
                                    <label class="mb-1"><b>City: </b></label><br>
                                    <a href="#" class="btn btn-primary btn-sm px-5 rounded-5 w-100 fw-semibold">View Therapist</a>
                                </div>
                            </div>

                            <div class="card shadow rounded" style="width: 16rem;">
                                <img src="./UserFiles/ProfilePictures/670026d923b2c.jfif" class="card-img-top" style="height: 250px; width: auto; object-fit: cover;" alt="#">
                                <div class="card-body">
                                    <h6 class="card-title">Charles Henry Tinoy</h6>
                                    <label class="mb-1"><b>Case handled: </b></label><br>
                                    <label class="mb-1"><b>City: </b></label><br>
                                    <a href="#" class="btn btn-primary btn-sm px-5 rounded-5 w-100 fw-semibold">View Therapist</a>
                                </div>
                            </div>

                            <div class="card shadow rounded" style="width: 16rem;">
                                <img src="./UserFiles/ProfilePictures/670026d923b2c.jfif" class="card-img-top" style="height: 250px; width: auto; object-fit: cover;" alt="#">
                                <div class="card-body">
                                    <h6 class="card-title">Charles Henry Tinoy</h6>
                                    <label class="mb-1"><b>Case handled: </b></label><br>
                                    <label class="mb-1"><b>City: </b></label><br>
                                    <a href="#" class="btn btn-primary btn-sm px-5 rounded-5 w-100 fw-semibold">View Therapist</a>
                                </div>
                            </div>

                            <div class="card shadow rounded" style="width: 16rem;">
                                <img src="./UserFiles/ProfilePictures/670026d923b2c.jfif" class="card-img-top" style="height: 250px; width: auto; object-fit: cover;" alt="#">
                                <div class="card-body">
                                    <h6 class="card-title">Charles Henry Tinoy</h6>
                                    <label class="mb-1"><b>Case handled: </b></label><br>
                                    <label class="mb-1"><b>City: </b></label><br>
                                    <a href="#" class="btn btn-primary btn-sm px-5 rounded-5 w-100 fw-semibold">View Therapist</a>
                                </div>
                            </div> -->

                        </div>

                    </div>

                </div>
                
            </div>

            <!-- <div class="container-fluid full-height">
                <div class="white-box">
                    <div class="flex-container">
                        <div class="box">
                            <div class="Details-box  rounded">
                                <div class="TherapistInfo">
                                    <img id="ProfPic" class="border rounded-circle" style="width: 200px; height: 180px;" src="" alt="profile Picture">
                                    <br><br>
                                    <p id="fllname"></p>
                                    <p id="case"></p>
                                    <p id="City"></p>
            
                                </div>
                            </div>
                            <div class="hi">
                                <div id="Therapists" style="padding-left: 20px; padding-top: 50px;">
                                    <div id="PT">
            
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </section>
    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    
    <script>
        let city;
        let caseDesc;
        let PtntID;

        (() => {
            
            GETPatient();

        })();

        async function GETPatient() {
            try {
                const response = await fetch("./PatientHomePageAPI/PatientInfoAPI.php", {
                    method: "POST",
                    body: JSON.stringify({
                        "PID": "<?php echo $_SESSION["sess_id"]; ?>"
                    })
                });

                const data = await response.json();
                const fullname = `${data.fname} ${data.mname.charAt(0)}. ${data.lname}`;

                document.getElementById("fllname").innerText = fullname;
                document.getElementById("ProfPic").src = `./UserFiles/ProfilePictures/${data.profPic}`;
                document.getElementById("case").innerText = data.case;
                document.getElementById("City").innerText = data.city;

                city = data.city;
                caseDesc = data.case;
                PtntID = data.PtntID;

                GETtherapists(city, caseDesc);
            } catch (error) {
                console.error('Error:', error);
            }
        }

        async function GETtherapists(city, caseDesc) {
            try {
                const therapists = await fetch("./PatientHomePageAPI/GETtherapistsAPI.php", {
                    method: "POST",
                    body: JSON.stringify({
                        "city": city,
                        "case": caseDesc
                    })
                });

                const ThrpstData = await therapists.json();
                const PTElement = document.getElementById("PT");

                // Clear previous results
                // PTElement.innerHTML = '';

                if (ThrpstData.message) {
                    PTElement.innerHTML = ThrpstData.message; // Fixed the element reference
                } else {
                    ThrpstData.forEach(therapist => {
                        const fullname = `${therapist.fname} ${therapist.mname.charAt(0)}. ${therapist.lname}`;
                        const profilePic = therapist.profilePic;
                        const caseHandled = therapist.case;
                        const city = therapist.city;

                        createTherapistCard(PTElement, profilePic, fullname, caseHandled, city, therapist.TID);
    
                        // const PTBTN = document.createElement('button'); // Create button element

                        // PTBTN.value = therapist.TID; // Set the button value
                        // PTBTN.innerHTML = `${fullname}<br>Case Handled: ${therapist.case}<br>City: ${therapist.city}`;

                        // // Add event listener for button click
                        // PTBTN.addEventListener('click', function () {
                        //     var SlctedID = this.value;
                        //     SessionID(SlctedID, PtntID);
                        //     //  alert(SlctedID+"  "+PtntID);
                        // });

                        // PTElement.appendChild(PTBTN); // Append button to PTElement
                    });
                }
            } catch (error) {
                console.log('Error:', error);
            }
        }

        function SessionID(id, PtntID) {
            fetch("./PatientHomePageAPI/SessionAPI.php", {
                method: "POST",
                body: JSON.stringify({
                    PTID: id,
                    PtntID: PtntID,
                })
            }).then((res) => {
                window.location.href = "PatientView.php";
            });
        }

        function createTherapistCard(parentElement, profilePicture, fullName, caseHandled, city, SlctedID) {
            const card = document.createElement('div');
            card.classList.add('card', 'shadow', 'rounded-5');
            // card.style.width = '16rem';

            const img = document.createElement('img');
            img.src = `./UserFiles/ProfilePictures/${profilePicture}`;
            img.classList.add('card-img-top');
            img.style.height = '250px';
            img.style.width = 'auto';
            img.style.objectFit = 'cover';
            img.alt = '#';

            card.appendChild(img);

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            const title = document.createElement('h6');
            title.classList.add('card-title');
            title.textContent = fullName;

            const caseHandledLabel = document.createElement('small');
            caseHandledLabel.classList.add('mb-1');
            caseHandledLabel.innerHTML = `<b>Case handled: </b>${caseHandled}`;

            const cityLabel = document.createElement('small');
            cityLabel.classList.add('mb-1');
            cityLabel.innerHTML = `<b>City: </b>${city}`;

            const viewButton = document.createElement('a');
            viewButton.href = '#';
            viewButton.classList.add('btn', 'btn-primary', 'btn-sm', 'px-5', 'rounded-5', 'w-100', 'fw-semibold', "mt-2");
            viewButton.textContent = 'View Therapist';

            viewButton.addEventListener("click", () => {
                SessionID(SlctedID, PtntID);
            });

            cardBody.appendChild(title);
            cardBody.appendChild(caseHandledLabel);
            cardBody.appendChild(document.createElement('br'));
            cardBody.appendChild(cityLabel);
            cardBody.appendChild(document.createElement('br'));
            cardBody.appendChild(viewButton);

            card.appendChild(cardBody);

            parentElement.appendChild(card);
        }

    </script>
</body>

</html>