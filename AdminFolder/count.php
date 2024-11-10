<?php
include("../database.php");

// Initialize arrays to store patient cases for each age group
$var_list = array();
$cases_age_18_25 = array();
$cases_age_26_35 = array();
$cases_age_36_50 = array();
$cases_age_51_plus = array();

// SQL query to select the patient case and birthday with age calculation
$var_Pcase = "SELECT 
                U.User_id,
                PAT.P_case,
                U.Bday,
                YEAR(CURDATE()) - YEAR(U.Bday) - 
                (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(U.Bday, '%m%d')) AS Age
            FROM 
                tbl_user U
            JOIN 
                tbl_patient PAT ON U.User_id = PAT.user_id;";

// Execute the query
$var_Pqry = mysqli_query($var_conn, $var_Pcase);

// Loop through the query results
while ($var_rec = mysqli_fetch_array($var_Pqry)) {
    // Split the P_case data by commas into an array
    $cases = explode(",", $var_rec["P_case"]);

    // Merge all cases into the main $var_list array
    $var_list = array_merge($var_list, $cases);

    // Classify cases by age groups
    if ($var_rec["Age"] >= 18 && $var_rec["Age"] <= 25) {
        $cases_age_18_25 = array_merge($cases_age_18_25, $cases);
    } elseif ($var_rec["Age"] >= 26 && $var_rec["Age"] <= 35) {
        $cases_age_26_35 = array_merge($cases_age_26_35, $cases);
    } elseif ($var_rec["Age"] >= 36 && $var_rec["Age"] <= 50) {
        $cases_age_36_50 = array_merge($cases_age_36_50, $cases);
    } else {
        $cases_age_51_plus = array_merge($cases_age_51_plus, $cases);
    }
}

// Count occurrences of all cases
$case_counts = array_count_values($var_list);

// Count occurrences of cases for each age group
$case_counts_age_18_25 = array_count_values($cases_age_18_25);
$case_counts_age_26_35 = array_count_values($cases_age_26_35);
$case_counts_age_36_50 = array_count_values($cases_age_36_50);
$case_counts_age_51_plus = array_count_values($cases_age_51_plus);

// Output the total case occurrences
echo "<h3>Total Case Occurrences:</h3>";
foreach ($case_counts as $case => $count) {
    echo "Case: $case - Duplicated $count times<br>";
}

// Output occurrences of cases for patients aged 18-25
echo "<h3>Case Occurrences for Patients Aged 18-25:</h3>";
foreach ($case_counts_age_18_25 as $case => $count) {
    echo "Case: $case - Duplicated $count times among 18-25 year-olds<br>";
}

// Output occurrences of cases for patients aged 26-35
echo "<h3>Case Occurrences for Patients Aged 26-35:</h3>";
foreach ($case_counts_age_26_35 as $case => $count) {
    echo "Case: $case - Duplicated $count times among 26-35 year-olds<br>";
}

// Output occurrences of cases for patients aged 36-50
echo "<h3>Case Occurrences for Patients Aged 36-50:</h3>";
foreach ($case_counts_age_36_50 as $case => $count) {
    echo "Case: $case - Duplicated $count times among 36-50 year-olds<br>";
}

// Output occurrences of cases for patients aged 50+
echo "<h3>Case Occurrences for Patients Aged 50+:</h3>";
foreach ($case_counts_age_51_plus as $case => $count) {
    echo "Case: $case - Duplicated $count times among 50+ year-olds<br>";
}
?>
