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
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 处理添加商品请求
    if (isset($_POST["add_user"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "INSERT INTO user (name, price, description) VALUES ('$name', '$price', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理编辑商品请求
    if (isset($_POST["edit_user"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "UPDATE users SET name='$name', price='$price', description='$description' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理删除商品请求
    if (isset($_POST["delete_category"])) {
        $id = $_POST["id"];

        $sql = "DELETE FROM users WHERE id=$id";

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
    <title>User Management</title>
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

        .cell-content{
            display:flex;
            align-items:center;
        }

        .info{
            display:flex;
            flex-direction: column;
        }

        h2{
            margin-left: 5%;
        }
        
        div.search_clearfix{
            float:right;
            margin-right:calc(5% - 10px);
        }
    </style>
</head>

<body>
<?php include ("include/sidebar.php");?>


    
<div class="mdui-drawer-body-left" id="body" >

 <!--主题-->
 <h2>User List</h2>

<!-- SEARCHING -->

<div class="margin" id="page_style">
  <div class="operation clearfix">
  
  <span class="submenu"><a href="add_category.php" style ="margin-left:5%;"class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" title="Add User"><i class="fa  fa-edit"></i>&nbsp;Add User</a></span>
  <div class="search_clearfix">
   <label class="label_name">User Searching：</label><input name="" type="text"  class="form-control col-xs-6"/><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" onclick=""  type="button" ><i class="fa  fa-search"></i>&nbsp;Search</button>
   
  </div>
  </div>

    <!--列表展示-->
    <h3>
    <div class="list_Exhibition margin-sx">
    <table class="table table_list table_striped table-bordered center" id="sample-table">
        <tr>
            <th width="5%"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
            <th width="10%">ID</th>
            <th width="25%">User</th>
            <th width="5%">Member</th>
            <th width="20%">Email</th>
            <th width="10%">Payment</th>
            <th width="10%">Last Online Time</th>
            <th width="15%">Operation</th>
        </tr>
        <?php
        // 在这里添加您的PHP代码
    
        while($user=$result->fetch_assoc()){
          echo "<table class='table table_list table_striped table-bordered center'>";
          echo "<tr>";
          echo '<td width="5%">'.'<label>'.'<input type="checkbox" class="ace"><span class="lbl">'.'</span>'.'</label>'.'</td>';
          echo '<td width="10%">'.$user['id'].'</td>';
          echo '<td width="25%"><div class="cell-content"><img src="../images/user_avatar/'.$user['image_path'].'"alt="'.$user['image_path'].'"width="100px"height="100px"></div><div class="info"><div>'.$user['username'].'</div><div>'.$user['phone'].'</div></div></td>';
          echo '<td width="5%">' . ($user['is_member'] == 0 ? 'No' : ($user['is_member'] == 1 ? 'Yes' : '')) . '</td>';
          echo '<td width="20%">'.$user['email'].'</td>';
          echo '<td width="10%">' . ($user['payment'] == 0 ? 'PayPal' : ($user['payment'] == 1 ? 'Credit Card' : ($user['payment'] == 2 ? 'Other' :''))) . '</td>';
          echo '<td width="10%">'.$user['last_online'].'</td>';   
          echo '<td width="15%"><a href="user_information.php?ID='.$user['id'].'">Edit</a> ';
          echo '<a href="Delete.php?cate=user&id='.$user['id'].'">Delete</a></td>';
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
