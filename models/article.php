<?php

require_once 'model.php';

class Article extends model
{
    // Retrieve all articles
    public function getAllArticles(): array
    {
        $sql = "SELECT id, title, image, date, views, content, visible FROM articles";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Save a new article with the current date
    public function saveArticle(
        string $title,
        string $image,
        string $content,
        int $visible
    ): int|false {
        $sql = "INSERT INTO articles (title, image, date, content, visible) 
                VALUES (:title, :image, NOW(), :content, :visible)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":visible", $visible);

        return $stmt->execute() ? (int)$this->conn->lastInsertId() : false;
    }

    // Get details of a specific article by ID
    public function getArticleDetails(int $id): array|false
    {
        $sql = "SELECT id, title, image, date, views, content, visible 
                FROM articles 
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing article by ID
    public function updateArticle(
        int $id,
        string $title,
        string $image,
        string $content,
        int $visible
    ): bool {
        $sql = "UPDATE articles 
                SET title = :title, image = :image, 
                    content = :content, visible = :visible 
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":visible", $visible);
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
