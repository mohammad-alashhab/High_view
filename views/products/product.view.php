<?php require 'views/partials/header.php'; ?>
<style>
    .custom-alert {
        padding: 15px 20px;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        max-width: 500px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        position: fixed;
        top: 20px; /* Position it at the top */
        left: 50%; /* Center horizontally */
        transform: translateX(-50%); /* Center adjustment */
        z-index: 1000; /* Ensure it appears above other content */
        opacity: 1;
        transition: opacity 0.5s ease, transform 0.5s ease;
        transform: translateY(0);
    }

    .alert-success {
        background-color: #4CAF50;
    }

    .alert-danger {
        background-color: #f44336;
    }

    /* Fade out animation */
    .custom-alert.fade-out {
        opacity: 0;
        transform: translateY(-10px);
    }

    .hoveer:hover{

        color:#ffb900 ;
        transform: scale(1.03);
        transition: 0.8s;
        border: 2px solid #ffb900 !important ;
        border-radius: 20px !important;
    }
    .link-hover{
        color: gray;
    }
    .link-hover:hover{
        color: #ffb900 !important;
        transform: scale(1.03);
        transition: 0.3s;

    }

</style>


<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shop Category page</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="/category" >Shop</a>

                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<?php if (isset($_GET['message'])): ?>
    <div class="custom-alert alert-success" id="alert-message">
        <?php echo htmlspecialchars($_GET['message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="custom-alert alert-danger" id="alert-message">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>




<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">
                <ul>
                    <div class="head" style="background-color: #ffb900">Browse Categories</div>
                    <?php
                    // Loop through the categories and print
                    foreach ($categories as $category) { ?>
                        <div class="d-flex border">
                            <a href="/category/filter?category_id=<?php echo $category['id']; ?>" class="link-hover">
                                <img src="../views/public/images/category/<?php echo $category['img']; ?>" alt="" width="50px" height="50px" class="mr-3 border rounded">
                                <?php echo $category['name'] . "   <i class='fa-solid fa-arrow-right'></i><br>"; ?>
                            </a>
                        </div>
                    <?php } ?>
                </ul>

            </div>




        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center " style="background-color: #ffb900">

                <form method="POST" action="/category" id="sortForm">
                    <div class="sorting">
                        <select name="sort" onchange="this.form.submit()">
                            <option value="all">ALL</option>
                            <option value="oldest">Oldest</option>
                            <option value="newest">Newest</option>
                            <option value="price">Price</option>
                        </select>
                    </div>
                </form>

                <div class="sorting mr-auto">


                </div>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" <?php echo $i == $currentPage ? 'class="active"' : ''; ?>>
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?php echo $currentPage + 1; ?>">Next</a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Filter Bar -->



            <div class="products hover" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
                <?php if (!empty($products)) {
                    foreach ($products as $product) { ?>
                        <div class="single-product m-1 border shadow-lg p-3 bg-white rounded hoveer">
                            <a href="/category/details?product_id=<?php echo $product['id']; ?>">
                                <img class="img-fluid" src="../views/public/images/product/<?php echo $product['front_view']; ?>" loading="lazy">
                                <hr>
                                <div class="product-details">
                                    <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;"><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <div class="price">
                                        <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                                    </div>
                                </div>
                            </a>
                            <div class="prd-bottom">
                                <form action="/category/details/addCart" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" id="quantity" name="quantity" value="1">
                                    <button type="submit" class="btn btn-warning w-100 mb-2">
                                        <i class="fa fa-shopping-cart"></i> Add to Cart
                                    </button>
                                </form>
                                <form action="/category/details/create" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button id="wishlistButton" type="submit" class="btn btn-primary w-100" onclick="toggleWishlist()">Add to Wishlist</button>
                                </form>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>




            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" <?php echo $i == $currentPage ? 'class="active"' : ''; ?>>
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?php echo $currentPage + 1; ?>">Next</a>
                <?php endif; ?>
            </div>


        </div>
        </section>
        <!-- End Best Seller -->
        <!-- Start Filter Bar -->


    </div>
    <!-- End Filter Bar -->
</div>
</div>
</div>

<!-- Start related-product Area -->
<section class="related-product-area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Deals of the Week</h1>
                    <p>Here you will find the best deals</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9"> <!-- Changed to col-lg-9 to allow for the advertisement column -->
                <div class="row">
                    <?php foreach ($discount as $product): ?>
                        <div class="col-md-4 mb-4"> <!-- Moved this line to make sure each product is inside the row -->
                            <a href="/category/details?product_id=<?php echo $product['id']; ?>">
                                <div class="product-item border p-3 h-100 text-center">
                                    <img src="../views/public/images/product/<?php echo htmlspecialchars($product['img']); ?>" alt="Product Image" class="img-fluid mb-3" style="height: 200px; width: auto;">
                                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                                    <p>Original Price: <del>$<?php echo number_format($product['price'], 2); ?></del></p>
                                    <p>Discounted Price: $<?php echo number_format($product['newprice'], 2); ?></p>
                                    <p class="text-warning">Discount Valid from: <br> <?php echo htmlspecialchars($product['startdate']); ?> <i class="fa-solid fa-arrow-right"></i> <?php echo htmlspecialchars($product['enddate']); ?></p>
                                </div>
                            </a>
                            <form action="/category/details/addCart" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" id="quantity" name="quantity" value="1">
                                <button type="submit" class="btn btn-warning w-100 mb-2">
                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                            <form action="/category/details/create" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button id="wishlistButton" type="submit" class="btn btn-primary w-100" onclick="toggleWishlist()">Add to Wishlist</button>
                            </form>
                        </div> <!-- Closing the product item div here -->
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="../../views/public/images/category/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End related-product Area -->

<!-- start footer Area -->
<!-- End footer Area -->

<!-- Modal Quick Product View -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="container relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="product-quick-view">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="quick-view-carousel">
                            <div class="item" style="background: url(img/organic-food/q1.jpg);">

                            </div>
                            <div class="item" style="background: url(img/organic-food/q1.jpg);">

                            </div>
                            <div class="item" style="background: url(img/organic-food/q1.jpg);">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="quick-view-content">
                            <div class="top">
                                <h3 class="head">Mill Oil 1000W Heater, White</h3>
                                <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
                                <div class="category">Category: <span>Household</span></div>
                                <div class="available">Availibility: <span>In Stock</span></div>
                            </div>
                            <div class="middle">
                                <p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
                                    looking for something that can make your interior look awesome, and at the same time give you the pleasant
                                    warm feeling during the winter.</p>
                                <a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
                            </div>
                            <div class="bottom">
                                <div class="color-picker d-flex align-items-center">Color:
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                </div>
                                <div class="quantity-container d-flex align-items-center mt-15">
                                    Quantity:
                                    <input type="text" class="quantity-amount ml-15" value="1" />
                                    <div class="arrow-btn d-inline-flex flex-column">
                                        <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                                        <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                    </div>

                                </div>
                                <div class="d-flex mt-20">
                                    <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
                                    <a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
                                    <a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Hide the alert after 2 seconds with fade-out effect
    setTimeout(function() {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.classList.add('fade-out'); // Add fade-out effect
            setTimeout(() => alert.style.display = 'none', 500); // Wait for fade-out to finish
        }
    }, 2000);


    function toggleWishlist() {
        const button = document.getElementById('wishlistButton');
        if (button.innerHTML === "Add to Wishlist") {
            button.innerHTML = "Remove from Wishlist";
            button.classList.remove('btn-primary');
            button.classList.add('btn-danger');
        } else {
            button.innerHTML = "Add to Wishlist";
            button.classList.remove('btn-danger');
            button.classList.add('btn-primary');
        }
    }
</script>

<?php require 'views/partials/footer.php'; ?>
