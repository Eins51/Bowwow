<?php
include ("conn.php");
$id = $_GET["id"];
$db = $_GET["cate"];
$sql = "DELETE FROM ".$db." WHERE id = '{$id}'";
if(mysqli_query($conn, $sql)){echo $id.$db;echo "<script>alert('deleted');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";}
else {echo "<script>alert('Error happaned');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";}
