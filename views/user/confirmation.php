<!-- Start Header Area -->
<?php require 'views/partials/header.php'; ?>
<!-- End Header Area -->

<?php
if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
    $status = $_SESSION['status']; // success or error
    $message = $_SESSION['message']; // the message content
    echo "<div class='alert alert-$status'>$message</div>"; // Display the message
    unset($_SESSION['status'], $_SESSION['message']); // Clear the message after displaying
}
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Confirmation</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="/confirmation">Confirmation</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Order Details Area =================-->
<section class="order_details section_gap">
    <div class="container">
        <div class="row order_d_inner">
            <!-- Order Info -->
            <div class="col-lg-4" style="padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="details_item">
                    <h4 style="font-size: 18px; margin-bottom: 15px; font-weight: bold;">Order Info</h4>
                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 10px;">
                            <span style="display: block; font-weight: bold;">Order number:</span>
                            <span style="display: block; font-size: 14px;">00<?php echo $orders + 1; ?></span>
                        </li>
                        <li style="margin-bottom: 10px;">
                            <span style="display: block; font-weight: bold;">Date:</span>
                            <span style="display: block; font-size: 14px;"><?php echo date("Y/m/d"); ?></span>
                        </li>
                        <li style="margin-bottom: 10px;">
                            <span style="display: block; font-weight: bold;">Total:</span>
                            <span style="display: block; font-size: 14px;"><?php echo isset($_SESSION['discount_total']) ? $_SESSION['discount_total'] : 'N/A'; ?></span>
                        </li>
                        <li>
                            <span style="display: block; font-weight: bold;">Payment method:</span>
                            <span style="display: block; font-size: 14px;">Cash On Delivery</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="col-lg-4" style="padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="details_item">
                    <h4 style="font-size: 18px; margin-bottom: 15px; font-weight: bold;">Customer Info</h4>
                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 10px;">
                            <span style="display: block; font-weight: bold;">Name:</span>
                            <span style="display: block; font-size: 14px;"><?php echo $users['first_name'] . ' ' . $users['last_name']; ?></span>
                        </li>
                        <li style="margin-bottom: 10px;">
                            <span style="display: block; font-weight: bold;">Email:</span>
                            <span style="display: block; font-size: 14px;"><?php echo $users['email']; ?></span>
                        </li>
                        <li>
                            <span style="display: block; font-weight: bold;">Phone:</span>
                            <span style="display: block; font-size: 14px;"><?php echo $users['phone']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Delivery Address Form -->
            <div class="col-lg-4" style="padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="details_item">
                    <h4 style="font-size: 18px; margin-bottom: 15px; font-weight: bold;">Delivery Address</h4>
                    <form action="/confirmation/edit" method="POST" style="font-size: 14px;">
                        <ul style="list-style-type: none; padding: 0;">
                            <li style="margin-bottom: 10px;">
                                <label for="street" style="display: block; font-weight: bold; margin-bottom: 5px;">Street:</label>
                                <input type="text" id="street" name="street" value="<?php echo isset($_SESSION['input']['street']) ? htmlspecialchars($_SESSION['input']['street']) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                            </li>
                            <li style="margin-bottom: 10px;">
                                <label for="city" style="display: block; font-weight: bold; margin-bottom: 5px;">City:</label>
                                <input type="text" id="city" name="city" value="<?php echo isset($_SESSION['input']['city']) ? htmlspecialchars($_SESSION['input']['city']) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                            </li>
                            <li style="margin-bottom: 10px;">
                                <label for="country" style="display: block; font-weight: bold; margin-bottom: 5px;">Country:</label>
                                <input type="text" id="country" name="country" value="<?php echo isset($_SESSION['input']['district']) ? htmlspecialchars($_SESSION['input']['district']) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                            </li>
                            <li style="margin-bottom: 10px;">
                                <label for="building" style="display: block; font-weight: bold; margin-bottom: 5px;">Building Number:</label>
                                <input type="text" id="building" name="building_num" value="<?php echo isset($_SESSION['input']['building_num']) ? htmlspecialchars($_SESSION['input']['building_num']) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                            </li>
                        </ul>

                        <!-- Submit button -->
                        <button type="submit" style="width: 100%; padding: 12px; border-radius: 6px; border: none; background-color: #ffc107; color: #333; font-weight: bold; cursor: pointer;">
                            Update Address
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="order_details_table">
            <h2>Order Details</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($carts as $cart): ?>
                        <tr>
                            <td><p><?php echo $cart['name']; ?></p></td>
                            <td><h6>x <?php echo $cart['quantity'];
                            $quantity=$cart['quantity'] ;?></h6></td>
                            <td><p>JOD<?php echo number_format($cart['price'], 2);
                            $total=number_format($cart['price'], 2);?></p></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><h4>Total</h4></td>
                        <td></td>
                        <td><p><?php echo number_format($_SESSION['discount_total'], 2); ?></p></td>
                    </tr>
                    <tr>
                        <td><h4>Delivery</h4></td>
                        <td></td>
                        <td>
                            <p>
                                <?php
                                if ($_SESSION['discount_total']) {
                                    echo "Free";
                                } else {
                                    echo 'JOD5';
                                    $_SESSION['discount_total'] += 5;
                                }
                                ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><h4>Grand Total</h4></td>
                        <td></td>
                        <td><p><?php echo number_format($_SESSION['discount_total'], 2); ?></p></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Confirmation and Cancellation buttons -->

        <!-- Confirm Order Button -->
        <form action="/saveOrder" method="post">
            <input type="hidden" name="product_id" value="">
        <button type="submit" name="submit"
                style="width: 100%; padding: 8px; margin-top: 10px; border-radius: 4px;
               border: 2px solid #ffc107; background-color: transparent; color: #ffc107;
               font-weight: bold; font-size: 14px; cursor: pointer; transition: background-color 0.3s, color 0.3s;"
                onmouseover="this.style.backgroundColor='#ffc107'; this.style.color='#fff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#ffc107';">


            <i class="fas fa-check"></i> Confirm Order
        </button>
        </form>


        <!-- Cancel Order Button -->
        <button onclick="cancelOrder()"
                style="width: 100%; padding: 8px; margin-top: 10px; border-radius: 4px;
               border: none; background-color: #dc3545; color: #fff;
               font-weight: bold; font-size: 14px; cursor: pointer;">
            <i class="fas fa-times"></i> Cancel Order
        </button>



    </div>
