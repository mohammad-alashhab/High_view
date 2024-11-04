<?php require 'partials/header.php'; ?>
<h5>Favorite</h5>
<hr>

<div class="row">
    <?php foreach ($favorites as $favorite): ?>
        <div class="col-lg-4 col-md-6">
            <div class="single-product">
                <img class="img-fluid" src="../../views/public/images/product/<?php echo $favorite['front_view']; ?>" alt="">
                <div class="product-details">
                    <h6><?php echo $favorite['product_name']; ?></h6>
                    <div class="price">
                        <h6><?php echo $favorite['price'] ?></h6>
                        <!-- <h6 class="l-through">$210.00</h6> -->
                    </div>
                    <div class="prd-bottom">
                        <a href="" class="social-info">
                            <span class="ti-bag"></span>
                            <p class="hover-text">add to bag</p>
                        </a>
                        <a href="" class="social-info">
                            <span class="lnr lnr-heart"></span>
                            <p class="hover-text">Wishlist</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<hr>
<?php require 'partials/footer.php'; ?>
