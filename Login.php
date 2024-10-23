<?php

include "./database";

session_start();

if (isset($_POST["BtnSubmit"])) {
    $var_Username = $_POST["TxtUsername"];
    $var_Password = $_POST["TxtPassword"];

    $var_chk = "SELECT * FROM tbl_user WHERE UserName = '$var_Username'";
    $var_rec = mysqli_query($var_conn, $var_chk);

    if (mysqli_num_rows($var_rec) > 0) {
        $var_record = mysqli_fetch_array($var_rec);

        if (password_verify($var_Password, $var_record["Password"])) {
            $userID = $var_record["User_id"];
            $var_Utype = $var_record["user_type"];
            $_SESSION["sess_Utype"] = $var_Utype;
            $_SESSION["sess_id"] = $userID;

            if ($var_Utype == "P") {
                header("location: PatientHomePage.php");
            }
            
            if ($var_Utype == "T") {

                $var_chk = "SELECT `therapist_id` FROM `tbl_therapists` WHERE user_id = '$userID'";
                $var_rec = mysqli_query($var_conn, $var_chk);
                $var_record = mysqli_fetch_array($var_rec);

                $_SESSION["sess_PTID"] = $var_record["therapist_id"];

                header("location: TherapistsHomePage.php");
            }
        } else {
            $_SESSION["statusText"] = '<span class="text-danger">Invalid password, please try again.</span>';
        }
    } else {
        $_SESSION["statusText"] = '<span class="text-danger">Unable to find the username, please try again.</span>';
    }
}
?>

<!DOCTYPE html>
<html data-bs-theme="light">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/registration.css'>
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

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <main>
        <section class="main-section container py-5">
            <div class="shadow p-5 rounded-5 bg-primary-subtle">
                <form class="needs-validation" method="POST" action="Login.php" novalidate>
                    <h1 class="display-6 text-center fw-semibold">Login</h1>
                    <div class="mb-3">
                        <label for="TxtUsername" class="mb-1">Username</label>
                        <input type="text" name="TxtUsername" id="TxtUsername" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a username.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="TxtPassword" class="mb-1">Password</label>
                        <div class="input-group">
                            <input type="password" name="TxtPassword" id="TxtPassword" class="form-control" required>
                            <button type="button" class="btn btn-primary viewPasswordButton rounded-end">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please enter a password.
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary shadow rounded-5 px-5" name="BtnSubmit">Login</button>
                    </div>

                </form>
                <div class="mt-3">
                    <label class="small text-center w-100">
                        Don't have an account yet?<br>
                        <a href="./RegistrationChoice.html">Create an account</a>
                    </label>
                </div>
            </div>
        </section>
    </main>

    <script src='./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'></script>
    <script>
        (() => {

            const forms = document.getElementsByClassName("needs-validation");

            Array.from(forms).forEach((form) => {
                form.addEventListener("submit", (e) => {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    form.classList.add("was-validated");
                });
            });

            const viewPasswordButton = document.getElementsByClassName("viewPasswordButton");

            Array.from(viewPasswordButton).forEach((button) => {
                button.addEventListener("click", () => {
                    const inputPassword = button.parentElement.getElementsByTagName("input")[0];

                    if (inputPassword.type === "password") {
                        inputPassword.type = "text";
                    } else {
                        inputPassword.type = "password";
                    }
                });
            });

            <?php

            if (isset($_SESSION["statusText"])) {
                $statusText = $_SESSION["statusText"];

                echo "showToast('$statusText')";

                unset($_SESSION["statusText"]);
            }

            ?>

        })();

        function showToast(message) {
            const toastElement = document.getElementById("toast");
            const toast = new bootstrap.Toast(toastElement);

            toastElement.getElementsByClassName("toast-body")[0].innerHTML = message;

            toast.show();
        }
    </script>
</body>
</html>