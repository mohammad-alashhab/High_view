<?php require 'views/partials/header.php'; ?>
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shop Category page</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="/user/fav" >Favorite<span class="lnr lnr-arrow-right"></span></a>

                </nav>
            </div>
        </div>
    </div>
</section>
<section class="container mt-3">
<h5>Favorite</h5>
<hr>
<div class="products hover " style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
     <?php
        if (isset($_SESSION['user'])) {
  if (!empty($favorites)) {
         foreach ( $favorites as $favorite): ?>
            <div class="single-product m-1 border shadow-lg p-3 bg-white rounded hoveer">
                <a href="/category/details?product_id=<?php echo $favorite['product_id']; ?>">
                    <img class="img-fluid" src="../views/public/images/product/<?php echo $favorite['front_view']; ?>" loading="lazy">
                    <hr>
                    <div class="product-details">
                        <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;"><?php echo htmlspecialchars($favorite['product_name']); ?></h3>
                        <div class="price">
                            <p>Price: $<?php echo htmlspecialchars($favorite['price']); ?></p>
                        </div>
                    </div>
                </a>
                <div class="prd-bottom">
                    <form action="/category/details/addCart" method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $favorite['product_id']; ?>">
                        <input type="hidden" id="quantity" name="quantity" value="1">
                        <button type="submit" class="btn btn-warning w-100 mb-2">
                            <i class="fa fa-shopping-cart"></i> Add to Cart
                        </button>
                    </form>
                    <form action="/category/details/create" method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $favorite['product_id'] ?>">
                        <button id="wishlistButton" type="submit" class="btn btn-primary w-100" onclick="toggleWishlist()">Add to Wishlist</button>
                    </form>
                </div>

            </div>
         <?php endforeach;}}else{
                            echo"<h3>Please Log In First To View Your Favorites </h3>";
                        } ?>
</div>

</section>
<hr>
<?php require 'views/partials/footer.php'; ?>
