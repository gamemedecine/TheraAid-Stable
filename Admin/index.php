<?php
include("../database.php");

session_start();

$var_Uname="";
$var_Pass="";

if(isset($_SESSION["Sess_AdminID"])){
    header("location: AdminHomePage.php");
}
?>
<!DOCTYPE html>
<html data-bs-theme="light">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Admin Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
   
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/main.css'>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md bg-primary-subtle">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
                </a>
                <button class="navbar-toggler rounded-pill shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start bg-primary-subtle" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <img src="../assets/img/Logo.jpg" class="rounded-pill shadow" alt="Logo.jpg" width="64" height="64">
                        </h5>
                        <button type="button" class="btn-close shadow" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-0 gap-0 gap-md-3">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" aria-current="page" href="#">Conditions and Treatment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#">About Us</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center align-items-center gap-2 mt-2 mt-md-0">
                                <button type="button" class="btn btn-primary rounded-5 px-4 shadow w-100" data-bs-toggle="modal" data-bs-target="#LoginModal">Login</button>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="landing-section text-white">
            <div class="container">
                <h1 class="display-4 text-center fw-semibold">Welcome to TheraAid</h1>
                <p class="fst-italic text-center">Connecting Patients and Therapists for Better Care.</p>
                <div class="row mt-5">
                    <div class="col-md">
                        <p>TheraAid is a user-friendly, web-based platform that connects patients with qualified therapists. Our mission is to provide an easy, accessible way for individuals to seek professional mental and physical health support. Whether you're looking for guidance on mental wellness, physical therapy, or other therapeutic services, TheraAid simplifies the process by offering a convenient space for therapy sessions, scheduling, and communication.</p>
                    </div>
                    <div class="col-md">
                        <p>For therapists, TheraAid provides an efficient platform to manage patient interactions, appointments, and resources. With secure, easy-to-use tools, therapists can focus on providing care without the hassle of managing paperwork or complex systems. At TheraAid, we believe that everyone deserves easy access to quality therapeutic care, and we're here to make that happen.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-3 bg-secondary-subtle">
        <div class="container">
            <ul class="nav justify-content-center border-bottom border-black border-opacity-25 mb-2 pb-1">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Conditions and Treatment</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About us</a></li>
            </ul>
        </div>
        <p class="text-center text-body-secondary">© 2024 TheraAid</p>
    </footer>
    
    <!-- Modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="LoginModal">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label>Username: </label><input type="text" id="TxtUname"  value=""><br><br>
        <label>Password: </label><input type="Password" id="TxtPass" value="" required>
      </div>
      <div class="modal-footer">
        <button type="button" id="BtnLogin" class="btn btn-primary">Login</button>
      </div>
    </div>
  </div>
</div>

     <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>    
    var Uname;
    var Pass;
    document.getElementById("BtnLogin").addEventListener("click",function(){
        
        Uname = document.getElementById("TxtUname").value;
        Pass = document.getElementById("TxtPass").value;
        
        if(Uname === "" || Pass === ""){
            alert("Please enter username and password!");
        }else{
            Login(Uname,Pass);
        }
    });

    async function Login(Uname, Pass) {
    try {
        let response = await fetch("./AdminApi/AdminLoginAPI.php", {
            method: "POST",
            body: JSON.stringify({
                "Uname": Uname,
                "Pass": Pass
            }),
            headers: {
                'Content-Type': 'application/json' 
            }
        });
        
        const res = await response.json();
        
        if(res == "1"){
            window.location.href = "./AdminHomePage.php";
        }else{
            alert("Admin does not Exist!");
        }
    } catch (error) {
        console.error('Error', error);
    }
}

</script>
</html>