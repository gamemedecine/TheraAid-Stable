<?php

include "./database.php";

session_start();



$var_UserID= $_SESSION["sess_id"];

date_default_timezone_set('Asia/Manila'); // Change to your timezone

$var_crrntTime = date("h:i:sa");
//$var_currntDate = date("Y-m-d");
$var_currntDate = "2024-10-18";

echo $var_currntDate . "<br>";
// echo $var_crrntTime;
$var_validate="";
$var_filter = "";
$var_days= array();
$var_sessionList = "SELECT *    
                        FROM tbl_session SS JOIN tbl_appointment AP ON AP.appointment_id = SS.appointment_id
                        JOIN tbl_therapists PT ON PT.therapist_id = AP.therapists_id 
                        JOIN tbl_patient PAT ON AP.patient_id =  PAT.patient_id 
                        JOIN tbl_user U ON PAT.user_id = U.User_id 
                        JOIN tbl_sched SC ON SC.shed_id = AP.schedle_id
                        WHERE U.User_id  = $var_UserID
                        AND AP.status LIKE '%On-Going%'
                        ";
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
                                <a class="nav-link fw-semibold text-center active" aria-current="page" href="./PatientHomePage.php">
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./PatientSessions.php">
                                    <i class="bi bi-calendar-check fs-3"></i><br>
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

            
                <div class="container-fluid full-height">
                        <div class="flex-container">
                            <div class="box">
                                <div class="Details-box  rounded">
                                    <div class="TherapistInfo">

                                    </div>
                                </div>
                                <div class="hi">
                                    <div id="Therapists" style="padding-left: 20px; padding-top: 50px;">
                                        <div class="SessionList">
                                            <table border="4px solid black" style="border-collapse:collpase; width: 1100px;">
                                                <tr>
                                                    <th style="text-align:center;">Sessions</th>
                                                </tr>
                                                
                                                    <?php
                                                         
                                                            if(mysqli_num_rows($var_Slist)>0){
                                                                while($var_SSRec=mysqli_fetch_array($var_Slist)){
                                                                    $var_days= explode(",", $var_SSRec["day"]);
                                                                    
    
                                                                       
                                                                        ?>
                                                                        <tr>
                                                                    <td><button style="width: 1100px; height: 100px; border-radius: 25px;"  
                                                                        type="submit" name="BtnsessID" value="<?php echo $var_SSRec["session_id"]; ?>"><?php echo $var_SSRec["Fname"]; ?></button></td>
                                                                    </tr>
                                                                    <?php
                                                                 
                                                                    
                                                                }
                                                            }else{
                                                                echo  '<tr>
                                                                    <td><button style="width: 1100px; height: 100px; border-radius: 25px;"  
                                                                        type="submit" name="BtnsessID" value="<?php echo $var_SSRec["session_id"]; ?>"><?php echo $var_SSRec["Fname"]; ?></button></td>
                                                                    </tr>';
                                                            }

                                                                
                                                               

                                                            
                                                                
                                                    ?>
                                            </table>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                


              
      
        </section>

    </main>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

  
</body>

</html>