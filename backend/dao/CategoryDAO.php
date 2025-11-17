<?php
class CategoryDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createCategory($category_name) {
        $stmt = $this->conn->prepare("INSERT INTO category (category_name) VALUES (?)");
        $stmt->bind_param("s", $category_name);
        return $stmt->execute();
    }

    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM category WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getAllCategories() {
        $result = $this->conn->query("SELECT * FROM category");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function updateCategory($id, $category_name) {
        $stmt = $this->conn->prepare("UPDATE category SET category_name = ? WHERE category_id = ?");
        $stmt->bind_param("si", $category_name, $id);
        return $stmt->execute();
    }

    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM category WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
