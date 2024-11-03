<?php

function uploadFiles($names, $tmp_names, $sizes, $target_dir) {
    $uploadedFiles = [];
    
    for ($i = 0; $i < count($names); $i++) {
        $name = $names[$i];
        $tmp_name = $tmp_names[$i];
        $size = $sizes[$i];

        $fileExtension = explode(".", $name);
        $newFileName = basename(uniqid() . "." . end($fileExtension));
        $target_file = $target_dir . $newFileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($tmp_name);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        if ($size > 50000000) {
            $uploadOk = 0;
        }

        if (
            $imageFileType != "jpg" && 
            $imageFileType != "png" && 
            $imageFileType != "jpeg" && 
            $imageFileType != "jfif"
        ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            http_response_code(400);
            return false;
        } else {
            if (move_uploaded_file($tmp_name, $target_file)) {
                $uploadedFiles[] = $newFileName;
            } else {
                http_response_code(400);
                return false;
            }
        }
    }

    return $uploadedFiles;
}