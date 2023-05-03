<?php
session_start();
require_once 'include/config.php';

// Check "admin_id" session variable
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

$admin_id = $_SESSION['admin_id'];

// Get admin information from the database
$query = "SELECT * FROM admin WHERE id = '$admin_id'";
$result = mysqli_query($con, $query);
$admin = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get submitted data
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password is changed
    if ($password != '**********') {
        // Check if passwords match
        if ($password == $confirm_password) {
            // Update admin with new password
            $password = md5($password);
            $query = "UPDATE admin SET gender='$gender', phone='$phone', email='$email', password='$password' WHERE id='$admin_id'";
        } else {
            echo '<script>alert("Error: Passwords do not match");</script>';
            return;
        }
    } else {
        // Update admin without changing the password
        $query = "UPDATE admin SET gender='$gender', phone='$phone', email='$email' WHERE id='$admin_id'";
    }

    if (mysqli_query($con, $query)) {
        if (isset($_POST['ajax'])) {
            echo 'success';
        } else {
            header("Refresh:0");
            echo '<script>alert("Profile updated successfully");</script>';
        }
    } else {
        echo '<script>alert("Error updating profile");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Info</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .profile-avatar {
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar-overlay {
            position: absolute;
            bottom: -6px;
            right: 0;
            padding: 5px;
            cursor: pointer;
        }

        .profile-header {
            border-bottom: 1px solid #ccc;
            padding-top: 20px;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .d-flex {
            display: flex;
            align-items: center;
        }

        .icon-adjust {
            position: relative;
            top: -5px; /* Adjust this value to move the icon up */
        }

        .username-input {
            background: none;
            border: none;
            font-size: 1.25rem;
            font-weight: 500;
            display: inline;
            width: auto;
        }

        .username-input:focus {
            outline: none;
        }

    </style>
</head>
<body>
    <?php include 'include/sidebar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="profile-header">
                    <div class="d-flex">
                        <div class="profile-avatar">
                            <img src="images/<?php echo $admin['image_path']; ?>" alt="Profile Avatar" class="rounded-circle">
                            <div class="profile-avatar-overlay">
                                <label for="upload-avatar">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" id="upload-avatar" hidden>
                            </div>
                        </div>
                        <div class="profile-info ml-5">
                            <div class="profile-name d-flex align-items-center">
                                <h5 id="username"><?php echo $admin['username']; ?></h5>
                                <i id="edit-username" class="fas fa-pencil-alt ml-2 icon-adjust"></i>
                            </div>
                            <p>Account ID: <?php echo $admin['id']; ?></p>
                        </div>
                    </div>
                </div>

                <form action="profile.php" method="post" id="profile-form">
                    <div class="my-information mt-5">
                        <h3>My Information</h3>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="0" <?php echo $admin['gender'] == 0 ? 'selected' : ''; ?>>Male</option>
                                <option value="1" <?php echo $admin['gender'] == 1 ? 'selected' : ''; ?>>Female</option>
                                <option value="2" <?php echo $admin['gender'] == 2 ? 'selected' : ''; ?>>Others</option>
                                <option value="3" <?php echo $admin['gender'] == 3 ? 'selected' : ''; ?>>Secrecy</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="<?php echo $admin['phone']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="<?php echo $admin['email']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="password-settings mt-5">
                        <h3>Password Settings</h3>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="**********" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" placeholder="Please enter your password again" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Edit username -->
    <script>
        document.getElementById('edit-username').addEventListener('click', editUsername);

        function editUsername() {
            const usernameElement = document.getElementById('username');
            const currentUsername = usernameElement.textContent;

            const usernameInput = document.createElement('input');
            usernameInput.type = 'text';
            usernameInput.value = currentUsername;
            usernameInput.classList.add('username-input');

            usernameElement.textContent = '';
            usernameElement.appendChild(usernameInput);
            usernameInput.focus();

            usernameInput.addEventListener('blur', saveUsername);
            usernameInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    saveUsername();
                }
            });
        }

        function saveUsername() {
            const usernameInput = document.querySelector('.username-input');
            const newUsername = usernameInput.value.trim();

            if (newUsername !== '') {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_username.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        const usernameElement = document.getElementById('username');
                        usernameElement.textContent = newUsername;
                    }
                };
                xhr.send(`admin_id=${encodeURIComponent(<?php echo $admin_id; ?>)}&username=${encodeURIComponent(newUsername)}`);
            }
        }
    </script>

    <!-- Update avatar -->
    <script> 
        const uploadInput = document.getElementById('upload-avatar');
        uploadInput.addEventListener('change', uploadAvatar);

        function uploadAvatar() {
        const file = uploadInput.files[0];
        const formData = new FormData();
        formData.append('avatar', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload_avatar.php', true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                // Update avatar on the page
                const avatarImg = document.querySelector('.profile-avatar img');
                avatarImg.src = URL.createObjectURL(file);

                // Update sidebar avatar
                const sidebarAvatar = document.getElementById('sidebar-avatar');
                sidebarAvatar.src = URL.createObjectURL(file);
            } else {
                alert('Error uploading avatar');
            }
        };
        xhr.send(formData);
        }
    </script>

    <!-- Edit profile info -->
    <script>
        // Edit profile info
        document.getElementById('profile-form').addEventListener('submit', function (event) {
            event.preventDefault();

            // Check if passwords match
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

            if (password !== '**********' && password !== confirmPassword) {
                alert('Error: Passwords do not match');
                return;
            }

            const formData = new FormData(event.target);
            formData.append('ajax', '1');

            fetch('profile.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(responseText => {
                    if (responseText.trim().startsWith('success')) {
                        alert('Profile updated successfully');
                    } else {
                        alert('Error updating profile');
                    }
                });
        });

    </script>

</body>
</html>
