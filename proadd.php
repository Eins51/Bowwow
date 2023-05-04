<!DOCTYPE html>
<html lang="en">
<?php
include ("conn.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入样式，mdui -->
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>
    <link rel="stylesheet" href="a5common/commonCSS.css">
    <!-- 这个页面css-->
    <style>
        .side{ padding: 2px 20px;
        }
        .content{
            margin-left: 25px

        }
        .return{
            margin-left: 150px
        }

    </style>
    <!-- 引入jquery和boostrap，mdui -->
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    <title>CAN302 Store Admin| Product</title>
</head>
<?php include 'include/sidebar.php'; ?>
<!-- 主内容 -->
<div class="content" id="content">
    <h1 style="text-transform:capitalize;">Product Management/Add Product
        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue-accent" id="return">Return</button>
    </h1>
    <form action="addproduct.php" method="post" id="submit"></form>
    <h2 style="font-style: italic;">Please enter category information</h2>
    <div class="mdui-col-xs-3" style="font-weight: 400;">Product Name:</div>
    <div class="mdui-col-xs-9">
        <div class="mdui-textfield">
            <input class="mdui-textfield-input" type="text" placeholder="Food" name="proname" form="submit"/>
        </div>
    </div>
    <div class="mdui-col-xs-3">Product Category:</div>
    <div class="mdui-col-xs-9">
        <select class="mdui-select" name="catesele" form="submit">
            <?php
            $sql = "SELECT * FROM category";
            $rows = mysqli_query($conn, $sql);
            while($cate = mysqli_fetch_assoc($rows)){
                echo "<option value='{$cate["id"]}'>{$cate["name"]}</option>";
            }
            ?>

        </select>
    </div>

    <div class="mdui-col-xs-3">Product image:</div>
    <div class="mdui-col-xs-9">
        <!-- 单选框 -->
        <i class="mdui-icon material-icons" style="font-size: 100px;" onclick="upload.click()">add_to_photos
            <input type="file" name="up" id="upload" style="display: none;" accept="image/jpeg" form="submit"/></i>
        <i>Only jpg/png with a maxium size of 500 kb</i>
    </div>




    <div class="mdui-col-xs-3">Is Hot:</div>
    <div class="mdui-col-xs-9">
        <select class="mdui-select" name="prosele" form="submit">
            <option value="0" selected>no</option>
            <option value="1">yes</option>

        </select>
    </div>

    <div class="mdui-col-xs-3">Product Description:</div>
    <div class="mdui-col-xs-9">
        <div class="mdui-textfield">
            <textarea class="textfield3" form="submit" placeholder="Description" cols="30" rows="3" name="prodesc"></textarea>
        </div>
    </div>
    <div class="mdui-col-xs-3">Product Price:</div>
    <div class="mdui-col-xs-9">

        <input type='text' form='submit' name='price'>

    </div>
    <div class="mdui-col-xs-3">Status:</div>
    <div class="mdui-col-xs-9">
        <select class="mdui-select" form="submit" name="status">

            <option value="0">Shelved</option>';
            <option value="1">Unshelved</option>';

        </select>
    </div>
    <div class="purchasenumber" >
        <h3 class="mdui-col-xs-3">Quantity in stocks</h3>
        <div class="number" >
            <i class = "minus iconfont icon-jianhao" class="mdui-col-xs-3" style="margin: 10px 10px 10px 10px;"></i>
            <input type="text" name="qty" style='margin: 10px 10px 10px -10px;' form="submit">
            <i class = "plus iconfont icon-jiahao1"></i>
        </div>
    </div>

    <div>
        <button class="mdui-btn mdui-color-blue-accent mdui-ripple" form="submit" style="margin: 20px 20px 20px 20px;">Save</button>
        <button class="mdui-btn mdui-ripple">Cancle</button>
    </div>
</div>
</body>
<!-- 这个页面的JS -->
<script>

</script>
</html>