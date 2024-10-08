<?php

include "./database.php";

session_start();

function uploadFile($name, $tmp_name, $size, $target_dir) {
    $fileExtension = explode(".", $name);
    $newFileName = basename(uniqid() . "." . end($fileExtension));
    $target_file = $target_dir . $newFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($tmp_name);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($size > 50000000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && 
        $imageFileType != "png" && 
        $imageFileType != "jpeg" &&
        $imageFileType != "jfif"
    ) {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        http_response_code(400);
        return false;
    } else {
        if (move_uploaded_file($tmp_name, $target_file)) {
            return $newFileName;
        } else {
            http_response_code(400);
            return false;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["username"]) &&
        isset($_POST["firstName"]) &&
        isset($_POST["middleName"]) &&
        isset($_POST["lastName"]) &&
        isset($_POST["password"]) &&
        isset($_POST["email"]) &&
        isset($_POST["mobileNumber"]) &&
        isset($_POST["birthDate"]) &&
        isset($_FILES["profilePicture"]) &&

        isset($_POST["patientCase"]) &&
        isset($_POST["patientCaseDescription"]) &&
        isset($_POST["location"]) &&
        isset($_FILES["assesmentImage"]) &&
        isset($_FILES["medicalHistoryImage"])
    ) {
        $username = $_POST["username"];
        $firstName = $_POST["firstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["lastName"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $mobileNumber = $_POST["mobileNumber"];
        $birthDate = $_POST["birthDate"];
        $profilePicture = $_FILES["profilePicture"];

        $patientCase = $_POST["patientCase"];
        $patientCaseDescription = $_POST["patientCaseDescription"];
        $location = $_POST["location"];
        $assesmentImage = $_FILES["assesmentImage"];
        $medicalHistoryImage = $_FILES["medicalHistoryImage"];

        $barangay = explode(",", $location)[0];
        $city = explode(",", $location)[1];
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $profilePictureName = $profilePicture["name"];
        $profilePictureTmpName = $profilePicture["tmp_name"];
        $profilePictureSize = $profilePicture["size"];
        $newProfilePictureName = uploadFile($profilePictureName, $profilePictureTmpName, $profilePictureSize, "./UserFiles/ProfilePictures/");

        $assesmentImageName = $assesmentImage["name"];
        $assesmentImageTmpName = $assesmentImage["tmp_name"];
        $assesmentImageSize = $assesmentImage["size"];
        $newAssesmentImageName = uploadFile($assesmentImageName, $assesmentImageTmpName, $assesmentImageSize, "./UserFiles/PatientAssementPictures/");

        $medicalHistoryImageName = $medicalHistoryImage["name"];
        $medicalHistoryImageTmpName = $medicalHistoryImage["tmp_name"];
        $medicalHistoryImageSize = $medicalHistoryImage["size"];
        $newMedicalHistoryImageName = uploadFile($medicalHistoryImageName, $medicalHistoryImageTmpName, $medicalHistoryImageSize, "./UserFiles/PatientMedicalHistoryPictures/");

        if ($newProfilePictureName && $newAssesmentImageName && $newMedicalHistoryImageName) {
            $userSql = "INSERT INTO `tbl_user`(`User_id`, `Fname`, `Lname`, `Mname`, `Bday`, `UserName`, `Password`, `ContactNum`, `Email`, `user_type`, `profilePic`) VALUES ('[value-1]','$firstName','$lastName','$middleName','$birthDate','$username','$hashedPassword','$mobileNumber','$email','P','$newProfilePictureName')";
            $userQuery = mysqli_query($var_conn, $userSql);

            $userID = $var_conn->insert_id;
            $_SESSION["sess_id"] = $userID;

            $patientSql = "INSERT INTO `tbl_patient`(`patient_id`, `user_id`, `P_case`, `case_desc`, `City`, `barangay`, `assement_photo`, `mid_hisotry_photo`) VALUES ('[value-1]','$userID','$patientCase','$patientCaseDescription','$city','$barangay','$newAssesmentImageName','$newMedicalHistoryImageName')";
            $patientQuery = mysqli_query($var_conn, $patientSql);

            if ($userQuery && $patientQuery) {
                $_SESSION["statusCode"] = 1;
                $_SESSION["statusTitle"] = "Your account has been created";
                $_SESSION["statusText"] = 'Go to the <a href="./Login.php">login page</a>';
                $_SESSION["sess_Utype"] = "P";
            } else {
                $_SESSION["statusCode"] = 0;
                $_SESSION["statusTitle"] = "Oops!";
                $_SESSION["statusText"] = "Something went wrong while creating your account, please try again.";
                http_response_code(500);
                session_destroy();
            }
        } else {
            $_SESSION["statusCode"] = 0;
            $_SESSION["statusTitle"] = "Oops!";
            $_SESSION["statusText"] = "Something went wrong while upload your profile picture, assesment image or medical history image, please try again.";
            http_response_code(500);
            session_destroy();
        }
    } else {
        $_SESSION["statusCode"] = 0;
        $_SESSION["statusTitle"] = "Oops!";
        $_SESSION["statusText"] = "Missing variable, please try again.";
        http_response_code(400);
        session_destroy();
    }
}

?>
<!DOCTYPE html>
<html data-bs-theme="light">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Register as Patient</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/registration.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='./node_modules/leaflet/dist/leaflet.css'>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md bg-primary-subtle">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="./assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
                </a>
                <button class="navbar-toggler rounded-pill shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start bg-primary-subtle" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <img src="./assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
                        </h5>
                        <button type="button" class="btn-close shadow" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-0 gap-0 gap-md-3">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="./index.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" aria-current="page" href="#">Conditions and Treatment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="modal fade" tabindex="-1" id="map-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose your location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <small class="mb-2 fw-semibold">Click the map to choose a location</small>
                    <div id="map" style="width: 100%; height: 500px;" class="mb-2"></div>
                    <div class="row gap-2 gap-md-0">
                        <div class="mt-2 col-md">
                            <label for="chosen-latitude" class="mb-1 fw-semibold">Latitude</label>
                            <input type="text" id="chosen-latitude" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mt-2 col-md">
                            <label for="chosen-longitude" class="mb-1 fw-semibold">Longitude</label>
                            <input type="text" id="chosen-longitude" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="fullAddress">Full Address</label>
                        <input type="text" id="fullAddress" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-5 rounded-5" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary px-5 rounded-5" data-bs-dismiss="modal" id="save-location-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="main-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-5 rounded-5" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <main>
        <section class="main-section container py-5">
            <div class="shadow p-5 rounded-5">
                <form action="PatientRegistration.php" method="POST" enctype="multipart/form-data" class="needs-validation" id="registrationForm" novalidate>
                    <h3 class="fw-semibold mb-4">User Information</h3>
                    <hr>

                    <div class="mb-3">
                        <label for="username" class="mb-1">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <div class="invalid-feedback">
                            Please choose a Username.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="firstName" class="mb-1">First Name</label>
                        <input type="text" name="firstName" id="firstName" class="form-control" required>
                        <div class="invalid-feedback">
                            Please choose a First Name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="middleName" class="mb-1">Middle Name</label>
                        <input type="text" name="middleName" id="middleName" class="form-control" required>
                        <div class="invalid-feedback">
                            Please choose a Middle Name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="mb-1">Last Name</label>
                        <input type="text" name="lastName" id="lastName" class="form-control" required>
                        <div class="invalid-feedback">
                            Please choose a Last Name.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="mb-1">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button" class="btn btn-primary viewPasswordButton rounded-end">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please choose a Password.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirmation" class="mb-1">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="passwordConfirmation" id="passwordConfirmation" class="form-control" required>
                            <button type="button" class="btn btn-primary viewPasswordButton rounded-end">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>
                        <small class="text-danger d-none mt-1" id="password-confirmation-feedback">
                            Password do not match.
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="mb-1">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a valid Email.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mobileNumber" class="mb-1">Mobile Number</label>
                        <input type="text" name="mobileNumber" id="mobileNumber" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a valid Mobile Number.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="mb-1">Birthday</label>
                        <input type="date" name="birthDate" id="birthDate" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a valid Birthday.
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="mb-3">
                            <label for="profilePicture" class="mb-1">Profile Picture</label>
                            <input type="file" name="profilePicture" id="profilePicture" class="form-control" accept="image/*" required>
                            <div class="invalid-feedback">
                                Please choose a valid Profile Picture Image.
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center flex-column d-none mb-3">
                            <small class="fw-semibold mb-2">Profile Picture Preview</small>
                            <img src="#" id="profilePicturePreview" class="img-thumbnail" style="height: 250px; width: auto; object-fit: cover;">
                        </div>
                    </div>

                    <h3 class="fw-semibold mb-4">Patient Information</h3>
                    <hr>

                    <div class="mb-3">
                        <label for="patientCase" class="mb-1">Patient Case</label>
                        <input type="text" id="patientCase" name="patientCase" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a Case.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="patientCaseDescription" class="mb-1">Patient Case Description</label>
                        <textarea style="height: 250px; max-height: 250px;" id="patientCaseDescription" name="patientCaseDescription" class="form-control" required></textarea>
                        <div class="invalid-feedback">
                            Please enter a Case Description.
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="location" class="mb-1">Address</label>
                        <input type="text" name="location" id="location" class="form-control mb-3" required>
                        <div class="invalid-feedback">
                            Please enter a Location.
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary px-5 rounded-5" id="choose-location-btn">Choose Location</button>
                    </div>

                    <div class="mb-3">
                        <label for="assesmentImage" class="mb-1">Assesment Image</label>
                        <input type="file" name="assesmentImage" id="assesmentImage" class="form-control" accept="image/*" required>
                        <div class="invalid-feedback">
                            Please choose a valid Assesment Image.
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column d-none mb-3">
                        <small class="fw-semibold mb-2">Assesment Image Preview</small>
                        <img src="#" id="assesmentReview" class="img-thumbnail" style="height: 250px; width: auto; object-fit: cover;">
                    </div>

                    <div class="mb-3">
                        <label for="medicalHistoryImage" class="mb-1">Medical History Image</label>
                        <input type="file" name="medicalHistoryImage" id="medicalHistoryImage" class="form-control" accept="image/*" required>
                        <div class="invalid-feedback">
                            Please choose a valid Medical History Image.
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column d-none mb-3">
                        <small class="fw-semibold mb-2">Medical History Image Preview</small>
                        <img src="#" id="medicalHistoryPreview" class="img-thumbnail" style="height: 250px; width: auto; object-fit: cover;">
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary rounded-5 px-5 shadow">Register</button>
                    </div>
                </form>
                <div class="mt-3">
                    <label class="small text-end w-100">
                        Already have an account? <a href="./Login.php">Login</a>
                    </label>
                </div>
            </div>
        </section>
    </main>

    <script src='./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'></script>
    <script src='./node_modules/leaflet/dist/leaflet.js'></script>
    <script>
        (() => {

            let latitude;
            let longitude;

            const viewPasswordButton = document.getElementsByClassName("viewPasswordButton");

            Array.from(viewPasswordButton).forEach((button) => {
                button.addEventListener("click", () => {
                    const input = button.parentElement.getElementsByTagName("input")[0];

                    if (input.type === "password") {
                        input.type = "text";
                        button.innerHTML = `<i class="bi bi-eye-slash-fill"></i>`;
                    } else { 
                        input.type = "password";
                        button.innerHTML = `<i class="bi bi-eye-fill"></i>`;
                    }
                });
            });

            const assesmentImage = document.getElementById("assesmentImage");
            const assesmentReview = document.getElementById("assesmentReview");

            assesmentImage.addEventListener("change", () => {
                const file = assesmentImage.files[0];

                if (file) {
                    assesmentReview.parentElement.classList.replace("d-none", "d-block");
                    assesmentReview.src = URL.createObjectURL(file);
                } else {
                    assesmentReview.parentElement.classList.replace("d-block", "d-none");
                    assesmentReview.src = "#"
                }
            });

            const medicalHistoryImage = document.getElementById("medicalHistoryImage");
            const medicalHistoryPreview = document.getElementById("medicalHistoryPreview");

            medicalHistoryImage.addEventListener("change", () => {
                const file = medicalHistoryImage.files[0];

                if (file) {
                    medicalHistoryPreview.parentElement.classList.replace("d-none", "d-block");
                    medicalHistoryPreview.src = URL.createObjectURL(file);
                } else {
                    medicalHistoryPreview.parentElement.classList.replace("d-block", "d-none");
                    medicalHistoryPreview.src = "#"
                }
            });

            const profilePicture = document.getElementById("profilePicture");
            const profilePicturePreview = document.getElementById("profilePicturePreview");

            profilePicture.addEventListener("change", () => {
                const file = profilePicture.files[0];

                if (file) {
                    profilePicturePreview.parentElement.classList.replace("d-none", "d-block");
                    profilePicturePreview.src = URL.createObjectURL(file);
                } else {
                    profilePicturePreview.parentElement.classList.replace("d-block", "d-none");
                    profilePicturePreview.src = "#"
                }
            });

            const forms = document.getElementsByClassName("needs-validation");

            Array.from(forms).forEach((form) => {
                form.addEventListener("submit", async (e) => {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    form.classList.add("was-validated");
                });
            });

            const registrationForm = document.getElementById("registrationForm");

            const chooseLocationBtn = document.getElementById("choose-location-btn");
            const mapModal = document.getElementById("map-modal");
            const chosenLatitude = document.getElementById("chosen-latitude");
            const chosenLongitude = document.getElementById("chosen-longitude");
            const saveLocationBtn = document.getElementById("save-location-btn");
            const map = document.getElementById("map");
            const fullAddressInput = document.getElementById("fullAddress");

            chooseLocationBtn.addEventListener("click", () => {
                const modal = new bootstrap.Modal(mapModal);

                modal.show();
            });

            if (!navigator.geolocation) {
                map.innerHTML = "<small>Geolocation is not supported by this browser.</small>";
            }

            navigator.geolocation.getCurrentPosition((position) => {
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;

                chosenLatitude.value = latitude;
                chosenLongitude.value = longitude;

                const map = L.map("map", {
                    center: [
                        latitude, longitude
                    ],
                    zoom: 17
                });

                const marker = L.marker([latitude, longitude])
                    .addTo(map)
                    .bindPopup("Your current location.")
                    .openPopup();

                let chosenMarker;

                map.on("click", async (e) => {
                    const latitudeLongitude = map.mouseEventToLatLng(e.originalEvent);
                    latitude = latitudeLongitude.lat;
                    longitude = latitudeLongitude.lng;

                    map.removeLayer(marker);

                    if (chosenMarker) {
                        map.removeLayer(chosenMarker);
                        chosenLatitude.value = latitude;
                        chosenLongitude.value = longitude;

                        apiUrl = `https://geocode.maps.co/reverse?lat=${latitude}&lon=${longitude}&api_key=66ffa02e9542d122573242pqy09573f`;

                        const response = await fetch(apiUrl, {
                            method: "GET"
                        })
                        const json = await response.json();
                        const barangay = json.address.quarter;
                        const city = json.address.city;

                        fullAddressInput.value = `${barangay}, ${city}`;
                    }

                    chosenMarker = L.marker([latitude, longitude])
                        .addTo(map);
                });

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
            }, showError);

            saveLocationBtn.addEventListener("click", () => {
                registrationForm.location.value = fullAddressInput.value;
            });

            const passwordConfirmationFeedback = document.getElementById("password-confirmation-feedback");

            registrationForm.addEventListener("submit", (e) => {
                const password = registrationForm.password.value;
                const passwordConfirmation = registrationForm.passwordConfirmation.value;

                if (password !== passwordConfirmation) {
                    passwordConfirmationFeedback.classList.replace("d-none", "d-block");
                    showToast("<span class='text-danger'>Password do not match.</span>");
                    e.preventDefault();
                    e.stopPropagation();
                } else {
                    passwordConfirmationFeedback.classList.replace("d-block", "d-none");
                }
            });

            <?php

            if (
                isset($_SESSION["statusCode"]) &&
                isset($_SESSION["statusTitle"]) &&
                isset($_SESSION["statusText"])
            ) {
                $statusCode = $_SESSION["statusCode"];
                $statusTitle = $_SESSION["statusTitle"];
                $statusText = $_SESSION["statusText"];

                if ($statusCode === 0 || $statusCode === 1) {
                    echo "showModal('$statusTitle', '$statusText')";
                    unset($_SESSION["statusCode"], $_SESSION["statusTitle"], $_SESSION["statusText"]);
                }
            }

            ?>

        })();

        function showToast(message) {
            const toastElement = document.getElementById("toast");
            const toast = new bootstrap.Toast(toastElement);

            toastElement.getElementsByClassName("toast-body")[0].innerHTML = message;

            toast.show();
        }

        function showModal(title, message) {
            const modalElement = document.getElementById("main-modal");
            const modal = new bootstrap.Modal(modalElement);

            modalElement.getElementsByClassName("modal-title")[0].innerHTML = title;
            modalElement.getElementsByClassName("modal-body")[0].innerHTML = message;

            modal.show();
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
</body>
</html>