<?php
// 数据库连接信息
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bowwow";

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Failed " . $conn->connect_error);
}

// 查询所有商品
$sql = "SELECT * FROM coupon";
$result = $conn->query($sql);

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 处理添加商品请求
    if (isset($_POST["add_coupon"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "INSERT INTO coupon (name, price, description) VALUES ('$name', '$price', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理编辑商品请求
    if (isset($_POST["edit_coupon"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "UPDATE coupons SET name='$name', price='$price', description='$description' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理删除商品请求
    if (isset($_POST["delete_category"])) {
        $id = $_POST["id"];

        $sql = "DELETE FROM coupon WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Coupon Management</title>
    <!-- Remote style sheet -->

    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    
    <!-- Local style sheet relative to workspace folder -->
    <link rel="stylesheet" href="/style.css">
    <script src="css/theme.css"></script>
    <!-- Local style sheet relative to this file -->
    <link rel="stylesheet" href="theme.css">
    
    <!-- Embedded style sheet -->
    <style>
        table.center{
            margin:auto;
                width:90%;
                border-collapse:collapse;
                text-align: center;

            }
    
        table.center th, table.center td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        table.center th{
            background-color: #D8CCC4;
        }

        
    </style>
</head>

<body>
<?php include("include/sidebar.php");?>

    
<div class="mdui-drawer-body-left" id="body" >

  <!--主题-->
  <h1 >Coupon Mangement</h1>
  <!-- 显示已有类别 -->
  <h2></h2>

  <!-- SEARCHING -->

  <div class="margin" id="page_style">
    <div class="operation clearfix">
    
    <span class="submenu"><a href="addCoupon.php" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" title="Add coupon"><i class="fa  fa-edit"></i>&nbsp;Add Coupon</a></span>
    <div class="search  clearfix">
     <label class="label_name">Coupon Searching：</label><input name="" type="text"  class="form-control col-xs-6"/><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" onclick=""  type="button"><i class="fa  fa-search"></i>&nbsp;Search</button>
     
    </div>
    </div>
    <!--列表展示-->
    <h3>
    <div class="list_Exhibition margin-sx">
    <table class="table table_list table_striped table-bordered center" id="sample-table">
        <tr>
            <th width="5%"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
            <th width="10%">ID</th>
            <th width="20%">Coupon Name</th>
            <th width="20%">Coupon Category</th>
            <th width="15%">Value</th>
            <th width="10%">Total Quantity</th>
            <th width="10%">Start Time</th>
            <th width="10%">End Time</th>
            <th width="20%">Operation</th>
        </tr>
        <?php
        // 在这里添加您的PHP代码
    
        while($coupon=$result->fetch_assoc()){
          echo "<table class='table table_list table_striped table-bordered center'>";
          echo "<tr>";
          echo '<td width="5%">'.'<label>'.'<input type="checkbox" class="ace"><span class="lbl">'.'</span>'.'</label>'.'</td>';
          echo '<td width="10%">'.$coupon['id'].'</td>';
          echo '<td width="20%">'.$coupon['name'].'</td>';
          echo '<td width="20%">'.$coupon['category'].'</td>';
          echo '<td width="15%">'.$coupon['value'].'</td>';
          echo '<td width="10%">'.$coupon['quantity'].'</td>';
          echo '<td width="10%">'.$coupon['start_time'].'</td>';  
          echo '<td width="10%">'.$coupon['end_time'].'</td>';
          echo '<td width="20%"><a href="Delete.php?cate=cuopon&id='.$coupon['id'].'">Delete</a></td>';
          echo "</tr>";
          echo "</table>";
        }
         ?>

    </table>
</div>
 
      
    </h3>  
    </div>

      

 

</body>

    </html>
