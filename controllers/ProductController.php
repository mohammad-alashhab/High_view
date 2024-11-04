<?php
require_once ('model/Product.php');

require 'model/Category.php';
require 'model/Type.php';
require 'model/Product_images.php';
require 'model/Product_sizes.php';
require 'model/UserReviews.php' ;
require 'model/Discount.php';

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new Product();

    }






    public function showLatestProducts() {
        $latestProducts = $this->model->getLatestProducts();

        require 'views/pages/index.view.php';
    }

    public function showComingProducts() {
        $comingProducts = $this->model->getComingProducts();
        require 'views/pages/index.view.php';
    }
    public function showSliderProducts() {
        $products = $this->model->getProductsForSlider();
        $expiryDates = $this->model->getProductDiscountExpiryDates();
        require 'views/pages/index.view.php';
    }




    public function index() {

        $bestSellerProducts = $this->model->getBestSellersProduct();
        if (empty($bestSellerProducts)) {
            $bestSellerProducts = [['front_view' => 'default.jpg', 'name' => 'No Best Seller Available']];
        }
        $bestSeller = $this->model->getBestSellers(); // Ensure this returns an array
        if (empty($bestSeller)) {
            // Handle case when no best sellers are found
            $bestSeller = ['front_view' => 'default.jpg', 'name' => 'No Best Seller Available'];}
        $package = $this->model->getRandomPackage();
        $category = $this->model->getRandomCategory();
        $discount = $this->model->getRandomDiscountProduct();
        $latestProduct = $this->model->getRandomLatestProduct();
        $products = $this->model->getProductsForSlider();
        $expiryDates = $this->model->getProductDiscountExpiryDates();
        $latestProducts = $this->model->getLatestProducts();
        $comingProducts = $this->model->getComingProducts();
//        var_dump($bestSeller, $package, $category, $discount, $latestProduct);
//        die(); // Temporarily stop script to inspect output

//        dd($comingProducts);
        // Ensure you are correctly assigning values to view variables
        require 'views/pages/index.view.php';
    }

    public function show()
    {
        $product = new Product();
        $category = new Category();

        $discount = new Discount();
        $discounts = $discount->all();
        $categories = $category->all();
        $type = new Type();
        $types = $type->all();
        $discount = $product->getDiscountedProducts();

        // Pagination parameters
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 9;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Get paginated products and total count
        $products = $product->getPaginatedProducts($itemsPerPage, $offset);
        $totalProducts = $product->countAllProducts();
        $totalPages = ceil($totalProducts / $itemsPerPage);

        // Retrieve images for each product
        foreach ($products as &$prod) {
            $prod['front_view'] = $product->getImageByProductId($prod['id'])['front_view'] ?? 'default.jpg';
        }

        require 'views/products/product.view.php';
    }


    public function filter()
    {
        $product = new Product();
        $category = new Category();
        $categories = $category->all();
        $type = new Type();
        $types = $type->all();


        $discount = new Discount();
        $discounts = $discount->all();
        $discount = $product->getDiscountedProducts();



        $sort = $_POST['sort'] ?? 'all';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 9;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Determine sorting method based on `sort` parameter
        switch ($sort) {
            case 'price':
                $products = $product->orderByPrice();
                break;
            case 'newest':
                $products = $product->orderBytimeNew();
                break;
            case 'oldest':
                $products = $product->orderBytimeOld();
                break;
            default:
                $products = $product->all();
                break;
        }

        // Implement pagination for filtered products
        $totalProducts = count($products);
        $totalPages = ceil($totalProducts / $itemsPerPage);
        $products = array_slice($products, $offset, $itemsPerPage);

        foreach ($products as &$prod) {
            $prod['front_view'] = $product->getImageByProductId($prod['id'])['front_view'] ?? 'default.jpg';
        }


        require 'views/products/product.view.php';
    }



    public function categoryFilter()
    {
        $product = new Product();
        $category = new Category();
        $categories = $category->all();
        $discount = new Discount();
        $discounts = $discount->all();
        $discount = $product->getDiscountedProducts();
        $type = new Type();
        $types = $type->all();


        // Check if the category is set from POST or GET
        if (isset($_POST['categorySort'])) {
            $this->category = $_POST['categorySort'];
        } elseif (isset($_GET['category_id'])) {
            $this->category = $_GET['category_id'];
        } else {
            // Handle case when no category is selected
            $this->category = null; // or set a default category
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 9;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Filter products by category and apply pagination
        $products = $product->orderByCategory($this->category);
        $totalProducts = count($products);
        $totalPages = ceil($totalProducts / $itemsPerPage);
        $products = array_slice($products, $offset, $itemsPerPage);

        foreach ($products as &$prod) {
            $prod['front_view'] = $product->getImageByProductId($prod['id'])['front_view'] ?? 'default.jpg';
        }


        require 'views/products/product.view.php';
    }

    public function filterProducts()
    {
        $category = new Category();
        $categories = $category->all();

        $product = new Product();
        $discount = new Discount();
        $discounts = $discount->all();
        $discount = $product->getDiscountedProducts();
        $type = new Type();
        $types = $type->all();

        $typeId = $_POST['type_id'] ?? null;

        if ($typeId) {
            // Filter products by the selected type_id
            $products = $product->getProductsByTypeId($typeId);
        } else {
            // If no type is selected, get all products
            $products = $product->all();

        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 9;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Filter products by category and apply pagination
        $products = $product->orderByCategory($this->category);
        $totalProducts = count($products);
        $totalPages = ceil($totalProducts / $itemsPerPage);
        $products = array_slice($products, $offset, $itemsPerPage);

        foreach ($products as &$prod) {
            $prod['front_view'] = $product->getImageByProductId($prod['id'])['front_view'] ?? 'default.jpg';
        }






        require 'views/products/product.view.php';
    }




    public function showDetails(){
        $product = new Product();
        $product_image = new Product_images();
        $product_size = new Product_sizes();
        $product_review = new User_reviews();
        $category = new Category();
        $review = new User_reviews();



        $id = $_GET['product_id'];
        $productDetails = $product->find($id);
        $reviews = $review->getReviewsByProductId($id);
        // Assuming you have a method to get product details

        $categories = $category->getCategoryName($id);
        $product = $product->find($id);
        $product_images = $product_image->getProductImg($id);
        $product_sizes = $product_size->getProductSize($id);
        $product_reviews = $product_review->getProductReviews($id); // All reviews
        $avg = $product_review->AVGRate($id);
        $count = $product_review->countReview($id);
        $user_reviews_name = $product_review->getUserName($id);

        require 'views/products/productDetails.view.php';
    }
    public function showDetailsSearch($id) // Use the $id parameter directly
    {
        // Ensure the product ID is an integer
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            // Handle invalid ID with a redirect or an error message
            header("Location: /error?message=Invalid product ID.");
            exit; // Exit after redirecting
        }

        // Fetch product details from the model
        $product = new Product();
        $productDetails = $product->find($id); // Assuming this method exists
dd($productDetails);
        if ($productDetails) {
            // Render your view with the product details
            header("Location:views/products/searchResults.view.php");
            exit;
        } else {
            // Handle case when the product is not found
            header("Location: /error?message=Product not found.");
            exit; // Exit after redirecting
        }
    }




}