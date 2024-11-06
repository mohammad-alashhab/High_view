<?php require 'views/partials/header.php'; ?>
<style>
    .rating {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 4px;
    }

    .rating input {
        display: none;
    }

    .rating label {
        cursor: pointer;
        width: 36px;
        height: 36px;
        background-size: contain;
        background-repeat: no-repeat;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='36' height='36' viewBox='0 0 24 24' fill='none' stroke='%23ffd700' stroke-width='2'%3E%3Cpolygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/%3E%3C/svg%3E");
        transition: transform 0.2s ease;
    }

    .rating input:checked~label,
    .rating label:hover,
    .rating label:hover~label {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='36' height='36' viewBox='0 0 24 24' fill='%23ffd700' stroke='%23ffd700' stroke-width='2'%3E%3Cpolygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/%3E%3C/svg%3E");
        transform: scale(1.1);
    }

    .rating-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: inline-block;
    }

    .rating-title {
        font-family: system-ui, -apple-system, sans-serif;
        color: #333;
        margin-bottom: 12px;
        font-size: 16px;
    }
</style>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shop Category page</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                    
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
                            <img class="img-fluid"
                                src="../views/public/images/product/<?php echo $product_images['front_view'] ?>" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid"
                                src="../views/public/images/product/<?php echo $product_images['back_view'] ?>" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid"
                                src="../views/public/images/product/<?php echo $product_images['side_view'] ?>" alt="">

            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/category" >Shop<span class="lnr lnr-arrow-right"></span></a>

                    </nav>
                </div>

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

<div class="container border mt-2 bg-">
    <div class="">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid"
                                src="../views/public/images/product/<?php echo $product_images['front_view'] ?>" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid"
                                src="../views/public/images/product/<?php echo $product_images['back_view'] ?>" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid"
                                src="../views/public/images/product/<?php echo $product_images['side_view'] ?>" alt="">

                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3><?php echo $product['name'] ?></h3>
                        <h2><?php echo $product['price'] ?></h2>
                        <ul class="list">
                            <li><span>category</span> : <?php echo $categories['name'] ?> </li>
                            <li><span>Availibility</span> : <?php echo $product['stock'] ?></a></li>
                            <li>size : <?php echo $product_sizes['size']; ?></li>

                        </ul>
                        <p>Description : <?php echo $product['description'] ?></p>
                        <hr>
                        <div class="card_area  align-items-center">
                            <form action="/category/details/addCart" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="number" class="w-25" id="quantity" name="quantity" required min="1"
                                    placeholder="Enter Quantity">
                                <button class="primary-btn m-3"> <i class="fa fa-shopping-cart"></i> Add to
                                    Cart</button>
                            </form>

                            </ul>
                            <p>Description : <?php echo $product['description']?></p>
                            <hr>
                            <div class="card_area  align-items-center">
                                <form action="/category/details/addCart" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="number" id="quantity" name="quantity" required min="1" placeholder="Enter Quantity"
                                           style="width: 170px; height:42px; padding: 10px 15px; font-size: 16px; border: 2px solid #ddd;
               border-radius: 6px; outline: none; transition: border-color 0.3s ease, box-shadow 0.3s ease;"
                                           onfocus="this.style.borderColor='#3085d6'; this.style.boxShadow='0 0 5px rgba(48, 133, 214, 0.3)';"
                                           onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none';">
                                    <button  class="primary-btn m-3"> <i class="fa fa-shopping-cart"></i> Add to Cart</button>
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
                                    <h5><?php echo $product['width'] . 'cm' ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Height</h5>
                                </td>
                                <td>
                                    <h5><?php echo $product['height'] . 'cm' ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>weight</h5>
                                </td>
                                <td>
                                    <h5><?php echo $product['weight'] . 'gm' ?></h5>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>Quality checking</h5>
                                </td>
                                <td>
                                    <h5><?php echo $product['quality_checking'] ?></h5>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>






        <div class="tab-content para2" id="para2" style="display: block;">

            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Overall</h5>
                                    <h4><?php echo number_format($avg, 1) ?></h4>
                                    <h6><?php echo $count ?> Reviews</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Based on 3 Reviews</h3>
                                    <ul class="list">
                                        <li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i> 01</a></li>
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
                                                <img src="<?php echo $review['img']; ?>" alt="" loading="lazy" width="150px"
                                                    height="200px">
                                            </div>


                        <?php $reviewCount = count($reviews); ?>
                        <div id="reviewContainer">
                            <?php foreach ($reviews as $index => $review): ?>
                                <div class="review_item border <?php echo $index >= 2 ? 'd-none' : ''; ?>">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="../views/public/images/users/<?php echo $review['user_img']; ?>" alt="" loading="lazy" width="150px" height="150px">
                                        </div>


                                            <div class="media-body">
                                                <h4><?php echo htmlspecialchars($review['first_name'] . ' ' . $review['last_name']); ?>
                                                </h4>

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
                                <button id="showMoreButton" class="btn btn-primary mt-3" onclick="showMoreReviews()">Show
                                    More</button>
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

                                                <div class="rating-container">
                                                    <div class="rating-title">Rate your experience</div>
                                                    <div class="rating">
                                                        <input type="radio" name="rating" id="star5" value="5">
                                                        <label for="star5" title="5 stars"></label>

                                                        <input type="radio" name="rating" id="star4" value="4">
                                                        <label for="star4" title="4 stars"></label>

                                                        <input type="radio" name="rating" id="star3" value="3">
                                                        <label for="star3" title="3 stars"></label>

                                                        <input type="radio" name="rating" id="star2" value="2">
                                                        <label for="star2" title="2 stars"></label>

                                                        <input type="radio" name="rating" id="star1" value="1">
                                                        <label for="star1" title="1 star"></label>
                                                    </div>
                                                </div>

                                        <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="primary-btn">Submit Now</button>
                                </div>
                            </form>

                        <script>
                            document.querySelectorAll('.rating input').forEach(input => {
                                input.addEventListener('change', (e) => {
                                    console.log('Selected rating:', e.target.value);
                                });
                            });
                        </script>
                                

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


<?php require 'views/partials/footer.php'; ?>