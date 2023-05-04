<?php
// 数据库连接信息
include ("conn.php");

// 查询所有商品
$sql = "SELECT * FROM product";
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

    }

    // 处理删除商品请求
    if (isset($_POST["delete_category"])) {
        $id = $_POST["id"];

        $sql = "DELETE FROM products WHERE id=$id";


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
<div class="span3">
 <!-- 顶部框 -->
     <div class="mdui-toolbar mdui-color-theme" style="color:#D8CCC4;" id="side">
            <a class="mdui-btn mdui-btn-icon">
                <i class="mdui-icon material-icons">format_indent_decrease</i>
            </a>
            <div class="mdui-toolbar-spacer"></div> <!--会将该元素两边的内容推向两侧。-->
            <a class="mdui-btn mdui-btn-icon" >
                <i class="mdui-icon material-icons"onclick="window.location=`myprofile.php`;">account_circle</i>
            </a>
            <div class="mdui-chip" style="line-height:normal">
			<button class="mdui-btn mdui-btn-raised mdui-ripple" onclick="window.location=`login.php`;">
				Log out
			</button>
            </div>
     </div>
    <!--侧边栏-->
    <div class="mdui-drawer" id="siderbar" style="background-color: #D8CCC4;">
	<div>
		<h1 style="text-transform:capitalize; font-size: 22; color: gray" ><!--暂时写死，看情况是否需要连接数据库-->
		<img src="../images/admin_avatar.png" alt="" id="dog1" style="width:50px; height: 50px;"> Admin_01
			<i class="mdui-icon material-icons" onclick="window.location=`myprofile.php`;">edit</i>
		</h1>
	
        </div>
        <div>
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple" onclick="window.location=`myprofile.php`;" style="color: white;">
                <i class="mdui-icon material-icons">account_circle</i>
                <div class="mdui-list-item-content">&nbsp My Profile</div>
            </li>
        <li class="mdui-list-item mdui-ripple" onclick="window.location=`category.php`;" style="color: white;">
            <i class="mdui-icon material-icons">local_mall</i>
            <div class="mdui-list-item-content">&nbsp Category Management</div>
        </li>
        <li class="mdui-list-item mdui-ripple " onclick="window.location=`product.php`;" style="color: white;">
            <i class="mdui-icon material-icons">apps</i>
            <div class="mdui-list-item-content" >&nbsp Product Management</div>
        </li>
        <li class="mdui-list-item mdui-ripple " onclick="window.location=`user.php`;" style="color: white;">
            <i class="mdui-icon material-icons">person</i>
            <div class="mdui-list-item-content">&nbsp User Management</div>
        </li>
        <li class="mdui-list-item mdui-ripple " onclick="window.location=`order.php`;" style="color: white;">
            <i class="mdui-icon material-icons">assignment</i>
            <div class="mdui-list-item-content">&nbsp Order Management</div>
        </li>
        <li class="mdui-list-item mdui-ripple " onclick="window.location=`coupon.php`;" style="color: white;">
            <i class="mdui-icon material-icons">card_giftcard</i>
            <div class="mdui-list-item-content">&nbsp Coupon Management</div>
        </li>
        </ul>
    </div>
	<div>
        <img src="../images/sidebar_dog.png" alt="" id="dog" style="position:absolute; bottom: 0">
		</div>
</div>



    
<div class="mdui-drawer-body-left" id="body" >

  <!--主题-->
  <h1 >Product Mangement</h1>
  <!-- 显示已有类别 -->
  <h2></h2>

  <!-- SEARCHING -->

  <div class="margin" id="page_style">
    <div class="operation clearfix">
    
    <span class="submenu"><a href="proadd.php" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" title="Add Product"><i class="fa  fa-edit"></i>&nbsp;Add Product</a></span>
    <div class="search  clearfix">
     <label class="label_name">Product Searching：</label><input name="" type="text"  class="form-control col-xs-6"/><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber-100" onclick=""  type="button"><i class="fa  fa-search"></i>&nbsp;Search</button>
     
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
          echo '<td width="10%"><img src="../images/category_img/'.$product['image_path'].'"alt="'.$product['image_path'].'"width="100px"height="100px"></td>';
          echo '<td width="15%">'.$product['name'].'</td>';
          echo '<td width="10%">'.$product['cate_id'].'</td>';
          echo '<td width="5%">'.$product['is_hot'].'</td>';
          echo '<td width="15%">'."$".$product['price'].'</td>';
          echo '<td width="10%">'.$product['stock_qty'].'</td>';    
          echo '<td width="30%"><a href="proedit.php?id='.$product  ['id'].'">Edit</a> ';
          echo '<a href="Delete.php?action=delete&id='.$product['id'].'">Delete</a></td>';
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
