<?php
session_start();
include("include/config.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result)) {
        $_SESSION['username'] = $username;
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_avatar'] = $admin['image_path'];
        header("Location: profile.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bowwow Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html,body {
			margin: 0px;
			width: 100%;
			height: 100%;
		}
        
        .bg-image {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            height: 50%;
        }

        .bottom-half {
            background-color: rgba(239, 239, 239, 0.9);
            min-height: 50%;
            position: relative;
            padding: 20px;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            top: 30%;
            width: 100%;
            margin-top: -50px;
        }

        .decorative-image {
            position: absolute;
            top: 100px;
            left: 420px;
            max-height: 200px;
            width: auto;
        }

        .card h2 {
            color: #D8CCC4;
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            z-index: 10;
        }

        .form-control {
            padding-left: 35px;
        }

        .btn-login {
            margin-bottom: 10px;
            background-color: #D8CCC4;
            color: #fff;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="bg-image"></div>
    <div class="bottom-half">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="login-container">
                        <div class="card p-5">
                            <h2 class="text-center">Management System</h2>
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error; ?>
                            </div>
                            <?php endif; ?>
                            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="input-group mb-4">
                                    <i class="fas fa-user"></i>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                </div>
                                <div class="input-group mb-4">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                                <button type="submit" class="btn btn-login" name="submit">Login</button>
                            </form>
                            <hr>
                            <footer class="col-sm-12 text-center">
                                <p class="m-b-0">Copyright © CAN302 Group D3</a>. All right reserved</p>
                            </footer>
                        </div>
                        <img src="images/login_dog.png" alt="Decorative image" class="decorative-image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

