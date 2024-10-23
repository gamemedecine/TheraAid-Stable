<?php

include "../database.php";

$sql = "INSERT INTO `tbl_user`(`User_id`, `Fname`, `Lname`, `Mname`, `Bday`, `UserName`, `Password`, `ContactNum`, `Email`, `user_type`, `profilePic`) VALUES ('[value-1]','$firstName','$lastName','$middleName','$birthDate','$username','$hashedPassword','$mobileNumber','$email','T','$newProfilePictureName')";
$query = mysqli_query($var_conn, $sql);

$userID = $var_conn->insert_id;

$sql = "INSERT INTO `tbl_therapists`(`therapist_id`, `user_id`, `case_handled`, `city`, `Radius`, `license_img`, `date_created`) VALUES ('[value-1]','$userID','$caseHandled','$city','[value-5]','$newLicensePictureName','[value-7]')";
mysqli_query($var_conn, $sql);