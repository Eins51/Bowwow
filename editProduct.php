<?php


include("conn.php");
mysqli_select_db($conn, "bowwow");
$proName = $_POST["proname"];
$prodesc = $_POST["prodesc"];
$prosele = $_POST["prosele"];
$cate = $_POST["catesele"];
$quan = $_POST["quan"];
$price = $_POST["price"];
$status = $_POST["status"];
$img = $_FILES["upload"];
$id = $_GET["id"];
if ($proName == "") {
    echo "<script>alert('Warning:Name cannot be empty!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else {


        $edit = "UPDATE category SET name='{$proName}',description='{$prodesc}', status = '{$status}' is_hot = '{$prosele}' price = '{$price}' stock_qty = '{$quan}' cate_id = '{$cate}' WHERE id = {$id}";
        mysqli_query($conn, $edit);
        echo "<script>alert('Edit category successfully');location.href='category.php';</script>";

}





//$userEmail = $_POST["email"];
//$sql = "INSERT INTO test (id,email) VALUES ('$userName','$userEmail')";
//mysqli_query($conn, $sql);
//echo "<script>alert('success');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";


