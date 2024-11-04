<?php include("views/partials/header.php"); ?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Blog Page</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="/blog">Blog</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================ Blog Area =================-->
<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <!-- Blog Content Area -->
            <div class="col-lg-8 col-md-10 mx-auto posts-list">
                <div class="single-post shadow-sm p-4 mb-5 bg-white rounded">
                    <!-- Featured Image -->
                    <div class="feature-img mb-4 text-center">
                        <img class="img-fluid rounded"
                             src="../views/public/images/category/<?php echo htmlspecialchars($article['featured_img']); ?>"
                             alt="Featured Image"
                             style="width: 100%; max-height: 500px; object-fit: cover;">
                    </div>
                    <!-- Article Title -->
                    <div class="blog_details">
                        <h2 class="text-warning text-center mb-4">
                            <?php echo htmlspecialchars($article['title']); ?>
                        </h2>
                        <!-- Article Description -->
                        <p class="text-muted lead text-center mb-3">
                            <?php echo htmlspecialchars($article['descreption']); ?>
                        </p>
                        <!-- Article Body -->
                        <p class="text-secondary" style="line-height: 1.7; font-size: 1.1rem;">
                            <?php echo nl2br(htmlspecialchars($article['body'])); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Blog Area =================-->

<!-- Start Footer Area -->
<?php include("views/partials/footer.php"); ?>
