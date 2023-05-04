<?php

include ("conn.php");
mysqli_select_db($conn,"bowwow");
$cateName = $_POST["catename"];
$catedesc = $_POST["catedesc"];
$catesele = $_POST["catesele"];
$img = $_FILES["upload"];
$id = $_GET["id"];
if ($cateName == ""){
    echo "<script>alert('Warning:Name cannot be empty!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}else{
    $checkExist = "SELECT * FROM category where name = '$cateName' and id !={$id}";
    $rows = mysqli_query($conn, $checkExist);
    $num = mysqli_num_rows($rows);
    if (mysqli_num_rows($rows) != 0)
    {
        echo "<script>alert('Warning:Name has existed!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }else{
        $edit = "UPDATE category SET name='{$cateName}',description='{$catedesc}', status = '{$catesele}' WHERE id = {$id}";
        mysqli_query($conn, $edit);
        echo "<script>alert('Edit category successfully');location.href='category.php';</script>";
    }
}





//$userEmail = $_POST["email"];
//$sql = "INSERT INTO test (id,email) VALUES ('$userName','$userEmail')";
//mysqli_query($conn, $sql);
//echo "<script>alert('success');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>
