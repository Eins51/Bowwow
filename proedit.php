<?php
// 数据库连接信息
include ("conn.php");
$id = $_GET["id"];
$sql = "SELECT * FROM product where id = ".$id;
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入样式，mdui -->
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>    
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    <title>CAN302 Store Admin| Product</title>
</head>

<body class="mdui-drawer-body-left mdui-theme-primary-white mdui-theme-accent-blue">
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
    <img src="./images/admin_avatar.png" alt="" id="dog1" style="width:50px; height: 50px;"> Admin_01
        <i class="mdui-icon material-icons" onclick="window.location=`myprofile.php`;">edit</i>
    </h1>

</div>
    <div>
    <ul class="mdui-list">
        <li class="mdui-list-item mdui-ripple" onclick="window.location=`myprofile.php`;" style="color: white;">
            <i class="mdui-icon material-icons">account_circle</i>
            <div class="mdui-list-item-content">&nbsp My Profile</div>
        </li>
    <li class="mdui-list-item mdui-ripple" onclick="window.location=`product.php`;" style="color: white;">
        <i class="mdui-icon material-icons">local_mall</i>
        <div class="mdui-list-item-content">&nbsp Category Management</div>
    </li>
    <li class="mdui-list-item mdui-ripple " onclick="window.location=`category.php`;" style="color: white;">
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
    <img src="./images/sidebar_dog.png" alt="" id="dog" style="position:absolute; bottom: 0">
    </div>
    </div>
    <!-- 顶部框 -->

    <div class="content" id="content">
        <h1 style="text-transform:capitalize;">Product Management/Edit Product
            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue-accent" id="return">Return</button>
        </h1>
        <?php
        echo '<form action="editProduct.php?id='.$id.'" method="post" id="submission"></form>'
        ?>
        <h2 style="font-style: italic;">Edit the product information</h2>                
                <div class="mdui-col-xs-3" style="font-weight: 400;">Product Name:</div>
                <div class="mdui-col-xs-9">
                    <div class="mdui-textfield">
                        <?php
                        echo "<input class='mdui-textfield-input' type='text' value='".$row["name"]."' placeholder='Food' form='submission' name='proname'/>";
                        ?>
                      </div>
                        </div>
                        <div class="mdui-col-xs-3">Product Category:</div>
                        <div class="mdui-col-xs-9">
                            <select class="mdui-select" form="submission" name="catesele">
                                <?php
                                $sql = "SELECT * FROM category";
                                $rows = mysqli_query($conn, $sql);
                                while($cate = mysqli_fetch_assoc($rows)){
                                    if ($cate["id"] == $id){
                                        echo "<option value='{$cate["id"]}' selected>{$cate["name"]}</option>";
                                    }else{echo "<option value='{$cate["id"]}'>{$cate["name"]}</option>";}

                                }
                                ?>
                              </select>
                        </div>
                <div class="mdui-col-xs-3">Product image:</div>
                <div class="mdui-col-xs-9">
                    <!-- 单选框 -->
                    <?php
                    $parh = 'product_img/'.$row["id"].'.jpg';
                    echo'<img src="'.$parh.'" alt="" id="dog" style="width:100px; height: 100px;"><i>Current icon</i><br/>';
                    ?>
                    <i class="mdui-icon material-icons" style="position:relative; font-size: 100px;" onclick="upload.click()">add_to_photos
                        <input type="file" form="submission" name="up" id="upload" style="display: none;" /></i>
                    <i>Only jpg/png with a maxium size of 500 kb</i>
                    </div>               
                <div class="mdui-col-xs-3">Is Hot:</div>
                    <div class="mdui-col-xs-9">
                        <select class="mdui-select">
                            <?php
                            if ($row["is_hot"] == 0){
                                echo '  <option value="0" selected>no</option>';
                                echo '  <option value="1">yes</option>';
                                echo '</select>';
                            }else{

                                echo '  <option value="0">no</option>';
                                echo '  <option value="1" selected>yes</option>';
                                echo '</select>';
                            }
                            ?>
                          </select>
                    </div>
        <div class="mdui-col-xs-3">Status:</div>
        <div class="mdui-col-xs-9">
            <select class="mdui-select" form="submission" name="stutes">
                <?php
                if ($row["status"] == 0){
                    echo '  <option value="0" selected>Shelved</option>';
                    echo '  <option value="1">Unshelved</option>';

                }else{

                    echo '  <option value="0">Shelved</option>';
                    echo '  <option value="1" selected>Unshelved</option>';

                }
                ?>


            </select>
        </div>
                <div class="mdui-col-xs-3">Product Description:</div>
                <div class="mdui-col-xs-9">
                    <div class="mdui-textfield">
                        <?php
                        echo '<textarea class="textfield3"  placeholder="Description" name="prodesc" cols="30" rows="3" id="prodesc" form="submission"></textarea>';
                        echo '<script>';
                        echo 'document.getElementById("prodesc").value="'.$row["description"].'"';
                        echo '</script>';
                        ?>
                    </div>
                </div>
        <div class="mdui-col-xs-3">Product Price:</div>
        <div class="mdui-col-xs-9">
            <?php
                 echo "<input type='text' value='{$row["price"]}' form='submission' name='price'>";
            ?>
        </div>

        <div class="purchasenumber" >
            <div class="mdui-col-xs-3" style="margin-top: 10px;">Quantity in stocks:</div>
            <div class="number" >
                <i class = "minus iconfont icon-jianhao" class="mdui-col-xs-3" style="margin: 10px 10px 10px 10px;"></i>
                <?php
                echo "<input type='text' style='margin: 10px 10px 10px -10px;' value='{$row["stock_qty"]}' form='submission' name='quan'>";
                ?>

                <i class = "plus iconfont icon-jiahao1"></i>
            </div>
        </div>
                       <div>

                    <button class="mdui-btn mdui-ripple" id="cancelButton" onclick="cancelEdit()">Resit</button>
                           <button class="mdui-btn mdui-color-blue-accent mdui-ripple" id="submitButton" form="submission" name="sub">submit</button>
                       </div>
        </div>
</body>

<!-- 这个页面的JS -->    
<style>
        .side{ padding: 2px 20px;
        }
        .content{
            margin-left: 25px

        }
        .dog{
            position: absolute;
            bottom: 0;
        }

    </style>

<script>

    
    function cancelEdit() {
        <?php
        echo 'window.location.href = "proedit.php?id='.$row["id"].'"'
        ?>

    }

    </script>
</html>