<?php require 'views/partials/header.php'; ?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#" >Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.php">Fashon Category</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <div class="container border mt-2 bg-">
        <div class="">
            <div class="container">
                <div class="row s_product_inner">
                    <div class="col-lg-6">
                        <div class="s_Product_carousel">
                            <div class="single-prd-item">
                                <img class="img-fluid" src="../views/public/images/product/<?php echo $product_images['front_view']?>" alt="">
                            </div>
                            <div class="single-prd-item">
                                <img class="img-fluid" src="../views/public/images/product/<?php echo $product_images['back_view']?>" alt="">
                            </div>
                            <div class="single-prd-item">
                                <img class="img-fluid" src="../views/public/images/product/<?php echo $product_images['side_view']?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <div class="s_product_text">
                            <h3><?php echo $product['name']?></h3>
                            <h2><?php echo $product['price']?></h2>
                            <ul class="list">
                                <li><span>category</span> : <?php echo $categories['name']?> </li>
                                <li><span>Availibility</span> : <?php echo $product['stock']?></a></li>
                                <li>size : <?php echo $product_sizes['size'];?></li>

                            </ul>
                            <p>Description : <?php echo $product['description']?></p>
                            <hr>
                            <div class="card_area  align-items-center">
                                <form action="/category/details/addCart" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="number" id="quantity" name="quantity" required min="1" placeholder="Enter Quantity">
                                    <button class="primary-btn m-3"> <i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                </form>


                                <form action="/category/details/create" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" class="btn btn-primary w-75">Add to Wishlist</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="product_description_area">
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <button class="btn primary-btn" onclick="showParagraph('para1')">Specification</button>
                    <button class="btn primary-btn" onclick="showParagraph('para2')">Reviews</button>


                </ul>

                <div id="para1" style="display: none;">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <h5>Width</h5>
                                </td>
                                <td>
                                    <h5><?php echo $product['width'].'cm'?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Height</h5>
                                </td>
                                <td>
                                    <h5><?php echo $product['height'].'cm'?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>weight</h5>
                                </td>
                                <td>
                                    <h5><?php echo $product['weight'].'gm'?></h5>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>Quality checking</h5>
                                </td>
                                <td>
                                    <h5><?php echo $product['quality_checking']?></h5>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>






            <div class="tab-content para2" id="para2"  style="display: none;>

    <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row total_rate">
                        <div class="col-6">
                            <div class="box_total">
                                <h5>Overall</h5>
                                <h4><?php echo  number_format($avg,1) ?></h4>
                                <h6><?php echo $count?> Reviews</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rating_list">
                                <h3>Based on 3 Reviews</h3>
                                <ul class="list">
                                    <li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                    <li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                    <li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                    <li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                    <li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="review_list">




                        <?php $reviewCount = count($reviews); ?>
                        <div id="reviewContainer">
                            <?php foreach ($reviews as $index => $review): ?>
                                <div class="review_item border <?php echo $index >= 2 ? 'd-none' : ''; ?>">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="<?php echo $review['img']; ?>" alt="" loading="lazy" width="150px" height="200px">
                                        </div>

                                        <div class="media-body">
                                            <h4><?php echo htmlspecialchars($review['first_name'] . ' ' . $review['last_name']); ?></h4>

                                            <!-- Display star rating based on review rating -->
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fa fa-star<?php echo $i <= $review['rate'] ? '' : '-o'; ?>"></i>
                                            <?php endfor; ?>

                                            <hr>
                                            <p><?php echo htmlspecialchars($review['review']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Show More Button (only visible if there are more than 2 reviews) -->
                        <?php if ($reviewCount > 2): ?>
                            <button id="showMoreButton" class="btn btn-primary mt-3" onclick="showMoreReviews()">Show More</button>
                        <?php endif; ?>



                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="review_box">
                        <h4>Add a Review</h4>
                        <p>Your Rating:</p>
                        <ul class="list">
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                        </ul>
                        <p>Outstanding</p>
                        <form class="row contact_form" action="/review/store" method="POST" id="contactForm" novalidate="novalidate">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="Review" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" id="rate" name="rate" required>
                                        <option value="" disabled selected>Select your rating</option>
                                        <?php for ($i = 0; $i <= 5; $i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" value="submit" class="primary-btn">Submit Now</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    </div>
    </div>




    </div>
    </ul>
    </div>







    </div>




    <script>
        function showParagraph(paragraphId) {
            // Hide all paragraphs
            document.getElementById("para1").style.display = "none";
            document.getElementById("para2").style.display = "none";

            // Show the selected paragraph
            document.getElementById(paragraphId).style.display = "block";
        }
        function showMoreReviews() {
            // Get all review items with class 'd-none' and remove 'd-none' class to show them
            const hiddenReviews = document.querySelectorAll('.review_item.d-none');
            hiddenReviews.forEach(review => {
                review.classList.remove('d-none');
            });

            // Hide the "Show More" button after revealing all reviews
            document.getElementById('showMoreButton').style.display = 'none';
        }
    </script>


<?php require 'views/partials/footer.php';?>