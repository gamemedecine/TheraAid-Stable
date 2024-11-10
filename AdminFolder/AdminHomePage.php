<?php

include("../database.php");

session_start();

$var_AdminID = $_SESSION["Sess_AdminID"];
$var_CurrentMonth = date("m");
//ACTIVE USER QUERY
$var_totalUsers=0;
$var_ActiveUsers = "SELECT UPT.User_id AS 'THERAPIST_UID',
		                    UPAT.User_id AS 'PATIENT_UID'
                    FROM tbl_session SS
                    JOIN tbl_appointment AP ON AP.appointment_id = SS.appointment_id
                    JOIN tbl_therapists PT ON AP.therapists_id = PT.therapist_id
                    JOIN tbl_patient PAT ON AP.patient_id = PAT.patient_id
                    JOIN tbl_user UPT ON PT.user_id = UPT.User_id
                    JOIN tbl_user UPAT ON PAT.user_id = UPAT.User_id 
                    WHERE SS.status = 'On-Going'";
$var_ActiveUsersqry = mysqli_query($var_conn,$var_ActiveUsers);
if(mysqli_num_rows($var_ActiveUsersqry)>0){
    $var_actvpt= array();
    $var_actvpat= array();
    while($var_AUrec=mysqli_fetch_array($var_ActiveUsersqry)){
        $var_actvpt[] = $var_AUrec["THERAPIST_UID"];
        $var_actvpat[] = $var_AUrec["PATIENT_UID"];
    }
    $var_ActivePT=count($var_actvpt);
    $var_ActivePAT=count($var_actvpat);
    $var_totalUsers = $var_ActivePT +$var_ActivePAT;
}else{
    $var_totalUsers=0;
}

// All Users
$var_TtlUsers = 0;
$var_NewUSer = 0;
$var_AllUsers = "SELECT * FROM tbl_user";
$var_allusersqry=mysqli_query($var_conn,$var_AllUsers);

if(mysqli_num_rows($var_allusersqry)>0){
    while($var_Urec = mysqli_fetch_array($var_allusersqry)){
        $var_TtlUsers ++;
        $var_Udate = date("m",strtotime($var_Urec["date_created"]));
        if($var_Udate == $var_CurrentMonth){
            $var_NewUSer ++;
        }else{
            $var_NewUSer = 0;
        }
    }
}else{
    $var_TtlUsers = 0;
    $var_NewUSer = 0;
}

//TRANSACTIONS 
$var_Alltransactions ="SELECT * FROM tbl_payment WHERE status ='Paid' ";
$var_transactionqry = mysqli_query($var_conn,$var_Alltransactions);

$var_TootalTransaction=0;
if(mysqli_num_rows($var_transactionqry)>0){
    while($var_transactionRec = mysqli_fetch_array($var_transactionqry)){
        $var_TootalTransaction++;
    }
}





?>
<!DOCTYPE html>
<html data-bs-theme="light">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TheraAid | Therapist Home Page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/TherapistHomePage.css'>
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./AdminValidate.php">
                                    <i class="bi bi-calendar-check fs-3"></i><br>
                                    <small>Manage Therapists</small>
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
    <main>

    <section class="main-section container py-5">
    <!-- Wrap the entire cards section in a div for the background -->
    <div class="bg-primary-subtle p-5 rounded-5">
        <div class="row justify-content-center g-4">
        <h1 class="display-6 text-center fw-semibold mb-5">Home Page</h1>

            <!-- Active Users-->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow p-5 rounded-5">
                    <h5 class="card-title fw-bold text-center">Active User</h5>
                    <img src="../Photos/active-user.png" class="img-fluid img-thumbnail rounded" alt="Active Users">
                    <h4 class="text-center"><?php echo $var_totalUsers;?></h4>
                </div>
            </div>

            <!-- New Users -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow p-5 rounded-5">
                    <h5 class="card-title fw-bold text-center">New Users</h5>
                    <img src="../Photos/profile.jpg" class="img-fluid img-thumbnail rounded" alt="New Users">
                    <h4 class="text-center"><?php echo $var_NewUSer;?></h4>

                </div>
            </div>

            <!--Total Users -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow p-5 rounded-5">
                    <h5 class="card-title fw-bold text-center">Total Users</h5>
                    <img src="../Photos/group.png" class="img-fluid img-thumbnail rounded" alt="New Users">
                    <h4 class="text-center"><?php echo $var_TtlUsers;?></h4>

                    
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow p-5 rounded-5">
                    <h5 class="card-title fw-bold text-center">Transactions</h5>
                    <img src="../Photos/transactions.png" class="img-fluid img-thumbnail rounded" alt="New Users">
                    <h4 class="text-center"><?php echo $var_TootalTransaction;?></h4>

                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow p-5 rounded-5">
                    <h5 class="card-title fw-bold text-center">Profit</h5>
                    <img src="../Photos/profit.png" class="img-fluid img-thumbnail rounded" alt="New Users">
                </div>
            </div>
        </div>
    </div>
</section>

    </main>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script>


    </script>

    </body>

</html>