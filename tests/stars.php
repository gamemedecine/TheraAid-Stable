<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/main.css'>

    <title>Stars</title>
</head>
<body>
<?php
$var_pat = "";
$var_stars ="";
$var_TtlStars ="";
if(isset($_POST["BtnStars"])){

    $var_pat = $_POST["TxtPatient"];
    $var_stars = $_POST["TxtTtlStars"];


    $var_TtlStars = $var_stars / $var_pat;
    $var_float = floatval($var_TtlStars);
    $var_format = number_format($var_float, 2);
    echo $var_format ;
    
}
?>

<div class="mb-3">
    <form method="POST" action="stars.php">
        <input type="text" name="TxtPatient" placeholder="Num of patients"> 
        <input type="text" name="TxtTtlStars" placeholder="Num of stars">
        
        <input type="submit" name="BtnStars" value="submit">
    </form>
            <div class="d-flex justify-content-start align-items-start flex-row gap-2 fs-4">
                <div class="bg-body">
                <!-- <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i>
                </div>
                 echo '<i class="bi bi-star"></i>';-->
                 <?php
                $full_stars = floor($var_TtlStars);  
                $has_half_star = $var_TtlStars - $full_stars >= 0.5;  
                $vacant_stars = 5 - ceil($var_TtlStars);  

                for ($i = 0; $i < $full_stars; $i++) {
                    echo '<i class="bi bi-star-fill text-warning"></i>';
                }
                
                if ($has_half_star) {
                    echo '<i class="bi bi-star-half text-warning"></i>';
                }

               
                for ($j = 0; $j < $vacant_stars; $j++) {
                    echo '<i class="bi bi-star text-warning"></i>';
                }
            ?>
            </div>
        </div>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>