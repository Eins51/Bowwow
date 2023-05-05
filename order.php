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

// 查询所有order
$sql = "SELECT `order`.*, user.username AS user_name FROM `order` LEFT JOIN user ON `order`.user_id = user.id";
$result = $conn->query($sql);

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 处理添加商品请求
    if (isset($_POST["add_order"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "INSERT INTO `order` (name, price, description) VALUES ('$name', '$price', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理编辑商品请求
    if (isset($_POST["edit_Order"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "UPDATE `order` SET name='$name', price='$price', description='$description' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理删除商品请求
    if (isset($_POST["delete_category"])) {
        $id = $_POST["id"];

        $sql = "DELETE FROM `order` WHERE id=$id";

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
    <title>Order Management</title>
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
            margin:auto auto auto  -20%;
            width:115%;
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

        
        h2{
            margin-left: -20%;
        }
        
        div.search_clearfix{
            float:right;
            margin-right:calc(5%);
            margin-bottom:calc(2%);
        }
        
    </style>
</head>

<body>
<?php include 'include/sidebar.php'; ?>


    
<div class="mdui-drawer-body-left" id="body" >

   <!--主题-->
   <h2>Order List</h2>

<!-- SEARCHING -->

<div class="margin" id="page_style">
  <div class="operation clearfix">
  
  <span class="submenu">
  <div class="search_clearfix">
   <label class="label_name">Order Searching：</label><input name="" type="text"  class="form-control col-xs-6"/><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" onclick=""  type="button" ><i class="fa  fa-search"></i>&nbsp;Search</button>
   
  </div>
  </div>
    <h3>
  <div class="list_Exhibition margin-sx">
  <table class="table table_list table_striped table-bordered center" id="sample-table">
      <tr>
          <th width="5%"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
          <th width="5%">ID</th>
          <th width="5%">Total Amount</th>
          <th width="10%">User Name</th>
          <th width="5%">Payment</th>
          <th width="10%">Status</th>
          <th width="15%">Paid Time</th>
          <th width="15%">Shipped Time</th>
          <th width="15%">Completed Time</th>
          <th width="15%">Operation</th>
      </tr>
      <?php
      // php code
     
      
      while($order=$result->fetch_assoc()){
        echo "<table class='table table_list table_striped table-bordered center'>";
        echo "<tr>";
        echo '<td width="5%">'.'<label>'.'<input type="checkbox" class="ace"><span class="lbl">'.'</span>'.'</label>'.'</td>';
        echo '<td width="5%">'.$order['id'].'</td>';

        echo '<td width="5%">'.$order['amount'].'</td>';

        echo '<td width="10%">'.$order['user_name'].'</td>';
        
        echo '<td width="5%">' . ($order['payment'] == 0 ? 'PayPal' : ($order['payment'] == 1 ? 'Credit Card' : ($order['payment'] == 2 ? 'Other' :''))) . '</td>';

        echo '<td width="10%">' . ($order['status'] == 0 ? 'Unpaid' : ($order['status'] == 1 ? 'Unshipped' : ($order['status'] == 2 ? 'Shipped' : ($order['status'] == 3 ? 'Shipped' : ($order['status'] == 4 ? 'Canceled':''))))) . '</td>';

        echo '<td width="15%">'.$order['pay_time'].'</td>';
        echo '<td width="15%">'.$order['shipped_time'].'</td>';
        echo '<td width="15%">'.$order['completed_time'].'</td>';       
        echo '<td width="15%"><a href="cateedit.php?id='.$order['id'].'">Edit</a> ';
        echo '<a href="Delete.php?cate=order&id='.$order['id'].'">Delete</a></td>';
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

