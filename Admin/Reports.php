<?php
include("../database.php");

session_start();
$_SESSION["Sess_AdminID"];

$var_currentYear = date("Y");
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
                                <a class="nav-link fw-semibold text-center" aria-current="page" href="./Reports.php">
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
                    <h1 class="display-6 text-center fw-semibold mb-5">Reports</h1><br><br>


                    <div>
                        <canvas id="myChart"></canvas>
                    </div>  

                </div>
        </section>

        <section class="main-section container py-5">
            <!-- Wrap the entire cards section in a div for the background -->
            <div class="bg-primary-subtle p-5 rounded-5">
                <div class="row justify-content-center g-4">
                    <h1 class="display-6 text-center fw-semibold mb-5">Income Reports</h1><br>
                    <h1 class="display-6 text-center fw-semibold mb-5"><?php echo $var_currentYear;?></h1><br><br>


                    <div>
                        <canvas id="IncomeChart"></canvas>
                    </div>

                </div>
        </section>
    </main>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>



    <script>
       
document.addEventListener("DOMContentLoaded", async function() {
    await getData();
    await getIncome() 
    Generatecharts(labels, data18_25, data26_35, data36_45, data46);
    GenerateIncomecharts(Monnths, monthName );
});

async function getData() {
    try {
       
        const response = await fetch("./AdminApi/GetCasesAPI.php", {
            method: "GET"
        });

        
        const data = await response.json();

        // Check if the response has valid data
        if (data.cases.length === 0) {
            alert("No data available");
        } else {
            // Access cases and counts from the response
            labels = data.cases;
            data18_25 = data.counts_18_25;
            data26_35 = data.counts_26_35;
            data36_45 = data.counts_36_45;  // Corrected key
            data46 = data.counts_46_plus;   // Corrected key
        }
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

async function getIncome() {
    try {
        const res = await fetch("./AdminApi/GetIncomeAPI.php", {
            method: "GET"
        });
        const data = await res.json();

        if (data.length === 0) {
            alert("No data available");
        } else {
            const monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"];
            const transactionCounts = new Array(12).fill(0); // Initialize all months to 0

            // Accumulate transaction counts for each month based on the data
            data.forEach(item => {
                const monthIndex = item.month - 1; // Adjust to 0-based index for array
                transactionCounts[monthIndex] = item.transaction_count;
            });

            // Generate the chart with full 12 months and updated counts
            GenerateIncomecharts(monthNames, transactionCounts);
        }

    } catch (error) {
        console.error("Error fetching data:", error);
    }
}


function GenerateIncomecharts(months, transactionCounts) {
    const ctx = document.getElementById('IncomeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months, // Use all 12 month names
            datasets: [{
                label: 'Transaction Count',
                data: transactionCounts, // Use the transaction count data for each month
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            },
            plugins: {
                legend: {
                    position: 'top' // Places the legend at the top
                }
            }
        }
    });
}


function Generatecharts(labels, data18_25, data26_35, data36_45, data46) {
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: '18-25',
                    data: data18_25,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)'
                },
                {
                    label: '26-35',
                    data: data26_35,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                },
                {
                    label: '36-45',
                    data: data36_45,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                },
                {
                    label: '46+',
                    data: data46,
                    backgroundColor: 'rgba(153, 102, 255, 0.6)'
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            },
            plugins: {
                legend: {
                    position: 'top' // Places the legend at the top
                }
            }
        }
    });
}
    </script>
</body>

</html>