<?php

include "../database.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST["username"]) &&
        isset($_POST["firstName"]) &&
        isset($_POST["middleName"]) &&
        isset($_POST["lastName"]) &&
        isset($_POST["birthDate"]) &&
        isset($_POST["password"]) &&
        isset($_POST["passwordConfirmation"]) &&
        isset($_POST["email"]) &&
        isset($_POST["mobileNumber"])
    ) {
        $username = $_POST["username"];
        $firstName = $_POST["firstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["lastName"];
        $birthDate = $_POST["birthDate"];
        $password = $_POST["password"];
        $passwordConfirmation = $_POST["passwordConfirmation"];
        $email = $_POST["email"];
        $mobileNumber = $_POST["mobileNumber"];

        if ($password !== $passwordConfirmation) {
            echo "Password must match, please try again";
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE tbl_user
                SET
                	UserName = '$username',
                	Fname = '$firstName',
                    Mname = '$middleName',
                    Lname = '$lastName',
                    Bday = '$birthDate',
                    Password = '$hashedPassword',
                    Email = '$email',
                    ContactNum = '$mobileNumber'
                WHERE User_id = $userID";

        $result = $var_conn->query($sql);

        if ($result) {
            echo "Your user information has been updated!";
        } else {
            echo "<span class='text-danger'>Something went wrong, please try again.</span>";
        }
    } else {
        echo "Missing variable, please try again.";
    }

} else {
    header("location ..");
}