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
$sql = "SELECT * FROM product";"SELECT product.*, category.name AS category_name FROM product JOIN category ON product.cate_id = category.id";
$result = $conn->query($sql);

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 处理添加商品请求
    if (isset($_POST["add_product"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];

        $sql = "INSERT INTO product (name, price, description) VALUES ('$name', '$price', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "scuessful";
        } else {
            echo "Failed: " . $conn->error;
        }
    }

    // 处理编辑商品请求
    if (isset($_POST["edit_product"])) {
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

    // 处理删除商品请求
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
    <title>Product Management</title>
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
<?php include 'include/sidebar.php'; ?>

    
<div class="mdui-drawer-body-left" id="body" >

  <!--主题-->
  <h2>Product List</h2>

  <!-- SEARCHING -->

  <div class="margin" id="page_style">
    <div class="operation clearfix">
    
    <span class="submenu"><a href="proadd.php" style ="margin-left:-20%;"class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" title="Add Product"><i class="fa  fa-edit"></i>&nbsp;Add Product</a></span>
    <div class="search_clearfix">
     <label class="label_name">Product Searching：</label><input name="" type="text"  class="form-control col-xs-6"/><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" onclick=""  type="button" ><i class="fa  fa-search"></i>&nbsp;Search</button>
     
    </div>
    </div>
    <!--列表展示-->
    <h3>
    <div class="list_Exhibition margin-sx">
    <table class="table table_list table_striped table-bordered center" id="sample-table">
        <tr>
            <th width="5%"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
            <th width="10%">ID</th>
            <th width="10%">Icon</th>
            <th width="15%">Product Name</th>
            <th width="10%">Category</th>
            <th width="5%">Hot</th>
            <th width="15%">Price</th>
            <th width="10%">StockQty</th>
            <th width="30%">Operation</th>
        </tr>
        <?php
        // 在这里添加您的PHP代码
    
        while($product=$result->fetch_assoc()){
          echo "<table class='table table_list table_striped table-bordered center'>";
          echo "<tr>";
          echo '<td width="5%">'.'<label>'.'<input type="checkbox" class="ace"><span class="lbl">'.'</span>'.'</label>'.'</td>';
          echo '<td width="10%">'.$product['id'].'</td>';
          echo '<td width="10%"><img src="./images/product_img/'.$product['id'].'.jpg"alt="'.$product['image_path'].'"width="100px"height="100px"></td>';
          echo '<td width="15%">'.$product['name'].'</td>';
          echo '<td width="10%">'.$product['cate_id'].'</td>';
          
          
         echo '<td width="5%">' . ($product['is_hot'] == 0 ? 'No' : ($product['is_hot'] == 1 ? 'Yes' : '')) . '</td>';

          echo '<td width="15%">'."$".$product['price'].'</td>';
          echo '<td width="10%">'.$product['stock_qty'].'</td>';    
          echo '<td width="30%"><a href="proedit.php?id='.$product['id'].'">Edit</a> ';
          echo '<a href="Delete.php?cate=product&id='.$product['id'].'">Delete</a></td>';
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
