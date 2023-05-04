<div class="span3">
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>
    <style>
        .mdui-toolbar {
            border-bottom: 1px solid #ccc;
        }
    </style>
<div class="sidebar">
<body class="mdui-drawer-body-left mdui-theme-primary-white mdui-theme-accent-blue">
    <!-- 顶部框 -->
        <div class="mdui-toolbar mdui-color-theme" style="color:#D8CCC4;" id="header">
            <a class="mdui-btn mdui-btn-icon">
                <i class="mdui-icon material-icons" id="menu" onclick="toggleSidebar()">format_indent_decrease</i>
            </a>

            <div class="mdui-toolbar-spacer"></div> <!--会将该元素两边的内容推向两侧。-->
            <div class="mdui-chip" style="line-height:normal">
			<button class="mdui-btn mdui-btn-raised mdui-ripple" onclick="window.location=`index.php`;">
				Log out
			</button>
            </div>
        </div>
    <!--侧边栏-->
    <div class="mdui-drawer" id="siderbar" style="background-color: #D8CCC4;">
	<div>
		<h1 style="text-transform:capitalize; font-size: 22; color: gray" ><!--暂时写死，看情况是否需要连接数据库-->
		<img src="images/<?php echo $_SESSION['admin_avatar']; ?>" alt="Admin Avatar" class="avatar" id="sidebar-avatar" style="width:50px; height: 50px;"> 
        <?php echo $_SESSION['username']; ?>
		</h1>
	
	</div>
        <div>
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple" onclick="window.location=`./profile.php`;" style="color: white;">
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
        <style>
        ..mdui-toolbar-fixed{
                padding-left: 0;
                padding-right: 0;
            }

        </style>
        <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
        <script>
        function toggleSidebar() {
            document.getElementById("siderbar").classList.toggle("mdui-drawer-close");
  
  // 更改顶部样式
            var topbar = document.getElementById("header");
            if (topbar.style.width === "100%") {
                topbar.style.width = "auto";
            } else {
                topbar.style.width = "100%";
            }
        }
        </script>
