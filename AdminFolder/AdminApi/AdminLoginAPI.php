    <?php
   include("../../database.php");
    session_start();
    $JSONDATA = file_get_contents("php://input");
    $DCodeJSON = json_decode($JSONDATA,true);
    $var_o="0";
    if(
        isset($DCodeJSON["Uname"])&&
        Isset($DCodeJSON["Pass"])
    ){
        $var_Uname =$DCodeJSON["Uname"];
        $var_Pass =$DCodeJSON["Pass"];

        $var_check = "SELECT * FROM tbl_admin WHERE username = '$var_Uname' AND password='$var_Pass'";
        $var_Cqry = mysqli_query($var_conn,$var_check);

        if(mysqli_num_rows($var_Cqry)>0){
            $var_o ="1";

            $var_Arec = mysqli_fetch_array($var_Cqry);
            $_SESSION["Sess_AdminID"] =  $var_Arec["admin_id"];
        }else{
            $var_o ="0";
        }
    }
    echo $var_o;