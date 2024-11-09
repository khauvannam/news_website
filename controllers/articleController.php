<?php

require_once 'models/article.php';

class ArticleController
{
    private article $articleModel;

    public function __construct()
    {
        $this->articleModel = new Article();
    }

    // Retrieve all articles
    public function index(): void
    {
        $articles = $this->articleModel->getAllArticles();
        $titlePage = "All Articles";
        $view = "views/articles/index.php"; // Assuming you have a view for listing articles
        include "views/layout.php";
    }

    // Show the form for creating a new article
    public function create(): void
    {
        $title = "Create Article";
        $view = "views/form/article/_create.php"; // Assuming you have a form view for creating an article
        include "views/layout.php";
    }

    // Store a new article in the database
    public function store(): void
    {
        // Retrieve form data
        $title = trim(strip_tags($_POST['title']));
        $image = trim(strip_tags($_POST['image']));
        $content = trim(strip_tags($_POST['content']));
        $visible = (int)$_POST['visible'];
        $category_id = (int)$_POST['category_id'];

        // Save the article
        $articleId = $this->articleModel->saveArticle($title, $image, $content, $visible, $category_id);

        if ($articleId) {
            header("Location: articles.php?action=index"); // Redirect to article list
        } else {
            echo "Failed to save article.";
        }
    }

    // Display a specific article
    public function show($id): void
    {
        $article = $this->articleModel->getArticleDetails($id);

        if ($article) {
            $titlePage = $article['title'];
            $view = "views/articles/show.php"; // Assuming a detail view
            include "views/layout.php";
        } else {
            echo "Article not found.";
        }
    }

    // Show the form for editing an article
    public function edit($id): void
    {
        $article = $this->articleModel->getArticleDetails($id);

        if ($article) {
            $titlePage = "Edit Article";
            $view = "views/articles/edit.php"; // Assuming an edit view
            include "views/layout.php";
        } else {
            echo "Article not found.";
        }
    }

    // Update an existing article in the database
    public function update(): void
    {
        $id = (int)$_POST['id'];
        $title = trim(strip_tags($_POST['title']));
        $image = trim(strip_tags($_POST['image']));
        $content = trim(strip_tags($_POST['content']));
        $visible = (int)$_POST['visible'];
        $category_id = (int)$_POST['category_id'];

        $success = $this->articleModel->updateArticle($id, $title, $image, $content, $visible, $category_id);

        if ($success) {
            header("Location: articles.php?action=index"); // Redirect to article list
        } else {
            echo "Failed to update article.";
        }
    }

    // Delete an article
    public function delete($id): void
    {
        $success = $this->articleModel->deleteArticle($id);

        if ($success) {
            header("Location: articles.php?action=index"); // Redirect to article list
        } else {
            echo "Failed to delete article.";
        }
    }
}
