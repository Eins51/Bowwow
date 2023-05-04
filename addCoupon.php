<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入样式，mdui -->
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>    
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    <!-- 这个页面css-->
    <title>Store Admin| Coupon</title>
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
    <div class="content">
            <!-- 主内容 -->
        <h1 style="text-transform:capitalize;">Coupon Management/Add Coupon
            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue-accent">Return</button>
        </h1>
        <h2 style="font-style: italic;">Please enter Coupon information</h2>                
                      
                <form action="addedCoupon.php" method="post" id="submit">
                <div class="mdui-col-xs-3" style="font-weight: 400;">Coupon Name:</div>

                <div class="mdui-col-xs-9">
                    <!-- required必填字段 -->
                    <div class="mdui-textfield">
                        <input class="mdui-textfield-input" type="text" placeholder="Food" id="couname" form="submit" name="couname"/>
                      </div>
                        </div>
                        <div class="mdui-col-xs-3">Coupon Category:</div>
                        <div class="mdui-col-xs-9">
                            <select class="mdui-select" name="cousele" form="submit">
                                <option value="0" selected>Discount</option>
                                <option value="1">Voucher</option>
                                <option value="2">Cash</option>
                              </select>
                        </div>
                <div class="mdui-col-xs-3">Valid Time:</div>
                <div class="mdui-col-xs-9">
                    <p><input type="datetime-local" id="time1" name="start" form="submit"> to <input type="datetime-local" id="time2" name="end" form="submit"></p>
                </div>                    
                <div class="mdui-col-xs-3">Coupon Value:</div>
                        <div class="mdui-col-xs-9">
                            <!-- required必填字段 -->
                            <div class="mdui-textfield">
                                <input type="text" placeholder="0" id="value" name="value" form="submit">
                              </div>
                                </div>

                <div class="mdui-col-xs-3">Coupon Description:</div>
                <div class="mdui-col-xs-9">

                    <div class="mdui-textfield">
                        <textarea class="textfield3" name="coudisc" placeholder="Description" cols="30" rows="3" id="coudesc" form="submit"></textarea>
                      </div>
                        </div>
                        <div class="purchasenumber" >
                            <h3 class="mdui-col-xs-3">Quantity</h3>
                             <div class="number" >
                                  <i class = "minus iconfont icon-jianhao" class="mdui-col-xs-3" style="margin: 10px 10px 10px 10px;"></i>
                                  <input type="text" name="cousele" form="submit">
                                  <i class = "plus iconfont icon-jiahao1"></i>
                             </div>
                       </div>
                </form>
                       <div>
                        <button class="mdui-btn mdui-color-blue-accent mdui-ripple" form="submit" style="margin: 10px 10px 10px 10px;" id="myButton" onclick="saveText()" form="submit">Save</button>
                    <button class="mdui-btn mdui-ripple" id="cancelButton" onclick="cancel()">Cancle</button>  
                </div>
                       
        </div>
    </div>
</body>
<!-- 这个页面的JS -->    
<style>
                .content{
            margin-left: 25px

        }

    </style>
<script>
    var text1 = "";
	var text2 = "";
	var text3 = "";
    var text4 = "";
    var text5 = "";
    var numberInput = 1;
    function saveText() {
			// 将文本框的值保存到变量中
			text1 = document.getElementById("couname").value;
			text2 = document.getElementById("time1").value;
			text3 = document.getElementById("time2").value;
            text4 = document.getElementById("value").value;
            text5 = document.getElementById("coudesc").value;
            numberInput = document.querySelector('.number input').value;

			// 提示用户保存成功

		}

		function cancel() {
			// 将文本框的值重置为初始值
			text1 = document.getElementById("couname").value = "";
			text2 = document.getElementById("time1").value = "";
			text3 = document.getElementById("time2").value = "";
            text4 = document.getElementById("value").value = "";
            text5 = document.getElementById("coudesc").value = "";
            numberInput = document.querySelector('.number input').value = 1;
			// 提示用户已还原到初始状态

		}
</script>
</html>