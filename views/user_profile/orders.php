<?php require 'partials/header.php'; ?>
      <h5>Purchase History</h5>
      <hr>


    <div class="container py-5">
        <h2 class="mb-4 fw-bold">Order History</h2>
<!--        this is the start of teh cards -->
        <div class="container mb-4 container-order">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card card-order total-orders-card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title card-title-order">
                                <i class="fas fa-list"></i> Total Orders
                            </h5>
                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Total orders in the system</h6>
                            <p class="card-text card-text-order">Displays the total number of orders placed.</p>
                            <h5 class="card-title card-title-order"><?= $totalOrders ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-order delivered-orders-card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title card-title-order">
                                <i class="fas fa-truck"></i> Delivered Orders
                            </h5>
                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders that have been delivered</h6>
                            <p class="card-text card-text-order">Displays the number of orders that have been successfully delivered.</p>
                            <h5 class="card-title card-title-order"><?=  $deliveredOrders ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-order pending-orders-card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title card-title-order">
                                <i class="fas fa-clock"></i> Pending Orders
                            </h5>
                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders awaiting confirmation</h6>
                            <p class="card-text card-text-order">Displays the number of orders that are still pending.</p>
                            <h5 class="card-title card-title-order"><?= $pendingOrders?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-order processing-orders-card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title card-title-order">
                                <i class="fas fa-cog"></i> Processing Orders
                            </h5>
                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders currently being processed</h6>
                            <p class="card-text card-text-order">Displays the number of orders currently being processed.</p>
                            <h5 class="card-title card-title-order"><?= $processingOrders?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-order shipped-orders-card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title card-title-order">
                                <i class="fas fa-shipping-fast"></i> Shipped Orders
                            </h5>
                            <h6 class="card-subtitle card-subtitle-order mb-2 text-muted">Orders that have been shipped</h6>
                            <p class="card-text card-text-order">Displays the number of orders that have been shipped.</p>
                            <h5 class="card-title card-title-order"><?=  $shippedOrders?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-order canceled-orders-card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title card-title-order">
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


        <!--        this is the endddddd of the cards -->


        <div class="row mb-4 g-3">


            <div class="col-md-6 text-md-end">
                <form method="GET" action="/user/order">
                    <select class="form-select w-auto shadow-sm" name="status" onchange="this.form.submit()">
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
            <?php foreach ($ordersData as $order): ?>
                <div class="card mb-4 order-item shadow-sm" tabindex="0">
                    <div class="card-body">
                        <!-- Order Header -->
                        <div class="row align-items-center mb-3">
                            <div class="col-md-3">
                                <h6 class="mb-0 fw-bold">#ORD-2023-00<?= htmlspecialchars($order['order_id']) ?></h6>
                                <small class="text-muted">Order placed at <?= (new DateTime($order['created_at']))->format('Y-m-d H:i') ?></small>
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
                                    <h6 class="mb-1 fw-bold text-uppercase">Shipping Address</h6>
                                    <small class="text-muted" style="white-space: nowrap;">
                                        Shipped to <?= htmlspecialchars($order['shipping_address']) ?>
                                    </small>
                                </div>
                                <?php if ($order['order_status'] !='Delivered'  && $order['order_status'] !='Cancelled' ){?>
                                <div class="col-md-5 text-end">
                                    <button class="btn btn-outline-danger btn-sm rounded-pill shadow-sm">
                                        <i class="bi bi-trash me-1"></i><a href="/user/order/cancel/<?= $order['order_id']?>/<?= $order['order_status'] ?>"> Cancel Order</a>
                                    </button>
                                </div>
                                <?php } ?>
                            </div>

                        </div>

                        <hr class="my-3">

                        <!-- Ordered Items List -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="mb-3 fw-bold">Ordered Items:</h6>
                                <div class="ordered-items">
                                    <?php foreach ($order['items'] as $item): ?>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-2">
                                                <img src="../../views/public/images/product/<?= htmlspecialchars($item['front_view']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="img-fluid rounded product-thumbnail shadow-sm">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



    </div>


   <?php require 'partials/footer.php'; ?>