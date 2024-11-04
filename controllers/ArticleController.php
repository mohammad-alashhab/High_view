<?php
require 'model/Articles.php';

class ArticleController
{
    public function show() {
        $articles = new Articles();

        // Pagination logic
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 4; // Define how many items you want per page
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Get paginated articles
        $paginatedArticles = $articles->getPaginatedArticles($itemsPerPage, $offset);

        // Count total articles for pagination
        $totalArticles = $articles->countAllArticles();
        $totalPages = ceil($totalArticles / $itemsPerPage);

        // Retrieve article ID from query parameter



        // Pass paginated articles and other data to the view
        require 'views/pages/blog.view.php';
    }



    public function showSingle($id){
        $articles = new Articles();

    if ($id) {
        $article = $articles->find($id);

        if ($article) {
            $newViewCount = $article['views'] + 1;
            $articles->views($newViewCount, $id);
        } else {

            echo "Article not found.";
            return;
        }
        require 'views/pages/singleBlog.view.php';
    }

}
}