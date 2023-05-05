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

// 查询所有类别
$sql = "SELECT * FROM category"; 
$result = $conn->query($sql);

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 处理添加类别请求
    if (isset($_POST["add_product"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "INSERT INTO category (name, price, description) VALUES ('$name', '$price', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理编辑类别请求
    if (isset($_POST["edit_category"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理删除类别请求
    if (isset($_POST["delete_category"])) {
        $id = $_POST["id"];

        $sql = "DELETE FROM products WHERE id=$id";

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
    <title>Category Management</title>
    <!-- Remote style sheet -->

    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    
    <!-- Local style sheet relative to workspace folder -->
    <link rel="stylesheet" href="/style.css">
    <script src="css/theme.css"></script>
    <!-- Local style sheet relative to this file -->
    <link rel="stylesheet" href="../theme.css">
    
    <!-- Embedded style sheet -->
    <style>
        
        table.center{
            margin:auto auto auto -20%;
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
        }
    </style>
</head>

<body>
<?php include("include/sidebar.php");?>


    
<div class="mdui-drawer-body-left" id="body" >

  <!--主题-->
  <h2>Category List</h2>

  <!-- SEARCHING -->

  <div class="margin" id="page_style">
    <div class="operation clearfix">
    
    <span class="submenu"><a href="addcategory.php" style ="margin-left:-20%;"class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" title="Add Category"><i class="fa  fa-edit"></i>&nbsp;Add Category</a></span>
    <div class="search_clearfix">
     <label for="search">Category Searching：</label><input name="search" type="text" id="search" class="form-control col-xs-6"/><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" onclick="search"  type="button" ><i class="fa  fa-search"></i>&nbsp;Search</button>
     
     <?php
  // 如果搜索关键词不为空，执行搜索
  if (!empty($_GET['search'])) {
    // 连接数据库
    $conn = mysqli_connect("localhost", "root", "", "bowwow");

    // 获取搜索关键词
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // 构造查询语句
    $query = "SELECT * FROM category WHERE name LIKE '%$search%' ORDER BY id DESC";

    // 查询数据
    $result = mysqli_query($conn, $query);

    // 显示搜索结果
    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo '<tr>
      <th width="5%"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
      <th width="10%">ID</th>
      <th width="20%">Icon</th>
      <th width="20%">Category Name</th>
      <th width="15%">Status</th>
      <th width="30%">Operation</th>
  </tr>';
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<table class='table table_list table_striped table-bordered center'>";
        echo "<tr>";
        echo '<td width="5%">'.'<label>'.'<input type="checkbox" class="ace"><span class="lbl">'.'</span>'.'</label>'.'</td>';
        echo '<td width="10%">'.$row['id'].'</td>';
        echo '<td width="20%"><img src="images/category_img/'.$row['id'].'.svg" alt="'.$row['image_path'].'"width="100px"height="100px"></td>';
        echo '<td width="20%">'.$row['name'].'</td>';

        echo '<td width="15%">' . ($row['status'] == 0 ? 'Activated' : ($row['status'] == 1 ? 'Forbidden' : '')) . '</td>';

        echo '<td width="30%"><a href="cateedit.php?id='.$row['id'].'">Edit</a> ';
        echo '<a href="Delete.php?cate=category&id='.$row['id'].'">Delete</a></td>';
        echo "</tr>";
        echo "</table>";
      }
      echo "</table>";
    } else {
      echo "No results found.";
    }

    // 关闭数据库连接
    mysqli_close($conn);
  }
  ?>
    </div>  
    </div>
    
    <!--列表展示-->
    <h3>
    <div class="list_Exhibition margin-sx">
    <table class="table table_list table_striped table-bordered center" id="sample-table">
        <tr>
            <th width="5%"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
            <th width="10%">ID</th>
            <th width="20%">Icon</th>
            <th width="20%">Category Name</th>
            <th width="15%">Status</th>
            <th width="30%">Operation</th>
        </tr>
        <?php
        // 在这里添加您的PHP代码
        $value = 1; // 表格单元格中的值
        while($category=$result->fetch_assoc()){
          echo "<table class='table table_list table_striped table-bordered center'>";
          echo "<tr>";
          echo '<td width="5%">'.'<label>'.'<input type="checkbox" class="ace"><span class="lbl">'.'</span>'.'</label>'.'</td>';
          echo '<td width="10%">'.$category['id'].'</td>';
          echo '<td width="20%"><img src="./images/category_img/'.$category['image_path'].'"alt="'.$category['image_path'].'"width="100px"height="100px"></td>';
          echo '<td width="20%">'.$category['name'].'</td>';

          echo '<td width="15%">' . ($category['status'] == 0 ? 'Activated' : ($category['status'] == 1 ? 'Forbidden' : '')) . '</td>';

          echo '<td width="30%"><a href="cateedit.php?id='.$category['id'].'">Edit</a> ';
          echo '<a href="Delete.php?cate=category&id='.$category['id'].'">Delete</a></td>';
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


