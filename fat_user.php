<?php
session_start();
require("config.php");
$fat = 86.01*(log10($_POST["user_neck"]-$_POST["user_back"]))- 70.041*(log10($_SESSION["user_height"]))+36.76;
$fat = number_format($fat, 2);
date_default_timezone_set('Asia/Tehran');
$currentDate = date('Y-m-d H:i:s');
$sql ="iNSERT INTO `user_fat` (`user_id`, `user_neck`, `user_back`, `fat_date`, `user_fat`) 
VALUES ('".$_SESSION["user_id"]."', '".$_POST["user_neck"]."', '".$_POST["user_back"]."', '".$currentDate."', '".$fat."');";
mysqli_query($connect,$sql);
mysqli_close($connect);
$_SESSION["user_fat"] = $fat;
header("location:user_status.php");
?>