<?php

require_once './models/user.php';

class userController
{
    private user $model;

    function __construct()
    {
        $this->model = new user;
    }

    function register(): void
    {
        $titlePage = "Đăng ký thành viên";
        $view = "views/form/user/_register.php";
        include "views/layout.php";
    }

    function register_(): void
    {
        // Retrieve and sanitize form data
        $firstName = trim(strip_tags($_POST['firstName']));
        $lastName = trim(strip_tags($_POST['lastName']));
        $email = trim(strip_tags($_POST['email']));
        $password = trim(strip_tags($_POST['password']));

        // Set default isAdmin value to 0
        $isAdmin = 0;

        // Save user to the database using saveUser method
        $id_user = $this->model->saveUser($firstName, $lastName, $email, $password, $isAdmin);

        // Check if registration was successful
        if ($id_user) {
            echo "User registered successfully with ID: " . $id_user;
        } else {
            echo "Failed to register user.";
        }
    }

    function login(): void
    {
        $titlePage = "Đăng nhập";
        $view = "views/form/_login.php";
        include "views/layout.php";
    }

    function login_(): void
    {
        // Sanitize and retrieve form inputs
        $email = trim(strip_tags($_POST['email']));
        $password = trim(strip_tags($_POST['password']));

        // Check user credentials
        $user = $this->model->checkUser($email, $password);

        if (is_array($user)) {
            // Set session variables if login is successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];

            header("Location: home.php");
        } else {
            // If login fails, set view for login page with error message
            $titlePage = "Login";
            $view = "login.php";
            $error = "Incorrect login information";
            include "views/layout.php";
        }
    }

    function logout_(): void
    {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        // Redirect to homepage
        header("Location: home.php");
    }

    function change_pass(): void
    {
        $titlePage = "Change Password";
        $view = "changepass.php";
        include "views/layout.php";
    }

    function change_pass_(): void
    {
        // Get the user's email from session
        $email = $_SESSION['email'];

        // Retrieve and sanitize current and new passwords
        $currentPassword = trim(strip_tags($_POST['currentPassword']));
        $newPassword1 = trim(strip_tags($_POST['newPassword1']));
        $newPassword2 = trim(strip_tags($_POST['newPassword2']));

        // Check if current password is correct
        $result = $this->model->checkUser($email, $currentPassword);
        if (!is_array($result)) {
            echo "Current password is incorrect.";
            return;
        }

        // Check if the new passwords match
        if ($newPassword1 !== $newPassword2) {
            echo "The new passwords do not match.";
            return;
        }

        // Hash the new password
        $hashedPassword = password_hash($newPassword1, PASSWORD_BCRYPT);

        $this->model->changePassword($email, $hashedPassword);
    }
}