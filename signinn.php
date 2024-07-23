<?php 
session_start();
require("config.php");

$userPhone = $_POST["user_phone"]; 
$sql = "sELECT user_id FROM user WHERE user_phone = '".$userPhone."'";
$result = mysqli_query($connect, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user_id"] = $row["user_id"];
}
header("location:user_page.php");
?>