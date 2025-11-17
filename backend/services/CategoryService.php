<?php
require_once __DIR__ . '/../dao/CategoryDAO.php';

class CategoryService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new CategoryDAO($conn);
    }

    public function getAllCategories() {
        return $this->dao->getAllCategories();
    }

    public function getCategoryById($id) {
        return $this->dao->getCategoryById($id);
    }

    public function createCategory($data) {
        if (empty($data['category_name'])) {
            throw new Exception("Category name is required");
        }
        return $this->dao->createCategory($data['category_name']);
    }

    public function updateCategory($id, $data) {
        if (empty($data['category_name'])) {
            throw new Exception("Category name is required");
        }
        return $this->dao->updateCategory($id, $data['category_name']);
    }

    public function deleteCategory($id) {
        return $this->dao->deleteCategory($id);
    }
}
