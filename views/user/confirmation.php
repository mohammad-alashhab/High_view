<!-- Start Header Area -->
<?php require 'views/partials/header.php' ?>
<!-- End Header Area -->

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
        <!-- <h3 class="title_confirmation">Thank you. Your order has been received.</h3> -->
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
                                <span style="display: block; font-size: 14px;"><?php echo isset($_SESSION['subtotal']) ? $_SESSION['subtotal'] : 'N/A'; ?></span>
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
                                    <input type="text" id="street" name="street" value="<?php echo isset($users->street) ? htmlspecialchars($user->street) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <label for="city" style="display: block; font-weight: bold; margin-bottom: 5px;">City:</label>
                                    <input type="text" id="city" name="city" value="<?php echo isset($users->city) ? htmlspecialchars($user->city) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <label for="country" style="display: block; font-weight: bold; margin-bottom: 5px;">Country:</label>
                                    <input type="text" id="country" name="district" value="<?php echo isset($users->country) ? htmlspecialchars($user->country) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <label for="building" style="display: block; font-weight: bold; margin-bottom: 5px;">Building Number:</label>
                                    <input type="text" id="building" name="building_num" value="<?php echo isset($users->building_num) ? htmlspecialchars($user->building_num) : ''; ?>" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
                                </li>
                            </ul>
                            <button type="submit" style="width: 100%; padding: 10px; border-radius: 6px; border: none; background-color: #ffc107; color: #333; font-weight: bold; cursor: pointer;">Update Address</button>
                        </form>
                    </div>
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
                        <?php  foreach ($carts as $cart):?>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Sample product rows -->
                    <tr>
                        <td>
                            <p><?php echo $cart['name']?></p>
                        </td>
                        <td>
                            <h6>x <?php echo $cart['quantity'] ?></h6>
                        </td>
                        <td>
                            <p>$<?php echo number_format($cart['price'], 2) ?></p>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <!-- End Sample rows -->
                    <tr>
                        <td>
                            <h4>Total</h4>
                        </td>
                        <td>
                            <h5></h5>
                        </td>
                        <td>
                            <p><?php echo number_format($_SESSION['subtotal']) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Delivery</h4>
                        </td>
                        <td>
                            <h5>
                            </h5>
                        </td>
                        <td>
                            <p><?php if($_SESSION['subtotal'] > 50){
                                    echo "Free";
                                }else{
                                    echo '$5';
                                    $_SESSION['subtotal'] += 5;
                                }
                                ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Total</h4>
                        </td>
                        <td>
                            <h5></h5>
                        </td>
                        <td>
                            <p><?php echo $_SESSION['subtotal'] ?></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Confirmation and Cancellation Buttons -->
        <?php if (!empty($users['city']) && !empty($users['street']) && !empty($users['district']) && !empty($users['building_num'])) { ?>

        <div class="d-flex justify-content-end" style="margin-top: 20px;">

            <button type="button" class="btn" style="border: 2px solid #ffc107; border-radius: 6px; padding: 10px 20px; background: transparent; color: #ffc107; font-weight: bold; display: flex; align-items: center; transition: all 0.3s; margin-left: 20px;" onmouseover="this.style.background='#ffc107'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#ffc107';" onclick="confirmOrder();">
                <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i> Confirm Order
            </button>


            <button type="button" class="btn" style="border: 2px solid #dc3545; border-radius: 6px; padding: 10px 20px; background: transparent; color: #dc3545; font-weight: bold; display: flex; align-items: center; transition: all 0.3s;" onmouseover="this.style.background='#dc3545'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#dc3545';">
            <i class="fas fa-times-circle" style="margin-right: 8px;"></i> Cancel Order
        </button>
    </div>
<?php } else { ?>
            <div class="alert alert-danger" role="alert">
                Please fill in your address details in the form above.
            </div>

        <?php } ?>
    </div>
</section>
<!--================End Order Details Area =================-->

<!-- Start footer Area -->
<?php include("views/partials/footer.php"); ?>
<!-- End footer Area -->
