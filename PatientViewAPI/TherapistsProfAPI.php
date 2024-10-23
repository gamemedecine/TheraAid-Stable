<?php

include "../database.php";

$JSONDATA = file_get_contents(filename:"php://input");

$DcodeJSON = json_decode($JSONDATA,true);

if( isset($DcodeJSON["ID"]) 
    
){
    $var_id = $DcodeJSON["ID"];
    
    $var_getTherapists = "SELECT U.User_id,
                             U.Fname,
                             U.Lname,
                             U.Mname,
                             u.profilePic,
                             T.case_handled,
                             T.city,
                             T.barangay,
                             T.therapist_id 
                        FROM tbl_therapists T 
                        JOIN tbl_user U ON T.user_id = U.User_id 
                        WHERE T.therapist_id  =".$var_id;
    $var_qry = mysqli_query($var_conn, $var_getTherapists);
    if(mysqli_num_rows($var_qry)>0){
        $var_rec = mysqli_fetch_array($var_qry);
        
        echo json_encode([
            "userID" =>$var_rec["User_id"],
            "fname" => $var_rec["Fname"],
            "lname" =>$var_rec["Lname"],
            "mname" => $var_rec["Mname"],
            "ProfPic" =>$var_rec["profilePic"],
            "case" => $var_rec["case_handled"],
            "city" => $var_rec["city"],
            "barangay" => $var_rec["barangay"],
            "therapitst_id" =>$var_rec["therapist_id"],
        ]);

    }
    else{
        echo "No data Available";
    }
}