<?php

include "../database.php";

$JSONDATA = file_get_contents(filename: "php://input");

$DCodeJSON = json_decode(json: $JSONDATA, associative: true);


if (
    isset($DCodeJSON["DeleteID"]) 
) {
    $var_res = "";
    $var_schedID = $DCodeJSON["DeleteID"];
   

  
    $var_INSERT = "DELETE FROM tbl_sched WHERE shed_id= $var_schedID ";
    $var_qry = mysqli_query($var_conn, $var_INSERT);
    if($var_qry){
        $var_res = "1";
    }else{
        $var_res = "0";
    }
    echo $var_res;

}