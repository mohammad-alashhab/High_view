<?php require 'partials/header.php' ?>
<h5>Reviews History</h5>
<hr>

<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                <h5 class="mb-0 mb-4">Your Ratings and Reviews</h5>
            </div>
            <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                <h5 class="mb-1">All Ratings and Reviews</h5>
                <div class="reviews-members pt-4 pb-4">

                    <div class="media">
                        <?php foreach ($reviews as $review): ?>
                            <a href="#">
                                <img alt="Generic placeholder image"
                                     src="../../views/public/images/product/<?php echo $review['front_view'] ?>"
                                     class="mr-3 rounded-pill"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </a>
                            <div class="media-body">
                                <div class="reviews-members-header">
                                    <span class="star-rating float-right">
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating"></i></a>
                                    </span>

                                    <h6 class="mb-1"><a style="color: #0b0b0b" href="#"><?php echo $review['product_name'] ?></a></h6>
                                    <p class="text-gray"><?php echo $review['created_at'] ?></p>
                                </div>
                                <div class="reviews-members-body">
                                    <p><?php echo $review['review'] ?> </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <hr>
            </div>
        </div>
    </div>
</div>

<hr>

<?php require 'partials/footer.php' ?>
