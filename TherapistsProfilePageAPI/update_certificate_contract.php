<?php

include "../database.php";

session_start();

$userID = $_SESSION["sess_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_FILES["certificate"]) &&
        isset($_FILES["contract"])
    ) {
        $certificate = $_FILES["certificate"];
        $contract = $_FILES["contract"];

        $certificatesDir = "../UserFiles/Certificates";
        $contractsDir = "../UserFiles/Contracts";

        $certificateTmpName = $certificate["tmp_name"];
        $contractTmpName = $contract["tmp_name"];

        $newCertificateName = uniqid() . ".pdf";
        $newContractName = uniqid() . ".pdf";

        if (move_uploaded_file($certificateTmpName, "$certificatesDir/$newCertificateName") && move_uploaded_file($contractTmpName, "$contractsDir/$newContractName")) {
            $sql = "UPDATE tbl_therapists
                    SET
                    	certificate = '$newCertificateName',
                    	contract = '$newContractName'
                    WHERE user_id = $userID";
            $result = $var_conn->query($sql);

            if ($result) {
                echo "Your certificate and contract has been updated!";
            } else {
                echo "Something went wrong while uploading your files, please try again.";
            }
        } else {
            echo "Something went wrong while uploading your files, please try again.";
        }
    }
} else {
    header("location ..");
}