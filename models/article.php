<?php

require_once 'model.php';

class Article extends Model
{
    // Retrieve all articles with category information
    public function getAllArticles(): array
    {
        $sql = "SELECT a.id, a.title, a.image, a.date, a.views, a.content, a.visible, c.name AS category 
                FROM articles a
                JOIN categories c ON a.category_id = c.id";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Save a new article with category ID and the current date
    public function saveArticle(
        string $title,
        string $image,
        string $content,
        int $visible,
        int $category_id
    ): int|false {
        $sql = "INSERT INTO articles (title, image, date, content, visible, category_id) 
                VALUES (:title, :image, NOW(), :content, :visible, :category_id)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
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
        int $id,
        string $title,
        string $image,
        string $content,
        int $visible,
        int $category_id
    ): bool {
        $sql = "UPDATE articles 
                SET title = :title, image = :image, 
                    content = :content, visible = :visible, category_id = :category_id
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":visible", $visible);
        $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Delete an article by ID
    public function deleteArticle(int $id): bool
    {
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
