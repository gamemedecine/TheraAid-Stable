<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
</head>
<?php
include("database.php");

session_start();
echo $_SESSION["sess_PTID"];
$var_patientID = $_SESSION["sess_PTID"];
$var_TransactionHistory = "SELECT PM.payment_id,
                            PM.amount, 
                            PM.status, 
                            PM.date_paid,
                            SC.day,
                            SC.start_time,
                            SC.end_time,
                            PT.case_handled,
                            AP.Date_creadted,
                            PAT.P_case,
                            AP.appointment_id,
                            CONCAT(U.Fname,' ', U.Mname,' ',U.Lname) AS fullname
                        FROM tbl_payment PM
                        JOIN tbl_appointment  AP ON PM.appointment_id = ap.appointment_id
                        JOIN tbl_sched SC ON AP.schedle_id = SC.shed_id
                        JOIN tbl_therapists PT ON AP.therapists_id = PT.therapist_id
                        JOIN tbl_patient PAT ON AP.patient_id = PAT.patient_id
                        JOIN tbl_user U ON PAT.user_id = U.User_id
                        WHERE AP.therapists_id = $var_patientID"; 
$var_Historyqry = mysqli_query($var_conn,$var_TransactionHistory);
?>
<body>
    <a href="TherapistsHomePage.php">Back</a>
    <div class="card">
        <h1>History</h1>

        <!--History Table-->
        <br>
        <br>
        <table  border="2px solid black;">
            <tr>
                <th>Date Created</th>
                <th>Patient</th>
                <th>Schedule</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Date Paid</th>
                <th>Action</th>
            </tr>
            <?php 
                if(mysqli_num_rows($var_Historyqry )>0){
                    while($var_HstryRec = mysqli_fetch_array($var_Historyqry)){
                        ?>
                            <tr>
                                <td><?php echo $var_HstryRec["Date_creadted"];?></td>
                                <td><?php echo $var_HstryRec["fullname"]."<br>"."<br>"
                                    ."Case:".$var_HstryRec["P_case"];?></td>
                                <td><?php echo $var_HstryRec["day"]."<br>".
                                    $var_HstryRec["start_time"]."-".$var_HstryRec["end_time"];?></td>
                                <td><?php echo "₱".$var_HstryRec["amount"]."<br>";?></td>
                                <td><?php echo$var_HstryRec["status"]."<br>";?></td>
                                <td><?php echo$var_HstryRec["date_paid"]."<br>";?></td>
                                <td><button type="button" id="Btndelete" style="background-color:red;">Delete</button></td>
                            </tr>
                        <?php
                    }
                }else{
                    echo "<tr><td>No Data</td></tr>";
                    echo "<tr><td>No Data</td></tr>";
                    echo "<tr><td>No Data</td></tr>";
                }    
            ?>
        </table>
    </div>
</body>
</html>
<style> 
*{
    margin: 0;
    padding: 0;
}
.card{
    width: 85%;
    height:500px;
    box-shadow: 0 1px 5px 4px;
    margin-left: 7.5%;
    margin-top: 4%;
    padding: 0;
    border-radius: 25px;;
}
.card h1{
    text-align:center;
}
.card table{
    width: 92%;
    border-collapse:collapse;
    text-align:center;
    margin-left: 50px;
    font-size: 25px;
    box-shadow:  0 5px 0 2px;
}


</style>