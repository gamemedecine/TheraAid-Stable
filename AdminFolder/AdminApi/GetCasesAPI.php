<?php
include("../../database.php");

$all_cases = array(); // To hold all unique cases
$cases_age_18_25 = array();
$cases_age_26_35 = array();
$cases_age_36_45 = array();
$cases_age_46_plus = array();

// SQL query to select patient case and birthday with age calculation
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

while ($var_rec = mysqli_fetch_array($var_Pqry)) {
    // Split P_case data by commas to get individual cases
    $cases = explode(",", $var_rec["P_case"]);

    // Add each case to the main list of all cases (for consistency across age groups)
    foreach ($cases as $case) {
        $case = trim($case); // Trim whitespace
        if (!in_array($case, $all_cases)) {
            $all_cases[] = $case; // Add to unique cases if not already present
        }
    }

    // Classify cases by age groups
    foreach ($cases as $case) {
        $case = trim($case);
        if ($var_rec["Age"] >= 18 && $var_rec["Age"] <= 25) {
            $cases_age_18_25[] = $case;
        } elseif ($var_rec["Age"] >= 26 && $var_rec["Age"] <= 35) {
            $cases_age_26_35[] = $case;
        } elseif ($var_rec["Age"] >= 36 && $var_rec["Age"] <= 45) {
            $cases_age_36_45[] = $case;
        } else {
            $cases_age_46_plus[] = $case;
        }
    }
}

// Count occurrences of cases for each age group
$case_counts_age_18_25 = array_count_values($cases_age_18_25);
$case_counts_age_26_35 = array_count_values($cases_age_26_35);
$case_counts_age_36_45 = array_count_values($cases_age_36_45);
$case_counts_age_46_plus = array_count_values($cases_age_46_plus);

// Ensure each unique case is represented in each age group
foreach ($all_cases as $case) {
    $case_counts_age_18_25[$case] = $case_counts_age_18_25[$case] ?? 0;
    $case_counts_age_26_35[$case] = $case_counts_age_26_35[$case] ?? 0;
    $case_counts_age_36_45[$case] = $case_counts_age_36_45[$case] ?? 0;
    $case_counts_age_46_plus[$case] = $case_counts_age_46_plus[$case] ?? 0;
}

// Prepare response arrays for JSON output
$cases = $all_cases; // Use the consistent list of all cases
$counts_18_25 = array_map(fn($case) => $case_counts_age_18_25[$case], $cases);
$counts_26_35 = array_map(fn($case) => $case_counts_age_26_35[$case], $cases);
$counts_36_45 = array_map(fn($case) => $case_counts_age_36_45[$case], $cases);
$counts_46_plus = array_map(fn($case) => $case_counts_age_46_plus[$case], $cases);

// Send the data as a JSON response
$response = [
    "cases" => $cases,
    "counts_18_25" => $counts_18_25,
    "counts_26_35" => $counts_26_35,
    "counts_36_45" => $counts_36_45,
    "counts_46_plus" => $counts_46_plus
];

echo json_encode($response); // Send data as JSON response
?>
