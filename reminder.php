<?php

include "./database.php";

$var_days = ['Wed', 'Fri'];
$var_SelectedStartDate = '2024-10-11';
$NumofMeeting = 10;
$var_CurrentDate = "2024-10-18";
$future_dates = [];
$startDate = new DateTime($var_SelectedStartDate);

while (count($future_dates) < $NumofMeeting) {
    $currentDay = $startDate->format('D');

    if (in_array($currentDay, $var_days)) {
        $future_dates[] = $startDate->format('Y-m-d');
    }

    $startDate->modify('+1 day');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <script>
        <?php

        if (in_array($var_CurrentDate, $future_dates)) {
            echo "alert('You have a Meeting Today')";
        } else {
            echo "alert('Yout have no meetings for today')";
        }
        
        ?>
    </script>
</body>

</html>