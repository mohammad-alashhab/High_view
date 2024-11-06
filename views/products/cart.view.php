<?php include("views/partials/header.php"); ?>
<!-- End Header Area -->

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shopping Cart</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="/cart">Cart</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Cart Table -->
        <div class="cart_inner">
            <div class="table-responsive">
                <form method="post" action="/cart/update" id="cartForm"> <!-- Form Wrap -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_SESSION['user'])) {
                            if (empty($cart_items)) {
                                echo "<tr><td colspan='5'>Your cart is empty. <a href='/category'>Continue Shopping</a></td></tr>";
                            } else {
                                $subtotal = 0;
                                $discount = $_SESSION['discount'] ?? 0;
                                $totalDiscountAmount = 0;

                                // Loop through cart items
                                foreach ($cart_items as $item) {
                                    if ($item['status'] == 'visible') {
                                        $totalPrice = $item['price'] * $item['quantity'];
                                        $subtotal += $totalPrice;
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img src="../views/public/images/product/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="50">
                                                    </div>
                                                    <div class="media-body">
                                                        <p><?php echo htmlspecialchars($item['name']); ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>JOD<?php echo number_format($item['price'], 2); ?></h5>
                                            </td>

                                            <td>
                                                <div class="product_count">
                                                    <!-- Add name attribute to pass quantities properly -->
                                                    <input type="number" name="qty[<?php echo $item['product_id']; ?>]" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1" aria-label="Quantity for <?php echo htmlspecialchars($item['name']); ?>">
                                                    <button type="button" onclick="incrementQuantity(this)" class="increase items-count" aria-label="Increase Quantity"><i class="fas fa-plus"></i></button>
                                                    <button type="button" onclick="decrementQuantity(this)" class="reduced items-count" aria-label="Decrease Quantity"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>JOD<?php echo number_format($totalPrice, 2); ?></h5>
                                            </td>
                                            <td>
                                                <form method="post" action="/cart/delete/<?php echo $item['id']; ?>" id="cancelOrderForm">
                                                    <button type="button" class="btn btn-outline-danger cancel-order-btn" data-id="<?php echo $item['id']; ?>">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }

                                if ($discount > 0) {
                                    $totalDiscountAmount = $subtotal * ($discount / 100);
                                }

                                $finalTotal = $subtotal - $totalDiscountAmount;
                                $_SESSION['subtotal'] = $subtotal;
                                $_SESSION['discount_total'] = $finalTotal;
                                ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>
                                        <h5>Total</h5>
                                    </td>
                                    <td>
                                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                            <?php if ($totalDiscountAmount > 0) { ?>
                                                <span style="font-size: 1rem; color: #999; text-decoration: line-through;">
                                                JOD <?php echo number_format($subtotal, 2); ?>
                                            </span>
                                                <span style="font-size: 1.2rem; font-weight: bold;" class="text-warning">
                                                JOD <?php echo number_format($finalTotal, 2); ?>
                                            </span>
                                                <span style="font-size: 0.9rem; color: #4CAF50; font-weight: 600; margin-top: 5px;">
                                                You save JOD <?php echo number_format($totalDiscountAmount, 2); ?>!
                                            </span>
                                            <?php } else { ?>
                                                <span style="font-size: 1.2rem; font-weight: bold;">
                                                JOD <?php echo number_format($subtotal, 2); ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bottom_button">
                                    <td colspan="2"></td>
                                    <td>
                                        <button type="submit" class="btn btn-outline-secondary update-cart-btn " id="updateCartButton">
                                            <i class="fas fa-sync-alt"></i> Update Cart
                                        </button>

                                    </td>
                                    <td colspan="2">
                                        <form action="/cart/coupon" method="post">

                                                <div>
                                                    <input type="text" name="coupon_code" placeholder="Coupon Code" style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ddd; width: 250px; margin-right: 10px;">
                                                    <button type="submit" class="primary-btn" style="padding: 10px 15px; font-size: 14px; border-radius: 5px; background-color: #4CAF50; color: #fff; border: none; cursor: pointer; transition: background-color 0.3s; margin-right: 10px;">Apply</button>
                                                    <button type="submit" class="primary-btn" name="action" value="close_coupon" style="padding: 10px 15px; font-size: 14px; border-radius: 5px; background-color: #f44336; color: #fff; border: none; cursor: pointer; transition: background-color 0.3s;">
                                                        <i class="fas fa-times" style="margin-right: 5px;"></i> Close Coupon
                                                    </button>

                                            </div>
                                        </form>

                                    </td>
                                </tr>
                                <tr class="out_button_area">
                                    <td colspan="3" style="width:950px">&nbsp;</td>
                                    <td>
                                        <div class="checkout_btn_inner d-flex align-items-center">
                                            <a class="primary-btn" href="/category">Continue Shopping</a>
                                            <?php if (!empty($cart_items)) { ?>
                                                <a class="primary-btn" href="/confirmation">Checkout</a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Please log in first to view the content of your cart.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

    </div>
</section>
<!--================End Cart Area =================-->

<!-- start footer Area -->
<?php include("views/partials/footer.php"); ?>
