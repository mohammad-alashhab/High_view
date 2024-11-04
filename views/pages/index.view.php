<!-- End Header Area -->
<?php include("views/partials/header.php");

?>
<!-- start banner Area -->
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">
                    <!-- single-slide -->
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1>Gear Up for Adventure!</h1>
                                <p>Prepare for Your Next Journey with Top Outdoor Gear and Essentials!</p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="primary-btn" href="/category"><span class="lnr-txt">Explore Now</span></a>
                                    <span class="add-text text-uppercase"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid"  src="" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- single-slide -->
                    <div class="row single-slide">
                        <div class="col-lg-5">
                            <div class="banner-content">
                                <h1>Explore the <br> Latest Adventure Gear!</h1>
                                <p>Equip Yourself for the Wild: Discover the Best in Outdoor Gear!</p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="primary-btn" href="/category">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap">
    <div class="container">
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="../../views/public/images/features/f-icon1.png" loading="lazy" alt="">
                    </div>
                    <h6>Free Delivery</h6>
                    <p>Free Shipping on all order</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="../../views/public/images/features/f-icon2.png" loading="lazy" alt="">
                    </div>
                    <h6>Return Policy</h6>
                    <p>Free Shipping on all order</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="../../views/public/images/features/f-icon3.png" loading="lazy" alt="">
                    </div>
                    <h6>24/7 Support</h6>
                    <p>Free Shipping on all order</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="../../views/public/images/features/f-icon4.png" loading="lazy" alt="">
                    </div>
                    <h6>Secure Payment</h6>
                    <p>Free Shipping on all order</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end features Area -->
<!-- Start category Area -->
<div class="container bootstrap snippets bootdeys">
    <div class="row">
        <?php if (!empty($bestSeller)): ?>
            <div class="col-md-4 col-sm-6 custom-content-card">
                <div class="custom-card-big-shadow">
                    <div class="custom-card custom-card-just-text" data-background="color" data-color="blue" data-radius="none">
                        <div class="custom-content">
                            <h6 class="custom-category">Best Seller</h6>
                            <h4 class="custom-title"><a href="#"><?php echo $bestSeller[0]['category_name']; ?></a></h4>
                            <img loading="lazy" src="/views/public/images/product/<?php echo $bestSeller[0]['front_view']; ?>" alt="<?php echo $bestSeller[0]['category_name']; ?>" class="img-fluid">
                        </div>
                    </div> <!-- end custom-card -->
                </div>
            </div>
        <?php endif; ?>





        <?php if (!empty($discount)): ?>
            <div class="col-md-4 col-sm-6 custom-content-card">
                <div class="custom-card-big-shadow">
                    <div class="custom-card custom-card-just-text" data-background="color" data-color="brown" data-radius="none">
                        <div class="custom-content">
                            <h6 class="custom-category">Discount</h6>

                            <img loading="lazy" src="/views/public/images/product/<?php echo $discount[0]['front_view']; ?>" alt="<?php echo $discount[0]['name']; ?>" class="img-fluid">
                        </div>
                    </div> <!-- end custom-card -->
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($latestProduct)): ?>
            <div class="col-md-4 col-sm-6 custom-content-card">
                <div class="custom-card-big-shadow">
                    <div class="custom-card custom-card-just-text" data-background="color" data-color="purple" data-radius="none">
                        <div class="custom-content">
                            <h6 class="custom-category">New Arrival</h6>
                            <h4 class="custom-title"><a href="#"><?php echo $latestProduct[0]['name']; ?></a></h4>
                            <img loading="lazy" src="/views/public/images/product/<?php echo $latestProduct[0]['front_view']; ?>" alt="<?php echo $latestProduct[0]['name']; ?>" class="img-fluid">
                        </div>
                    </div> <!-- end custom-card -->
                </div>
            </div>
<?php endif;?>

    </div>
</div>




<!-- End category Area -->



<!--Latest and Best seller Products-->
<section class="owl-carousel active-product-area section_gap">
    <!-- Latest Products Section -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>New Arrivals</h1>
                        <p>Discover the latest products added to our collection! Shop now to find the newest styles and trends.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (!empty($latestProducts)): ?>
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <a href="/category/details?product_id=<?php echo $product['id']; ?>">
                                <img  loading="lazy"class="img-fluid" src="../../../views/public/images/product/<?= htmlspecialchars($product['front_view']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                <div class="product-details">
                                    <h6><?= htmlspecialchars($product['name']) ?></h6>
                                    <div class="price">
                                        <h6>$<?= number_format($product['newprice'] ?? $product['price'], 2) ?></h6>
                                        <?php if (isset($product['newprice'])): ?>
                                            <h6 class="l-through">$<?= number_format($product['price'], 2) ?></h6>
                                        <?php endif; ?>
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
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No latest products available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Best Seller Products Section -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Featured Products</h1>
                        <p>Explore our most popular items! These top-rated products are loved by our customers and are sure to impress.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (!empty($bestSellerProducts)): ?>
                    <?php foreach ($bestSellerProducts as $product): ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <a href="/category/details?product_id=<?php echo $product['id']; ?>">
                                <img loading="lazy" class="img-fluid" src="../../views/public/images/product/<?= htmlspecialchars($product['front_view']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                <div class="product-details">

                                    <h6><?= htmlspecialchars($product['name']) ?></h6>
                                    <div class="price">

                                        <h6>$<?= number_format($product['newprice'], 2) ?></h6>
                                        <?php if (isset($product['newprice']) && $product['newprice'] < $product['price']): ?>
                                            <h6 class="l-through">$<?= number_format($product['price'], 2) ?></h6>
                                        <?php endif; ?>
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
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No best sellers available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!--End Latest and Best seller Products-->

