<?php
require_once "models/category.php";
require_once "services/adminService.php";

class categoryController
{
    private adminService $adminService;
    private ?category $model = null;
    public function __construct()
    {
        $this->adminService = new adminService();
        $this->model = new category();
    }
    function index() {
        $this->adminService->checkLoginAdmin();
        $title = "Quản trị loại sản phẩm";
        $view = "views/admin/category.php";
        $tatCaLoai = $this->model->readAll(); // Fetch all categoriest
        include "views/admin/layoutAdmin.php";
    }
    
    function add() {
        $this->adminService->checkLoginAdmin();
        $title = "Thêm loại sản phẩm";
        $view = "views/form/category/_create.php";
        include "views/admin/layoutAdmin.php";
    }

    function add_() {
        $this->adminService->checkLoginAdmin();
        $ten_loai = trim(strip_tags($_POST['ten_loai']));
        
        $this->model->create($ten_loai); // Add new category
        header("Location: category");
        exit();
    }

    function edit() {
        $this->adminService->checkLoginAdmin();
        global $params;
        $id_loai = $params['id'];
        
        if ($this->model->exists($id_loai)) {
            $loai = $this->model->read($id_loai); // Fetch category details
            $title = "Sửa loại sản phẩm";
            $view = "views/form/category/_edit.php";

            include "views/admin/layoutAdmin.php";
        } else {
            echo "Không tìm thấy loại sản phẩm.";
        }
    }

    function edit_() {
        $this->adminService->checkLoginAdmin();
        $id_loai = (int)$_POST['id_loai'];
        $ten_loai = trim(strip_tags($_POST['ten_loai']));
        
        if ($this->model->exists($id_loai)) {
            $this->model->update($id_loai, $ten_loai); // Update category
            header("Location: category");
            exit();
        } else {
            echo "Không tìm thấy loại sản phẩm.";
        }
    }

    function delete() {
        $this->adminService->checkLoginAdmin();
        global $params;
        $id_loai = $params['id'];
        
        if ($this->model->exists($id_loai)) {
            if ($this->model->delete($id_loai)) { // Delete category
                header("Location: category");
                exit();
            } else {
                echo "Xóa loại sản phẩm không thành công.";
            }
        } else {
            echo "Không tìm thấy loại sản phẩm để xóa.";
        }
    }
}