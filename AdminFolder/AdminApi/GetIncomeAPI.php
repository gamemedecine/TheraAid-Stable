<?php
include("../../database.php");

// SQL query to get the transaction count and total income by month
$var_income = "
    SELECT 
        MONTH(date) AS month, 
        COUNT(payment_id) AS transaction_count, 
        SUM(income) AS total_income
    FROM 
        tbl_income
    GROUP BY 
        MONTH(date)
    ORDER BY 
        MONTH(date)
";
$var_incomeqry = mysqli_query($var_conn, $var_income);

$incomeData = [];

while ($row = mysqli_fetch_assoc($var_incomeqry)) {
    $incomeData[] = [
        'month' => $row['month'],
        'transaction_count' => $row['transaction_count'],
        'total_income' => $row['total_income']
    ];
}

// Return JSON format
header('Content-Type: application/json');
echo json_encode($incomeData);