<!-- Start exclusive deal Area -->
<section class="exclusive-deal-area">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left">
                <?php if (!empty($expiryDates) && isset($expiryDates[0])): ?>  <!-- Check if there's an expiry date -->
                    <div class="row clock_sec clockdiv" id="clockdiv-global"
                         data-expiry-date="<?= htmlspecialchars($expiryDates[0]['expiry_date']) ?>">
                        <div class="col-lg-12">
                            <h1>Exclusive Hot Deal Ends Soon!</h1>
                            <p>Get these deals before they're gone!</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="row clock-wrap" id="clockdiv-global" data-expiry-date="<?= htmlspecialchars($expiryDates[0]['expiry_date']) ?>">
                                <div class="col clockinner1 clockinner">
                                    <h1 class="days"></h1>
                                    <span class="smalltext">Days</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="hours"></h1>
                                    <span class="smalltext">Hours</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="minutes"></h1>
                                    <span class="smalltext">Mins</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="seconds"></h1>
                                    <span class="smalltext">Secs</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="/category" class="primary-btn">Shop Now</a>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <strong>No active discounts currently.</strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="active-exclusive-product-slider">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="single-exclusive-slider">
                                <a href="/category/details?product_id=<?php echo $product['id']; ?>">
                                <img  loading="lazy" class="img-fluid" src="../../views/public/images/product/<?= htmlspecialchars($product['image']) ?>" >
                                <div class="product-details">
                                    <h6><?= $product['name'] ?></h6>
                                    <div class="price">
                                        <h6>$<?= number_format($product['new_price'], 2) ?></h6>
                                        <h6 class="l-through">$<?= number_format($product['price'], 2) ?></h6>
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
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <strong>No products available.</strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End exclusive deal Area -->









<!-- Start brand Area -->
<section class="brand-area section_gap">
    <div class="container">
        <div class="row">
            <a class="col single-img" href="#">
                <img  loading="lazy" class="img-fluid d-block mx-auto" src="/views/public/images/brand/1.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img  loading="lazy" class="img-fluid d-block mx-auto" src="/views/public/images/brand/2.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img loading="lazy" class="img-fluid d-block mx-auto" src="/views/public/images/brand/3.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img loading="lazy"  class="img-fluid d-block mx-auto" src="/views/public/images/brand/4.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="/views/public/images/brand/5.png" alt="">
            </a>
        </div>
    </div>
</section>
<!-- End brand Area -->

<!-- Start related-product Area -->
<div class="container custom-container">
    <h2 class="text-center my-4">What Our <span class="text-warning"> Customers</span> Are Saying </h2>
    <p class="text-center mb-4">Our customers love our outdoor gear! Discover how our products have enhanced their adventures and experiences in the great outdoors. Join the community of satisfied adventurers who trust us for their outdoor needs.</p>
    <div class="accordion d-flex justify-content-center align-items-center custom-height" id="accordionExample">
        <div class="row">
            <div class="col-md-6">
                <div class="p-3">
                    <ul class="custom-testimonial-list">
                        <li>
                            <div class="custom-card-test p-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex flex-row align-items-center">
                                    <img src="../../views/public/images/r7.jpg" width="50" class="rounded-circle">
                                    <div class="d-flex flex-column ml-2">
                                        <span class="font-weight-normal">Milton Austin</span>
                                        <span>Outdoor Enthusiast</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="custom-card-test p-3" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="d-flex flex-row align-items-center">
                                    <img src="../../views/public/images/r8.jpg" width="50" class="rounded-circle">
                                    <div class="d-flex flex-column ml-2">
                                        <span class="font-weight-normal">John Reeves</span>
                                        <span>Head of Sales, Outdoor Gear Co.</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="custom-card-test p-3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <div class="d-flex flex-row align-items-center">
                                    <img src="../../views/public/images/r9.jpg" width="50" class="rounded-circle">
                                    <div class="d-flex flex-column ml-2">
                                        <span class="font-weight-normal">Luke Harper</span>
                                        <span>Adventure Blogger</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 custom-testimonials-margin">
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <h4>Incredible hiking gear!</h4>
                            <div class="custom-ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>The hiking boots I bought have completely changed my outdoor experience. They are comfortable, durable, and have excellent grip on rocky terrains. Highly recommended for anyone who loves hiking!</p>
                        </div>
                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <h4>Amazing camping gear!</h4>
                            <div class="custom-ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>Just came back from a weekend camping trip using your tent and sleeping bag. The setup was super easy, and I stayed warm and dry despite the chilly nights. Thanks for providing quality gear!</p>
                        </div>
                    </div>

                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <h4>Perfect for my adventures!</h4>
                            <div class="custom-ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>I recently purchased a waterproof backpack, and it performed flawlessly during my kayaking trip. No water damage at all, and it was spacious enough for all my gear. Will be buying more products from you!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- End related-product Area -->

<!-- start footer Area -->
<?php  include("views/partials/footer.php"); ?>
<!-- End footer Area -->

