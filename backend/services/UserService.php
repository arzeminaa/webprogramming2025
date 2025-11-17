<?php
require_once __DIR__ . '/../dao/UserDAO.php';

class UserService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new UserDAO($conn);
    }

    public function getAllUsers() {
        return $this->dao->getAllUsers();
    }

    public function getUserById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid user ID");
        }
        return $this->dao->getUserById($id);
    }

    public function createUser($data) {
        if (empty($data['username']) || empty($data['password']) || empty($data['email'])) {
            throw new Exception("All fields are required");
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        return $this->dao->createUser($data['username'], $data['password'], $data['email']);
    }

    public function updateUser($id, $data) {
        if (empty($data['username']) || empty($data['email'])) {
            throw new Exception("Username and email are required");
        }
        return $this->dao->updateUser($id, $data['username'], $data['password'], $data['email']);
    }

    public function deleteUser($id) {
        return $this->dao->deleteUser($id);
    }

    public function getUserByEmail($email) {
    return $this->dao->getUserByEmail($email);
}

}
?>
