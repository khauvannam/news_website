<?php

require_once 'model.php';


class user extends Model
{
    // Save a new user to the database
    public function saveUser(string $firstName, string $lastName, string $email, string $password): int|false
    {
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:fn, :ln, :em, :pwd)";
        $stmt = $this->conn->prepare($sql);

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":fn", $firstName);
        $stmt->bindParam(":ln", $lastName);
        $stmt->bindParam(":em", $email);
        $stmt->bindParam(":pwd", $hashPassword);

        return $stmt->execute() ? (int)$this->conn->lastInsertId() : false;
    }

    // Check if a user exists with the given email and password
    public function checkUser(string $email, string $password): string|array
    {
        $sql = "SELECT * FROM users WHERE email = :em";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":em", $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return "Email does not exist";
        }

        return password_verify($password, $user['password'] ?? '') ? $user : "Incorrect password";
    }

    // Change the password for a user with the given email
    public function changePassword(string $email, string $newPassword): bool|string
    {
        $sql = "UPDATE users SET password = :pwd WHERE email = :em";
        $stmt = $this->conn->prepare($sql);


        $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt->bindParam(":em", $email);
        $stmt->bindParam(":pwd", $newPassword);

        $stmt->execute();

        return $stmt->rowCount() === 1 ? true : "Update failed";
    }
}
