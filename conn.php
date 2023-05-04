<?php

$servername = "localhost";
$username = "root"; // 默认用户名
$password = ""; // 默认密码为空

// 创建连接
$conn = mysqli_connect($servername, $username, $password);

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
mysqli_select_db($conn,"bowwow");


?>
