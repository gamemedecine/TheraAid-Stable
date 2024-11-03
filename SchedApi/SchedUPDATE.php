<?php

include "../database.php";

$JSONDATA = file_get_contents(filename: "php://input");

$DCodeJSON = json_decode(json: $JSONDATA, associative: true);


if (
    isset($DCodeJSON["day"]) &&
    isset($DCodeJSON["start_time"]) &&
    isset($DCodeJSON["end_time"]) &&
    isset($DCodeJSON["note"]) &&
    isset($DCodeJSON["SchedID"])
) {
    $var_res = "";
    $var_Day = $DCodeJSON["day"];
    $var_Stime = $DCodeJSON["start_time"];
    $var_Etime = $DCodeJSON["end_time"];
    $var_Note = $DCodeJSON["note"];
    $var_SchedID = $DCodeJSON["SchedID"];


    
    $var_EMPDays = implode(",", $var_Day);
   
    $var_UPDATE = "UPDATE tbl_sched 
               SET day = '$var_EMPDays', 
                   start_time = '$var_Stime', 
                   end_time = '$var_Etime', 
                   note = '$var_Note' 
               WHERE shed_id = $var_SchedID";

$var_qry = mysqli_query($var_conn, $var_UPDATE);
    if($var_qry){
        $var_res = "1";
    }else{
        $var_res = "0";
    }
    echo $var_res;
}