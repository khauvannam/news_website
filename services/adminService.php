
<?php

class adminService
{
    function checkLoginAdmin() {
        if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
            $_SESSION['back'] = $_SERVER['REQUEST_URI'];
            header("location: login");
            exit();
        }
    }
}