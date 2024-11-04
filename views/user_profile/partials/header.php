
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $isLoggedIn = isset($_SESSION['user']);
    ?>
    <script>
        const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
    </script>
    <script>
        const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;

        document.addEventListener("DOMContentLoaded", function () {
            const loginButton = document.getElementById("login-button");
            const signupButton = document.getElementById("signup-button");
            const logoutButton = document.getElementById("logout-button");

            if (isLoggedIn) {
                loginButton.style.display = "none";
                signupButton.style.display = "none";
                logoutButton.style.display = "block";
            } else {
                loginButton.style.display = "block";
                signupButton.style.display = "block";
                logoutButton.style.display = "none";
            }
        });

        // Handle logout
        logoutButton.addEventListener("click", async function () {
            try {
                const response = await fetch('/logout', { method: 'POST' });
                if (response.ok) {
                    window.location.reload(); // Refresh the page
                } else {
                    console.error("Logout failed");
                }
            } catch (error) {
                console.error("Error during logout:", error);
            }
        });
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <link rel="shortcut icon" href="../../../views/public/images/done.png">
    <title>User Profile</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../views/public/css/userProfile/style.css">
    <link rel="stylesheet" href="../../../views/public/css/userProfile/popover.css">
    <link rel="stylesheet" href="../../../views/public/css/linearicons.css">
	<link rel="stylesheet" href="../../../views/public/css/owl.carousel.css">
	<link rel="stylesheet" href="../../../views/public/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../../views/public/css/themify-icons.css">
	<link rel="stylesheet" href="../../../views/public/css/nice-select.css">
	<link rel="stylesheet" href="../../../views/public/css/nouislider.min.css">
	<link rel="stylesheet" href="../../../views/public/css/bootstrap.css">
	<link rel="stylesheet" href="../../../views/public/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://kit.fontawesome.com/8510d63d0e.js" crossorigin="anonymous"></script>


</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
          <a class="navbar-brand logo_h" href="/"><img src="../../views/public/images/done.png" alt="" height="70px" width="75px"></a>
        <a href="/user/profile">Profile </a>


        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <?php


        ?>


      <div class="sidebar-header">
        <div class="user-pic">
          <img loading="lazy" class="img-responsive img-rounded" src="../../views/public/images/users/<?php echo  $_SESSION['img']?>" alt="User picture" height="70px" width="75px">
        </div>
        <div class="user-info">
          <span class="user-name" style="color:black ; font-size:16px;">
          <?php echo $_SESSION['firstName'] ?>
            <strong><?php echo    $_SESSION['secondName'] ?></strong>
          </span>

          <span class="user-role">Customer</span>

        </div>
      </div>
      <!-- sidebar-header  -->

      <!-- sidebar-search  -->
      <div class="sidebar-menu">
  <ul>
    <li class="header-menu">
      <span>Account Overview</span>
    </li>
    <li class="">
      <a href="/user">
        <i class="fa fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="">
      <a href="/user/profile">
        <i class="fa fa-user"></i>
        <span>Profile Information</span>
      </a>
    </li>


    <li class="header-menu">
      <span>Shopping Information</span>
    </li>
    <li>
      <a href="/user/order">
        <i class="fa fa-shopping-bag"></i>
        <span>Orders</span>
      </a>
    </li>
    <li>
      <a href="/user/fav">
        <i class="fa fa-heart"></i>
        <span>Favorites</span>
      </a>
    </li>
    <li>
      <a href="/user/review">
        <i class="fa fa-star"></i>
        <span>Reviews</span>
      </a>
    </li>

    <li class="header-menu">
      <span>Support & Communication</span>
    </li>
    <li>
      <a href="/user/contact">
        <i class="fa fa-history"></i>
        <span>Contact History</span>
      </a>
    </li>
    <li>


    <li class="header-menu">
      <span>Settings</span>
    </li>
    <li>
      <a href="/logout">
        <i class="fa fa-sign-out-alt"></i>
        <span>Log Out</span>
      </a>
    </li>
  </ul>
</div>

      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->

  </nav>
    <main class="page-content">
        <div class="container-fluid">
            <h2>Welcome back,<?php echo $_SESSION['firstName'] ;?>! </h2>
            <div class="text-end">
                <a href="/" class="btn btn-outline-warning btn-sm rounded-pill shadow-sm">
                    <i class="bi bi-house-door me-1"></i>Back to Home
                </a>
            </div>




            <hr>
            <div class="row">
                <div class="form-group col-md-12">
                    <h3>Your adventure <a href="/" style="color:#FFBA01">Gear</a> awaits—let's get you ready for your next journey!</h3>
                    <h6><a href="/" style="color:#FFBA01"> Explore our gear </a>and embark on your next journey with confidence!</h6>
                </div>

                <div class="form-group col-md-12">
                    <div class="alert alert alert-warning" role="alert">
                        <h4 class="alert-heading">Explore What's New!</h4>
                        <p>Discover our latest collection of outdoor gear designed for adventurers like you! From cutting-edge equipment to stylish apparel, explore what’s new and gear up for your next adventure.</p>

                    </div>

                </div>
            </div>