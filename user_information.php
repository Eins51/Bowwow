<?php
session_start();
require_once 'include/config.php';

$ID = 1;
$sql = "select * from user where id=$ID";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $id = $row["id"];
    $username = $row["username"];
    $gender = $row["gender"];
    $phone = $row["phone"];
    $email = $row["email"];
    $is_member = $row["is_member"];
    $payment = $row["payment"];
    $last_online = $row["last_online"];
    $image_path = $row["image_path"];
}

$sql1 = "select * from pet where user_id=$ID";
$result1 = mysqli_query($con, $sql1);

$sql2 = "select * from address where user_id=$ID";
$result2 = mysqli_query($con, $sql2);

include 'include/sidebar.php';

//a safe method to recieve post data
function mypost($str)
{
    $val = !empty($_POST[$str]) ? $_POST[$str] : '';
    return $val;
}

$petid = mypost('changep');
$petid1 = mypost('deletep');
$addressid = mypost('changea');
$addressid1 = mypost('deletea');

//receive query parameters.
if (!empty(mypost('username1'))) {
    $username1 = mypost('username1');
} else {
    $username1 = $username;
}
$genderu = mypost('genderu');
if (!empty(mypost('phoneu'))) {
    $phoneu = mypost('phoneu');
} else {
    $phoneu = $phone;
}
if (!empty(mypost('emailu'))) {
    $emailu = mypost('emailu');
} else {
    $emailu = $email;
}
$paymentu = mypost('paymentu');
if (!empty(mypost('image_pathu'))) {
    $image_pathu = mypost('image_pathu');
} else {
    $image_pathu = $image_path;
}


$petname1 = mypost('petname');
$genderp = mypost('genderp');
$breedp = mypost('breedp');
$sizep = mypost('sizep');
$agep = mypost('agep');
$birthdayp = mypost('birthdayp');

$petnamec = mypost('petnamec');
$genderc = mypost('genderc');
$breedc = mypost('breedc');
$sizec = mypost('sizec');
$agec = mypost('agec');
$birthdayc = mypost('birthdayc');


$is_defaulta = mypost('is_defaulta');
$countrya = mypost('countrya');
$provincea = mypost('provincea');
$citya = mypost('citya');
$districta = mypost('districta');
$detaila = mypost('detaila');
$postal_codea = mypost('postal_codea');

$is_defaultc = mypost('is_defaultc');
$countryc = mypost('countryc');
$provincec = mypost('provincec');
$cityc = mypost('cityc');
$districtc = mypost('districtc');
$detailc = mypost('detailc');
$postal_codec = mypost('postal_codec');


//add the received data to database
if (isset($_POST['add'])) {
    $sqlp = "INSERT INTO `pet` (`id`, `name`,`gender`,`breed`,`size`,`age`,`birthday`,`user_id`) VALUES (NULL, '" . $petname1 . "','" . $genderp . "','" . $breedp . "','" . $sizep . "', '" . $agep . "','" . $birthdayp . "','" . $ID . "')";
    $query = mysqli_query($con, $sqlp);
    echo "<script language=\"javascript\">location.href='user_information.php';</script>";
}
if (isset($_POST['add1'])) {
    $sqla = "INSERT INTO `address` (`id`, `user_id`, `is_default`, `country`, `province`, `city`, `district`, `detail`, `postal_code`) VALUES (NULL, '" . $ID . "','" . $is_defaulta . "','" . $countrya . "','" . $provincea . "', '" . $citya . "','" . $districta . "','" . $detaila . "','" . $postal_codea . "')";
    $query = mysqli_query($con, $sqla);
    echo "<script language=\"javascript\">location.href='user_information.php';</script>";
}

