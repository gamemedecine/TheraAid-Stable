<?php

include "../database.php";

session_start();

$JSNDATA = file_get_contents(filename: "php://input");

$DcodeJSON = json_decode($JSNDATA, true);


if (isset($DcodeJSON["PTID"])) {
    $_SESSION["sess_PTID"] = $DcodeJSON["PTID"];
}