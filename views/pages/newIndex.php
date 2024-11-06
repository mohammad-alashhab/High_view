<?php
require('views/partials/header.php');
?>

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1 class="h3">User Profile</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/" class="text-sm">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/user" class="text-sm">Your profile</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
<div class="container bootstrap snippet mt-5">




    <div class="row">

        <div class="col-sm-3"><!--left col-->


            <div class="text-center">
                <img src="../views/public/images/users/<?php echo $users['img'] ?>" class=" img-circle img-thumbnail" alt="avatar" style="border-radius: 50%" width="200px">
                <div class="col-sm-10 mt-1"><h3> <?php echo $users['first_name'] ." ". $users['last_name']  ?></h3></div>

            </div>
            <hr><br>







        </div><!--/col-3-->
        <div class="col-sm-9">

                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#ffba00">Profile</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="color:#ffba00">Order History</button>
                    <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false" style="color:#ffba00">Reviews History</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="color:#ffba00">Contact History</button>

                </div>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo htmlspecialchars($users['first_name'] . " " . $users['last_name']); ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo htmlspecialchars($users['email']); ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo htmlspecialchars($users['phone']); ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo htmlspecialchars($users['city'] . ", " . $users['district'] . ", " . $users['street'] . ", " . $users['building_num']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-warning btn-custom mb-3" onclick="appear()">Edit Your Profile</button>
                        </div>


                        <form method="post" action="/user/edit" enctype="multipart/form-data">
                            <div class="card col-lg-12 mb-3" style="display:none;border: none" id="edit">
                                <div class="card-body">
                                    <div class="row gutters">
                                        <div class="col-xl-12">
                                            <h6 class="mb-2 text-warning">Personal Details</h6>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="firstName">First Name</label>
                                                <input type="text" class="form-control" name="firstName" placeholder="Enter first name" value="<?php echo htmlspecialchars($users['first_name']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" class="form-control" name="lastName" placeholder="Enter last name" value="<?php echo htmlspecialchars($users['last_name']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter email ID" value="<?php echo htmlspecialchars($users['email']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="newPassword">New Password (leave blank to keep current password)</label>
                                                <input type="password" class="form-control" name="newPassword" placeholder="Enter new password">
                                            </div>
                                        </div>


                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" name="phone" placeholder="Enter phone number" value="<?php echo htmlspecialchars($users['phone']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="image">Upload Image (Optional)</label>
                                                <input type="file" class="form-control" name="image" accept="image/*">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row gutters">
                                        <div class="col-xl-12">
                                            <h6 class="mt-3 mb-2 text-warning">Address</h6>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" name="city" placeholder="Enter City" value="<?php echo htmlspecialchars($users['city']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="district">District</label>
                                                <input type="text" class="form-control" name="district" placeholder="Enter district" value="<?php echo htmlspecialchars($users['district']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="street">Street</label>
                                                <input type="text" class="form-control" name="street" placeholder="Enter Street" value="<?php echo htmlspecialchars($users['street']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="buildingNumber">Building Number</label>
                                                <input type="text" class="form-control" name="b_number" placeholder="Building number" value="<?php echo htmlspecialchars($users['building_num']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gutters">
                                        <div class="col-xl-12">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-secondary" onclick="hide()">Cancel</button>
                                                <button type="submit" id="submitBtn" class="btn btn-warning">Update</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div></div>
                <div class="tab-pane fade mt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> <h5>Purchase History</h5>
                    <hr>


                    <div class="container py-5 ">
                        <h2 class="mb-4 fw-bold ">Order History</h2>
                        <!--        this is the start of teh cards -->
                        <div class="container mb-4 container-order">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="card card-order total-orders-card" style="width: 100%; height:220px">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-order text-warning" >
                                                <i class="fas fa-list"></i> Total Orders
                                            </h5>
                                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Total orders in the system</h6>
                                            <p class="card-text card-text-order">Displays the total number of orders placed.</p>
                                            <h5 class="card-title card-title-order"><?= $totalOrders ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card card-order delivered-orders-card" style="width: 100%;height:220px">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-order text-warning">
                                                <i class="fas fa-truck"></i> Delivered Orders
                                            </h5>
                                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders that have been delivered</h6>
                                            <p class="card-text card-text-order">Displays the number of orders that have been successfully delivered.</p>
                                            <h5 class="card-title card-title-order"><?=  $deliveredOrders ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card card-order pending-orders-card" style="width: 100%;height:220px">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-order text-warning">
                                                <i class="fas fa-clock"></i> Pending Orders
                                            </h5>
                                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders awaiting confirmation</h6>
                                            <p class="card-text card-text-order">Displays the number of orders that are still pending.</p>
                                            <h5 class="card-title card-title-order"><?= $pendingOrders?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card card-order processing-orders-card" style="width: 100%;height:220px">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-order text-warning">
                                                <i class="fas fa-cog"></i> Processing Orders
                                            </h5>
                                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders currently being processed</h6>
                                            <p class="card-text card-text-order">Displays the number of orders currently being processed.</p>
                                            <h5 class="card-title card-title-order"><?= $processingOrders?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card card-order shipped-orders-card" style="width: 100%;height:220px">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-order text-warning">
                                                <i class="fas fa-shipping-fast"></i> Shipped Orders
                                            </h5>
                                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders that have been shipped</h6>
                                            <p class="card-text card-text-order">Displays the number of orders that have been shipped.</p>
                                            <h5 class="card-title card-title-order"><?=  $shippedOrders?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card card-order canceled-orders-card" style="width: 100%;height:220px">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-order text-warning">
                                                <i class="fas fa-ban"></i> Canceled Orders
                                            </h5>
                                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders that were canceled</h6>
                                            <p class="card-text card-text-order">Displays the number of orders that have been canceled.</p>
                                            <h5 class="card-title card-title-order"><?=  $cancelledOrders ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="row mb-4 g-3 ">


                            <div class="col-md-6 text-md-end">
                                <form method="GET" action="/user#nav-profile">
                                    <select class=" w-auto shadow-sm" name="status" onchange="this.form.submit()">
                                        <option value="" <?= !isset($_GET['status']) ? 'selected' : '' ?>>All Orders</option>
                                        <option value="Delivered" <?= isset($_GET['status']) && $_GET['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                        <option value="Pending" <?= isset($_GET['status']) && $_GET['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="Processing" <?= isset($_GET['status']) && $_GET['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                        <option value="Shipped" <?= isset($_GET['status']) && $_GET['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                        <option value="Cancelled" <?= isset($_GET['status']) && $_GET['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                </form>
                            </div>
                        </div>


                        <!--*********************************this is the start of the order list ***************************-->
                        <!-- Inside the order-list section -->
                        <div class="order-list">
                            <?php foreach ($formattedOrderData as $order): ?>
                                <div class="card mb-4 order-item shadow-sm" tabindex="0">
                                    <div class="card-body">
                                        <!-- Order Header -->
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-3">
                                                <h6 class="mb-0 fw-bold">#ORD-2023-00<?= htmlspecialchars($order['order_id']) ?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <?php if ($order['order_status'] == 'Delivered') { ?>
                                                    <span class="badge bg-success rounded-pill" style="color: white"><?= htmlspecialchars($order['order_status']) ?></span>
                                                <?php } elseif ($order['order_status'] == 'Pending') { ?>
                                                    <span class="badge bg-secondary rounded-pill" style="color: white"><?= htmlspecialchars($order['order_status']) ?></span>
                                                <?php } elseif ($order['order_status'] == 'Processing') { ?>
                                                    <span class="badge bg-warning rounded-pill" style="color: white"><?= htmlspecialchars($order['order_status']) ?></span>
                                                <?php } elseif ($order['order_status'] == 'Shipped') { ?>
                                                    <span class="badge bg-primary rounded-pill" style="color: white"><?= htmlspecialchars($order['order_status']) ?></span>
                                                <?php } else { ?>
                                                    <span class="badge bg-danger rounded-pill" style="color: white"><?= htmlspecialchars($order['order_status']) ?></span>
                                                <?php } ?>

                                                <p class="mb-0 mt-1 fw-bold">$<?= number_format($order['order_total'], 2) ?></p>
                                            </div>
                                            <div class="row align-items-center border-bottom py-3">
                                                <div class="col-md-7 text-start">
                                                    <h6 class="mb-1 fw-bold text-uppercase">Delivery Address</h6>
                                                    <small class="text-muted" style="white-space: nowrap;">
                                                        Shipped to <?= htmlspecialchars($order['shipping_address']) ?>
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Ordered Items List -->
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="mb-3 fw-bold">Ordered Items:</h6>
                                                <div class="ordered-items">
                                                    <?php if (!empty($order['items'])): // Check if items array is set and not empty ?>
                                                        <?php foreach ($order['items'] as $item): ?>
                                                            <div class="row align-items-center mb-3">
                                                                <div class="col-md-2">
                                                                    <img src="../../views/public/images/product/<?= htmlspecialchars($item['front_view']) ?>"
                                                                         alt="<?= htmlspecialchars($item['product_name']) ?>"
                                                                         class="img-fluid rounded product-thumbnail shadow-sm">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p class="mb-0 fw-semibold"><?= htmlspecialchars($item['product_name']) ?></p>
                                                                    <small class="text-muted">Quantity: <?= htmlspecialchars($item['quantity']) ?> × $<?= number_format($item['product_price'], 2) ?></small>
                                                                </div>
                                                                <div class="col-md-3 text-md-end">
                                                                    <p class="mb-0 fw-bold">$<?= number_format($item['order_item_total'], 2) ?></p>
                                                                </div>
                                                                <div class="col-md-3 text-md-end">
                                                                    <button class="btn btn-outline-warning btn-sm rounded-pill shadow-sm">
                                                                        <i class="bi bi-arrow-repeat me-1"></i> Purchase Again
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <p class="text-muted">No items in this order.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>




                    </div></div>
                <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">

                    <h5 class="mt-4 ">Reviews History</h5>
                    <hr>

                    <div class="row">
                        <div class="container">
                            <div class="col-md-12">

                                <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                                    <h5 class="mb-1">All Ratings and Reviews</h5>
                                    <?php foreach ($reviews as $review): ?>
                                    <div class="reviews-members pt-2 pb-2">

                                        <div class="media">

                                                <a href="#">
                                                    <img alt="Generic placeholder image"
                                                         src="../../views/public/images/product/<?php echo $review['front_view'] ?>"
                                                         class="mr-3 rounded-pill"
                                                         style="width: 150px; height: 150px; object-fit: cover;">
                                                </a>
                                                <div class="media-body">
                                                    <div class="reviews-members-header">


                                                        <h6 class="mb-1"><a style="color: #0b0b0b" href="#"><?php echo $review['name'] ?></a></h6>
                                                        <p class="text-gray"><?php echo $review['created_at'] ?></p>
                                                    </div>
                                                    <div class="reviews-members-body">
                                                        <p class="fw-light">Your Rating : <?php echo $review['rate'] ?> stars</p>
                                                        <p><?php echo $review['review'] ?> </p>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <h5>Recent Messages</h5>
                    <hr>

                    <div class="row">
                        <section style="background-color: #FEFEFC;">

                            <div class="container mb-5">
                                <div class="card text-body mb-4" style="width: 1000px; margin: 0 auto;"> <!-- Added mb-4 for spacing -->
                                    <div class="card-body p-4">
                                        <h3 class="mb-0">Recent Messages</h3>
                                        <p class="fw-light">Latest messages by YOU</p>
                                        <hr class="mb-3">
                                        <?php foreach ($contacts as $contact) : ?>


                                            <h6 class="fw-bold mb-1"><?php echo $contact['message']; ?></h6>


                                            <p>
                                                <?php
                                                if ($contact['status'] == 'replied') {
                                                    echo " <span class='badge bg-primary'>".$contact['status']."</span>";
                                                    echo $contact['reply'];
                                                } else {
                                                    echo " <span class='badge bg-danger'>".$contact['status']."</span>";
                                                }
                                                ?>

                                            </p>

<hr>
                                        <?php endforeach; ?>

                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>



                </div>
            </div>




        </div><!--/tab-content-->


    </div><!--/col-9-->
</div><!--/row-->

<?php
require('views/partials/footer.php');
?>

<script>
    // $("#menu-toggle").click(function(e) {
    //     e.preventDefault();
    //     $("#wrapper").toggleClass("toggled");
    // });
    // $("#menu-toggle-2").click(function(e) {
    //     e.preventDefault();
    //     $("#wrapper").toggleClass("toggled-2");
    //     $('#menu ul').hide();
    // });
    //
    // function initMenu() {
    //     $('#menu ul').hide();
    //     $('#menu ul').children('.current').parent().show();
    //     //$('#menu ul:first').show();
    //     $('#menu li a').click(
    //         function() {
    //             var checkElement = $(this).next();
    //             if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    //                 return false;
    //             }
    //             if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    //                 $('#menu ul:visible').slideUp('normal');
    //                 checkElement.slideDown('normal');
    //                 return false;
    //             }
    //         }
    //     );
    // }
    // $(document).ready(function() {
    //     initMenu();
    // });$("#menu-toggle").click(function(e) {
    //     e.preventDefault();
    //     $("#wrapper").toggleClass("toggled");
    // });
    // $("#menu-toggle-2").click(function(e) {
    //     e.preventDefault();
    //     $("#wrapper").toggleClass("toggled-2");
    //     $('#menu ul').hide();
    // });
    //
    // function initMenu() {
    //     $('#menu ul').hide();
    //     $('#menu ul').children('.current').parent().show();
    //     //$('#menu ul:first').show();
    //     $('#menu li a').click(
    //         function() {
    //             var checkElement = $(this).next();
    //             if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    //                 return false;
    //             }
    //             if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    //                 $('#menu ul:visible').slideUp('normal');
    //                 checkElement.slideDown('normal');
    //                 return false;
    //             }
    //         }
    //     );
    // }
    // $(document).ready(function() {
    //     initMenu();
    // });
    jQuery(function ($) {

        $(".sidebar-dropdown > a").click(function () {
            $(".sidebar-submenu").slideUp(200);
            if (
                $(this)
                    .parent()
                    .hasClass("active")
            ) {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .parent()
                    .removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .next(".sidebar-submenu")
                    .slideDown(200);
                $(this)
                    .parent()
                    .addClass("active");
            }
        });

        $("#close-sidebar").click(function () {
            $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function () {
            $(".page-wrapper").addClass("toggled");
        });


    });

    function appear() {
        var editForm = document.getElementById('edit');
        editForm.style.display = 'inline-block';
        editForm.style.minheight = 'calc(100vh - [footer height])'; // Show the form

        editForm.style.backgroundColor = '#fff'; // Optional: Set background color
        editForm.style.border = '1px solid #ccc'; // Optional: Set border

    }

    function hide() {
        var editForm = document.getElementById('edit');
        editForm.style.display = 'none';
    }

    function toggleTooltip() {
        const tooltip = document.getElementById('emailTooltip');
        const isVisible = tooltip.getAttribute('aria-hidden') === 'false';
        tooltip.setAttribute('aria-hidden', !isVisible);
    }

    function theme() {
        var slide = document.getElementById('sidebar');
        slide.style.backgroundColor = '#282c33';
    }

    /////////////////////////////////////////////////////////////////////
    function showToast(icon, title, buttonId) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: icon,
            title: title
        }).then(() => {
            // Hide the submit button after the toast is shown

        });
    }

    /////////////////////////////////////
    function validateForm(event) {
        event.preventDefault(); // Prevent form submission

        const firstName = document.querySelector('input[name="firstName"]').value.trim();
        const lastName = document.querySelector('input[name="lastName"]').value.trim();
        const email = document.querySelector('input[name="email"]').value.trim();
        const phone = document.querySelector('input[name="phone"]').value.trim();
        const city = document.querySelector('input[name="city"]').value.trim();
        const district = document.querySelector('input[name="district"]').value.trim();
        const street = document.querySelector('input[name="street"]').value.trim();
        const buildingNum = document.querySelector('input[name="b_number"]').value.trim();
        const imageInput = document.querySelector('input[name="image"]');

        let errors = [];

        // Check for empty fields
        if (!firstName) errors.push("First Name is required.");
        if (!lastName) errors.push("Last Name is required.");
        if (!email) errors.push("Email is required.");
        if (!phone) errors.push("Phone number is required.");
        if (!city) errors.push("City is required.");
        if (!district) errors.push("District is required.");
        if (!street) errors.push("Street is required.");
        if (!buildingNum) errors.push("Building number is required.");

        // Check for numeric characters in First Name, Last Name, and City
        const nameCityRegex = /[0-9]/;
        if (nameCityRegex.test(firstName)) errors.push("First Name cannot contain numbers.");
        if (nameCityRegex.test(lastName)) errors.push("Last Name cannot contain numbers.");
        if (nameCityRegex.test(city)) errors.push("City cannot contain numbers.");

        // Validate phone number: must start with '07' and have a total of 10 digits
        const phoneRegex = /^07\d{8}$/; // Matches '07' followed by exactly 8 digits
        if (!phoneRegex.test(phone)) {
            errors.push("Phone number must start with '07' and contain exactly 10 digits.");
        }

        // Validate email: should end with specified domains
        const emailDomainRegex = /^(.*?@(?:gmail\.com|outlook\.com|hotmail\.com|yahoo\.com))$/; // List of allowed domains
        if (!emailDomainRegex.test(email)) {
            errors.push("Email must be a valid address from Gmail, Outlook, Hotmail, or Yahoo.");
        }

        // Check for optional image file
        if (imageInput.files.length > 0) {
            const file = imageInput.files[0];
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validImageTypes.includes(file.type)) {
                errors.push("Image must be a JPEG, PNG, or GIF.");
            }
        }

        // If there are errors, display them; otherwise, submit the form
        if (errors.length > 0) {
            // Display errors using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: errors.map(err => `<p>${err}</p>`).join(''), // Display errors in a list
                confirmButtonText: 'OK'
            });
        } else {
            // If no errors, submit the form
            document.querySelector('form').submit();
        }
    }

    // Attach the validation function to the form
    document.querySelector('form').addEventListener('submit', validateForm);

    //////////////////////////////////
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });
</script>
