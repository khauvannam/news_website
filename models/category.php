<?php
require_once 'model.php';

class category extends model
{
    function create($name): false|string
    {
        $sql = "INSERT INTO category (name) 
                VALUES (:n)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":n", $name);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function read($id): array|false
    {
        $sql = "SELECT * FROM category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Read all categories
    public function readAll(): array
    {
        $sql = "SELECT * FROM category";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a category by ID
    public function update($id, $name): bool
    {
        $sql = "UPDATE category SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Delete a category by ID
    public function delete($id): bool
    {
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Check if a category exists by ID
    public function exists($id): bool
    {
        $sql = "SELECT COUNT(*) FROM category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

}