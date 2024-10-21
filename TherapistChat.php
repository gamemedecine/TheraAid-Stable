<?php

include "./database.php";

session_start();

$userID = $_SESSION["sess_id"];

function getChatHistory($userID) {
    include "./database.php";

    $userDir = "./Chats/$userID";

    if (!is_dir($userDir)) {
        mkdir($userDir);
    }

    $files = scandir($userDir);

    foreach (array_diff($files, array(".", "..")) as $file) {
        $ID = explode(".", $file)[0];

        $sql = "SELECT Fname, Mname, Lname, profilePic FROM tbl_user WHERE tbl_user.User_id = $ID;";
        $results = $var_conn->query($sql);

        foreach ($results as $result) {
            $firstName = $result["Fname"];
            $middleName = $result["Mname"];
            $lastName = $result["Lname"];
            $profilePic = $result["profilePic"];
            $fullName = "$firstName $middleName $lastName";

            echo "<button type='submit' name='target' class='btn d-flex justify-content-center align-items-center gap-2 py-3 shadow rounded-5 w-100 ' value='$ID'>
                <img src='./UserFiles/ProfilePictures/$profilePic' alt='$profilePic' class='rounded-pill' style='height: 24px; width: 24px; object-fit: cover;'>
                $fullName
            </button>";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Therapist Chat</title>
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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./TherapistChat.php">
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

    <div class="modal modal-xl fade" id="newChatModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">New Chat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="newChatForm" novalidate>

                        <div class="mb-3">
                            <label for="userID" class="mb-1">User ID<span class="text-danger">*</span></label><br>
                            <input type="text" id="userID" name="userID" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="messageText" class="mb-1">Message<span class="text-danger">*</span></label><br>
                            <textarea id="messageText" name="messageText" class="form-control" style="height: 350px;" required></textarea>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-5 rounded-5" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-5 rounded-5" form="newChatForm" data-bs-dismiss="modal">Send</button>
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
    
    <main class="py-0 py-lg-3">

        <section class="main-section bg-secondary-subtle py-3 py-lg-5 px-3 px-lg-5 shadow container-fluid container-lg">

            <div class="row rounded">

                <div class="col-3" id="users" style="height: 650px; overflow-y: auto;">

                    <h3 class="fw-semibold text-center">Chats</h3>

                    <hr>

                    <form method="GET" action="./TherapistChat.php" class="d-flex justify-content-start align-items-center p-3 flex-column gap-2">

                    <?php
                    
                    getChatHistory($userID);

                    ?>

                    </form>

                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill w-100" data-bs-target="#newChatModal" data-bs-toggle="modal">New Chat</button>

                </div>

                <div class="col">

                    <div class="mb-3">

                        <div>
                            <?php

                            if (
                                isset($_GET["target"])
                            ) {
                                $target = $_GET["target"];

                                $sql = "SELECT Fname, Mname, Lname FROM tbl_user WHERE User_id = $target;";
                                $result = $var_conn->query($sql)->fetch_assoc();

                                if ($result) {
                                    $firstName = $result["Fname"];
                                    $middleName = $result["Mname"];
                                    $lastName = $result["Lname"];

                                    echo "<h3 class='fw-semibold'>$firstName $middleName $lastName</h3><hr>";
                                }
                            }

                            ?>
                        </div>

                        <div class="d-flex justify-content-start align-items-center flex-column gap-3 p-3" id="messages" style="height: 600px; overflow-y: auto;"></div>

                        <form id="messageBoxForm" class="needs-validation" method="POST">
                            <?php

                            if (isset($_GET["target"])) {
                                $targetID = $_GET["target"];
                                echo "<input type='text' name='targetID' class='d-none' value='$targetID' required>";
                            }

                            ?>
                            <div class="input-group w-100">
                                <input type="text" class="form-control" name="messageText" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>
        (async () => {
            const urlParameters = new URLSearchParams(window.location.search);
            const targetID = urlParameters.get("target");

            const messageBoxForm = document.getElementById("messageBoxForm");
        
            messageBoxForm.addEventListener("submit", async (e) => {
                e.preventDefault();
                e.stopPropagation();
            
                if (!messageBoxForm.checkValidity()) {
                    return;
                }
            
                const targetID = messageBoxForm.targetID.value;
                const messageText = messageBoxForm.messageText.value;
            
                const formData = new FormData();
                formData.append("recipientID", targetID);
                formData.append("messageText", messageText);
            
                const response = await fetch("./ChatAPI/postChat.php", {
                    method: "POST",
                    body: formData
                });

                if (response.status === 200) {
                    messageBoxForm.reset();
                }
            });

            const newChatForm = document.getElementById("newChatForm");

            newChatForm.addEventListener("submit", async (e) => {
                e.preventDefault();
                e.stopPropagation();

                if (newChatForm.classList.contains("was-validated")) {
                    newChatForm.classList.remove("was-validated");
                } else {
                    newChatForm.classList.add("was-validated");
                }

                if (!newChatForm.checkValidity()) {
                    return;
                }

                const recipientID = newChatForm.userID.value;
                const messageText = newChatForm.messageText.value;

                const formData = new FormData();
                formData.append("recipientID", recipientID);
                formData.append("messageText", messageText);

                const response = await fetch("./ChatAPI/postChat.php", {
                    method: "POST",
                    body: formData
                });

                const responseText = await response.text();

                if (response.status === 200) {
                    window.location.href = `./TherapistChat.php?target=${recipientID}`;
                    newChatForm.reset();
                }

                if (response.status === 400) {
                    showToast(responseText);
                    newChatForm.reset();
                }
            });

            const messages = document.getElementById("messages");

            const response = await fetch(`./ChatAPI/getMessageHistory.php?target=${targetID}`);
            messages.innerHTML = await response.text();

            setInterval(async () => {
                if (targetID) {
                    const response = await fetch(`./ChatAPI/getMessageHistory.php?target=${targetID}`);
                    messages.innerHTML = await response.text();
                }
            }, 1000);
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