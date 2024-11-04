<?php include("views/partials/header.php"); ?>
<!-- End Header Area -->

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-center">
            <div class="col-first text-center">
                <h1>Our Blog</h1>
                <nav class="d-flex justify-content-center">
                    <a href="/">Home <span class="lnr lnr-arrow-right"></span></a>
                    <a href="/blog">Blog</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Area =================-->
<section class="blog_area section_padding" style="background-color: #f8f9fa; padding: 40px 0;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="blog_left_sidebar">
                    <?php if (!empty($paginatedArticles)) : ?>
                        <?php foreach ($paginatedArticles as $element): ?>
                            <article class="row blog_item align-items-center mb-5" style="border: 1px solid #e0e0e0; border-radius: 8px; background-color: #ffffff; transition: transform 0.3s, box-shadow 0.3s; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                <div class="col-md-4" style="padding: 0;">
                                    <div class="blog_image" style="overflow: hidden; border-radius: 8px 0 0 8px; height: 250px;">
                                        <img src="views/public/images/category/<?php echo htmlspecialchars($element['featured_img']); ?>" alt="Blog Image" class="img-fluid h-100 w-100 object-fit-cover">
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding: 0;">
                                    <div class="blog_post p-4" style="background-color: #f9f9f9; border-radius: 0 8px 8px 0;">
                                        <a href="/blog/<?php echo htmlspecialchars($element['id']); ?>" class="text-decoration-none text-dark">
                                            <h2 class="blog_title mb-2" style="font-size: 1.5rem; font-weight: bold;"><?php echo htmlspecialchars($element['title']); ?></h2>
                                        </a>
                                        <ul class="blog_meta list-inline mb-3 text-muted">
                                            <li class="list-inline-item"><i class="lnr lnr-calendar-full"></i> <?php echo htmlspecialchars($element['created_at']); ?></li>
                                            <li class="list-inline-item"><i class="lnr lnr-eye"></i> <?php echo htmlspecialchars($element['views']); ?></li>
                                        </ul>
                                        <p class="blog_excerpt mb-4" style="color: #555;"><?php echo htmlspecialchars($element['descreption']); ?></p>
                                        <form method="get" action="/blog/<?= $element['id']?>">
                                        <a href="/blog/<?php echo htmlspecialchars($element['id']); ?>" class="btn btn-outline-warning btn-sm rounded-pill shadow-sm text-warning">
                                            <i class="bi bi-arrow-right me-1"></i> Read More
                                        </a>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">No articles available.</p>
                    <?php endif; ?>

                    <!-- Pagination -->
                    <div class="pagination" style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                        <?php if ($currentPage > 1): ?>
                            <a href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous Page"
                               class="btn me-3"
                               style="background-color: #ffc107; color: white; border: 1px solid #ffc107; padding: 0.375rem 0.75rem; border-radius: 0.25rem; width: 30px; justify-content: center;' : 'background-color: transparent;  "">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>"
                               class="btn me-2"
                               aria-label="Page <?php echo $i; ?>"
                               style="<?php echo $i == $currentPage ? 'background-color: #ffc107; color: white; border: 1px solid #ffc107; padding: 0.375rem 0.75rem; border-radius: 0.25rem; width: 30px; justify-content: center;' : 'background-color: transparent; color: #ffc107; border: 1px solid #ffc107; padding: 0.375rem 0.75rem; text-decoration: none; transition: background-color 0.3s, color 0.3s; border-radius: 0.25rem; width: 30px; justify-content: center;'; ?> display: flex; align-items: center;">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                            <a href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next Page"
                               class="btn ms-3"
                               style="background-color: #ffc107; color: white; border: 1px solid #ffc107; padding: 0.375rem 0.75rem; border-radius: 0.25rem; width: 30px; justify-content: center;' : 'background-color: transparent;  ">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>





                </div>
            </div>
        </div>
    </div>
</section>









<!--================Blog Area =================-->

<!-- Start Footer Area -->
<?php include("views/partials/footer.php"); ?>
