

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="../../views/public/images/done.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>High view</title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="../../views/public/css/linearicons.css">
	<link rel="stylesheet" href="../../views/public/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../views/public/css/themify-icons.css">
	<link rel="stylesheet" href="../../views/public/css/bootstrap.css">
	<link rel="stylesheet" href="../../views/public/css/owl.carousel.css">
	<link rel="stylesheet" href="../../views/public/css/nice-select.css">
	<link rel="stylesheet" href="../../views/public/css/nouislider.min.css">
	<link rel="stylesheet" href="../../views/public/css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="../../views/public/css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="../../views/public/css/magnific-popup.css">
	<link rel="stylesheet" href="../../views/public/css/main.css">
    <link rel="stylesheet" href="../../views/public/css/404style.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/faqs/faq-3/assets/css/faq-3.css">

	<script src="https://kit.fontawesome.com/8510d63d0e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    $isLoggedIn = isset($_SESSION['user']);
    ?>

    <script>
        const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;

        document.addEventListener("DOMContentLoaded", function () {
            const loginButton = document.getElementById("login-button");
            const signupButton = document.getElementById("signup-button");
            const logoutButton = document.getElementById("logout-button");
            const userProfileButton = document.getElementById("user-profile-button");

            if (isLoggedIn) {
                loginButton.style.display = "none";
                signupButton.style.display = "none";
                logoutButton.style.display = "block";
                userProfileButton.style.display = "block"; // Show user profile
            } else {
                loginButton.style.display = "block";
                signupButton.style.display = "block";
                logoutButton.style.display = "none";
                userProfileButton.style.display = "none"; // Hide user profile
            }

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
        });
    </script>


</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="/"><img src="../../views/public/images/done.png" alt="" height="80px" width="85px"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
						<li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
							
							<li class="nav-item"><a class="nav-link" href="/category">Shop</a></li>
					
							<li class="nav-item"> <a class="nav-link" href="/blog">Blog</a></li>

							<li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
							
							
							<li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
							<li > <a class="nav-link custom-btn2" href="/login"  id="login-button"> Login</a></li>
							<li ><a class="nav-link custom-btn2" href="/register" id="signup-button"> Sign Up</a></li>
                            <li><a class="nav-link custom-btn2" id="user-profile-button" href="/user" style="display: none;">User Profile</a></li>
                            <li><a class="nav-link custom-btn2" href="/logout" style="display: none" id="logout-button"> Logout</a></li>
							
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="/cart" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
        <div class="search_input" id="search_input_box" >
            <div class="container">

                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">

                       <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>

                <div id="searchResults" class="position-absolute bg-white border mt-2" style="display: none; z-index: 1000; width: 95%;">
                </div>
            </div>
        </div>

    </header>