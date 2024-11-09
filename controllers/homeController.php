<?php

class homeController
{
    public function index(): void
    {
        $title = "Vina Office - Trang chủ";
        $view = "home.php";
        include "views/layout.php";
    }
}