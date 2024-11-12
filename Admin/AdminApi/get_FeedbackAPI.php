<?php

include "../../database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["therapist_id"])) {
        $therapist_id = $_POST["therapist_id"];

        $sql = "SELECT
                	*,
                    CONCAT(user.Fname, ' ', user.Mname, ' ', user.Lname) as fullName,
                    DATE_FORMAT(feedback.date_created, '%Y %M %D %r') as formatted_date_created
                FROM feedback feedback
                JOIN tbl_patient patient ON feedback.recipient_id = patient.patient_id
                JOIN tbl_user user ON patient.user_id = user.User_id 
                WHERE feedback.receiver_id = $therapist_id";
        $results = $var_conn->query($sql);
       
        if ($results->num_rows > 0) {
            foreach ($results as $result) {
                
                $profilePicture = $result["profilePic"];
                $fullName = $result["fullName"];
                $message = $result["message"];
                $var_star = $result["stars"];

                echo "<div class='shadow bg-body-secondary rounded-5 p-3 mb-3'>
                        <div class='mb-3'>
                            <img src='../UserFiles/ProfilePictures/$profilePicture' alt='$profilePicture' class='img-fluid rounded-pill shadow' style='height: 48px; width: 48px; object-fit: cover;'>
                            <label class='ms-2'><b>$fullName</b></label>
                        </div>
                        <div class='mb-3'>
                            <div class='d-flex justify-content-start align-items-start flex-row gap-2 fs-4'>
";
                        for($var_i=0;$var_i < $var_star;$var_i++){
                                echo "<i class='bi bi-star-fill text-warning'></i>";
                                

                        }
                        $vacant_stars =5-$var_star;
                        
                        for($var_j=0;$var_j < $vacant_stars;$var_j++){
                            echo '<i class="bi bi-star text-warning"></i>';
                            

                         }

                            
                 echo"     
                         </div>
                       </div>
                        <div>
                            <label class='mb-1'><b>Comment:</b></label>
                            <textarea class='form-control' style='height: 150px;' readonly>$message</textarea>
                        </div>
                    </div>";
            }
        } else {
            echo "Something went wrong while fetching the therapist feedback, please try again.";
        }
    } else {
        echo "Missing variable, please try again.";
    }
} else {
    header("location ..");
}