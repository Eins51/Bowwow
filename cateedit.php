<?php
// 数据库连接信息
include ("conn.php");
$id = $_GET["id"];
$sql = "SELECT * FROM category where id = ".$id;
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
    <title>CAN302 Store Admin| Category Edition</title>
</head>

<body>
<!--侧边栏-->
<?php include ("include/sidebar.php");?>

    <div class="content" style="mdui-drawer-body-left">
            <!-- 主内容 -->
        <h1 style="text-transform:capitalize;">Category Management/Edit Category
            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue-accent">Return</button>
        </h1>
        <h2 style="font-style: italic;">Edit the category information</h2>
        <?php
        echo '<form action="editCategory.php?id='.$id.'" method="post" target="myiframe" id="submission" enctype="multipart/form-data"></form>'
        ?>

                <div class="mdui-col-xs-3" style="font-weight: 400;" >Category Name:</div>

                <div class="mdui-col-xs-9">
                    <!-- required必填字段 -->
                    <div class="mdui-textfield">
                        <?php
                        echo '<input class="mdui-textfield-input" value="'.$row["name"]. '" type="text" form="submission" name="catename" placeholder="Food" id="catename" disabled/>';
                      ?>
                      </div>
                        </div>

                <div class="mdui-col-xs-3">Category icon:</div>
                <div class="mdui-col-xs-9">
                <!-- 单选框 -->
                    <?php
                    $parh = 'images/category_img/'.$row["image_path"];
                    echo'<img src="'.$parh.'" alt="" id="dog" style="width:100px; height: 100px;"><i>Current icon</i><br/>';
                    ?>

                <i class="mdui-icon material-icons" style="font-size: 100px;" onclick="upload.click()">add_to_photos
                    <input type="file" name="up" id="upload" form="submission" style="display: none;" accept="image/svg+xml"/></i>
                <i>Only jpg/png with a maxium size of 500 kb</i>
                </div>

                <div class="mdui-col-xs-3">Category Description:</div>
                <div class="mdui-col-xs-9">
            
                    <div class="mdui-textfield">
                        <?php
                        echo '<textarea class="textfield3"  placeholder="Description" name="catedesc" cols="30" rows="3" id="catedesc" form="submission" disabled></textarea>';
                        echo '<script>';
                            echo 'document.getElementById("catedesc").value="'.$row["description"].'"';
                        echo '</script>';
                        ?>

                      </div>
                        </div>
                    <div class="mdui-col-xs-3">Category Status:</div>
                    <div class="mdui-col-xs-9">
                        <?php
                        if ($row["status"] == 0){
                            echo '<select class="mdui-select" name="catesele" select = >';
                            echo '  <option value="0" selected>Activated</option>';
                            echo '  <option value="1">Forbidden</option>';
                            echo '</select>';
                        }else{
                            echo '<select class="mdui-select" name="catesele" select = >';
                            echo '  <option value="0">Activated</option>';
                            echo '  <option value="1" selected>Forbidden</option>';
                            echo '</select>';
                        }

                          ?>
                    </div>

                    <button class="mdui-btn mdui-color-blue-accent mdui-ripple" id="myButton" onclick="toggleTextBox()">Edit</button>
                    <button class="mdui-btn mdui-ripple"id="cancelButton"onclick="cancelEdit()">Cancle</button>
                    <button class="mdui-btn mdui-ripple"id="saveButton" form="submission">Save</button>

        </div>
    </html>
</body>
<!-- 这个页面的JS-->
<style>
                .content{
            margin-left: 25px

        }

    </style>
<script>
    var originalValues = [];
    function toggleTextBox() {
      var textBox1 = document.getElementById('catename');
      var textBox2 = document.getElementById('catedesc');
      var myButton = document.getElementById('myButton');
      var cancelButton = document.getElementById('cancelButton');
      if (textBox1.disabled) {
        // Enter edit mode
        originalValues = [textBox1.value, textBox2.value];
        textBox1.disabled = false;
        textBox2.disabled = false;
        myButton.innerText = 'Editing';
        cancelButton.disabled = false;
      } else {
        // Exit edit mode
        if (textBox.value !== '') {
          originalValues[0] = textBox1.value;
        }
        if (otherTextBox.value !== '') {
          originalValues[1] = textBox2.value;
        }
        textBox1.value = originalValues[0];
        textBox2.value = originalValues[1];
        textBox1.disabled = true;
        textBox2.disabled = true;
        editButton.innerText = 'Edit';
        cancelButton.disabled = true;
      }
    }

    function cancelEdit() {
      var textBox1 = document.getElementById('catename');
      var textBox2 = document.getElementById('catedesc');
      var editButton = document.getElementById('myButton');
      var cancelButton = document.getElementById('cancelButton');

      textBox1.value = originalValues[0];
      textBox2.value = originalValues[1];
      textBox1.disabled = true;
      textBox2.disabled = true;
      myButton.innerText = 'Edit';
      cancelButton.disabled = true;
    }
    </script>