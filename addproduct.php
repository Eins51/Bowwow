<?php

include ("conn.php");
mysqli_select_db($conn,"bowwow");

$proName = $_POST["proname"];
$prodesc = $_POST["prodesc"];
$prosele = $_POST["prosele"];
$cate = $_POST["catesele"];
$qty = $_POST["qty"];
$price = $_POST["price"];
$status = $_POST["status"];
$img = $_FILES["up"];
$temp = $img['tmp_name'];
//if (!isset($img)){
// $err = $_FILES["up"]["error"];
#echo "<script>alert('$err');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
//}
//echo $catesele;
if ($proName == ""){
    echo "<script>alert('Warning:Name cannot be empty!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}else
{
    $add = "INSERT INTO product (name, description, is_hot, cate_id, price, status, stock_qty) VALUES ('$proName','$prodesc', '$prosele', '$cate','$price','$status','$qty')";
    mysqli_query($conn, $add);
    $id = mysqli_insert_id($conn);
    $path = "category_img/".$id.".jpg";
    if (isset($img)){
        $imgname = $id.".jpg";
        $path = "./images/product_img/".$imgname;
        move_uploaded_file($temp, $path);

        $addimg =  "UPDATE product SET image_path ='$imgname' WHERE id = {$id}";
        mysqli_query($conn, $addimg);
    }

    echo "<script>alert('Add product Successfully');location.href='product.php';</script>";

}





//$userEmail = $_POST["email"];
//$sql = "INSERT INTO test (id,email) VALUES ('$userName','$userEmail')";
//mysqli_query($conn, $sql);
//echo "<script>alert('success');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>
