
<?php require 'partials/header.php'?>


      <h5>New Arrivals</h5>
      <hr>

      <div class="row">

          <?php foreach ($products as $product): ?>
          <div class="col-lg-4 col-md-6">
              <div class="single-product">
                  <img class="img-fluid" src="../../views/public/images/product/<?php echo $product['front_view']; ?>" alt="">
                  <div class="product-details">
                      <h6><?php echo $product['name']; ?></h6>
                      <div class="price">
                          <h6><?php echo $product['price'] ?></h6>

                      </div>
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
          <?php endforeach;?>
      </div>
        <hr>


      </div>
      <hr>
 <?php require 'partials/footer.php'?>
