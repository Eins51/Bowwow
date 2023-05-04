<!DOCTYPE html>
<html lang="en">
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
                .content{
            margin-left: 25px

        }

    </style>
    <!-- 引入jquery和boostrap，mdui -->
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    <title>CAN302 Store Admin| Category</title>
</head>
<?php include("include/sidebar.php");?>
    <div class="content">
            <!-- 主内容 -->
        <h1 style="text-transform:capitalize;">Category Management/Add Category
            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue-accent">Return</button>
        </h1>
        <h2 style="font-style: italic;">Please enter category information</h2>

        <form action="addedCategory.php" method="post" id="submit" enctype="multipart/form-data"></form>
                <div class="mdui-col-xs-3" style="font-weight: 400;">Category Name:</div>

                <div class="mdui-col-xs-9">
                    <!-- required必填字段 -->
                    <div class="mdui-textfield">
                        <input class="mdui-textfield-input" type="text" placeholder="Food" name="catename" form="submit"/>
                      </div>
                        </div>

                <div class="mdui-col-xs-3">Category icon:</div>
                <div class="mdui-col-xs-9">
                <!-- 单选框 -->
                    <i class="mdui-icon material-icons" style="font-size: 100px;" onclick="upload.click()">add_to_photos
                        <input type="file" name="up" id="upload" style="display: none;" accept="image/svg+xml" form="submit"/></i>
                <i>Only jpg/png with a maxium size of 500 kb</i>
                </div>

                <div class="mdui-col-xs-3">Category Description:</div>
                <div class="mdui-col-xs-9">
            
                    <div class="mdui-textfield">
                        <textarea class="textfield3" placeholder="Description" cols="30" rows="3" name="catedesc" form="submit"></textarea>
                      </div>
                        </div>
                    <div class="mdui-col-xs-3">Category Status:</div>
                    <div class="mdui-col-xs-9">
                        <select class="mdui-select" name="catesele" form="submit">
                            <option value="0" selected>Activated</option>
                            <option value="1">Forbidden</option>

                          </select>
                    </div>
                    <button class="mdui-btn mdui-color-blue-accent mdui-ripple" form="submit">Save</button>
                    <button class="mdui-btn mdui-ripple" onclick="window.location.href = 'category.php'">Cancle</button>

        </div>
    </div>
</body>
<!-- 这个页面的JS-->
<script>
    
</script>
</html>