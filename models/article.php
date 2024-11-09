<?php

require_once 'model.php';

class Article extends Model
{
    // Retrieve all articles with category information
    public function getAllArticles(): array
    {
        $sql = "SELECT a.id, a.title, a.date, a.views, a.content, a.visible, c.name AS category 
                FROM articles a
                JOIN categories c ON a.category_id = c.id";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Save a new article with category ID and the current date
    public function saveArticle(
        string $title,
        string $content,
        int    $visible,
        int    $category_id,

    ): int|false
    {
        $sql = "INSERT INTO articles (title, created_at, content, visible, category_id) 
                VALUES (:title, NOW(), :content, :visible, :category_id)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":visible", $visible);
        $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);

        return $stmt->execute() ? (int)$this->conn->lastInsertId() : false;
    }

    // Get details of a specific article by ID, including category name
    public function getArticleDetails(int $id): array|false
    {
        $sql = "SELECT a.id, a.title, a.image, a.date, a.views, a.content, a.visible, c.name AS category 
                FROM articles a
                JOIN categories c ON a.category_id = c.id 
                WHERE a.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing article by ID with category ID

    public function updateArticle(
        int    $id,
        string $title,
        string $content,
        int    $visible,
        int    $category_id
    ): bool
    {
        // Retrieve current content and image
        $sql = "SELECT content, image FROM articles WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$currentData) {
            return false; // Article not found
        }

        $currentContent = $currentData['content'];
        $currentImage = $currentData['image'];

        // Extract image paths from current and new content
        $currentImages = $this->extractImagePaths($currentContent);
        $newImages = $this->extractImagePaths($content);

        // Identify images to delete
        $imagesToDelete = array_diff($currentImages, $newImages);
        foreach ($imagesToDelete as $imagePath) {
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }

        // Handle the main image update
        $updatedImage = $currentImage;
        if (!empty($image)) { // If a new image is provided
            if ($currentImage && file_exists($currentImage)) {
                unlink($currentImage); // Delete old main image
            }
            $updatedImage = $image; // Set new image
        }

        // Update the article with new content and main image
        $sql = "UPDATE articles 
            SET title = :title,
                content = :content, visible = :visible, category_id = :category_id
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":visible", $visible);
        $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

// Helper function to extract image paths from HTML content
    private function extractImagePaths(string $content): array
    {
        $imagePaths = [];
        $dom = new DOMDocument();
        @$dom->loadHTML($content); // Suppress warnings for invalid HTML
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            $imagePaths[] = $_SERVER['DOCUMENT_ROOT'] . parse_url($src, PHP_URL_PATH);
        }

        return $imagePaths;
    }

    public function deleteArticle(int $id): bool
    {
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
