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
$img = $_FILES["up"];
$temp = $img["tmp_name"];
$id = $_GET["id"];
$proName = str_replace('\'', '`', $proName);
$prodesc = str_replace('\'', '`', $prodesc);
if ($proName == "") {
    echo "<script>alert('Warning:Name cannot be empty!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else {


        $edit = "UPDATE product SET name='{$proName}',description='{$prodesc}', status = '{$status}', is_hot = '{$prosele}', price = '{$price}', stock_qty = '{$quan}', cate_id = '{$cate}' WHERE id = ".$id;
        if(mysqli_query($conn, $edit)){echo "<script>alert('Edit successfully');location.href='product.php';</script>";}
        else{echo $edit;}
    if (isset($img)){
        $imgname = $id.".jpg";
        $path = "./images/product_img/".$imgname;
        move_uploaded_file($temp, $path);

        $addimg =  "UPDATE product SET image_path ='$imgname' WHERE id = {$id}";
        if(!mysqli_query($conn, $addimg)){echo "s0s";};
    }
        //echo "<script>alert('Edit category successfully');location.href='product.php';</script>";

}





//$userEmail = $_POST["email"];
//$sql = "INSERT INTO test (id,email) VALUES ('$userName','$userEmail')";
//mysqli_query($conn, $sql);
//echo "<script>alert('success');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";