if (isset($_POST['changeu'])) {
    $sqlu = "UPDATE `user` SET `username` = '" . $username1 . "', `gender` = '" . $genderu . "', `phone` = '" . $phoneu . "', `email` = '" . $emailu . "', `is_member` = '" . $is_memberu . "', `payment` = '" . $paymentu . "', `image_path` = '" . $image_pathu . "' WHERE `user`.`id` = $ID";
    $query = mysqli_query($con, $sqlu);
    echo "<script language=\"javascript\">location.href='user_information.php';</script>";
}
if (isset($_POST['changep'])) {
    $sqlc = "UPDATE `pet` SET `name` = '" . $petnamec . "', `gender` = '" . $genderc . "', `breed` = '" . $breedc . "', `size` = '" . $sizec . "', `age` = '" . $agec . "', `birthday` = '" . $birthdayc . "' WHERE `pet`.`id` = $petid";
    $query = mysqli_query($con, $sqlc);
    echo "<script language=\"javascript\">location.href='user_information.php';</script>";
}
if (isset($_POST['changea'])) {
    $sqld = "UPDATE `address` SET `is_default` = '" . $is_defaultc . "', `country` = '" . $countryc . "', `province` = '" . $provincec . "', `city` = '" . $cityc . "', `district` = '" . $districtc . "', `detail` = '" . $detailc . "', `postal_code` = '" . $postal_codec . "' WHERE `address`.`id` = $addressid";
    $query = mysqli_query($con, $sqld);
    echo "<script language=\"javascript\">location.href='user_information.php';</script>";
}
if (isset($_POST['deletep'])) {
    $sqle = "DELETE FROM `pet` WHERE `pet`.`id` = $petid1";
    $query = mysqli_query($con, $sqle);
    echo "<script language=\"javascript\">location.href='user_information.php';</script>";
}
if (isset($_POST['deletea'])) {
    $sqlf = "DELETE FROM `address` WHERE `address`.`id` = $addressid1";
    $query = mysqli_query($con, $sqlf);
    echo "<script language=\"javascript\">location.href='user_information.php';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>User Information</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/core.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script>
    </script>
</head>

<body>
    <div class="main">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">
                                <?php echo '<img src="images/user_avatar/' . $image_path . '" alt="" class="avatar-photo">';     ?>
                            </div>
                            <!-- View Information -->

                            <h5 class="text-center h5 mb-0">
                                <?php
                                echo $username;
                                ?></h5>
                            <p class="text-center text-muted font-14">Set individual information</p>
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-orange">Basic Information</h5>
                                <ul>
                                    <li>
                                        <span>Account ID:</span>
                                        <?php
                                        echo $id;
                                        ?>
                                    </li>
                                    <li>
                                        <span>Gender:</span>
                                        <?php
                                        switch ($gender) {
                                            case 0:
                                                echo "Male";
                                                break;
                                            case 1:
                                                echo "Female";
                                                break;
                                            case 2:
                                                echo "Others";
                                                break;
                                            default:
                                                echo "Secrecy";
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <span>Phone Number:</span>
                                        <?php
                                        echo $phone;
                                        ?>
                                    </li>
                                    <li>
                                        <span>Email Address:</span>
                                        <?php
                                        echo $email;
                                        ?>
                                    </li>
                                    <li>
                                        <span>Member:</span>
                                        <?php
                                        switch ($is_member) {
                                            case 1:
                                                echo "Yes";
                                                break;
                                            default:
                                                echo "No";
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <span>Default Payment:</span>
                                        <?php
                                        switch ($payment) {
                                            case 0:
                                                echo "PayPal";
                                                break;
                                            case 1:
                                                echo "Gredit Card";
                                                break;
                                            case 2:
                                                echo "Alipay";
                                                break;
                                            default:
                                                echo "Others";
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <span>Last Online Time:</span>
                                        <?php
                                        echo $last_online;
                                        ?>
                                    </li>
                                    <a href="task-add0" data-toggle="modal" data-target="#task-add0" class="bg-light-blue btn text-orange-50 weight-500"><i class="ion-plus-round"></i> Change</a>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <!-- Change Information -->
                    <div class="modal fade customscroll" id="task-add0" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Change Personal Information</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pd-0">
                                    <div class="task-list-form">
                                        <ul>
                                            <li>
                                                <form role="form" action="" method="post">
                                                    <div class="form-group row">
                                                        <label class="col-md-4">User Name</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo  '<input class="form-control" type="text" placeholder="' . $username . '" id="username1" name="username1">';
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label class="col-md-4">Gender:</label>
                                                        <select name="genderu" id="gender" class="form-control">
                                                            <option value="0" <?php echo $gender == 0 ? 'selected' : ''; ?>>Male</option>
                                                            <option value="1" <?php echo $gender == 1 ? 'selected' : ''; ?>>Female</option>
                                                            <option value="2" <?php echo $gender == 2 ? 'selected' : ''; ?>>Others</option>
                                                            <option value="3" <?php echo $gender == 3 ? 'selected' : ''; ?>>Secrecy</option>
                                                        </select>
                                                    </div>
                                                    <br />
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Phone Number</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo  '<input class="form-control" type="text" placeholder="' . $phone . '" id="phone" name="phoneu">';
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Email</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo  '<input class="form-control" type="text" placeholder="' . $email . '" id="email" name="emailu">';
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Member:</label>
                                                        <select name="is_memberu" id="member" class="form-control">
                                                            <option value="0" <?php echo $is_member == 0 ? 'selected' : ''; ?>>No</option>
                                                            <option value="1" <?php echo $is_member == 1 ? 'selected' : ''; ?>>Yes</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Payment:</label>
                                                        <select name="paymentu" id="payment" class="form-control">
                                                            <option value="0" <?php echo $payment == 0 ? 'selected' : ''; ?>>Paypal</option>
                                                            <option value="1" <?php echo $payment == 1 ? 'selected' : ''; ?>>Credit Card</option>
                                                            <option value="2" <?php echo $payment == 2 ? 'selected' : ''; ?>>Alipay</option>
                                                            <option value="3" <?php echo $payment == 3 ? 'selected' : ''; ?>>Others</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Image Path</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo  '<input class="form-control" type="text" placeholder="' . $image_path . '" id="image" name="image_pathu">';
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" id="add" name="changeu" value="changeu"> Change </button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </form>
                                            </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks Cards -->

                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Pet" role="tab">Pets</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Address" role="tab">Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#" role="tab">Order History</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Pet Tab start -->
                                        <div class="tab-pane fade show active" id="Pet" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Pets Home</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="task-addp" data-toggle="modal" data-target="#task-addp" class="bg-light-blue btn text-orange-50 weight-500"><i class="ion-plus-round"></i> Add</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pd-20">
                                                    <div class="profile-timeline">
                                                        <div class="profile-timeline-list">
                                                            <ul>
                                                                <form role="form" action="" method="post">
                                                                    <?php
                                                                    $nump = 1;
                                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                                        $nump = $nump + 1;
                                                                        $petid = $row1["id"];
                                                                        $petid1 = $row1["id"];
                                                                        $ge0 = 0;
                                                                        $ge1 = 0;
                                                                        $ge2 = 0;
                                                                        $ge3 = 0;
                                                                        echo "<li>";
                                                                        echo '<div class="task-type"><b>' . $row1["name"] . '</b></div>';
                                                                        switch ($row1["gender"]) {
                                                                            case 0:
                                                                                echo "Male";
                                                                                $ge0 = "selected";
                                                                                break;
                                                                            case 1:
                                                                                echo "Female";
                                                                                $ge1 = "selected";
                                                                                break;
                                                                            case 2:
                                                                                echo "Others";
                                                                                $ge2 = "selected";
                                                                                break;
                                                                            default:
                                                                                $ge3 = "selected";
                                                                                echo "Secrecy";
                                                                        }
                                                                        echo "<br/>";
                                                                        echo $row1["breed"] . " " . $row1["size"];
                                                                        echo '<div style="float:right;"><button type="submit" class="btn" id="add" name="deletep" value="' . $petid1 . '"><span aria-hidden="true">&times;</span>
                                                                        </button></div>';
                                                                        echo '<a href="task-addp" data-toggle="modal" data-target="#task-changep' . $nump . '" style="float:right;" class="bg-light-blue btn text-orange-50 weight-500" name="petid" value="' . $petid . '"><i class="ion-plus-round"></i> Change</a>';
                                                                        echo "<br/>";
                                                                        echo $row1["age"] . " years old. Birthday: " . $row1["birthday"];
                                                                        echo "<br/>";
                                                                        echo "<br/>";
                                                                        echo "</li>";
                                                                        echo "<div>";
                                                                        echo '<div class="modal fade customscroll" id="task-changep' . $nump . '" tabindex="-1" role="dialog">
                                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                              <div class="modal-content">
                                                                              <div class="modal-header">
                                                                              <h5 class="modal-title" id="exampleModalLongTitle">Pets Change</h5>
                                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                                                                              <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                              </div>
                                                                              <div class="modal-body pd-0">
                                                                              <div class="task-list-form">
                                                                              <ul>
                                                                              <li>
                                                                              <form role="form" action="" method="post">
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Name</label>
                                                                              <div class="col-md-8">
                                                                              <input type="text" class="form-control" id="name" placeholder=" " name="petnamec" value="' . $row1["name"] . ' ">
                                                                              </div> 
                                                                              </div>
                                                                              <div class="d-flex">
                                                                              <label class="col-md-4">Gender:</label>
                                                                              <select name="genderc" id="gender" class="form-control">
                                                                              <option value="0" ' . $ge0 . '>Male</option>
                                                                              <option value="1" ' . $ge1 . '>Female</option>
                                                                              <option value="2" ' . $ge2 . '>Others</option>
                                                                              <option value="3" ' . $ge3 . '>Secrecy</option>
                                                                              </select>
                                                                              </div>                                                                            
                                                                              <br/>                                                                             
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Birthday</label>
                                                                              <div class="col-md-8">
                                                                              <input class="input-sm form-control date-picker" data-date-format="yyyy-mm-dd" placeholder=" " id="birthday" name="birthdayc" value="' . $row1["birthday"] . '">
                                                                              </div>
                                                                              </div>
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Breed</label>
                                                                              <div class="col-md-8">
                                                                              <input class="form-control" type="text" placeholder=" " id="breed" name="breedc" value="' . $row1["breed"] . '">
                                                                              </div>
                                                                              </div>
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Size</label>
                                                                              <div class="col-md-8">
                                                                              <input class="form-control" type="text" placeholder=" " id="size" name="sizec" value="' . $row1["size"] . '">
                                                                              </div>
                                                                              </div>
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Age</label>
                                                                              <div class="col-md-8">
                                                                              <input class="form-control" type="text" placeholder=" " id="age" name="agec" value="' . $row1["age"] . '">
                                                                              </div>
                                                                              </div>                                                                    
                                                                              <button type="submit" class="btn btn-primary" id="add" name="changep" value="' . $petid . '"> Change </button>
                                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                              </form>
                                                                              </li>
                                                                              </ul>                                                               
                                                                              </div>     
                                                                              </div>                                         
                                                                              </div>
                                                                              </div>';
                                                                        echo "</div>";
                                                                    }
                                                                    ?>
                                                                </form>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- add Pet- -->
                                        <div class="modal fade customscroll" id="task-addp" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Pets Add</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pd-0">
                                                        <div class="task-list-form">
                                                            <ul>
                                                                <li>
                                                                    <form role="form" action="" method="post">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Name</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" id="name" placeholder=" " name="petname">
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <label class="col-md-4">Gender:</label>
                                                                            <select name="genderp" id="gender" class="form-control">
                                                                                <option value="0">Male</option>
                                                                                <option value="1">Female</option>
                                                                                <option value="2">Others</option>
                                                                                <option value="3">Secrecy</option>
                                                                            </select>
                                                                        </div>
                                                                        <br />
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Birthday</label>
                                                                            <div class="col-md-8">
                                                                                <input class="input-sm form-control date-picker" data-date-format="yyyy-mm-dd" placeholder=" " id="birthday" name="birthdayp">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Breed</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder=" " id="breed" name="breedp">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Size</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder=" " id="size" name="sizep">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Age</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder=" " id="age" name="agep">
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary" id="add" name="add" value="add"> Add </button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- add task popup End -->
                                        </div>
                                        <!-- Pet Tab End -->
                                        <!-- Address Tab start -->
                                        <div class="tab-pane fade" id="Address" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Address List</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="task-add" data-toggle="modal" data-target="#task-add" class="bg-light-blue btn text-orange-50 weight-500"><i class="ion-plus-round"></i> Add</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="profile-task-list pb-30">
                                                    <ul>
                                                        <form role="form" action="" method="post">
                                                            <?php
                                                            $numpi = 1;
                                                            while ($row2 = mysqli_fetch_array($result2)) {
                                                                $numpi = $numpi + 1;
                                                                $addressid = $row2["id"];
                                                                $addressid1 = $row2["id"];
                                                                $se0 = 0;
                                                                $se1 = 0;
                                                                echo "<li>";
                                                                switch ($row2["is_default"]) {
                                                                    case 0:
                                                                        echo "Not Default";
                                                                        $se0 = "selected";
                                                                        break;
                                                                    default:
                                                                        echo "Default";
                                                                        $se1 = "selected";
                                                                }
                                                                echo "<br/>";
                                                                echo $row2["country"] . "  " . $row2["province"] . " " . $row2["city"];
                                                                echo "<br/>";
                                                                echo  $row2["district"] . "  " . $row2["detail"] . " " . $row2["postal_code"];
                                                                echo "<br/>";
                                                                echo '<div style="float:right;"><button type="submit" class="btn" id="deletea" name="deletea" value="' . $addressid1 . '"><span aria-hidden="true">&times;</span>
                                                                        </button></div>';
                                                                echo '<a href="task-adda" data-toggle="modal" data-target="#task-changea' . $numpi . '" style="float:right" class="bg-light-blue btn text-orange-50 weight-500" name="petid" value="' . $addressid . '"><i class="ion-plus-round"></i> Change</a>';
                                                                echo "<br/>";
                                                                echo "<br/>";
                                                                echo "</li>";
                                                                echo "<div>";
                                                                echo '<div class="modal fade customscroll" id="task-changea' . $numpi . '" tabindex="-1" role="dialog">
                                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                              <div class="modal-content">
                                                                              <div class="modal-header">
                                                                              <h5 class="modal-title" id="exampleModalLongTitle">Address Change</h5>
                                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                                                                              <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                              </div>
                                                                              <div class="modal-body pd-0">
                                                                              <div class="task-list-form">
                                                                              <ul>
                                                                              <li>
                                                                              <form role="form" action="" method="post">                                                                                                                                                
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Country</label>
                                                                              <div class="col-md-8">
                                                                              <input type="text" class="form-control" id="name" placeholder=" " name="countryc" value="' . $row2["country"] . ' ">
                                                                              </div>
                                                                              </div>                                                                       
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Province</label>
                                                                              <div class="col-md-8">
                                                                              <input type="text" class="form-control" id="name" placeholder=" " name="provincec" value="' . $row2["province"] . ' ">
                                                                              </div>
                                                                              </div>
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">City</label>
                                                                              <div class="col-md-8">
                                                                              <input class="form-control" type="text" placeholder=" " id="breed" name="cityc" value="' . $row2["city"] . '">
                                                                              </div>
                                                                              </div>
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">District</label>
                                                                              <div class="col-md-8">
                                                                              <input class="form-control" type="text" placeholder=" " id="size" name="districtc" value="' . $row2["district"] . '">
                                                                              </div>
                                                                              </div>
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Detail</label>
                                                                              <div class="col-md-8">
                                                                              <input class="form-control" type="text" placeholder=" " id="age" name="detailc" value="' . $row2["detail"] . '">
                                                                              </div>
                                                                              </div>                                         
                                                                              <div class="form-group row">
                                                                              <label class="col-md-4">Postal Code</label>
                                                                              <div class="col-md-8">
                                                                              <input class="form-control" type="text" placeholder=" " id="size" name="postal_codec" value="' . $row2["postal_code"] . '">
                                                                              </div>
                                                                              </div>
                                                                              <div class="d-flex">
                                                                              <label class="col-md-4">Default:</label>
                                                                              <select name="is_defaultc" id="de" class="form-control">
                                                                              <option value="0" ' . $se0 . '>No</option>
                                                                              <option value="1" ' . $se1 . '>Yes</option>
                                                                              </select>      
                                                                              </div>                                                                            
                                                                              <button type="submit" class="btn btn-primary" id="add" name="changea" value="' . $addressid . '"> Change </button>
                                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                              </form>
                                                                              </li>
                                                                              </ul>                                                               
                                                                              </div>     
                                                                              </div>                                         
                                                                              </div>                                   
                                                                              </div>';
                                                                echo "</div>";
                                                            }
                                                            ?>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Open Task End -->


                                        <!-- add address popup start -->
                                        <div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Address Add</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pd-0">
                                                        <div class="task-list-form">
                                                            <ul>
                                                                <li>
                                                                    <form role="form" action="" method="post">
                                                                        <label class="col-md-4">Default</label>
                                                                        <div class="d-flex">
                                                                            <div class="custom-control custom-radio mb-5 mr-20">
                                                                                <input type="radio" id="customRadio111" name="is_defaulta" class="custom-control-input" value="0">
                                                                                <label class="custom-control-label weight-400" for="customRadio111">No</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio mb-5">
                                                                                <input type="radio" id="customRadio121" name="is_defaulta" class="custom-control-input" value="1">
                                                                                <label class="custom-control-label weight-400" for="customRadio121">Yes</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Country</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder=" " id="country" name="countrya">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Province</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder=" " id="pro" name="provincea">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">City</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder=" " id="city" name="citya">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">District</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" placeholder=" " id="district" name="districta">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Detail</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" placeholder=" " id="detail" name="detaila">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Postal Code</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" placeholder=" " id="post" name="postal_codea">
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary" id="add1" name="add1" value="add1"> Add </button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Address Tab End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                mysqli_close($con);
                ?>
            </div>
        </div>
    </div>
    </div>
    <div class="footer-wrap pd-20 mb-20 card-box">
        Bowwow-CAN_302-Assignment2
    </div>
    </div>
    </div>
    <!-- js -->
    <script src="assets/js/core.js"></script>
    <script src="assets/js/script.min.js"></script>
        <script>
        window.addEventListener('DOMContentLoaded', function() {
            var image = document.getElementById('image');
            var cropBoxData;
            var canvasData;
            var cropper;

            $('#modal').on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    autoCropArea: 0.5,
                    dragMode: 'move',
                    aspectRatio: 3 / 3,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    ready: function() {
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    }
                });
            }).on('hidden.bs.modal', function() {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });
        });
    </script>
</body>

</html>
