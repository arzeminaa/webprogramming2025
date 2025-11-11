<?php
class UserDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllUsers() {
        $result = $this->conn->query("SELECT * FROM user");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createUser($username, $password, $email) {
        $stmt = $this->conn->prepare("INSERT INTO user (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $email);
        return $stmt->execute();
    }

    public function updateUser($id, $username, $password, $email) {
        $stmt = $this->conn->prepare("UPDATE user SET username = ?, password = ?, email = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $username, $password, $email, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getUserByEmail($email) {
    $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
}
?>
