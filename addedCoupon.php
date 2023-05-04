<?php
include ("conn.php");
mysqli_select_db($conn,"bowwow");
$name = $_POST["couname"];
$cate = $_POST["cate"];
$description = $_POST["description"];
$start =$_POST["start"];
$end = $_POST["end"];
$value = $_POST["value"];
$quan = $_POST["quan"];

$sql = "INSERT INTO coupon (name, value, description, category, quantity, start_time, end_time) VALUES ('$name', '$value', '$description', '$cate', '$quan', '$start', '$end')";
if ($name == ""){
    echo "<script>alert('Warning:Name cannot be empty!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}else
{
    mysqli_query($conn, $sql);
    echo "<script>alert('Add category Successfully');location.href='coupon.php';</script>";
}
?>
