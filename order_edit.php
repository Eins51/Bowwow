<?php
include("include/config.php");

// Fetch order data
$id = $_GET["id"];
$query = "SELECT o.*, a.detail, a.district, a.city, a.province, a.country, a.postal_code FROM `order` o JOIN `address` a ON o.address_id = a.id WHERE o.id = ".$id;
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result)) {
    $orderData = $result->fetch_assoc();
} else {
    echo "0 results";
}

$query_product = "SELECT p.*, od.item_num FROM `order_detail` od JOIN `product` p ON od.item_id = p.id WHERE od.order_id = ".$id;
$result_product = mysqli_query($con, $query_product);
$products = [];
if (mysqli_num_rows($result_product)) {
    while ($row = mysqli_fetch_assoc($result_product)) {
        $products[] = $row;
    }
}
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
    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>CAN302 Store Admin| Order Edit</title>
</head>
<body>
    <?php include 'include/sidebar.php'; ?>

    <!-- 主内容 -->
    <div class="content" id="content">
        <h1 style="text-transform:capitalize;">Order Management/Order Detail</h1>
        <h2 style="font-style: italic;">Basic information</h2>
        </div>
            <div style="margin-left: 20px;">
                <div class="mdui-col-xs-6" style="font-weight: 400;">Order ID:
                    <input id="order_id" type="text" value="<?php echo $orderData['id']; ?>" readonly class="readonly">
                </div>
                <div class="mdui-col-xs-6" style="margin-top: -10px;">Status:
                    <select id="status" class="mdui-select" disabled>
                        <option value="1" <?php echo $orderData['status'] == 1 ? 'selected' : ''; ?>>unpaid</option>
                        <option value="2" <?php echo $orderData['status'] == 2 ? 'selected' : ''; ?>>unshipped</option>
                        <option value="3" <?php echo $orderData['status'] == 3 ? 'selected' : ''; ?>>shipped</option>
                        <option value="4" <?php echo $orderData['status'] == 4 ? 'selected' : ''; ?>>completed</option>
                        <option value="5" <?php echo $orderData['status'] == 5 ? 'selected' : ''; ?>>canceled</option>
                    </select>
                </div>
                <div class="mdui-col-xs-6" style="margin-top: 20px;">Created Time:
                    <input id="user_name" type="text" value="<?php echo $orderData['create_time']; ?>" readonly class="readonly">
                </div>    
                <div class="mdui-col-xs-6" style="margin-top: 20px;">Paid Time:
                    <input id="paid_time" type="text" value="<?php echo $orderData['pay_time']; ?>" readonly class="readonly">
                </div> 
            </div>

            <div class="clear" ></div> 

            <h3 style="font-style: italic; font-size: 1.5em; margin-left: 20px;">Logistics information</h3>
            <div style="margin-left: 20px;">
                <div class="mdui-col-xs-6" style="font-weight: 400;">Delivery Time:
                    <input id="delivery_time" type="text" value="<?php echo $orderData['delivery_time']; ?>" readonly class="readonly">
                </div>
                <div class="mdui-col-xs-6" style="font-weight: 400;">Shipped Time:
                    <input id="shipped_time" type="text" value="<?php echo $orderData['shipped_time']; ?>" readonly class="readonly">
                </div>
                <div class="mdui-col-xs-6" style="margin-top: 20px;">Completed Time:
                    <input id="completed_time" type="text" value="<?php echo $orderData['completed_time']; ?>" readonly class="readonly">
                </div>
                <div class="mdui-col-xs-6" style="margin-top: 20px; display: flex; flex-direction: column;">
                    <div>
                        <span style="font-weight: 400;">Shipping Address:</span>
                    </div>
                    <div>
                        <textarea id="address" rows="3" readonly class="readonly" style="width: 60%; resize: none;"><?php echo $orderData['detail'] . ', ' . $orderData['district'] . ', ' . $orderData['city'] . ', ' . $orderData['province'] . ', ' . $orderData['country'] . ', ' . $orderData['postal_code']; ?></textarea>
                    </div>
                </div>
                
            </div>

            <div class="clear" ></div> 
            
            <h4 style="font-style: italic; font-size: 1.5em; margin-left: 20px;">Products information</h4>
            <div style="margin-left: 20px;">
                <div class="mdui-col-xs-6" style="font-weight: 400;">Total Amount:
                <input id="total_amount" type="text" value="<?php echo $orderData['amount']; ?>" readonly class="readonly">
            </div>

            <div class="mdui-col-xs-6" style="font-weight: 400;">Payment Method:
                <select id="payment_method" class="mdui-select" disabled>
                    <option value="0" <?php echo $orderData['payment'] == 0 ? 'selected' : ''; ?>>PayPal</option>
                    <option value="1" <?php echo $orderData['payment'] == 1 ? 'selected' : ''; ?>>Credit card</option>
                    <option value="2" <?php echo $orderData['payment'] == 2 ? 'selected' : ''; ?>>Alipay</option>
                </select>
            </div>
            
            <div class="clear" ></div> 

                <div class="purchasenumber" >
                            <div class="mdui-col-xs-3" style="margin-top: 20px;">Products within the order:</div>
                            <table class="table table_list table_striped table-bordered center" id="sample-table">
                                <!-- <tr>
                                    <th width="25%">Product</th>
                                    <th width="15%">Price</th>
                                    <th width="10%">Quantity</th>
                                </tr> -->
                                <?php

                                // foreach ($products as $product) {
                                //     echo "<table class='table table_list table_striped table-bordered center'>";
                                //     echo "<tr>";
                                //     echo '<td width="25%">' . $product['name'] . '</td>';
                                //     echo '<td width="15%">' . "$" . $product['price'] . '</td>';
                                //     echo '<td width="10%">' . $product['item_num'] . '</td>';
                                //     echo "</tr>";
                                //     echo "</table>";
                                // }

                            
                                // while($product=$result->fetch_assoc()){
                                // echo "<table class='table table_list table_striped table-bordered center'>";
                                // echo "<tr>";
                                // echo '<td width="5%">'.'<label>'.'<input type="checkbox" class="ace"><span class="lbl">'.'</span>'.'</label>'.'</td>';
                                // echo '<td width="10%"><img src="./images/product_img/'.$product['id'].'.jpg"alt="'.$product['image_path'].'"width="100px"height="100px"></td>';
                                // echo '<td width="15%">'.$product['name'].'</td>';
                                // echo '<td width="15%">'."$".$product['price'].'</td>';
                                // echo '<td width="10%">'.$product['quantity'].'</td>';    
                                // echo "</tr>";
                                // echo "</table>";
                                // }
                                ?>

                            </table>
                            </div>
                            <!--价格与库存-->
                        </div>
                        <div class="clear" ></div> 
                        <div>
                        <button id="edit" class="mdui-btn mdui-color-blue-accent mdui-ripple" style="margin: 20px 20px 20px 20px;">Edit</button>
                        <button id="save" class="mdui-btn mdui-color-blue-accent mdui-ripple" style="margin: 20px 20px 20px 20px;" disabled> Save </button>  
                        <button id="cancel" class="mdui-btn mdui-color-red-accent mdui-ripple" style="margin: 20px 20px 20px 20px;" disabled>Cancel</button>  
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
        .clear{
            clear:both
        }
        .readonly {
            background-color: #f1f1f1;
        }
    </style>

    <script>
        $(document).ready(function() {
            var originalValues = {
                orderId: $('#order_id').val(),
                userName: $('#user_name').val(),
                paidTime: $('#paid_time').val(),
                status: $('#status').val(),
                deliveryTime: $('#delivery_time').val(),
                shippedTime: $('#shipped_time').val(),
                address: $('#address').val(),
                completedTime: $('#completed_time').val(),
                totalAmount: $('#total_amount').val(),
                paymentMethod: $('#payment_method').val()
            };

            $('#edit').click(function() {
                $('input[type="text"]').prop('readonly', false).removeClass('readonly');
                $('#status').prop('disabled', false);
                $('#payment_method').prop('disabled', false);
                $('#edit').prop('disabled', true);
                $('#save').prop('disabled', false);
                $('#cancel').prop('disabled', false);
                $('#address').prop('readonly', false).removeClass('readonly');
            });

            $('#cancel').click(function() {
                // Restore the original values
                $('#order_id').val(originalValues.orderId);
                $('#user_name').val(originalValues.userName);
                $('#paid_time').val(originalValues.paidTime);
                $('#status').val(originalValues.status);
                $('#delivery_time').val(originalValues.deliveryTime);
                $('#shipped_time').val(originalValues.shippedTime);
                $('#address').val(originalValues.address);
                $('#completed_time').val(originalValues.completedTime);
                $('#total_amount').val(originalValues.totalAmount);
                $('#payment_method').val(originalValues.paymentMethod);

                // Make the input fields read-only again and disable the save and cancel buttons
                $('input[type="text"]').prop('readonly', true).addClass('readonly');
                $('#status').prop('disabled', true);
                $('#payment_method').prop('disabled', true);
                $('#edit').prop('disabled', false);
                $('#save').prop('disabled', true);
                $('#cancel').prop('disabled', true);
                $('#address').prop('readonly', true).addClass('readonly');
            });

            $('#save').click(function() {
                // Save the updated data to the database
                var orderId = $('#order_id').val();
                var userName = $('#user_name').val();
                var paidTime = $('#paid_time').val();
                var status = $('#status').val();
                var deliveryTime = $('#delivery_time').val();
                var shippedTime = $('#shipped_time').val();
                var address = $('#address').val();
                var completedTime = $('#completed_time').val();
                var totalAmount = $('#total_amount').val();
                var paymentMethod = $('#payment_method').val();

                $.ajax({
                    type: "POST",
                    url: "save_order.php",
                    data: {
                        id: orderId,
                        user_name: userName,
                        paid_time: paidTime,
                        status: status,
                        delivery_time: deliveryTime,
                        shipped_time: shippedTime,
                        address: address,
                        completed_time: completedTime,
                        total_amount: totalAmount,
                        payment_method: paymentMethod
                    },
                    success: function(response) {
                        if (response == "success") {
                            mdui.alert('Order details updated successfully!');
                        } else {
                            mdui.alert('Failed to update order details. Please try again.');
                        }
                    }
                });

                // Make the input fields read-only again and disable the save and cancel buttons
                $('input[type="text"]').prop('readonly', true);
                $('#status').prop('disabled', true);
                $('#edit').prop('disabled', false);
                $('#save').prop('disabled', true);
                $('#cancel').prop('disabled', true);
            });
        });
    </script>
</html>


