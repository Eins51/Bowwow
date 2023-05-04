<?php

include ("conn.php");
mysqli_select_db($conn,"bowwow");

$cateName = $_POST["catename"];
$catedesc = $_POST["catedesc"];
$catesele = $_POST["catesele"];
$img = $_FILES["up"];
$temp = $img['tmp_name'];

//echo $catesele;
if ($cateName == ""){
    echo "<script>alert('Warning:Name cannot be empty!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}

$checkExist = "SELECT * FROM category where name = '$cateName'";
$rows = mysqli_query($conn, $checkExist);
if (mysqli_num_rows($rows) == 0)
{
    $add = "INSERT INTO category (name, description, status) VALUES ('$cateName','$catedesc', '$catesele')";
    if(mysqli_query($conn, $add)){
        $rows = mysqli_query($conn, $checkExist);
        $row = mysqli_fetch_assoc($rows);
        $id = $row["id"];
        if (isset($img)){

            $path = "./images/category_img/".$id.".svg";
            move_uploaded_file($temp, $path);
            $imgname = $id.".svg";
            $addimg =  "UPDATE category SET image_path ='$imgname' WHERE id = {$id}";
            mysqli_query($conn, $addimg);
        }

        echo "<script>alert('Add category Successfully');location.href='category.php';</script>";
    }
    else{echo "<script>alert('Error happaned');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";}

}else
{
    echo "<script>alert('Warning: category name is existing');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}

//$userEmail = $_POST["email"];
//$sql = "INSERT INTO test (id,email) VALUES ('$userName','$userEmail')";
//mysqli_query($conn, $sql);
//echo "<script>alert('success');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>
