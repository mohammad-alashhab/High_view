<?php
session_start();
require 'vendor/autoload.php';
require 'functions.php';
require 'app/Router.php';

$isLoggedIn = isset($_SESSION['user']);
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

// User dashboard routes
$router->get('/user', 'UserDashboardController@show');
$router->get('/user/fav', 'UserDashboardController@getfavorite');
$router->get('/user/order/cancel/{id}/{status}', 'UserDashboardController@cancelOrder');
$router->post('/user/edit', 'UserDashboardController@edit');

// User registration routes
$router->get('/login', "UserController@showlogin");
$router->get('/register', "UserController@showregister");
$router->get('/reset', "UserController@showreset");
$router->get('/forgot', "UserController@showforgot");
$router->post('/register', "UserController@registerUser");
$router->post('/login', "UserController@loginUser");
$router->get('/logout', "UserController@logoutUser");

// Review route
$router->post('/review/store', 'ReviewController@store');

// Contact routes
$router->get('/contact', "ContactController@showContact");
$router->post('/contact/submitMessage', 'ContactController@submitMessage');

// Static pages
$router->get('/terms', "PagesController@showterms");
$router->get('/delivery', "PagesController@delivery");
$router->get('/about', 'PagesController@aboutUs');

// Blog routes
$router->get('/blog', 'ArticleController@show');
$router->get('/blog/{id}', 'ArticleController@showSingle');

// Home page and product routes
$router->get('/', 'ProductController@index');

$router->get('/category', 'ProductController@show');



$router->get('/category/home', 'ProductController@showCategory');
$router->get('/discount', 'ProductController@showDiscount');
$router->get('/product', 'ProductController@showProduct');
$router->get('/best-seller', 'ProductController@showBestSeller');
$router->get('/packages', 'ProductController@showPackage');
$router->get('/latest-products', 'ProductController@showLatestProducts');
$router->get('/search', 'SearchController@handleSearch');

// Order checkout routes
$router->get('/confirmation', 'ConfirmationController@getOrderInfo');
$router->post('/confirmation/edit', 'ConfirmationController@editUserInfo');
$router->get('/cart', 'CartController@showCart');
$router->post('/cart/delete/{id}', 'CartController@deleteFromCart');
$router->post('/cart/add', 'CartController@store');
$router->post('/cart/coupon', 'CartController@applyCoupon');
$router->post('/cart/update', 'CartController@updateCart');
$router->post('/saveOrder', 'ConfirmationController@confirmOrder');



// Product and category routes
$router->get('/category/details', 'ProductController@showDetails');
$router->post('/category', 'ProductController@filter');
$router->get('/category/filter', 'ProductController@categoryFilter');
$router->post('/category/details/create', 'FavoriteController@store');
$router->post('/category/details/addCart', 'CartController@store');

// Dispatch the current request URI with optional POST data
$requestedRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $router->dispatch($requestedRoute, $_POST);
} else {
    $router->dispatch($requestedRoute);
}
