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
        <div class="cart_inner">
            <form action="/cart/update" method="post"> <!-- Update action to handle full cart update -->
                <div class="table-responsive">
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
                        // Check if user is logged in
                        if (isset($_SESSION['user'])) {
                            // Check if cart_items is empty
                            if (empty($cart_items)) {
                                echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                            } else {
                                $subtotal = 0; // Initialize subtotal
                                foreach ($cart_items as $item) {
                                    // Check if the product is visible
                                    if ($item['status'] == 'visible') {
                                        $totalPrice = $item['price'] * $item['quantity'];
                                        $discount = isset($_SESSION['discount']) ? $_SESSION['discount'] : 0; // Default to 0 if not set

                                        if ($discount > 0) {
                                            $discountAmount = $totalPrice * ($discount / 100);
                                            $subtotal += $totalPrice - $discountAmount;
                                        } else {
                                            $subtotal += $totalPrice;
                                        }
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
                                                <h5>$<?php echo number_format($item['price'], 2); ?></h5>
                                            </td>
                                            <td>
                                                <div class="product_count">
                                                    <input type="number" name="qty[<?php echo $item['product_id']; ?>]" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1">
                                                    <button type="button" onclick="var result = this.parentNode.querySelector('input'); var sst = result.value; if( !isNaN( sst )) result.value++; return false;" class="increase items-count"><i class="fas fa-plus"></i></button>
                                                    <button type="button" onclick="var result = this.parentNode.querySelector('input'); var sst = result.value; if( !isNaN( sst ) && sst > 1 ) result.value--; return false;" class="reduced items-count"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>$<?php echo number_format($totalPrice, 2); ?></h5>
                                            </td>
                                            <td>
                                                <form method="post" action="/user/delete" id="deleteForm_<?php echo $item['id']; ?>">
                                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                                    <button type="button" class="btn btn-outline-danger deleteBtn" data-id="<?php echo $item['id']; ?>">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            $_SESSION['subtotal'] = $subtotal;
                        ?>
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>$<?php echo number_format($subtotal, 2); ?></h5>
                            </td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                <button type="submit" class="gray_btn"><i class="fas fa-sync-alt"></i> Update Cart</button>
                            </td>
                            <td colspan="2"></td>
                            <td>
                                <form action="/cart/coupon" method="post">
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" name="coupon_code" placeholder="Coupon Code">
                                        <button type="submit" class="primary-btn">Apply</button>
                                        <button type="submit" class="primary-btn" name="action" value="close_coupon"><i class="fas fa-times"></i> Close Coupon</button>
                                    </div>
                                </form>

                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td colspan="3" style="width:950px">&nbsp;</td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="primary-btn" href="/category">Continue Shopping</a>
                                    <?php if(!empty($cart_items)){ ?>
                                    <a class="primary-btn" href="/confirmation">Checkout</a>
                                    <?php }?>
                                </div>
                            </td>
                        </tr>
                        <?php   } else {
                            echo "<tr><td colspan='5' class='text-center'>Please log in first to view the content of your cart.</td></tr>";
                        } ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

<!-- start footer Area -->
<?php include("views/partials/footer.php"); ?>