</section>
<?php if (isset($_SESSION['orderDetails'])): ?>
    <div id="orderModal" class="modal" style="display: block;">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2 style="color: #4CAF50; font-size: 1.5em; text-align: center; margin-bottom: 15px;">Thank You for Your Purchase!</h2>
            <p style="color: #FFBA01; font-weight: bold; text-align: center;">Your order has been confirmed.</p>
            <div style="margin-top: 20px;">
                <p><strong>Order ID:</strong> <span style="color: #3498db;"><?= $_SESSION['orderDetails']['order_id'] ?></span></p>
                <p><strong>Total:</strong> <span style="color: #3498db;">$<?= number_format($_SESSION['orderDetails']['total'], 2) ?></span></p>
                <p><strong>Shipping Address:</strong> <?= $_SESSION['orderDetails']['shipping_address'] ?></p>
            </div>

            <button onclick="closeModal()" style="background-color: #3498db; color: white; border: none; padding: 10px 20px; cursor: pointer; font-size: 1em; margin-top: 20px; display: block; width: 100%;">Close</button>
        </div>
    </div>

    <?php unset($_SESSION['orderDetails']); ?>
<?php endif; ?>

<style>
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); }
    .modal-content { background-color: #fff; margin: 15% auto; padding: 20px; width: 80%; max-width: 500px; }
    .close-button { float: right; cursor: pointer; }
</style>
<!--================End Order Details Area =================-->
<?php require 'views/partials/footer.php'; ?>
<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 1000;
    }
    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 25px;
        width: 80%;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    .close-button {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 1.5em;
        color: #333;
        cursor: pointer;
    }
    .close-button:hover {
        color: #FF5722;
    }
</style>

<script>
    function closeModal() {
        document.getElementById('orderModal').style.display = 'none';
        window.location.href = '/cart'; // Redirect to cart page after closing modal
    }

    window.onload = function() {
        const modal = document.getElementById('orderModal');
        if (modal) {
            modal.style.display = 'block';

        }

    };
</script>