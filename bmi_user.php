<?php
session_start();
require("config.php");
$bmi = $_POST["user_weight"] / ($_POST["user_height"]*$_POST["user_height"])*10000;
$bmi = number_format($bmi, 2);
date_default_timezone_set('Asia/Tehran');
$currentDate = date('Y-m-d H:i:s');
$sql="insert INTO `user_records` (`user_id`, `user_weight`, `user_bmi`, record_date) VALUES ('".$_SESSION["user_id"]."', '".$_POST["user_weight"]."', '".$bmi."','".$currentDate."');";
mysqli_query($connect,$sql);
mysqli_close($connect);
$_SESSION["user_height"] = $_POST["user_height"];
$_SESSION["user_bmi"] = $bmi;
if($bmi<18.5){
    $_SESSION["user_status"]="کمبود وزن";
}
elseif($bmi>18.5){
    $_SESSION["user_status"]="وزن نرمال";
}
else{
    $_SESSION["user_status"]= "اضافه وزن";
}

header("location:user_status.php");
?>